<?php
include 'db_connection.php';


// Add Employee Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeName = mysqli_real_escape_string($conn, $_POST['employeeName']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    // Add more fields as needed

    $sql = "INSERT INTO employees (employee_name, position, department) VALUES ('$employeeName', '$position', '$department')";
    // Add more fields to the SQL query as needed

    if ($conn->query($sql) === TRUE) {
        echo '<div class="container alert alert-success mt-3">
                Employee added successfully.
            </div>';
    } else {
        echo '<div class="container alert alert-danger mt-3">
                Error: ' . $conn->error . '
            </div>';
    }
}
?>

<div class="container">
    <h2>Add Employee</h2>

    <form method="post" action="">
        <div class="mb-3">
            <label for="employeeName" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="employeeName" name="employeeName" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" name="department" required>
        </div>
        <!-- Add more form fields as needed -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


