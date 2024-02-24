<!-- call.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Call Now</title>
    <!-- Add any additional styles or meta tags as needed -->
    <script>
        function confirmCall() {
            var confirmation = confirm("Are you sure you want to initiate the call?");
            if (confirmation) {
                // If user clicks OK, navigate to the tel link
                window.location.href = "<?php echo 'tel:' . $clinicPhoneNumber; ?>";
            } else {
                // If user clicks Cancel, do nothing
            }
        }
    </script>
</head>

<body>
    <?php
    // Extract the phone number from the URL parameter
    $clinicPhoneNumber = isset($_GET['phone']) ? $_GET['phone'] : '';

    // Check if the phone number is valid
    if ($clinicPhoneNumber) {
        // Display the phone number and provide a link for the user to initiate the call
        echo "<h1>Call Now</h1>";
        echo "<p>Click the link below to initiate the call:</p>";
        echo "<a href='#' onclick='confirmCall()'>Call {$clinicPhoneNumber}</a>";
    } else {
        // Display an error message if the phone number is not provided
        echo "<h1>Error</h1>";
        echo "<p>Phone number not specified.</p>";
    }
    ?>
</body>

</html>
