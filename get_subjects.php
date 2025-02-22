<?php
// Include database connection
include './db/connection.php';

// Fetch subject data from the database
$sql = "SELECT s.id, g.name AS grade, s.name AS subject, COUNT(p.id) AS papers
        FROM subjects s
        INNER JOIN grades g ON s.grade_id = g.id
        LEFT JOIN papers p ON s.id = p.subject_id
        GROUP BY s.id";


$result = $conn->query($sql);

if ($result) {
    $subjects = array();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }
    
    // Return subject data as JSON
    echo json_encode($subjects);
} else {
    // Return error message if query fails
    $response = array('error' => true, 'message' => $conn->error);
    echo json_encode($response);
}

// Close database connection
$conn->close();
?>
