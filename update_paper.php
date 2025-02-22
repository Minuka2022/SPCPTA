<?php
include 'db/connection.php';

// Check if required POST parameters are set
if (isset($_POST['paper_id']) && isset($_POST['subject_id']) && isset($_POST['year']) && isset($_POST['term']) && isset($_POST['medium'])) {
    $paperId = $_POST['paper_id'];
    $subjectId = $_POST['subject_id'];
    $year = $_POST['year'];
    $term = $_POST['term'];
    $medium = $_POST['medium'];
    
    // Get the existing file path using paper ID
    $sqlSelect = "SELECT paper_file FROM papers WHERE id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);

    if ($stmtSelect) {
        $stmtSelect->bind_param('i', $paperId);
        $stmtSelect->execute();
        $stmtSelect->bind_result($existingFile);
        $stmtSelect->fetch();
        $stmtSelect->close();
      
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL select statement.'));
        exit;
    }

    // Handle file upload
    $paperFile = $existingFile;
    $paperName = basename($existingFile);  // Initialize paper name as the existing file name

    if (isset($_FILES['paper_file']) && $_FILES['paper_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['paper_file']['tmp_name'];
        $fileName = $_FILES['paper_file']['name'];
        $fileSize = $_FILES['paper_file']['size'];
        $fileType = $_FILES['paper_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Sanitize file name and derive the paper name from the uploaded file
        $paperName = basename($fileName);
        $newFileName = $paperName;
        $uploadFileDir = './papers/';
        $destPath = $uploadFileDir . $newFileName;
      
        // Delete the old file using paper ID
        if ($existingFile) {
            $existingFilePath = './' . $existingFile; // Assuming papers directory is in the root directory
            if (file_exists($existingFilePath)) {
                if (unlink($existingFilePath)) {
                    echo json_encode(array('success' => true, 'message' => 'Old file deleted successfully.'));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Failed to delete the old file.'));
                    exit;
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Old file does not exist.'));
                exit;
            }
        }

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $paperFile = 'papers/' . $newFileName;
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to move uploaded file.'));
            exit;
        }
    }

    // Update the paper record in the database
    $sqlUpdate = "UPDATE papers SET subject_id = ?, year = ?, term = ?, medium = ?, paper_name = ?, paper_file = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);

    if ($stmtUpdate) {
        $stmtUpdate->bind_param('isssssi', $subjectId, $year, $term, $medium, $paperName, $paperFile, $paperId);
        $stmtUpdate->execute();

        if ($stmtUpdate->affected_rows > 0) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'No changes made to the paper.'));
        }

        $stmtUpdate->close();
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL update statement.'));
    }

    $conn->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Required parameters not provided.'));
}
?>
