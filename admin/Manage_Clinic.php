<!DOCTYPE html>
<html>

<head>
    <title>Edit Clinic</title>
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

<body>

    <div class="container">
        <h2>Update Clinic</h2>

        <table id="clinicTable">
            <tr>
                <th>ID</th>
                <th>Doctor ID</th>
                <th>Clinic Name</th>
                <th>Clinic Address</th>
                <th>Opening Days</th>
                <th>Morning Time</th>
                <th>Afternoon Time</th>
                <th>Evening Time</th>
                <th>Edit</th>
            </tr>
            <?php
            include '../sql_connection.php';

            $clinicQuery = "SELECT * FROM clinics";
            $clinicResult = $conn->query($clinicQuery);

            if ($clinicResult->num_rows > 0) {
                while ($row = $clinicResult->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['ClinicID'] . "</td>
                        <td>" . $row['DoctorID'] . "</td>
                        <td>" . $row['ClinicName'] . "</td>
                        <td>" . $row['ClinicAddress'] . "</td>
                        <td>" . $row['OpeningDays'] . "</td>
                        <td>" . $row['MorningStartTime'] . " - " . $row['MorningEndTime'] . "</td>
                        <td>" . $row['AfternoonStartTime'] . " - " . $row['AfternoonEndTime'] . "</td>
                        <td>" . $row['EveningStartTime'] . " - " . $row['EveningEndTime'] . "</td>
                        <td><button onclick='editClinic(" . $row['ClinicID'] . ")'>Edit</button></td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No clinics found</td></tr>";
            }
            ?>
        </table>

        <div id="editClinicForm" class="hidden">
            <h2>Edit Clinic</h2>
            <form method="post" id="clinicEditForm" action="update_clinic.php">
                <input type="hidden" id="clinicID" name="clinicID">
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
                        <input type="time" class="form-control" id="morningStartTime" name="morningStartTime" style="width: 45%;" required>
                        <span style="margin: 0 5px;">to</span>
                        <input type="time" class="form-control" id="morningEndTime" name="morningEndTime" style="width: 45%;" required>
                    </div>
                </div>

                <div class="mb-3 time-fields">
                    <label for="afternoonTime" class="form-label">Afternoon Time</label>
                    <div style="display: flex;">
                        <input type="time" class="form-control" id="afternoonStartTime" name="afternoonStartTime" style="width: 45%;" required>
                        <span style="margin: 0 5px;">to</span>
                        <input type="time" class="form-control" id="afternoonEndTime" name="afternoonEndTime" style="width: 45%;" required>
                    </div>
                </div>

                <div class="mb-3 time-fields">
                    <label for="eveningTime" class="form-label">Evening Time</label>
                    <div style="display: flex;">
                        <input type="time" class="form-control" id="eveningStartTime" name="eveningStartTime" style="width: 45%;" required>
                        <span style="margin: 0 5px;">to</span>
                        <input type="time" class="form-control" id="eveningEndTime" name="eveningEndTime" style="width: 45%;" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script>
        function editClinic(clinicID) {
            var editForm = document.getElementById("editClinicForm");
            if (editForm.classList.contains("hidden")) {
                editForm.classList.remove("hidden");
                document.getElementById("clinicID").value = clinicID;
                
                // Fetch clinic data via AJAX
                fetchClinicData(clinicID);
            } else {
                editForm.classList.add("hidden");
            }
        }

        function fetchClinicData(clinicID) {
            fetch('../sql_connection.php?clinicID=' + clinicID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("clinicName").value = data.clinicName;
                    document.getElementById("clinicAddress").value = data.clinicAddress;
                    
                    var openingDays = data.openingDays.split(",");
                    openingDays.forEach(day => {
                        document.getElementById(day.toLowerCase()).checked = true;
                    });
                    
                    document.getElementById("morningStartTime").value = data.morningStartTime;
                    document.getElementById("morningEndTime").value = data.morningEndTime;
                    document.getElementById("afternoonStartTime").value = data.afternoonStartTime;
                    document.getElementById("afternoonEndTime").value = data.afternoonEndTime;
                    document.getElementById("eveningStartTime").value = data.eveningStartTime;
                    document.getElementById("eveningEndTime").value = data.eveningEndTime;
                })
                .catch(error => console.error('Error fetching clinic data:', error));
        }
    </script>

</body>

</html>
