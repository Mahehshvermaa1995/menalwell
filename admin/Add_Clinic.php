<!DOCTYPE html>
<html>

<head>
    <title>Add Clinic</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<?php
include '../sql_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = isset($_POST['doctorID']) ? $_POST['doctorID'] : '';

    // Ensure doctorID is a valid integer
    $doctorID = intval($doctorID);

    // Check if the doctorID is valid
    if ($doctorID > 0) {
        // Proceed to add a new clinic
        $clinicName = isset($_POST['clinicName']) ? mysqli_real_escape_string($conn, $_POST['clinicName']) : null;
        $clinicAddress = isset($_POST['clinicAddress']) ? mysqli_real_escape_string($conn, $_POST['clinicAddress']) : null;
        $openingDays = isset($_POST['openingDays']) ? implode(",", $_POST['openingDays']) : null;

        $morningStartTime = isset($_POST['morningStartTime']) ? $_POST['morningStartTime'] : null;
        $morningEndTime = isset($_POST['morningEndTime']) ? $_POST['morningEndTime'] : null;

        $afternoonStartTime = isset($_POST['afternoonStartTime']) ? $_POST['afternoonStartTime'] : null;
        $afternoonEndTime = isset($_POST['afternoonEndTime']) ? $_POST['afternoonEndTime'] : null;

        $eveningStartTime = isset($_POST['eveningStartTime']) ? $_POST['eveningStartTime'] : null;
        $eveningEndTime = isset($_POST['eveningEndTime']) ? $_POST['eveningEndTime'] : null;

        $sql = "INSERT INTO Clinics (DoctorID, ClinicName, ClinicAddress, OpeningDays, MorningStartTime, MorningEndTime, AfternoonStartTime, AfternoonEndTime, EveningStartTime, EveningEndTime) 
                VALUES ('$doctorID', '$clinicName', '$clinicAddress', '$openingDays', '$morningStartTime', '$morningEndTime', '$afternoonStartTime', '$afternoonEndTime', '$eveningStartTime', '$eveningEndTime')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Clinic added successfully.');
                window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to add clinic: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Invalid doctor ID.');</script>";
    }
}

$conn->close();
?>


<body>

    <div class="container">
        <h2>Doctors Information</h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="doctorName" class="form-label">Doctor's Name:</label>
                <input type="text" id="doctorName" name="doctorName" required>
            </div>
            <button type="submit">Search</button>
        </form>

        <table id="doctorTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>specialization_name</th>
                <th>Add Clinic</th>
            </tr>
            <?php
            include '../sql_connection.php';

            $doctorName = isset($_POST['doctorName']) ? $_POST['doctorName'] : '';

            $doctorIDQuery = "SELECT ID, first_name, specialization_name FROM doctors WHERE first_name LIKE '%$doctorName%'";
            $doctorIDResult = $conn->query($doctorIDQuery);

            if ($doctorIDResult->num_rows > 0) {
                while ($row = $doctorIDResult->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['ID'] . "</td>
                        <td>" . $row['first_name'] . "</td>
                        <td>" . $row['specialization_name'] . "</td>
                        <td><button onclick='document.getElementById(\"doctorID\").value = " . $row['ID'] . "; toggleClinicForm();'>Add Clinic</button></td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No doctors found</td></tr>";
            }
            ?>
        </table>

        <div id="addClinicForm" class="hidden">
            <h2>Add Clinic</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" id="doctorID" name="doctorID">
                <div class="mb-3">
                    <label for="clinicName" class="form-label">Clinic Name</label>
                    <input type="text" class="form-control" id="clinicName" name="clinicName" required>
                </div>

                <div class="mb-3">
                    <label for="clinicAddress" class="form-label">Clinic Address</label>
                    <input type="text" class="form-control" id="clinicAddress" name="clinicAddress" required>
                </div>

                <div class="mb-3">
                    <label for="openingDays" class="form-label">Opening Days</label><br>
                    <input type="checkbox" id="monday" name="openingDays[]" value="Monday">
                    <label for="monday">Monday</label>
                    <input type="checkbox" id="tuesday" name="openingDays[]" value="Tuesday">
                    <label for="tuesday">Tuesday</label>
                    <input type="checkbox" id="wednesday" name="openingDays[]" value="Wednesday">
                    <label for="wednesday">Wednesday</label>
                    <input type="checkbox" id="thursday" name="openingDays[]" value="Thursday">
                    <label for="thursday">Thursday</label>
                    <input type="checkbox" id="friday" name="openingDays[]" value="Friday">
                    <label for="friday">Friday</label>
                    <input type="checkbox" id="saturday" name="openingDays[]" value="Saturday">
                    <label for="saturday">Saturday</label>
                    <input type="checkbox" id="sunday" name="openingDays[]" value="Sunday">
                    <label for="sunday">Sunday</label>
                </div>

                <div class="mb-3 time-fields">
                    <label for="morningTime" class="form-label">Morning Time</label>
                    <div style="display: flex;">
                        <input type="time" class="form-control" id="morningStartTime" name="morningStartTime" style="width: 45%;">
                        <span style="margin: 0 5px;">to</span>
                        <input type="time" class="form-control" id="morningEndTime" name="morningEndTime" style="width: 45%;">
                    </div>
                </div>

                <div class="mb-3 time-fields">
                    <label for="afternoonTime" class="form-label">Afternoon Time</label>
                    <div style="display: flex;">
                        <input type="time" class="form-control" id="afternoonStartTime" name="afternoonStartTime" style="width: 45%;">
                        <span style="margin: 0 5px;">to</span>
                        <input type="time" class="form-control" id="afternoonEndTime" name="afternoonEndTime" style="width: 45%;">
                    </div>
                </div>

                <div class="mb-3 time-fields">
                    <label for="eveningTime" class="form-label">Evening Time</label>
                    <div style="display: flex;">
                        <input type="time" class="form-control" id="eveningStartTime" name="eveningStartTime" style="width: 45%;">
                        <span style="margin: 0 5px;">to</span>
                        <input type="time" class="form-control" id="eveningEndTime" name="eveningEndTime" style="width: 45%;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function toggleClinicForm() {
            var clinicForm = document.getElementById("addClinicForm");
            if (clinicForm.classList.contains("hidden")) {
                clinicForm.classList.remove("hidden");
                // Clear the clinic name field
                document.getElementById("clinicName").value = "";
                // Clear the clinic address field
                document.getElementById("clinicAddress").value = "";
                // Clear the checkbox selections for opening days
                var checkboxes = document.querySelectorAll('input[name="openingDays[]"]');
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = false;
                });
                // Clear the time fields
                document.getElementById("morningStartTime").value = "";
                document.getElementById("morningEndTime").value = "";
                document.getElementById("afternoonStartTime").value = "";
                document.getElementById("afternoonEndTime").value = "";
                document.getElementById("eveningStartTime").value = "";
                document.getElementById("eveningEndTime").value = "";
            } else {
                clinicForm.classList.add("hidden");
            }
        }
    </script>

</body>

</html>