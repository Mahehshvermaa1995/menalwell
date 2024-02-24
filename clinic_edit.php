
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Information Form</title>
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
   
</head>
<?php
// Retrieve the username from the URL parameters
$authenticated_user = isset($_GET['user_name']) ? $_GET['user_name'] : '';

// Check if the username is set (to avoid undefined index notice)
if (isset($authenticated_user)) {
    echo '<p>Welcome, ' . $authenticated_user . '</p>';
} else {
    // Handle the case where the username is not set (optional)
    echo '<p>Invalid access. Please log in.</p>';
    // Assuming the user_name is obtained after successful clinic admin actions
    $user_name = "example_user"; // Replace with your actual logic to get user_name

    // Redirect to clinic_page.php with user_name parameter
    header("Location: clinic_page.php?user_name=" . urlencode($user_name));
    exit();
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
