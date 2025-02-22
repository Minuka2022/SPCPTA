<?php
include 'db/connection.php';

// Check if the required GET parameters are set
if (isset($_GET['grade_id']) && isset($_GET['subject_id'])) {
    $gradeId = $_GET['grade_id'];
    $subjectId = $_GET['subject_id'];

    // Prepare the SQL query to fetch papers based on grade_id and subject_id
    $sql = "SELECT year, term, medium, paper_name, paper_file FROM papers WHERE grade_id = ? AND subject_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ii', $gradeId, $subjectId);
        $stmt->execute();
        $result = $stmt->get_result();

        $papers = array();
        while ($row = $result->fetch_assoc()) {
            $papers[] = $row;
        }

        $stmt->close();

        // Return the result as JSON
        echo json_encode(array('success' => true, 'papers' => $papers));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL statement.'));
    }

    $conn->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Required parameters not provided.'));
}
?>
