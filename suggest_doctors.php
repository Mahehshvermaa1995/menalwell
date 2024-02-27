<?php
// Include your database connection file
include_once 'sql_connection.php';

// Function to display list items
function displayListItem($item) {
    echo '<li class="list-group-item">' . $item . '</li>';
}

// Check if the query parameter is set
if(isset($_POST['query'])) {
    // Sanitize user input
    $search = mysqli_real_escape_string($conn, $_POST['query']);

    // Initialize arrays to store unique names
    $unique_names = array();

    // Query to fetch specialization names that match the user input
    $sql_specialization = "SELECT specialization_name FROM specializations WHERE specialization_name LIKE '$search%' LIMIT 5";
    $result_specialization = mysqli_query($conn, $sql_specialization);

    // Query to fetch sub-specialization names that match the user input
    $sql_sub_specialization = "SELECT sub_specialization_name FROM sub_specializations WHERE sub_specialization_name LIKE '$search%' LIMIT 5";
    $result_sub_specialization = mysqli_query($conn, $sql_sub_specialization);

    // Query to fetch doctor names that match the user input
    $sql_doctors = "SELECT CONCAT_WS(' ', first_name, middle_name, last_name) AS doctor_name FROM doctors WHERE CONCAT_WS(' ', first_name, middle_name, last_name) LIKE '$search%' LIMIT 5";
    $result_doctors = mysqli_query($conn, $sql_doctors);

    // Query to fetch clinic names that match the user input
    $sql_clinics = "SELECT ClinicName FROM clinics WHERE ClinicName LIKE '$search%' LIMIT 5";
    $result_clinics = mysqli_query($conn, $sql_clinics);

    // Check if there are any results in specialization table
    if(mysqli_num_rows($result_specialization) > 0) {
        // Open the list for suggestions
        echo '<ul class="list-group">';
        // Fetch and display specialization suggestions
        while($row = mysqli_fetch_assoc($result_specialization)) {
            $specialization = trim($row['specialization_name']);
            if (!empty($specialization) && !in_array($specialization, $unique_names)) {
                displayListItem($specialization);
                // Add the name to the array to avoid repetition
                $unique_names[] = $specialization;
            }
        }
        // Close the list for suggestions
        echo '</ul>';
    }

    // Check if there are any results in sub-specialization table
    if(mysqli_num_rows($result_sub_specialization) > 0) {
        // Open the list for suggestions
        echo '<ul class="list-group">';
        // Fetch and display sub-specialization suggestions
        while($row = mysqli_fetch_assoc($result_sub_specialization)) {
            $sub_specialization = trim($row['sub_specialization_name']);
            if (!empty($sub_specialization) && !in_array($sub_specialization, $unique_names)) {
                displayListItem($sub_specialization);
                // Add the name to the array to avoid repetition
                $unique_names[] = $sub_specialization;
            }
        }
        // Close the list for suggestions
        echo '</ul>';
    }

    // Check if there are any results in doctors table
    if(mysqli_num_rows($result_doctors) > 0) {
        // Open the list for suggestions
        echo '<ul class="list-group">';
        // Fetch and display doctor name suggestions
        while($row = mysqli_fetch_assoc($result_doctors)) {
            $doctor_name = trim($row['doctor_name']);
            if (!empty($doctor_name) && !in_array($doctor_name, $unique_names)) {
                displayListItem($doctor_name);
                // Add the name to the array to avoid repetition
                $unique_names[] = $doctor_name;
            }
        }
        // Close the list for suggestions
        echo '</ul>';
    }

    // Check if there are any results in clinics table
    if(mysqli_num_rows($result_clinics) > 0) {
        // Open the list for suggestions
        echo '<ul class="list-group">';
        // Fetch and display clinic name suggestions
        while($row = mysqli_fetch_assoc($result_clinics)) {
            $clinic_name = trim($row['ClinicName']);
            if (!empty($clinic_name) && !in_array($clinic_name, $unique_names)) {
                displayListItem($clinic_name);
                // Add the name to the array to avoid repetition
                $unique_names[] = $clinic_name;
            }
        }
        // Close the list for suggestions
        echo '</ul>';
    }

    // If no matching suggestions found
    if(mysqli_num_rows($result_specialization) == 0 && mysqli_num_rows($result_sub_specialization) == 0 && mysqli_num_rows($result_doctors) == 0 && mysqli_num_rows($result_clinics) == 0) {
        echo '<li class="list-group-item">No suggestions found</li>';
    }
} else {
    // If query parameter is not set
    echo '<li class="list-group-item">Invalid request</li>';
}

// Close database connection
mysqli_close($conn);
?>
