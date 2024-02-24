<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h3 {
            margin-top: 10px;
        }

        .mt-100 {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <?php
    include 'header.php'; // Include your header file
    include_once 'sql_connection.php';

    // Check if the doctor_id is set in the URL
    if (isset($_GET['doctor_id'])) {
        $doctorId = mysqli_real_escape_string($conn, $_GET['doctor_id']);

        // Fetch doctor details
        $doctorSql = "SELECT *, LEFT(introduction, 50) AS short_intro FROM doctors WHERE id = $doctorId";
        $doctorResult = $conn->query($doctorSql);

        if ($doctorResult->num_rows > 0) {
            $doctorRow = $doctorResult->fetch_assoc();

    ?>
            <div class='container mt-100'>
                <div class='row'>
                    <div class='col-12'>
                        <div class='card mb-3 col-8'>
                            <div class='row g-0'>
                                <div class='col-md-4'>
                                    <?php
                                    // Display the doctor's photo here
                                    $photoPath = './admin/' . $doctorRow['photo'];
                                    echo "<img src='{$photoPath}' class='img-fluid p-5 rounded-start' alt='Doctor Image'>";
                                    ?>
                                </div>
                                <div class='col-md-8'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>
                                            <?php
                                            // Combine first_name, middle_name, and last_name
                                            $doctorName = trim($doctorRow['first_name'] . ' ' . $doctorRow['middle_name'] . ' ' . $doctorRow['last_name']);
                                            echo "Dr.{$doctorName}";
                                            ?>
                                        </h5>

                                        <?php
                                        // Fetch education details for the specific doctor
                                        $educationSql = "SELECT * FROM educations WHERE doctor_id = $doctorId LIMIT 1";
                                        $educationResult = $conn->query($educationSql);

                                        if ($educationResult) {
                                            // Check if there is at least one row found
                                            if ($educationResult->num_rows > 0) {
                                                $educationRow = $educationResult->fetch_assoc();
                                        ?>
                                                <p><?php echo "{$educationRow['degree']} - {$educationRow['university']} - {$educationRow['completion_year']}"; ?></p>
                                        <?php
                                            } else {
                                                echo "No education details found for this doctor.";
                                            }
                                        } else {
                                            echo "Error fetching education details: " . $conn->error;
                                        }
                                        ?>


                                        <p><?php echo $doctorRow['specialization_name']; ?></p>
                                        <p><?php echo $doctorRow['experience']; ?></p>
                                        <h6>Introduction:</h6>
                                        <p id="introText"><?php echo $doctorRow['short_intro']; ?></p>
                                        <a href="#" id="readMoreBtn" onclick="toggleIntroduction()">Read more</a>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var fullIntroVisible = false;

                function toggleIntroduction() {
                    var introText = document.getElementById('introText');
                    var readMoreBtn = document.getElementById('readMoreBtn');

                    if (fullIntroVisible) {
                        introText.innerHTML = '<?php echo addslashes($doctorRow['short_intro']); ?>';
                        readMoreBtn.innerHTML = 'Read more';
                    } else {
                        introText.innerHTML = '<?php echo addslashes($doctorRow['introduction']); ?>';
                        readMoreBtn.innerHTML = 'Read less';
                    }

                    fullIntroVisible = !fullIntroVisible;
                }
            </script>

            <div class="container">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1">Tab 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2">Tab 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3">Tab 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4">Tab 4</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <h3>Content for Tab 1</h3>
                        <p>This is the content of Tab 1.</p>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <h3>Content for Tab 2</h3>
                        <p>This is the content of Tab 2.</p>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <h3>Content for Tab 3</h3>
                        <p>This is the content of Tab 3.</p>
                    </div>
                    <div class="tab-pane fade" id="tab4">
                        <h3>Content for Tab 4</h3>
                        <p>This is the content of Tab 4.</p>
                    </div>
                </div>
            </div>

            <?php
            // Fetch sub_specialization_name data for the specific doctor
            $doctorsub_specialization_nameSql = "SELECT sub_specialization_name FROM doctors WHERE id = $doctorId";
            $doctorsub_specialization_nameResult = $conn->query($doctorsub_specialization_nameSql);

            if ($doctorsub_specialization_nameResult) {
                $doctorsub_specialization_nameData = $doctorsub_specialization_nameResult->fetch_all(MYSQLI_ASSOC);
            } else {
                echo "Error fetching doctor's sub_specialization_name data: " . $conn->error;
                $doctorsub_specialization_nameData = [];
            }
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-8 border-bottom">
                        <h3 class="fs-5">Services</h3>
                        <div class="row border-bottom">
                            <?php
                            // Loop through the sub_specialization_name data and display in three columns
                            foreach ($doctorsub_specialization_nameData as $sub_specialization_name) {
                            ?>
                                <div class="col-lg-4">
                                    <?php echo $sub_specialization_name['sub_specialization_name']; ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 border-bottom">
                                <h3 class="fs-5">Specializations</h3>
                                <p><?php echo $doctorRow['specialization_name']; ?></p>
                            </div>
                            <div class="col-lg-5 ms-4 border-bottom">
                                <h3 class="fs-5 ms-5">Awards and Recognitions</h3>
                                <?php
                                // Fetch awards and recognitions details
                                $awardsSql = "SELECT * FROM awards_recognitions WHERE doctor_id = $doctorId";
                                $awardsResult = $conn->query($awardsSql);

                                if ($awardsResult) {
                                    while ($awardsRow = $awardsResult->fetch_assoc()) {
                                        echo "<p>{$awardsRow['award_name']} - {$awardsRow['year']}</p>";
                                    }
                                } else {
                                    echo "Error fetching awards and recognitions details: " . $conn->error;
                                }
                                ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 border-bottom">
                                <h3 class="fs-5">Education</h3>
                                <?php
                                // Fetch education details
                                $educationSql = "SELECT * FROM educations WHERE doctor_id = $doctorId";
                                $educationResult = $conn->query($educationSql);

                                if ($educationResult) {
                                    while ($educationRow = $educationResult->fetch_assoc()) {
                                ?>
                                        <p><?php echo "{$educationRow['degree']} - {$educationRow['university']}- {$educationRow['completion_year']}"; ?></p>
                                <?php
                                    }
                                } else {
                                    echo "Error fetching education details: " . $conn->error;
                                }
                                ?>
                            </div>
                            <div class="col-lg-5 ms-4 border-bottom">
                                <h3 class="fs-5 ms-5 ">Memberships</h3>
                                <?php
                                // Fetch memberships details
                                $membershipsSql = "SELECT * FROM memberships WHERE doctor_id = $doctorId";
                                $membershipsResult = $conn->query($membershipsSql);

                                if ($membershipsResult) {
                                    while ($membershipsRow = $membershipsResult->fetch_assoc()) {
                                        echo "<p>{$membershipsRow['membership_name']} - {$membershipsRow['year']}</p>";
                                    }
                                } else {
                                    echo "Error fetching memberships details: " . $conn->error;
                                }
                                ?>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 border-bottom">
                                <h3 class="fs-5">Experience</h3>
                                <?php
                                // Fetch experience details
                                $experienceSql = "SELECT * FROM experiences WHERE doctor_id = $doctorId";
                                $experienceResult = $conn->query($experienceSql);

                                if ($experienceResult) {
                                ?>

                                    <?php
                                    while ($experienceRow = $experienceResult->fetch_assoc()) {
                                    ?>
                                        <p><?php echo "{$experienceRow['designation']} - {$experienceRow['organization']}- {$experienceRow['experience_years']}"; ?></p>
                                <?php
                                    }
                                } else {
                                    echo "Error fetching experience details: " . $conn->error;
                                }
                                ?>
                            </div>
                            <div class="col-lg-5 ms-4 border-bottom">
                                <h3 class="fs-5 ms-5">Registrations</h3>
                                <?php
                                // Fetch registration details
                                $registrationSql = "SELECT * FROM registrations WHERE doctor_id = $doctorId";
                                $registrationResult = $conn->query($registrationSql);

                                if ($registrationResult) {
                                    while ($registrationRow = $registrationResult->fetch_assoc()) {
                                        echo "<p>{$registrationRow['registration_name']} - {$registrationRow['year']}</p>";
                                    }
                                } else {
                                    echo "Error fetching registration details: " . $conn->error;
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showTab(tabId) {
                    // Hide all tabs
                    var tabs = document.getElementsByClassName('tab-pane');
                    for (var i = 0; i < tabs.length; i++) {
                        tabs[i].classList.add('hidden');
                    }

                    // Show the selected tab
                    document.getElementById(tabId).classList.remove('hidden');

                    // Update active class in the tabs
                    var tabLinks = document.getElementById('tabs').getElementsByTagName('a');
                    for (var i = 0; i < tabLinks.length; i++) {
                        tabLinks[i].classList.remove('active');
                    }
                    document.querySelector(`[href="#${tabId}"]`).classList.add('active');
                }
            </script>

        <?php
        } else {
            // Doctor not found
        ?>
            <div class='container alert alert-danger mt-3'>
                Doctor not found.
            </div>
        <?php
        }
    } else {
        // Doctor_id not set in the URL
        ?>
        <div class='container alert alert-danger mt-3'>
            Doctor ID not specified.
        </div>
    <?php
    }

    // Close the connection
    $conn->close();
    ?>

    <?php
    include 'footer.php'; // Include your footer file
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>