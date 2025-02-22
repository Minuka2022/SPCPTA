<?php
header('Content-Type: application/json');

// Define file paths
$greetingFile = 'index.html';  // Current greeting page
$newGreetingFile = 'index_old.html';  // New name for the greeting page
$homeFile = 'home.php';  // Current home page
$newHomeFile = 'index.php';  // New name for the home page (to be shown first)

// Initialize response
$response = ['success' => false, 'message' => ''];

// Rename the files if they exist
if (file_exists($greetingFile) && file_exists($homeFile)) {
    // Perform renaming operations
    if (rename($greetingFile, $newGreetingFile) && rename($homeFile, $newHomeFile)) {
        $response['success'] = true;
        $response['message'] = 'Files renamed successfully.';
    } else {
        $response['message'] = 'Error renaming files.';
    }
} else {
    $response['message'] = 'File(s) not found.';
}

// Output response as JSON
echo json_encode($response);
?>
