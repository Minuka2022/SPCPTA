<?php
include './db/connection.php';

$subjectId = $_GET['subject_id'];

// Fetch mediums based on the subject ID
$query = "SELECT DISTINCT medium FROM papers WHERE subject_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $subjectId);
$stmt->execute();
$result = $stmt->get_result();

$mediums = [];
while ($row = $result->fetch_assoc()) {
    $mediums[] = $row['medium'];
}

$response = [
    'success' => true,
    'mediums' => $mediums
];

echo json_encode($response);
?>
