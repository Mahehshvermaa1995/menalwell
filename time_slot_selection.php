<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot Selection</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        .time-slot {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .time-slot:hover {
            background-color: #f5f5f5;
        }

        .time-slot-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3></h3>
        <!-- Date Selection Dropdown -->
        <div class="row">
            <div class="col-md-6">
                <label for="datepicker">Select Date:</label>
                <select id="datepicker" class="form-control">
                    <?php
                    // PHP code to generate options for next 30 days
                    for ($i = 0; $i < 30; $i++) {
                        $date = date('Y-m-d', strtotime("+$i days"));
                        echo "<option value='$date'>$date</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="timeSlots" class="row">
                    <?php
                    // Include database connection
                    include_once 'sql_connection.php';

                    // Initialize selected date to current date
                    $selectedDate = date('Y-m-d');

                    // Check if doctor_id is provided in the GET parameters
                    if (isset($_GET['doctor_id'])) {
                        // Get doctor_id from GET parameters
                        $doctorId = $_GET['doctor_id'];

                        // Fetch booked slots from the book_appointments table for the specific doctor
                        $bookedSlots = array();
                        $bookedQuery = "SELECT appointment_time FROM book_appointments WHERE doctor_id = $doctorId";
                        $bookedResult = $conn->query($bookedQuery);

                        // Fetch data from clinics table for the specific doctor
                        $clinicQuery = "SELECT * FROM clinics WHERE doctor_id = $doctorId";
                        $clinicResult = $conn->query($clinicQuery);

                        // Check for errors in clinic query
                        if (!$clinicResult) {
                            echo "Error fetching clinics: " . $conn->error;
                        } else {
                            // Fetch existing appointments for the selected date
                            $existingAppointmentsQuery = "SELECT appointment_date, appointment_time FROM appointments WHERE doctor_id = $doctorId AND appointment_date = '$selectedDate'";
                            $existingAppointmentsResult = $conn->query($existingAppointmentsQuery);
                            $existingAppointments = array();
                            if ($existingAppointmentsResult && $existingAppointmentsResult->num_rows > 0) {
                                while ($row = $existingAppointmentsResult->fetch_assoc()) {
                                    $existingAppointments[] = $row;
                                }
                            }

                            // Function to generate time slots with 30-minute intervals for a specific date
                            function generateTimeSlots($startTime, $endTime, $bookedSlots, $existingAppointments)
                            {
                                $slots = array();
                                $currentTime = strtotime($startTime);
                                $endTime = strtotime($endTime);
                                while ($currentTime <= $endTime) {
                                    $slot = date('h:i A', $currentTime);
                                    // Check if slot is available (not booked and not overlapping with existing appointments)
                                    if (!in_array($slot, $bookedSlots) && !isOverlappingAppointment($slot, $existingAppointments)) {
                                        $slots[] = $slot;
                                    }
                                    $currentTime += 1800; // Add 30 minutes
                                }
                                return $slots;
                            }

                            // Function to check if a time slot overlaps with existing appointments
                            function isOverlappingAppointment($slot, $existingAppointments)
                            {
                                foreach ($existingAppointments as $appointment) {
                                    $startDateTime = date('Y-m-d H:i:s', strtotime($appointment['appointment_date'] . ' ' . $appointment['appointment_time']));
                                    $endDateTime = date('Y-m-d H:i:s', strtotime($startDateTime . ' +30 minutes')); // Assuming appointments are 30 minutes long
                                    $checkSlot = date('Y-m-d H:i:s', strtotime($appointment['appointment_date'] . ' ' . $slot));

                                    if ($checkSlot >= $startDateTime && $checkSlot < $endDateTime) {
                                        return true; // Overlapping appointment found
                                    }
                                }
                                return false; // No overlapping appointment found
                            }

                            // Pass $bookedSlots to the frontend
                            echo "<script>var bookedSlots = " . json_encode($bookedSlots) . ";</script>";

                            if ($clinicResult->num_rows > 0) {
                                // Loop through each clinic
                                while ($row = $clinicResult->fetch_assoc()) {
                                    // Generate time slots
                                    $morningSlots = generateTimeSlots($row['MorningStartTime'], $row['MorningEndTime'], $bookedSlots, $existingAppointments);
                                    $afternoonSlots = generateTimeSlots($row['AfternoonStartTime'], $row['AfternoonEndTime'], $bookedSlots, $existingAppointments);
                                    $eveningSlots = generateTimeSlots($row['EveningStartTime'], $row['EveningEndTime'], $bookedSlots, $existingAppointments);

                                    // Display time slots for morning, afternoon, and evening
                                    echo "<div class='clinic-time-slots col-md-12' data-clinic-id='" . $row['ClinicID'] . "'>";
                                    echo "<div class='time-slot-group row'>";
                                    echo "<h5>Morning Slots:</h5>";
                                    foreach ($morningSlots as $slot) {
                                        echo "<a class='time-slot col-3'
                                    href='book_appointment.php?doctor_id=$doctorId&time=" . urlencode($slot) . "&day=Morning&date=$selectedDate&clinic_id=" . $row['ClinicID'] . "'>
                                     $slot
                                 </a>";
                                    }
                                    echo "</div>";
                                    echo "<div class='time-slot-group row'>";
                                    echo "<h5>Afternoon Slots:</h5>";
                                    foreach ($afternoonSlots as $slot) {
                                        echo "<a class='time-slot col-3'
                                    href='book_appointment.php?doctor_id=$doctorId&time=" . urlencode($slot) . "&day=Afternoon&date=$selectedDate&clinic_id=" . $row['ClinicID'] . "'>
                                     $slot
                                 </a>";
                                    }
                                    echo "</div>";
                                    echo "<div class='time-slot-group row'>";
                                    echo "<h5>Evening Slots:</h5>";
                                    foreach ($eveningSlots as $slot) {
                                        echo "<a class='time-slot col-3'
                                    href='book_appointment.php?doctor_id=$doctorId&time=" . urlencode($slot) . "&day=Evening&date=$selectedDate&clinic_id=" . $row['ClinicID'] . "'>
                                     $slot
                                 </a>";
                                    }
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "No clinics found for this doctor.";
                            }
                        }

                        // Close the connection
                        $conn->close();
                    } else {
                        // doctor_id parameter is missing
                        echo "<p>Missing doctor ID.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });

            // Pass doctorId from PHP to JavaScript
            var doctorID = <?php echo isset($doctorId) ? $doctorId : 0; ?>;

            // Handle click on time slot
            $('.time-slot').click(function(event) {
                event.preventDefault(); // Prevent default link behavior
                var clinicID = $(this).closest('.clinic-time-slots').data('clinic-id');
                var time = $(this).text();
                var day = $(this).data('day');
                var selectedDate = $('#datepicker').val(); // Get selected date from datepicker
                // Redirect to book_appointment.php with parameters
                window.location.href = "book_appointment.php?doctor_id=" + doctorID + "&time=" + encodeURIComponent(time) + "&day=" + day + "&date=" + selectedDate + "&ClinicID=" + ClinicID;
            });
        });
    </script>
</body>

</html>
