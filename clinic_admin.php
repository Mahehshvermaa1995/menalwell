<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* styles.css */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            padding: 10px;
            color: white;
            text-align: center;
        }

        nav {
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            overflow-x: hidden;
            padding-top: 20px;
        }

        nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px;
            text-align: center;
            transition: 0.3s;
        }

        nav a:hover {
            background-color: #555;
        }

        main {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php
    // Include the file containing database connection details
    include 'sql_connection.php';

    // Check if the user_name parameter is present in the URL
    if (isset($_GET['user_name'])) {
        $authenticated_user = $_GET['user_name'];

        // Retrieve doctor_name from the database based on the authenticated user
        $query = "SELECT doctor_name FROM doctor_registration WHERE user_name='$authenticated_user'";

        // Check if the connection and query are successful
        if ($conn && ($result = $conn->query($query))) {
            // Check if the query returned any rows
            if ($result->num_rows > 0) {
                // Fetch the doctor_name
                $row = $result->fetch_assoc();
                $doctor_name = $row['doctor_name'];

                // Display the doctor_name in the header
                echo '<header>
                        <h2>Admin Panel</h2>
                        <h2>Welcome, Dr. ' . $doctor_name . '</h2>
                      </header>';
            } else {
                // Handle the case where the doctor_name is not found
                echo '<p>Error retrieving doctor information</p>';
            }
        } else {
            // Handle the case where the query or connection fails
            echo '<p>Error executing the query or connecting to the database</p>';
        }
    } else {
        // Handle the case where the user_name parameter is not present
        echo '<p>Error: User not authenticated</p>';
    }

    // Close the database connection
    if ($conn) {
        $conn->close();
    }
    ?>

    <nav>
        <ul>
            <li><a href="clinic_page.php?user_name=<?php echo $authenticated_user; ?>">Clinic Page</a></li>
            <li><a href="clinic_edit.php">Edit Clinic</a></li>
            <li><a href="clinic_appointment.php">Clinic Appointments</a></li>
            <!-- Add additional pages as needed -->
            <li><a href="additional_page1.php">Additional Page 1</a></li>
            <li><a href="additional_page2.php">Additional Page 2</a></li>
            <!-- Add more links as needed -->
        </ul>
    </nav>

    <main>
        <!-- Main content goes here -->
        <h2>Welcome to the Admin Panel</h2>
        <p>This is the main content area. You can customize it based on your needs.</p>
    </main>
</body>

</html>
