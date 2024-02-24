<?php

include '../sql_connection.php';

// Fetch sub-specializations based on the specialization ID
$specializationId = $_GET['specialization_id'];

$sql = "SELECT * FROM sub_specializations WHERE specialization_id = $specializationId";
$result = $conn->query($sql);

$subSpecializations = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $subSpecialization = array(
            'id' => $row['id'],
            'name' => $row['sub_specialization_name']
        );
        $subSpecializations[] = $subSpecialization;
    }
}

// Close the database connection
$conn->close();

// Output sub-specializations as JSON
header('Content-Type: application/json');
echo json_encode($subSpecializations);
?>
