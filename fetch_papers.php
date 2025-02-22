<?php
include 'db/connection.php';

if (isset($_GET['grade_id'])) {
    $gradeId = $_GET['grade_id'];

    // Ensure $gradeId is a valid integer
    if (filter_var($gradeId, FILTER_VALIDATE_INT)) {
        $gradeId = intval($gradeId);

        $sql = "SELECT subjects.name as subject, papers.year, papers.term, papers.medium, papers.paper_name, papers.paper_file , papers.id as paper_id 
                FROM papers 
                INNER JOIN subjects ON papers.subject_id = subjects.id 
                WHERE papers.grade_id = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $gradeId);
            $stmt->execute();
            $result = $stmt->get_result();

            $papers = array();
            while ($row = $result->fetch_assoc()) {
                $papers[] = $row;
            }

            echo json_encode(array('success' => true, 'papers' => $papers));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL statement.'));
        }

        $stmt->close();
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid grade ID.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Grade ID not provided.'));
}

$conn->close();
?>
