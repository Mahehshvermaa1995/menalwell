<?php
include '../sql_connection.php';

// Fetch specializations from the database
$sql_specializations = "SELECT * FROM specializations";
$result_specializations = $conn->query($sql_specializations);

// Add Sub-specialization Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each submitted sub-specialization name and insert into the database
    foreach ($_POST['sub_specialization_name'] as $sub_specialization_name) {
        $specialization_id = mysqli_real_escape_string($conn, $_POST['specialization_id']);

        // Insert the sub-specialization into the database
        $sql = "INSERT INTO sub_specializations (specialization_id, sub_specialization_name) VALUES ('$specialization_id', '$sub_specialization_name')";

        if ($conn->query($sql) !== TRUE) {
            echo '<div class="container alert alert-danger mt-3">
                    Error: ' . $conn->error . '
                </div>';
            // If there's an error, stop the loop
            break;
        }
    }

    // If all sub-specializations were added successfully
    if (!isset($_POST['sub_specialization_name']) || count($_POST['sub_specialization_name']) === 0) {
        echo '<div class="container alert alert-warning mt-3">
                Please enter at least one sub-specialization.
            </div>';
    } else {
        echo '<div class="container alert alert-success mt-3">
                Sub-specializations added successfully.
            </div>';
        
        // Redirect to the dashboard after successful addition
        echo '<script>window.location.href = "dashboard.php";</script>';
        exit(); // Stop further execution
    }
}
?>

<div class="container">
    <h2>Add Sub-specializations</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <label for="specialization_id" class="form-label">Select Specialization:</label><br>
            <select id="specialization_id" name="specialization_id" required>
                <option value="">Select Specialization</option>
                <?php
                if ($result_specializations->num_rows > 0) {
                    while ($row = $result_specializations->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["specialization_name"] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div id="subSpecializationsContainer" class="mb-3">
            <label for="sub_specialization_name" class="form-label">Sub-specialization Names</label><br>
            <input type="text" class="form-control mb-2" name="sub_specialization_name[]" required>
        </div>
        <button type="button" id="addSubSpecializationBtn" class="btn btn-primary">Add Another Sub-specialization</button>
        <!-- Add more form fields as needed -->
        <button type="submit" class="btn btn-success mt-2">Add Sub-specializations</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Add input field for sub-specialization name when clicking the button
    $('#addSubSpecializationBtn').click(function() {
        $('#subSpecializationsContainer').append('<input type="text" class="form-control mb-2" name="sub_specialization_name[]" required>');
    });
});
</script>
