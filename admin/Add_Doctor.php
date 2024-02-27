<?php
include __DIR__ . '/../sql_connection.php'; // Include the database connection file
include __DIR__ . '/districts_data.php'; // Include districts data file

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $selectedState = mysqli_real_escape_string($conn, $_POST['state']);
    $selectedDistrict = mysqli_real_escape_string($conn, $_POST['district']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $introduction = mysqli_real_escape_string($conn, $_POST['introduction']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $yearsAsSpecialist = mysqli_real_escape_string($conn, $_POST['yearsAsSpecialist']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $selectedSpecialization = isset($_POST['specialization']) ? mysqli_real_escape_string($conn, $_POST['specialization']) : '';
    $selectedSubSpecializations = isset($_POST['sub_specializations']) ? $_POST['sub_specializations'] : [];

    // Handle image upload errors
    if ($_FILES['photo']['error'] == 0) {
        $tempName = $_FILES['photo']['tmp_name'];
        $targetDirectory =  'Image/';

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        // Move uploaded file to target directory
        $fileName = uniqid() . '.jpg'; // Unique file name to avoid conflicts
        $targetFilePath = $targetDirectory . $fileName;

        if (move_uploaded_file($tempName, $targetFilePath)) {
            $specializationName = '';
            if (!empty($selectedSpecialization)) {
                $sqlSpecialization = "SELECT specialization_name FROM specializations WHERE id = '$selectedSpecialization'";
                $resultSpecialization = $conn->query($sqlSpecialization);
                if ($resultSpecialization->num_rows == 1) {
                    $rowSpecialization = $resultSpecialization->fetch_assoc();
                    $specializationName = $rowSpecialization['specialization_name'];
                }
            }

            $subSpecializationNames = [];
            foreach ($selectedSubSpecializations as $subSpecializationId) {
                $sqlSubSpecialization = "SELECT sub_specialization_name FROM sub_specializations WHERE id = '$subSpecializationId'";
                $resultSubSpecialization = $conn->query($sqlSubSpecialization);
                if ($resultSubSpecialization->num_rows == 1) {
                    $rowSubSpecialization = $resultSubSpecialization->fetch_assoc();
                    $subSpecializationNames[] = $rowSubSpecialization['sub_specialization_name'];
                }
            }

            // Insert doctor data into doctors table
            $sqlDoctor = "INSERT INTO doctors (first_name, middle_name, last_name, email, mobile_number, website, address, state, district, pincode, introduction, experience, photo, specialization_name, sub_specialization_name, years_as_specialist) 
            VALUES ('$firstName', '$middleName', '$lastName', '$email', '$mobileNumber', '$website', '$address', '$selectedState', '$selectedDistrict', '$pincode', '$introduction', '$experience', '$targetFilePath', '$specializationName', '" . implode(",", $subSpecializationNames) . "','$yearsAsSpecialist')";

            if ($conn->query($sqlDoctor) === TRUE) {
                $doctorId = $conn->insert_id; // Get the ID of the newly inserted doctor

                // Insert education data into educations table
                if (isset($_POST['degree']) && isset($_POST['university']) && isset($_POST['completionYear'])) {
                    $degrees = $_POST['degree'];
                    $universities = $_POST['university'];
                    $completionYears = $_POST['completionYear'];
                    $count = min(count($degrees), count($universities), count($completionYears)); // Get the minimum count to avoid accessing undefined indexes
                    for ($i = 0; $i < $count; $i++) {
                        $degree = mysqli_real_escape_string($conn, $degrees[$i]);
                        $university = mysqli_real_escape_string($conn, $universities[$i]);
                        $completionYear = mysqli_real_escape_string($conn, $completionYears[$i]);
                        $sqlEducation = "INSERT INTO educations (doctor_id, degree, university, completion_year) VALUES ('$doctorId', '$degree', '$university', '$completionYear')";
                        $conn->query($sqlEducation);
                    }
                }

                // Insert experience data into experiences table
                if (isset($_POST['designation']) && isset($_POST['organization']) && isset($_POST['experienceYears'])) {
                    $designations = $_POST['designation'];
                    $organizations = $_POST['organization'];
                    $experienceYears = $_POST['experienceYears'];
                    $count = min(count($designations), count($organizations), count($experienceYears)); // Get the minimum count to avoid accessing undefined indexes
                    for ($i = 0; $i < $count; $i++) {
                        $designation = mysqli_real_escape_string($conn, $designations[$i]);
                        $organization = mysqli_real_escape_string($conn, $organizations[$i]);
                        $experienceYear = mysqli_real_escape_string($conn, $experienceYears[$i]);
                        $sqlExperience = "INSERT INTO experiences (doctor_id, designation, organization, experience_years) VALUES ('$doctorId', '$designation', '$organization', '$experienceYear')";
                        $conn->query($sqlExperience);
                    }
                }
                if (isset($_POST['awardName']) && isset($_POST['awardYear'])) {
                    $awardNames = $_POST['awardName'];
                    $awardYears = $_POST['awardYear'];
                    $count = min(count($awardNames), count($awardYears));

                    for ($i = 0; $i < $count; $i++) {
                        $awardName = mysqli_real_escape_string($conn, $awardNames[$i]);
                        $awardYear = mysqli_real_escape_string($conn, $awardYears[$i]);
                        $sqlAwards = "INSERT INTO awards_recognitions (doctor_id, award_name, year) VALUES ('$doctorId', '$awardName', '$awardYear')";
                        $conn->query($sqlAwards);
                    }
                }

                // Process Memberships
                if (isset($_POST['membershipName']) && isset($_POST['membershipYear'])) {
                    $membershipNames = $_POST['membershipName'];
                    $membershipYears = $_POST['membershipYear'];
                    $count = min(count($membershipNames), count($membershipYears));

                    for ($i = 0; $i < $count; $i++) {
                        $membershipName = mysqli_real_escape_string($conn, $membershipNames[$i]);
                        $membershipYear = mysqli_real_escape_string($conn, $membershipYears[$i]);
                        $sqlMemberships = "INSERT INTO memberships (doctor_id, membership_name, year) VALUES ('$doctorId', '$membershipName', '$membershipYear')";
                        $conn->query($sqlMemberships);
                    }
                }

                // Process Registrations
                if (isset($_POST['registrationName']) && isset($_POST['registrationYear'])) {
                    $registrationNames = $_POST['registrationName'];
                    $registrationYears = $_POST['registrationYear'];
                    $count = min(count($registrationNames), count($registrationYears));

                    for ($i = 0; $i < $count; $i++) {
                        $registrationName = mysqli_real_escape_string($conn, $registrationNames[$i]);
                        $registrationYear = mysqli_real_escape_string($conn, $registrationYears[$i]);
                        $sqlRegistrations = "INSERT INTO registrations (doctor_id, registration_name, year) VALUES ('$doctorId', '$registrationName', '$registrationYear')";
                        $conn->query($sqlRegistrations);
                    }
                }
                // Output JavaScript to show alert and redirect
                echo "<script>
                        alert('Doctor added successfully.');
                        window.location.href = 'dashboard.php';
                      </script>";
            } else {
                echo '<div class="container alert alert-danger mt-3">Error inserting doctor data: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="container alert alert-danger mt-3">Error uploading image.</div>';
        }
    } else {
        echo '<div class="container alert alert-danger mt-3">Error: ' . $_FILES['photo']['error'] . '</div>';
    }

    if (!empty($errors)) {
        echo '<div class="container alert alert-danger mt-3">
                <ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>
              </div>';
    }
}

$sql = "SELECT * FROM specializations";
$result = $conn->query($sql);

$specializations = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $specializations[$row['id']] = $row['specialization_name'];
    }
}
?>




<div class="container">
    <h2>Add Doctor</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z\s]+" title="Please enter only letters and spaces" oninput="capitalizeFirstLetter(this)" required>
            </div>
            <div class="col">
                <label for="middleName" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName" pattern="[a-zA-Z\s]+" title="Please enter only letters and spaces" oninput="capitalizeFirstLetter(this)">
            </div>
            <div class="col">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z\s]+" title="Please enter only letters and spaces" oninput="capitalizeFirstLetter(this)" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-7">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com">
                <div class="invalid-feedback" id="emailValidationMessage">
                    Please enter a valid email address.
                </div>
            </div>
            <div class="col-5">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" pattern="[0-9]{10}" title="Please enter a 10-digit numeric value" required>
                <div class="invalid-feedback" id="mobileNumberValidationMessage">
                    Please enter a valid 10-digit numeric value.
                </div>
            </div>


        </div>
        <div class="row mb-3">
            <div class="col-4">
                <!-- Add a new column for the website -->
                <label for="website" class="form-label">Website:</label>
                <input type="url" value="https://" class="form-control" id="website" name="website" placeholder="https://example.com">
            </div>

            <div class="col-3">
                <label for="specialization" class="form-label">Specialization:</label>
                <select class="form-control" name="specialization" id="specialization">
                    <option value="" disabled selected>Select Specialization</option>
                    <?php
                    // Populate dropdown with fetched specializations
                    foreach ($specializations as $id => $specialization_name) {
                        echo "<option value='$id'>$specialization_name</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-3">
                <label for="yearsAsSpecialist" class="form-label">Years as Specialist:</label>
                <input type="text" class="form-control" id="yearsAsSpecialist" name="yearsAsSpecialist" pattern="[0-9]+" title="Please enter a valid number">
            </div>
            <div class="col-2">
                <label for="experience" class="form-label">Experience:</label>
                <input type="text" class="form-control" id="experience" name="experience" pattern="[0-9]+" title="Please enter a valid number">
            </div>

        </div>
        <div class="row mb-3">

            <div class="col">
                <!-- Photo Upload Input -->
                <label for="image">Choose an image:</label>
                <input class="form-control" type="file" id="photo" name="photo" accept="image/*" required>
            </div>

        </div>
        <div class="col">
            <!-- Address Input -->
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="state" class="form-label">Select State:</label>
                <select class="form-control" name="state" id="state" onchange="getDistricts(this.value)">
                    <option value="" disabled selected>Select State</option>
                    <?php
                    // Assume $states is an array containing the names of Indian states
                    $states = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];

                    foreach ($states as $state) {
                        echo "<option value='$state'>$state</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col">
                <label for="district" class="form-label">Select District:</label>
                <select class="form-control" name="district" id="district">

                </select>
            </div>

            <div class="col">
                <label for="pincode" class="form-label">Pincode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode" pattern="[0-9]{6}" title="Please enter a 6-digit numeric value">
            </div>
        </div>
        <div id="education-section-container">
        
            <!-- Initial education section -->
            <div class="row mb-3 education-section">
                <h5>Education</h5>
                <div class="col-sm-3">
                    <label for="degree_1" class="form-label">Degree:</label>
                    <input type="text" class="form-control" name="degree[]" placeholder="Degree">
                </div>
                <div class="col-sm-4">
                    <label for="university_1" class="form-label">University :</label>
                    <input type="text" class="form-control" name="university[]" placeholder="University">
                </div>
                <div class="col-sm-3">
                    <label for="completionYear_1" class="form-label">Completion Year:</label>
                    <input type="text" class="form-control" name="completionYear[]" placeholder="Year">
                </div>
                
            </div>
        </div>



        <div  id="experience-section-container">
        <div class="col-sm-4">
                    <button type="button" class="btn btn-success" id="addEducation">Add More Education</button>
                </div>
     
            <!-- Initial experience section -->
            <div class="row mb-3 experience-section">
                <h5>Experience</h5>
                <div class="col-sm-3">
                    <label for="designation_1" class="form-label">Designation:</label>
                    <input type="text" class="form-control" name="designation[]" placeholder="Designation">
                </div>
                <div class="col-sm-4">
                    <label for="organization_1" class="form-label">Organization :</label>
                    <input type="text" class="form-control" name="organization[]" placeholder="Organization">
                </div>
                <div class="col-sm-4">
                    <label for="experienceYears_1" class="form-label">Years of Experience:</label>
                    <input type="text" class="form-control" name="experienceYears[]" placeholder="Years">
                </div>
               
            </div>
          
        </div>


        <!-- Awards and Recognitions Section -->
        <div id="awards-section-container">
        <div class="col-sm-4">
                    <button type="button" class="btn btn-success" id="addExperience">Add More Experience</button>

                </div>
            <!-- Initial awards section -->
            <div class="row mb-3 awards-section" id="awards_section_1">
                <h5>Awards and Recognitions</h5>
                <div class="col-sm-4">
                    <label for="awardName_1" class="form-label">Award Name:</label>
                    <input type="text" class="form-control" name="awardName[]" id="awardName_1" placeholder="Award Name">
                </div>
                <div class="col-sm-4">
                    <label for="awardYear_1" class="form-label">Year:</label>
                    <input type="text" class="form-control" name="awardYear[]" id="awardYear_1" placeholder="Year">
                </div>
                
            </div>
        </div>


        <!-- Memberships Section -->
        <div id="memberships-section-container">
        <div class="col-sm-6">
                    <!-- Add More Awards and Recognitions Button -->
                    <button type="button" class="btn btn-success" id="addAwards">Add More Awards and Recognitions</button>
                </div>
            <!-- Initial memberships section -->
            <div class="row mb-3 memberships-section" id="memberships_section_1">
                <h5>Memberships</h5>
                <div class="col-sm-4">
                    <label for="membershipName_1" class="form-label">Membership Name:</label>
                    <input type="text" class="form-control" name="membershipName[]" id="membershipName_1" placeholder="Membership Name">
                </div>
                <div class="col-sm-4">
                    <label for="membershipYear_1" class="form-label">Year:</label>
                    <input type="text" class="form-control" name="membershipYear[]" id="membershipYear_1" placeholder="Year">
                </div>
               
            </div>
        </div>

        <!-- Registrations Section -->
        <div id="registrations-section-container">
        <div class="col-sm-6">
                    <!-- Add More Memberships Button -->
                    <button type="button" class="btn btn-success" id="addMemberships">Add More Memberships</button>

                </div>
            <!-- Initial registrations section -->
            <div class="row mb-3 registrations-section" id="registrations_section_1">
                <h5>Registrations</h5>
                <div class="col-sm-4">
                    <label for="registrationName_1" class="form-label">Registration Name:</label>
                    <input type="text" class="form-control" name="registrationName[]" id="registrationName_1" placeholder="Registration Name">
                </div>
                <div class="col-sm-4">
                    <label for="registrationYear_1" class="form-label">Year:</label>
                    <input type="text" class="form-control" name="registrationYear[]" id="registrationYear_1" placeholder="Year">
                </div>
               
            </div>
        </div>
        <!-- Add More Registrations Button -->

        <div class="col-sm-6">
                    <button type="button" class="btn btn-success" id="addRegistrations">Add More Registrations</button>
                </div>

        <div class="col">
            <!-- Introduction Textarea -->
            <label for="introduction" class="form-label">Introduction:</label>
            <textarea class="form-control" id="introduction" name="introduction" rows="4"></textarea>
        </div>
        <div class="col">
            <div id="selectedSpecialization"></div>
        </div>
        <div class="d-flex justify-content-center mt-5">
        <button type="submit" class="btn btn-primary text-center">Submit Data</button>
        </div>

        
    </form>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="doctor_add.js"></script>
<script>
    // Function to capitalize the first letter of a string
    function capitalizeFirstLetter(input) {
        input.value = input.value.replace(/\b\w/g, (char) => char.toUpperCase());
    }

    // Function to get districts based on the selected state
    function getDistricts(state) {
        // Assume $districts is an associative array where keys are states and values are arrays of districts
        var districts = <?php echo json_encode(getDistrictsArray()); ?>;
        var districtSelect = document.getElementById('district');

        // Clear existing options
        districtSelect.innerHTML = '';

        // Populate districts based on the selected state
        if (districts[state]) {
            districts[state].forEach(function(district) {
                var option = document.createElement('option');
                option.value = district;
                option.text = district;
                districtSelect.add(option);
            });
        } else {
            // If no districts for the selected state
            var option = document.createElement('option');
            option.text = 'Select State First';
            districtSelect.add(option);
        }
    }

    // Initial population of districts based on the default state
    getDistricts('Andhra Pradesh');

    // Email validation logic
    document.getElementById('email').addEventListener('input', function() {
        var emailInput = this;
        var emailValidationMessage = document.getElementById('emailValidationMessage');

        if (!isValidEmail(emailInput.value)) {
            emailInput.setCustomValidity('Invalid email address');
            emailValidationMessage.style.display = 'block';
        } else {
            emailInput.setCustomValidity('');
            emailValidationMessage.style.display = 'none';
        }
    });

    // Function to validate email format
    function isValidEmail(email) {
        // You can implement your own email validation logic here
        // For simplicity, let's use a basic regex pattern
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Mobile number validation logic
    document.getElementById('mobileNumber').addEventListener('input', function() {
        var mobileNumberInput = this;
        var mobileNumberValidationMessage = document.getElementById('mobileNumberValidationMessage');

        if (!isValidMobileNumber(mobileNumberInput.value)) {
            mobileNumberInput.setCustomValidity('Invalid mobile number');
            mobileNumberValidationMessage.style.display = 'block';
        } else {
            mobileNumberInput.setCustomValidity('');
            mobileNumberValidationMessage.style.display = 'none';
        }
    });

    // Function to validate mobile number
    function isValidMobileNumber(mobileNumber) {
        // Validate if the input consists only of numeric characters
        return /^[0-9]+$/.test(mobileNumber) && mobileNumber.length === 10;
    }

    document.getElementById('specialization').addEventListener('change', function() {
        var specializationId = this.value;
        if (specializationId) {
            // Make AJAX request to fetch sub-specializations
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_sub_specializations.php?specialization_id=' + specializationId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var subSpecializations = JSON.parse(xhr.responseText);
                    var subSpecializationsHTML = '<input type="checkbox" id="selectAll"> <label for="selectAll">Select All</label><br>';
                    var rowCount = Math.ceil(subSpecializations.length / 4); // Calculate the number of rows required
                    for (var i = 0; i < rowCount; i++) {
                        subSpecializationsHTML += '<div class="row">';
                        for (var j = 0; j < 4 && (i * 4 + j) < subSpecializations.length; j++) {
                            var index = i * 4 + j;
                            subSpecializationsHTML += '<div class="col-md-3"><input type="checkbox" name="sub_specializations[]" value="' + subSpecializations[index].id + '"> ' + subSpecializations[index].name + '</div>';
                        }
                        subSpecializationsHTML += '</div>';
                    }
                    document.getElementById('selectedSpecialization').innerHTML = subSpecializationsHTML;
                    // Add event listener to select all checkbox
                    document.getElementById('selectAll').addEventListener('change', function() {
                        var checkboxes = document.querySelectorAll('input[name="sub_specializations[]"]');
                        for (var i = 0; i < checkboxes.length; i++) {
                            checkboxes[i].checked = this.checked;
                        }
                    });
                }
            };
            xhr.send();
        } else {
            document.getElementById('selectedSpecialization').innerHTML = ''; // Clear the selected specialization area if no specialization is selected
        }
    });
</script>
<script>
    // JavaScript to handle adding more education and experience sections
    document.getElementById('addEducation').addEventListener('click', function() {
        var educationSection = document.querySelector('.education-section').cloneNode(true);
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'w-25', 'mt-2', 'remove-section');
        removeButton.addEventListener('click', function() {
            educationSection.remove();
        });
        educationSection.appendChild(removeButton);
        document.getElementById('education-section-container').appendChild(educationSection);
    });

    document.getElementById('addExperience').addEventListener('click', function() {
        var experienceSection = document.querySelector('.experience-section').cloneNode(true);
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'w-25', 'mt-2', 'remove-section');
        removeButton.addEventListener('click', function() {
            experienceSection.remove();
        });
        experienceSection.appendChild(removeButton);
        document.getElementById('experience-section-container').appendChild(experienceSection);
    });


    // JavaScript to handle adding more Awards and Recognitions sections
    document.getElementById('addAwards').addEventListener('click', function() {
        var awardsSection = document.querySelector('.awards-section').cloneNode(true);
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'w-25', 'mt-2', 'remove-section');
        removeButton.addEventListener('click', function() {
            awardsSection.remove();
        });
        awardsSection.appendChild(removeButton);
        document.getElementById('awards-section-container').appendChild(awardsSection);
    });

    // JavaScript to handle adding more Memberships sections
    document.getElementById('addMemberships').addEventListener('click', function() {
        var membershipsSection = document.querySelector('.memberships-section').cloneNode(true);
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'w-25', 'mt-2', 'remove-section');
        removeButton.addEventListener('click', function() {
            membershipsSection.remove();
        });
        membershipsSection.appendChild(removeButton);
        document.getElementById('memberships-section-container').appendChild(membershipsSection);
    });

    // JavaScript to handle adding more Registrations sections
    document.getElementById('addRegistrations').addEventListener('click', function() {
        var registrationsSection = document.querySelector('.registrations-section').cloneNode(true);
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'w-25', 'mt-2', 'remove-section');
        removeButton.addEventListener('click', function() {
            registrationsSection.remove();
        });
        registrationsSection.appendChild(removeButton);
        document.getElementById('registrations-section-container').appendChild(registrationsSection);
    });
</script>