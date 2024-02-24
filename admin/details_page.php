<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details and Data Addition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    
<?php
    // Replace these variables with your actual database connection details
    include '../sql_connection.php';

    // Function to add data to the server
    function addDataToServer($conn)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_name = $_POST['user_name'];
            $first_name = $_POST['first_name'];
            $mid_name = $_POST['mid_name'];
            $last_name = $_POST['last_name'];
            $clinic_name = $_POST['clinic_name'];
            $address = $_POST['address_name'];
            $specializations = $_POST['specializations'];
            $state = $_POST['state_name'];
            $city = $_POST['city'];
            $pincode = $_POST['pincode'];
            $experience = $_POST['experience'];
            $degree = $_POST['degree'];
            $photo_doctor = $_POST['photo_doctor'];
            $website_link = $_POST['website_link'];
            $phone_number = $_POST['phone_number'];
            $education = $_POST['education'];
            $award = $_POST['award'];
            $achievement = $_POST['achievement'];
            $videography = $_POST['videography'];
            $expertise = $_POST['expertise'];
            $aboutus = $_POST['aboutus'];

            // SQL query to insert data into the table
            $sql = "INSERT INTO doctor_detail (user_name, first_name, mid_name, last_name, clinic_name, address_name, specializations, state_name, city, pincode, experience, degree, photo_doctor, website_link, phone_number, education, award, achievement, videography, expertise, aboutus) VALUES ('$user_name', '$first_name', '$mid_name', '$last_name', '$clinic_name', '$address', '$specializations', '$state', '$city', '$pincode', '$experience', '$degree', '$photo_doctor', '$website_link', '$phone_number', '$education', '$award', '$achievement', '$videography', '$expertise', '$aboutus')";

            // Check if the user_name already exists in the doctor_detail table
            $check_duplicate_sql = "SELECT user_name FROM doctor_detail WHERE user_name = '$user_name'";
            $duplicate_result = $conn->query($check_duplicate_sql);

            if ($duplicate_result->num_rows > 0) {
                echo "Duplicate entry. Data for this user already exists.";
            } else {
                // Continue with the insertion since the user_name is not a duplicate

                // Check if the query was successful
                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Data added successfully");</script>';
                    echo '<script>window.location.href = "dashboard.php";</script>';
                } else {
                    // Log the error for debugging
                    $error_message = "Error: " . $sql . "\n" . $conn->error;
                    error_log($error_message);
                
                    // Provide a user-friendly error message along with detailed error information
                    echo '<script>alert("Oops! Something went wrong. Please try again later. Error details: ' . $error_message . '");</script>';
                }
            }
        }
    }

    // Check if a user name is provided in the URL
    if (isset($_GET['user_name'])) {
        $user_name = $_GET['user_name'];

        // SQL query to retrieve user details based on user_name
        $sql = "SELECT * FROM doctor_registration WHERE user_name = '$user_name'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo '<div class="container">
                    <h2>User Details</h2>
                    <ul>
                        <li>User Name: ' . $row['user_name'] . '</li>
                        <li>Doctor Name: ' . $row['doctor_name'] . '</li>
                        <li>Mobile: ' . $row['mobile'] . '</li>
                        <li>Email: ' . $row['email'] . '</li>
                        <li>Specialization: ' . $row['specialization'] . '</li>
                        <li>Experience: ' . $row['experience'] . '</li>
                    </ul>
                  </div>';
        } else {
            echo 'User details not found.';
        }
    }

    // Check if the form is submitted for adding data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Call the function to add data to the server
        addDataToServer($conn);
    }

    // Close the connection
    $conn->close();
    ?>

    <h1>Add Data</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()" id="add-form">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="mid_name">Middle Name:</label>
            <input type="text" class="form-control" id="mid_name" name="mid_name">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="clinic_name">Clinic Name:</label>
            <input type="text" class="form-control" id="clinic_name" name="clinic_name">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address_name">
        </div>

        <div class="form-group">
            <label for="specializations">Specializations:</label>
            <input type="text" class="form-control" id="specializations" name="specializations">
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" name="state_name">
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>

        <div class="form-group">
            <label for="pincode">Pincode:</label>
            <input type="text" class="form-control" id="pincode" name="pincode">
        </div>

        <div class="form-group">
            <label for="experience">Experience:</label>
            <input type="text" class="form-control" id="experience" name="experience">
        </div>

        <div class="form-group">
            <label for="degree">Degree:</label>
            <input type="text" class="form-control" id="degree" name="degree">
        </div>

        <div class="form-group">
            <label for="photo_doctor">Doctor's Photo URL:</label>
            <div class="input-group">
                <input type="file" class="form-control" name="photo_doctor" id="photo_doctor">
                <label class="input-group-text" for="photo_doctor">Upload</label>
            </div>
        </div>

        <div class="form-group">
            <label for="website_link">Website Link:</label>
            <input type="text" class="form-control" id="website_link" name="website_link">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
        </div>

        <div class="form-group">
            <label for="education">Education:</label>
            <input type="text" class="form-control" id="education" name="education">
        </div>

        <div class="form-group">
            <label for="award">Award:</label>
            <input type="text" class="form-control" id="award" name="award">
        </div>

        <div class="form-group">
            <label for="achievement">Achievement:</label>
            <input type="text" class="form-control" id="achievement" name="achievement">
        </div>

        <div class="form-group">
            <label for="videography">Videography:</label>
            <input type="text" class="form-control" id="videography" name="videography">
        </div>

        <div class="form-group">
            <label for="expertise">Expertise:</label>
            <input type="text" class="form-control" id="expertise" name="expertise">
        </div>

        <div class="form-group">
            <label for="aboutus">About Us:</label>
            <textarea class="form-control" id="aboutus" name="aboutus"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Data</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function validateForm() {
            var firstName = document.getElementById('first_name').value.trim();

            if (firstName === '') {
                alert('Please fill in all required fields.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
