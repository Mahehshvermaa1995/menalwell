<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Appointment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body> 
    <div class="container">
        <h1>Verify Appointment</h1>
        <?php
        // Start the session to access stored verification code
        session_start();

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if verification code is correct
            if (isset($_POST['verification_code'])) {
                $verificationCode = $_POST['verification_code'];

                if ($verificationCode == $_SESSION['verification_code']) {
                    // Verification successful, proceed to book appointment
                    // Include the file with the appointment booking logic
                    include 'book_appointment.php';
                    exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert">Incorrect verification code. Please try again.</div>';
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">Please enter the verification code.</div>';
            }
        }
        ?>
        <form method="post">
            <div class="mb-3">
                <label for="verificationCode" class="form-label">Verification Code:</label>
                <input type="text" class="form-control" id="verificationCode" name="verification_code" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify Appointment</button>
        </form>
    </div>

    <!-- JavaScript code -->
    <script>
        // Function to validate the verification code format
        function validateVerificationCode(code) {
            // Regular expression for four digits
            var regex = /^\d{4}$/;
            return regex.test(code);
        }

        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault();

            // Get the verification code input value
            var verificationCodeInput = document.getElementById('verificationCode');
            var verificationCode = verificationCodeInput.value;

            // Validate the verification code
            if (!validateVerificationCode(verificationCode)) {
                // If validation fails, show an error message
                alert('Please enter a valid 4-digit verification code.');
                return;
            }

            // If validation succeeds, submit the form
            event.target.submit();
        }

        // Add event listener to the form submission
        document.querySelector('form').addEventListener('submit', handleSubmit);
    </script>
</body>
</html>
