<?php
include '../sql_connection.php';

?>

<div class="container">
    <h2>Employee Details</h2>

    <?php
    // Fetch and display employee details from the database
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['employee_name'] . '</td>
                    <td>' . $row['position'] . '</td>
                    <td>' . $row['department'] . '</td>
                    <!-- Add more columns as needed -->
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No employee details found.</p>';
    }

    $conn->close();
    ?>
</div>

