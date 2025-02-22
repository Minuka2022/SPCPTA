<?php
include 'db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = htmlspecialchars($_POST['full_name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $currentPassword = htmlspecialchars($_POST['current_password']);
    $newPassword = htmlspecialchars($_POST['new_password']);

    $adminUsername = $_SESSION['username'];

    // If current password is provided, verify it
    if (!empty($currentPassword)) {
        $query = "SELECT password FROM admin WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $adminUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify current password
        if ($currentPassword != $storedPassword) {
            echo json_encode(array('success' => false, 'message' => 'Current password is incorrect.'));
            exit();
        }
    }

    // Update password if new password is provided and current password is verified or empty
    if (!empty($newPassword) && (!empty($currentPassword) && $currentPassword == $storedPassword || empty($currentPassword))) {
        $updateQuery = "UPDATE admin SET full_name = ?, username = ?, email = ?, phone = ?, password = ? WHERE username = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ssssss', $fullName, $username, $email, $phone, $newPassword, $adminUsername);
    } else {
        $updateQuery = "UPDATE admin SET full_name = ?, username = ?, email = ?, phone = ? WHERE username = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('sssss', $fullName, $username, $email, $phone, $adminUsername);
    }

    if ($stmt->execute()) {
        // Update session username if it has been changed
        $_SESSION['username'] = $username;
        echo json_encode(array('success' => true, 'message' => 'Profile updated successfully.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to update profile.'));
    }

    $stmt->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}

$conn->close();
?>
