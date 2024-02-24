<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="./Vender/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

form {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

#otp {
    width: calc(100% - 80px);
    display: inline-block;
}

.col-4 {
    margin-top: 15px; /* Adjust the margin as needed */
}

    </style>
</head>



<?php
 include 'sql_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $First_name = $conn->real_escape_string($_POST["First_name"]);
    $mobile = $_POST["mobile"];
    $otp = $_POST["otp"];
    $email = $conn->real_escape_string($_POST["email"]);

    // Validate OTP (for simplicity, hardcoded as 123456)
    if ($otp !== "123456") {
        die("Invalid OTP. Please try again.");
    }

    // Validate other form fields (you can add more validation as needed)

    // Check if the required fields are filled
    if (empty($First_name) || empty($mobile) || empty($email)) {
        die("All fields are required. Please fill in the form.");
    }

    // Perform further validation and save data to the database (you should use prepared statements to prevent SQL injection)
    $sql = "INSERT INTO patient_registration (First_name, mobile, email) VALUES ('$First_name', '$mobile', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php after successful registration
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<body>
    <h2>User Registration</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="row">
            <div class="col-12">
                <label for="name">Name:</label>
                <input type="text" name="First_name" required><br>
            </div>
            <div class="col-12">
                <label for="email">Email:</label>
                <input type="email" name="email" required><br>
            </div>
            <div class="col-12">
                <label for="mobile">Mobile Number:</label>
                <input type="text" name="mobile" id="mobile" required>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-8">
                        <label for="otp">OTP:</label>
                        <input type="text" name="otp" id="otp" required><br>
                    </div>
                    <div class="col-4">
                        <button type="button" onclick="sendOTP()">Send OTP</button><br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your additional form fields and structure here -->

        <input type="submit" value="Register">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    <script>
        // Your JavaScript functions here
        function sendOTP() {
            // Generate and send OTP logic here (you might use a backend API for this)
            // For simplicity, let's assume the OTP is 123456
            var otp = "123456";

            alert("OTP sent successfully. Please check your mobile.");

            // You may want to send OTP to the user's mobile using SMS gateway or other services.

            // For now, auto-fill the OTP for testing purposes (remove this in production)
            document.getElementById('otp').value = otp;
           
        }
    </script>
</body>

</html>
