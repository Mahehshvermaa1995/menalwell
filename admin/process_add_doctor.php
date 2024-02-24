
<?php
// process_add_doctor.php - Handle the form submission for adding a doctor

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
    // Replace these placeholders with your actual database connection code
    $servername = "your_servername";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_dbname";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $doctorName = $_POST['doctorName'];
    // Add other form fields as needed

    // SQL query to insert data into the database
    $sql = "INSERT INTO doctors (doctor_name) VALUES ('$doctorName')";
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Doctor added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the home page or handle errors as needed
    header("Location: index.php");
    exit();
}
?>
