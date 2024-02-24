<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            display: grid;
            grid-gap: 10px;
        }

        label {
            display: block;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <title>Clinic Information Form</title>
</head>

<?php
            // clinic_page.php

            // Retrieve the username from the URL parameters
            $authenticated_user = $_GET['user_name'];

            // Check if the username is set (to avoid undefined index notice)
            if (isset($authenticated_user)) {
                echo '<p>Welcome, ' . $authenticated_user . '</p>';
                // Add the rest of your clinic page content here
            } else {
                // Handle the case where the username is not set (optional)
                echo '<p>Invalid access. Please log in.</p>';
            }
            ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user_name from the query parameter
    $user_name = isset($_GET['user_name']) ? $_GET['user_name'] : '';

    // Retrieve other form data
    $clinic_name = $_POST["clinic_name"];
    $address = $_POST["Address_name"];
    $fees = $_POST["Fees"];
    $mon_to_fri = $_POST["mon_to_fri"];
    $sat = $_POST["sat"];
    $sun = $_POST["sun"];
    $gallery_photo_upload = $_POST["gallery_photo_upload"];
    $about_clinic = $_POST["about_clinic"];

    // Database connection parameters (replace with your actual database credentials)
    include 'sql_connection.php';

    // Check if the user_name already exists in the backend_clinic table
    $check_user_query = "SELECT * FROM backend_clinic WHERE user_name = '$user_name'";
    $result = $conn->query($check_user_query);

    if ($result->num_rows > 0) {
        echo '<script>alert("Data for this user_name already exists!");</script>';
    } else {
        // SQL query to insert data into the backend_clinic table
        $sql = "INSERT INTO backend_clinic (user_name, clinic_name, Address_name, Fees, mon_to_fri, sat, sun, gallery_photo_upload, about_clinic)
                VALUES ('$user_name', '$clinic_name', '$address', '$fees', '$mon_to_fri', '$sat', '$sun', '$gallery_photo_upload', '$about_clinic')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Data inserted successfully!");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>
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

                // Display the doctor_name on the clinic page
                echo '<h2>Welcome to the Clinic, Dr. ' . $doctor_name . '</h2>';
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
<body>
    <h2>Clinic Information Form</h2>

    <form method="post" action="">

        <!-- Add input fields for clinic information -->

        <label for="clinic_name">Clinic Name:</label>
        <input type="text" name="clinic_name" required>

        <label for="Address">Address:</label>
        <input type="text" name="Address_name" required>

        <label for="Fees">Fees:</label>
        <input type="text" name="Fees">

        <label for="mon_to_fri">Mon to Fri:</label>
        <input type="text" name="mon_to_fri">

        <label for="sat">Saturday:</label>
        <input type="text" name="sat">

        <label for="sun">Sunday:</label>
        <input type="text" name="sun">

        <label for="gallery_photo_upload">Gallery Photo Upload:</label>
        <input type="text" name="gallery_photo_upload">

        <label for="about_clinic">About Clinic:</label>
        <textarea name="about_clinic"></textarea>

        <input type="submit" value="Submit">
    </form>
</body>

</html>
