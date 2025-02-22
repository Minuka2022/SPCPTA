<?php
include './db/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade_id = $_POST['grade_id'];
    $subject_name = $_POST['subject_name'];

    $sql = "INSERT INTO subjects (grade_id, name) VALUES ('$grade_id', '$subject_name')";

    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => $conn->error);
    }

    echo json_encode($response);
}

$conn->close();
?>
