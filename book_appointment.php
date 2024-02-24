<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for centering the modal */
        .modal-dialog {
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php
// Include database connection
include_once 'sql_connection.php';

// Retrieve data from URL parameters
$doctorId = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : "";
$time = isset($_GET['time']) ? $_GET['time'] : "";
$day = isset($_GET['day']) ? $_GET['day'] : "";
$date = isset($_GET['date']) ? $_GET['date'] : "";
$clinicId = isset($_GET['clinic_id']) ? $_GET['clinic_id'] : "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data
    $patientName = mysqli_real_escape_string($conn, $_POST['name']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobile']);
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    // Insert appointment into appointments table
    $insertQuery = "INSERT INTO appointments (doctor_id, appointment_time, day, appointment_date, clinic_id, patient_name, mobile_number) 
                    VALUES ('$doctorId', '$time', '$day', '$date', '$clinicId', '$patientName', '$mobileNumber')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "<script>alert('Appointment booked successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<div class='container'><div class='alert alert-danger' role='alert'>Error: " . $insertQuery . "<br>" . $conn->error . "</div></div>";
    }

    // Close the connection
    $conn->close();
}
?>

<div class="container">
    <!-- Appointment booking form -->
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?doctor_id=$doctorId&time=$time&day=$day&date=$date&clinic_id=$clinicId"; ?>" method="post" id="appointmentForm">
        <!-- Form fields for patient's name and mobile number -->
        <div class="form-group">
            <label for="patientName">Patient's Name:</label>
            <input type="text" class="form-control" id="patientName" name="name" pattern="[A-Za-z]+" title="Only alphabets allowed" required>
            <div id="nameError" class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="mobileNumber">Mobile Number:</label>
            <div class="input-group">
                <input type="tel" class="form-control" id="mobileNumber" name="mobile" pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" id="sendOTPBtn">Send OTP</button>
                </div>
            </div>
            <div id="otpMessage" class="form-text text-muted"></div>
            <div id="mobileError" class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="otp">Enter OTP:</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
            <div id="otpError" class="invalid-feedback"></div>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Generate and send OTP when "Send OTP" button is clicked
        $('#sendOTPBtn').click(function () {
            var mobileNumber = $('#mobileNumber').val();
            if (/^[6-9]\d{9}$/.test(mobileNumber)) {
                // Valid mobile number format, generate and send OTP
                var otp = Math.floor(1000 + Math.random() * 9000); // Generate 4-digit OTP
                // Simulate sending OTP via SMS (Replace this with your actual OTP sending mechanism)
                console.log("OTP sent to " + mobileNumber + ": " + otp);
                $('#otpMessage').text('OTP sent to ' + mobileNumber);
                $('#otpMessage').removeClass('text-danger').addClass('text-success');
                $('#otp').val(otp); // Auto-fill OTP field
                $('#otp').data('otp', otp); // Store OTP in data attribute
            } else {
                // Invalid mobile number format
                $('#otpMessage').text('Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.');
                $('#otpMessage').removeClass('text-success').addClass('text-danger');
                $('#mobileNumber').addClass('is-invalid');
            }
        });

        // Handle form submission
        $('#appointmentForm').submit(function (event) {
            var otp = $('#otp').val();
            var expectedOtp = $('#otp').data('otp');
            if (otp !== expectedOtp.toString()) {
                // If entered OTP does not match the expected OTP
                $('#otpError').text('Entered OTP is incorrect.');
                $('#otpError').show();
                event.preventDefault(); // Prevent form submission
            } else {
                // OTP is correct, proceed with form submission
                $('#otpError').hide();
            }
        });

        // Optional: Validate name field to accept only alphabets
        $('#patientName').on('input', function () {
            var input = $(this).val();
            if (!/^[A-Za-z]+$/.test(input)) {
                $('#nameError').text('Only alphabets are allowed.');
                $('#nameError').show();
                $(this).addClass('is-invalid');
            } else {
                $('#nameError').hide();
                $(this).removeClass('is-invalid');
            }
        });

        // Optional: Validate mobile number field
        $('#mobileNumber').on('input', function () {
            var input = $(this).val();
            if (!/^[6-9]\d{9}$/.test(input)) {
                $('#mobileError').text('Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.');
                $('#mobileError').show();
                $(this).addClass('is-invalid');
            } else {
                $('#mobileError').hide();
                $(this).removeClass('is-invalid');
            }
        });
    });
</script>

</body>
</html>
