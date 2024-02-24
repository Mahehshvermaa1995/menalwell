
<?php
// Include the file for database connection
include '../sql_connection.php';

// Check if clinicID is provided in the GET request
if(isset($_GET['clinicID'])) {
    // Sanitize the input to prevent SQL injection
    $clinicID = mysqli_real_escape_string($conn, $_GET['clinicID']);

    // Query to fetch clinic data based on clinicID
    $query = "SELECT * FROM clinics WHERE ClinicID = '$clinicID'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch clinic data as an associative array
        $clinicData = $result->fetch_assoc();

        // Convert the openingDays string to an array
        $clinicData['openingDays'] = explode(",", $clinicData['OpeningDays']);

        // Send clinic data as JSON response
        header('Content-Type: application/json');
        echo json_encode($clinicData);
    } else {
        // If no clinic found with the provided clinicID, return an empty JSON object
        echo json_encode([]);
    }
} else {
    // If clinicID is not provided in the GET request, return an empty JSON object
    echo json_encode([]);
}

// Close database connection
$conn->close();
?>
