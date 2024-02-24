<?php
include '../sql_connection.php';

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    $doctorId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch doctor details from the database
    $doctorSql = "SELECT * FROM doctors WHERE id = '$doctorId'";
    $doctorResult = $conn->query($doctorSql);

    if ($doctorResult->num_rows > 0) {
        $doctorRow = $doctorResult->fetch_assoc();

        // Extract data for pre-filling the form
        $firstName = $doctorRow['first_name'];
        $middleName = $doctorRow['middle_name'];
        $lastName = $doctorRow['last_name'];
        $email = $doctorRow['email'];
        $mobileNumber = $doctorRow['mobile_number'];
        $address = $doctorRow['address'];
        $state = $doctorRow['state'];
        $district = $doctorRow['district'];
        $pincode = $doctorRow['pincode'];
        $introduction = $doctorRow['introduction'];
    } else {
        echo '<div class="container alert alert-danger mt-3">
                Doctor not found.
            </div>';
        exit();
    }

    // Fetch education details from the database
    $educationSql = "SELECT * FROM educations WHERE doctor_id = '$doctorId'";
    $educationResult = $conn->query($educationSql);
    $educations = [];

    if ($educationResult->num_rows > 0) {
        while ($educationRow = $educationResult->fetch_assoc()) {
            $educations[] = $educationRow;
        }
    }

    // Fetch experience details from the database
    $experienceSql = "SELECT * FROM experiences WHERE doctor_id = '$doctorId'";
    $experienceResult = $conn->query($experienceSql);
    $experiences = [];

    if ($experienceResult->num_rows > 0) {
        while ($experienceRow = $experienceResult->fetch_assoc()) {
            $experiences[] = $experienceRow;
        }
    }

    // Close the connection
    $conn->close();
} else {
    echo '<div class="container alert alert-danger mt-3">
            Doctor ID not provided.
        </div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <!-- Edit Doctor Form -->
        <form method="post" action="update_doctor.php">
            <!-- Include a hidden field to store the doctor's ID -->
            <input type="hidden" name="doctorId" value="<?php echo $doctorId; ?>">

            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
            </div>
            <div class="form-group">
                <label for="middleName">Middle Name:</label>
                <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo $middleName; ?>">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number:</label>
                <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" value="<?php echo $mobileNumber; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address"><?php echo $address; ?></textarea>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php echo $state; ?>">
            </div>
            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" class="form-control" id="district" name="district" value="<?php echo $district; ?>">
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $pincode; ?>">
            </div>
            <div class="form-group">
                <label for="introduction">Introduction:</label>
                <textarea class="form-control" id="introduction" name="introduction"><?php echo $introduction; ?></textarea>
            </div>

            <!-- Education details -->
            <h5>Education</h5>
            <?php foreach ($educations as $education) : ?>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="degree" class="form-label">Degree:</label>
                        <input type="text" class="form-control" id="degree" name="degree[]" value="<?php echo $education['degree']; ?>" placeholder="Enter Degree" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="college" class="form-label">College:</label>
                        <input type="text" class="form-control" id="college" name="college[]" value="<?php echo $education['college']; ?>" placeholder="Enter College" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="years" class="form-label">Years:</label>
                        <input type="text" class="form-control" id="years" name="years[]" value="<?php echo $education['years']; ?>" placeholder="Enter Years" required pattern="[0-9]{1,}">
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Experience details -->
            <h5>Experience</h5>
            <?php foreach ($experiences as $experience) : ?>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="designation" class="form-label">Designation:</label>
                        <input type="text" class="form-control" id="designation" name="designation[]" value="<?php echo $experience['designation']; ?>" placeholder="Designation" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="experienceCollege" class="form-label">College/Institute:</label>
                        <input type="text" class="form-control" id="experienceCollege" name="experienceCollege[]" value="<?php echo $experience['college']; ?>" placeholder="Institute" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="experienceYears" class="form-label">Years of Experience:</label>
                        <input type="text" class="form-control" id="experienceYears" name="experienceYears[]" value="<?php echo $experience['experience_years']; ?>" placeholder="Years" required pattern="[0-9]{1,}">
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Update Doctor</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch expertise options using AJAX
            $.ajax({
                url: 'get_expertise.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Dynamically populate expertise checkboxes
                    var expertiseCheckboxes = '';
                    data.forEach(function(expertise) {
                        expertiseCheckboxes += `
                            <div class='col'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name='expertise[]' value='${expertise}'>
                                    <label class='form-check-label'>${expertise}</label>
                                </div>
                            </div>`;
                    });

                    $('#expertise-checkboxes').html(expertiseCheckboxes);
                },
                error: function(error) {
                    console.error('Error fetching expertise options:', error);
                }
            });
        });
    </script>
</body>

</html>
