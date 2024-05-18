<?php
// Include the database connection file
include 'connection.php';

// Check if attendance ID and new status are provided in the POST request
if (isset($_POST['attendance_id']) && isset($_POST['status'])) {
    $attendanceId = $_POST['attendance_id'];
    $status = $_POST['status'];

    // Update the status of the attendance record in the database
    $sql = "UPDATE Attendance SET status = ? WHERE attendance_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $attendanceId);

    // Execute the update query
    if ($stmt->execute()) {
        // Send a success response back to the client
        echo json_encode(['success' => true]);
    } else {
        // Send an error response back to the client
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} else {
    // Send an error response back to the client if attendance ID or status is missing
    echo json_encode(['success' => false, 'message' => 'Attendance ID or status is missing']);
}
?>
