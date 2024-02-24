
<?php
// Include the file with database connection details
include 'sql_connection.php';

// Fetch suggestions based on input
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Use prepared statement to prevent SQL injection
    $stmt_specializations = $conn->prepare("SELECT DISTINCT specialization FROM doctors WHERE specialization LIKE ?");
    $stmt_specializations->bind_param("s", $query);
    $stmt_specializations->execute();

    $result_specializations = $stmt_specializations->get_result();

    $specializations = array();

    while ($row_specialization = $result_specializations->fetch_assoc()) {
        $specializations[] = $row_specialization['specialization'];
    }

    // Additional suggestion fetching for "expertise"
    $stmt_expertise = $conn->prepare("SELECT DISTINCT expertise FROM doctors WHERE expertise LIKE ?");
    $stmt_expertise->bind_param("s", $query);
    $stmt_expertise->execute();

    $result_expertise = $stmt_expertise->get_result();

    $expertise = array();

    while ($row_expertise = $result_expertise->fetch_assoc()) {
        $expertise[] = $row_expertise['expertise'];
    }

    // Combine specializations and expertise into a single array
    $all_categories = array_merge($specializations, $expertise);

    // Remove duplicates and sort the array
    $all_categories = array_unique($all_categories);
    sort($all_categories);

    // Return the filtered list as JSON
    echo json_encode($all_categories);

    $stmt_specializations->close();
    $stmt_expertise->close();
}

// Close the database connection
$conn->close();
?>
