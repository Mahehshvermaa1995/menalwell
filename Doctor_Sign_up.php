<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Sign Up</title>
    <link rel="stylesheet" href="./Vendor/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <style>
        /* Your existing styles remain unchanged */
        .otp-section {
            display: none;
            /* Hide OTP section initially */
        }

        .otp-section label,
        .otp-section input {
            display: block;
            margin-bottom: 8px;
        }

        /* styles.css */
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
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .otp-section {
            display: none;
        }
    </style>
</head>

<body>
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $doctor_name = $_POST['doctor_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $doctor_password = $_POST['doctor_password'];
    $confirm_password = $_POST['confirm_password'];
    $doctor_otp = $_POST['doctor_otp'];

    // Generate user_name based on the first 5 letters of the name and last 4 digits of mobile
    $user_name = strtolower(substr($doctor_name, 0, 5) . substr($mobile, -4));

    // Validate the data if needed

    // Database connection parameters
    include 'sql_connection.php';

    // Insert data into the database with the generated user_name
    $sql = "INSERT INTO `doctor_registration` (user_name, doctor_name, email, mobile, specialization, experience, doctor_password, confirm_password, doctor_otp)
        VALUES ('$user_name', '$doctor_name', '$email', '$mobile', '$specialization', '$experience', '$doctor_password', '$confirm_password', '$doctor_otp')";

    if ($conn->query($sql) === TRUE) {
        $response = "New record created successfully";
        echo "<script>alert('$response');</script>";
        // Redirect to index.php on OK
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        $response = "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>alert('$response');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>

    <div>
        <h2 class="text-center">Doctor Sign Up</h2>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">
        <div class="row">
            <div class="col-12">
                <label for="name">Name:</label>
                <input type="text" name="doctor_name" required>
            </div>
            <div class="col-12">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="col-12">
                <label for="mobile">Phone Number:</label>
                <input type="text" name="mobile" required>
            </div>
            <div class="col-12">
                <label for="specialization">Specialization:</label>
                <input type="text" name="specialization" required>
            </div>
            <div class="col-12">
                <label for="experience">Experience:</label>
                <input type="text" name="experience" required>
            </div>
            <div class="col-12">
                <label for="password">Password:</label>
                <input type="password" name="doctor_password" required>
            </div>
            <div class="col-12">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>

            <div class="col-6">
                <button type="button" name="send_otp" onclick="sendOTP()">Send OTP</button>
            </div>
        </div>

        <!-- OTP verification section -->
        <div class="otp-section" id="otp-section">
            <div class="col-12 mt-1">
                <label for="otp">Enter OTP:</label>
                <input type="text" name="doctor_otp" required>
            </div>
            <div class="col-6">
                <button type="button" name="submit_otp">Verify OTP</button>
            </div>
        </div>

        <div class="col-6">
            <input type="submit" value="Sign Up">
        </div>
    </form>
    <script>
        // Display alert box with response message
        function validateForm() {
            var password = document.querySelector('input[name="doctor_password"]').value;
            var confirm_password = document.querySelector('#confirm_password').value;

            if (password !== confirm_password) {
                alert("Password and Confirm Password do not match");
                return false; // prevent form submission
            }

            // Additional validation or actions can be added here if needed
            return true; // allow form submission
        }

        function sendOTP() {
            // Logic to send OTP to the provided mobile number (you may use a backend API for this)

            // Generate a random 6-digit OTP
            var otp = Math.floor(100000 + Math.random() * 900000);

            // Display the OTP section after sending OTP
            document.querySelector('.otp-section').style.display = 'block';

            // Auto-fill the OTP input field for testing purposes
            document.querySelector('input[name="doctor_otp"]').value = otp;
        }
    </script>
</body>

</html>
