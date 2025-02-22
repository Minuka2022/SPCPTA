<?php
include 'db/connection.php';

// Check if paper_id is set in POST request
if (isset($_POST['paper_id'])) {
    $paperId = $_POST['paper_id'];

    // Prepare SQL statement to get the paper file path
    $sqlSelect = "SELECT paper_file FROM papers WHERE id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);

    if ($stmtSelect) {
        // Bind paper_id parameter
        $stmtSelect->bind_param('i', $paperId);
        // Execute the statement
        $stmtSelect->execute();
        // Bind result variable
        $stmtSelect->bind_result($paperFile);
        // Fetch the result
        $stmtSelect->fetch();

        // Close the select statement
        $stmtSelect->close();

        if ($paperFile) {
            // Prepare SQL statement to delete paper
            $sqlDelete = "DELETE FROM papers WHERE id = ?";
            $stmtDelete = $conn->prepare($sqlDelete);

            if ($stmtDelete) {
                // Bind paper_id parameter
                $stmtDelete->bind_param('i', $paperId);
                // Execute the statement
                $stmtDelete->execute();

                if ($stmtDelete->affected_rows > 0) {
                    // Paper deleted successfully
                    $filePath = $paperFile; // No need to prepend 'papers/' since it's already included in $paperFile
                    if (file_exists($filePath)) {
                        // Attempt to delete the file
                        if (unlink($filePath)) {
                            echo json_encode(array('success' => true));
                        } else {
                            echo json_encode(array('success' => false, 'message' => 'Failed to delete the file.'));
                        }
                    } else {
                        echo json_encode(array('success' => true, 'message' => 'Paper deleted, but file not found.'));
                    }
                } else {
                    // No rows affected, paper may not exist
                    echo json_encode(array('success' => false, 'message' => 'Paper not found or already deleted.'));
                }

                // Close the delete statement
                $stmtDelete->close();
            } else {
                // Error in preparing SQL statement
                echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL delete statement.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Paper file not found.'));
        }
    } else {
        // Error in preparing SQL select statement
        echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL select statement.'));
    }

    // Close the connection
    $conn->close();
} else {
    // Paper id not provided
    echo json_encode(array('success' => false, 'message' => 'Paper ID not provided.'));
}
?>
