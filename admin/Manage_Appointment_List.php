<?php
include '../sql_connection.php';

?>

<div class="container">
    <h2>Manage Appointment List</h2>

    <?php
    // Fetch and display all appointments from the database
    $sql = "SELECT * FROM appointments";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Appointment Date</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['patient_name'] . '</td>
                    <td>' . $row['doctor_name'] . '</td>
                    <td>' . $row['appointment_date'] . '</td>
                    <!-- Add more columns as needed -->
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No appointments found.</p>';
    }

    $conn->close();
    ?>
</div>


