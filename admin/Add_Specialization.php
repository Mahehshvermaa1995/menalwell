<?php
include '../sql_connection.php';

// Add Specialization Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $specialization_name = mysqli_real_escape_string($conn, $_POST['specializations']);

    // Check if the specialization already exists
    $check_sql = "SELECT * FROM specializations WHERE specialization_name = '$specialization_name'";
    $check_result = $conn->query($check_sql);

    if ($check_result === false) {
        echo '<div class="container alert alert-danger mt-3">
                Error: ' . $conn->error . '
            </div>';
    } elseif ($check_result->num_rows > 0) {
        echo '<div class="container alert alert-warning mt-3">
                Specialization already exists.
            </div>';
    } else {
        $sql = "INSERT INTO specializations (specialization_name) VALUES ('$specialization_name')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="container alert alert-success mt-3">
                    Specialization added successfully.
                </div>';
            
            // Redirect to the dashboard after successful addition
            echo '<script>window.location.href = "dashboard.php";</script>';
            exit(); // Stop further execution
        } else {
            echo '<div class="container alert alert-danger mt-3">
                    Error: ' . $conn->error . '
                </div>';
        }
    }
}
?>

<div class="container">
    <h2>Add Specialization</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <label for="specializations" class="form-label">Specialization Name</label>
            <input type="text" class="form-control" id="specializations" name="specializations" required>
        </div>
        <!-- Add more form fields as needed -->

        <button type="submit" class="btn btn-primary">Add Specialization</button>
    </form>
</div>
