
<?php
include 'sql_connection.php';
// Fetch data based on input
if(isset($_GET['specialization'])) {
    $specialization = $_GET['specialization'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE specialization LIKE ?");
    $stmt->bind_param("s", $specialization);
    $stmt->execute();

    $result = $stmt->get_result();

    // Create an array to hold the search results
    $searchResults = array();

    // Display suggestions or error message
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $searchResults[] = array(
                'doctor_name' => $row['doctor_name'],
                'specialization' => $row['specialization']
            );
        }
    } else {
        $searchResults['error'] = "No results found for the given specialization.";
    }

    // Return the search results as JSON
    echo json_encode($searchResults);

    $stmt->close();
}

$conn->close();
?>
