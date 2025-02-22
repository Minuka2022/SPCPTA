<?php
include 'db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gradeId = $_POST['grade_id'];
    $year = $_POST['year'];
    $term = $_POST['term'];
    $medium = $_POST['medium'];
    $subject_id = $_POST['subject_id'];
    $paperFile = $_FILES['paper_file'];

    // Get the original file name
    $paperName = basename($paperFile['name']);

    // Check if a paper with the same name already exists in the database
    $checkSql = "SELECT COUNT(*) as count FROM papers WHERE paper_name = ?";
    $checkStmt = $conn->prepare($checkSql);
    if ($checkStmt) {
        $checkStmt->bind_param('s', $paperName);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['count'] > 0) {
            echo json_encode(array('success' => false, 'message' => 'This file already exists in the system. if you what to upload this file, Rename the file and upload it again '));
            $checkStmt->close();
            $conn->close();
            exit;
        }
        $checkStmt->close();
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL statement.'));
        $conn->close();
        exit;
    }

    // Move the uploaded file to the desired location (papers folder)
    $uploadDir = 'papers/'; // Specify the destination folder
    $uploadFile = $uploadDir . $paperName;
    if (move_uploaded_file($paperFile['tmp_name'], $uploadFile)) {
        // Insert paper data into the database
        $sql = "INSERT INTO papers (grade_id, year, term, medium, subject_id, paper_name, paper_file) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('iississ', $gradeId, $year, $term, $medium, $subject_id, $paperName, $uploadFile);
            if ($stmt->execute()) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to add paper.'));
            }
            $stmt->close();
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL statement.'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to upload file.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

$conn->close();
?>
