<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Optional: Add styles for error message */
        .error-message {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    // Database connection details
    include 'sql_connection.php';

    // Initialize variables to store error message and username
    $error_message = "";
    $authenticated_user = "";

    // Get username and password from the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Query to check if the username and password match
        $query = "SELECT doctor_name FROM doctor_registration WHERE user_name='$user' AND doctor_password='$pass'";
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result->num_rows > 0) {
            // Set the authenticated user variable
            $authenticated_user = $user;

            // Redirect to clinic_admin.php with the authenticated user's name
            header("Location: clinic_admin.php?user_name=$authenticated_user");
            exit(); // Ensure that the script stops execution after redirection
        } else {
            // Display an error message if the user is not authenticated
            $error_message = "User not found or incorrect password.";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <h2>Login</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    <?php
    // Display error message if present
    if (!empty($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>
</body>

</html>
