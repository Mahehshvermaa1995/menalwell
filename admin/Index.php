<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            color: red;
            margin-bottom: 16px;
            text-align: center;
        }
    </style>
</head>
<?php
session_start();

// Check if the user is already logged in, redirect to dashboard if true
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate login credentials (Replace with your own authentication logic)
    $username = "admin";
    $password = "123456";

    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>


<body>
    
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    
    <form method="post" action="">
    <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>