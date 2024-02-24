<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Manage Doctors</h2>

       
        <hr>

        <!-- Doctors Table -->
        <?php
        include '../sql_connection.php';

        // Fetch and display doctors from the database
        $sql = "SELECT * FROM doctors";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Doctor Name</th>
                            <th>Mobile Number</th>
                            <th>Specialization</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = $result->fetch_assoc()) {
                // Concatenate first_name, middle_name, and last_name to get the full name
                $fullName = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];

                echo '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $fullName . '</td>
                        <td>' . $row['mobile_number'] . '</td>
                        <td>' . $row['specialization'] . '</td>
                        <td>
                            <a href="edit_doctor.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="deleteDoctor(' . $row['id'] . ')">Delete</button>
                        </td>
                    </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No doctors found.</p>';
        }

        $conn->close();
        ?>

    </div>

    <script>
        function deleteDoctor(doctorId) {
            $.ajax({
                type: 'POST',
                url: 'delete_doctor.php', // Replace with your server-side script to handle deletion
                data: { doctorId: doctorId },
                success: function (response) {
                    // Handle the response, maybe reload the page or update the table
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        function toggleStatus(doctorId, currentStatus) {
            $.ajax({
                type: 'POST',
                url: 'toggle_status.php', // Replace with your server-side script to handle status toggling
                data: { doctorId: doctorId, currentStatus: currentStatus },
                success: function (response) {
                    // Handle the response, maybe reload the page or update the status cell
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        function saveChanges(doctorId) {
            // Implement the logic to save the changes made in the modal for the doctor with the given ID
            // You can use AJAX to send a request to the server to update the doctor's information
            // Reload the page or update the table after successful update
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>
