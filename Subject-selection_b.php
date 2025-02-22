<?php
include 'db/connection.php';

if (isset($_GET['grade_id'])) {
    $gradeId = $_GET['grade_id'];

    $sql = "SELECT * FROM subjects WHERE grade_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $gradeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    echo json_encode(['success' => true, 'subjects' => $subjects]);
} else {
    echo json_encode(['success' => false, 'message' => 'Grade ID not provided.']);
}
?>
