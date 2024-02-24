<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Time Slots</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php
    // process_time_slot.php

    include __DIR__ . '/../sql_connection.php';

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'add':
                $doctorId = $_POST['doctor_id'];
                $dayOfWeek = $_POST['day_of_week'];
                $timeSlot = $_POST['time_slot'];
                
                $sql = "INSERT INTO time_slots (doctor_id, day_of_week, time_slot) VALUES ('$doctorId', '$dayOfWeek', '$timeSlot')";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">New record created successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                }
                break;

            case 'edit':
                $timeSlotId = $_POST['time_slot_id'];
                $dayOfWeek = $_POST['day_of_week'];
                $timeSlot = $_POST['time_slot'];

                $sql = "UPDATE time_slots SET day_of_week='$dayOfWeek', time_slot='$timeSlot' WHERE id=$timeSlotId";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Record updated successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error updating record: ' . $conn->error . '</div>';
                }
                break;

            case 'delete':
                $timeSlotId = $_POST['time_slot_id'];

                $sql = "DELETE FROM time_slots WHERE id=$timeSlotId";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Record deleted successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error deleting record: ' . $conn->error . '</div>';
                }
                break;

            default:
                echo '<div class="alert alert-warning" role="alert">Invalid action</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Action parameter not set</div>';
    }

    $conn->close();
    ?>

    <div class="container mt-5">
        <h2 class="mb-4">Manage Time Slots</h2>
        
        <!-- Form for adding new time slot -->
        <div class="card mb-3">
            <div class="card-header">
                Add New Time Slot
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="doctorId" class="form-label">Doctor ID</label>
                        <input type="text" class="form-control" id="doctorId" name="doctor_id">
                    </div>
                    <div class="mb-3">
                        <label for="dayOfWeek" class="form-label">Day of Week</label>
                        <input type="text" class="form-control" id="dayOfWeek" name="day_of_week">
                    </div>
                    <div class="mb-3">
                        <label for="timeSlot" class="form-label">Time Slot</label>
                        <input type="time" class="form-control" id="timeSlot" name="time_slot">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Time Slot</button>
                </form>
            </div>
        </div>

        <!-- Form for editing time slot -->
        <div class="card mb-3">
            <div class="card-header">
                Edit Time Slot
            </div>
            <div class="card-body">
                <form action="process_time_slot.php" method="POST">
                    <input type="hidden" name="action" value="edit">
                    <div class="mb-3">
                        <label for="timeSlotId" class="form-label">Time Slot ID</label>
                        <input type="text" class="form-control" id="timeSlotId" name="time_slot_id">
                    </div>
                    <div class="mb-3">
                        <label for="editDayOfWeek" class="form-label">Day of Week</label>
                        <input type="text" class="form-control" id="editDayOfWeek" name="day_of_week">
                    </div>
                    <div class="mb-3">
                        <label for="editTimeSlot" class="form-label">Time Slot</label>
                        <input type="time" class="form-control" id="editTimeSlot" name="time_slot">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Time Slot</button>
                </form>
            </div>
        </div>

        <!-- Form for deleting time slot -->
        <div class="card mb-3">
            <div class="card-header">
                Delete Time Slot
            </div>
            <div class="card-body">
                <form action="process_time_slot.php" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <div class="mb-3">
                        <label for="deleteTimeSlotId" class="form-label">Time Slot ID</label>
                        <input type="text" class="form-control" id="deleteTimeSlotId" name="time_slot_id">
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Time Slot</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
