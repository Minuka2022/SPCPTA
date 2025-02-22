<?php
include 'db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        http_response_code(400);
        echo json_encode(array('success' => false, 'message' => 'Invalid or missing subject ID', 'id' => isset($_POST['id']) ? $_POST['id'] : null));
        exit;
    }

    $subjectId = $_POST['id'];

    // Perform the SQL delete operation
    $sql = "DELETE FROM subjects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL statement'));
        exit;
    }
    $stmt->bind_param('i', $subjectId);
    $result = $stmt->execute();
    if (!$result) {
        http_response_code(500);
        echo json_encode(array('success' => false, 'message' => 'Failed to execute SQL query'));
        exit;
    }

    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('success' => true, 'id' => $subjectId));
    } else {
        echo json_encode(array('success' => false, 'message' => 'No subject found with the given ID', 'id' => $subjectId));
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('success' => false, 'message' => 'Only POST requests are allowed'));
}

$conn->close();
?>
