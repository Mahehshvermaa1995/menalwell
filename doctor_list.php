<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Time Slot</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card img {
            height: 100%;
            object-fit: cover;
        }

        .card-title a {
            color: #007bff;
            text-decoration: none;
        }

        .card-title a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Include header.php -->
    <?php include 'header.php'; ?>

    <?php
    // Include database connection
    include_once 'sql_connection.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if the 'searchBar' key exists in the $_POST array
        if (isset($_POST['searchBar'])) {
            // Get the search input
            $searchInput = mysqli_real_escape_string($conn, $_POST['searchBar']);

            // Fetch doctors based on specialization_name or sub_specialization_name
            $sql = "SELECT * FROM doctors WHERE specialization_name LIKE '%$searchInput%' OR sub_specialization_name LIKE '%$searchInput%'";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    echo "<div class='container mt-5'>";
                    echo "<div class='row'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-12'>";
                        echo "<div class='row'>";
                        echo "<div class='card mb-3 col-9'>";
                        echo "<div class='row g-0'>";
                        echo "<div class='col-md-3 d-flex align-items-center'>";

                        // Display doctor image if available, otherwise use a placeholder
                        if (!empty($row['photo'])) {
                            echo "<img src='./admin{$row['photo']}' class='img-fluid rounded p-5' alt='Doctor Image'>";
                        } else {
                            echo "<img src='placeholder.jpg' class='img-fluid rounded' alt='Doctor Image'>";
                        }

                        echo "</div>";
                        $clinicPhoneNumber = '+91-8050403965';
                        echo "<div class='col-md-5 d-flex align-items-center'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>";

                        // Construct doctor's name URL-friendly
                        $doctorId = isset($row['id']) ? $row['id'] : 'N/A';
                        $doctorName = trim($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
                        $doctorName = str_replace(' ', ' ', $doctorName);
                        $doctorNameUrl = 'Dr-' . strtolower(str_replace(' ', '-', $doctorName));
                        $specialization_nameUrl = urlencode($row['specialization_name']);
                        $state = str_replace(' ', '-', $row['state']);
                        $district = str_replace(' ', '-', $row['district']);

                        // Construct doctor's profile URL
                        echo "<a class='text-decoration-none' href='profile.php?doctor_id={$doctorId}&/{$state}/{$doctorNameUrl}-{$specialization_nameUrl}/{$district}'>Dr. {$doctorName}</a>";

                        echo "</h5>";
                        echo "<p class='mb-1'>{$row['specialization_name']}</p>";
                        echo "<p class='mb-1'>{$row['experience']} years experience overall</p>";

                        echo "<p class='mb-1'>₹500 Consultation fee for Call Appointment</p>";

                        // Button to select time slot
                      
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-md-4 d-flex align-items-center mt-4'>";
                        echo "<div class='card-body'>";
                        echo "<p class='mb-1'> {$row['state']}/{$row['district']}</p>";
                        echo "<p class='mb-1'>Timings: Mon - Fri</p>";
                        echo "<p class='mb-1'>₹700 Consultation fee at clinic</p>";
                        echo "<button class='btn btn-primary mt-3 select-time-slot' data-bs-toggle='offcanvas' data-bs-target='#timeSlotOffcanvas' data-doctor-id='{$doctorId}' data-doctor-name='{$doctorName}' data-doctor-phone='{$clinicPhoneNumber}'>Select Time Slot</button>";

                        // Container to display time slots (initially hidden)
                        echo "<div class='time-slot-container offcanvas offcanvas-end' tabindex='-1' id='timeSlotOffcanvas'>
                            <div class='offcanvas-header'>
                                <h5 class='offcanvas-title'>Book Appoiment Time</h5>
                                <button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>
                            </div>
                            <div id='offcanvasContent' class='offcanvas-body'>
                                <!-- Time slot content will be loaded here -->
                            </div>
                        </div>";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                } else {
                    // No doctors found
                    echo "<div class='container alert alert-info mt-3'>
                            No doctors found with the specified specialization_name or sub_specialization_name.
                        </div>";
                }
            } else {
                // SQL query error
                echo "<div class='container alert alert-danger mt-3'>
                        Error executing the query: " . $conn->error;
                echo "</div>";
            }

            // Close the result set
            $result->close();
        } else {
            // 'searchBar' key is not set in the $_POST array
            echo "<div class='container alert alert-danger mt-3'>
                    Please use the search form to find doctors and provide a specialization_name.
                </div>";
        }
    } else {
        // If the form is not submitted, show an error message
        echo "<div class='container alert alert-danger mt-3'>
                Invalid request. Please use the search form to find doctors.
            </div>";
    }

    // Close the connection
    $conn->close();
    ?>

    <!-- Include footer.php -->
    <?php include 'footer.php'; ?>
    
    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // JavaScript to handle time slot selection
    document.addEventListener("DOMContentLoaded", function() {
        // Add event listener to each select-time-slot button
        document.querySelectorAll(".select-time-slot").forEach(function(button) {
            button.addEventListener("click", function() {
                var doctorId = this.getAttribute("data-doctor-id");
                var doctorName = this.getAttribute("data-doctor-name");
                var doctorPhone = this.getAttribute("data-doctor-phone");

                // Load content into Offcanvas
                var offcanvas = new bootstrap.Offcanvas(document.getElementById('timeSlotOffcanvas'));
                offcanvas.show();

                // AJAX request to load time_slot_selection.php content
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Replace Offcanvas content with time_slot_selection.php response
                            document.getElementById('offcanvasContent').innerHTML = xhr.responseText;
                        } else {
                            // Handle error
                            console.error('Error loading time_slot_selection.php: ' + xhr.status);
                        }
                    }
                };
                xhr.open("GET", "time_slot_selection.php?doctor_id=" + doctorId + "&doctor_name=" + encodeURIComponent(doctorName) + "&doctor_phone=" + doctorPhone, true);
                xhr.send();
            });
        });
    });
    </script>

</body>
</html>
