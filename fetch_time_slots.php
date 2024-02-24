<?php
// Sample data for demonstration purposes
$doctorId = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : null;

// Sample time slots
$timeSlots = [];

// You might have a database query here to fetch actual time slots based on $doctorId and $date
// For demonstration, I'll just generate some dummy time slots
if ($doctorId !== null && $date !== null) {
    // Example: Fetch time slots from a database table named "appointments"
    // This is just a placeholder for actual database queries
    // You should replace this with your actual database query logic
    // Assume you have a table structure like this:
    // | id | doctor_id | date       | time_slot |
    // |----|-----------|------------|-----------|
    // | 1  | 123       | 2024-02-15 | 10:00 AM  |
    // | 2  | 123       | 2024-02-15 | 11:00 AM  |
    // | 3  | 123       | 2024-02-15 | 12:00 PM  |
    // ...
    // Here, we're just generating some sample time slots
    for ($i = 0; $i < 5; $i++) {
        $timeSlots[] = date('h:i A', strtotime("10:00 AM +$i hour"));
    }
}

// Output the time slots as JSON
header('Content-Type: application/json');
echo json_encode($timeSlots);
?>
