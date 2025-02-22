<?php
include 'db/connection.php';

if (isset($_GET['grade_id']) && is_numeric($_GET['grade_id'])) {
    $gradeId = $_GET['grade_id'];
    $stmt = $conn->prepare("SELECT id, name FROM subjects WHERE grade_id = ?");
    $stmt->bind_param('i', $gradeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = array();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    echo json_encode($subjects);
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid grade ID'));
}

$conn->close();
?>
