<?php
include 'db/connection.php';
require 'vendor/autoload.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

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
            echo json_encode(array('success' => false, 'message' => 'This file already exists in the system. If you want to upload this file, rename the file and upload it again.'));
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

    // Dropbox Configuration
    $appKey = 'ub0mjtxjijepiyz';
    $appSecret = '02lrm6ivv278cy4';
    $accessToken = 'sl.u.AFhZnKWcCHohFwEsBL-5Idl7sB1eYA9ZxFc7BI23-PK5Ao6E3ir7wpNB2b0WkWqDvgpLr_5SE3a5VlcG9JR0uirEmvBk88pL1uz3hUzE1YJJzCX0mXtR3f8oEt4jH0fZAMATRVgUDj6odr9Ve7oCQpKfOFnzZoRfKFhM4rYmFbbwK4W7bp5GhWNkRZ4hQrn2rook-bwvomfy4f715avAlZSBYHo9JEZaO1zZ7yNsYprHrv3k3UvWKB88_V9dQUA-z6Pgm-zq0xbQnVhTEbV-6peFIO1s6eGH-Y41mPuS-lFEpRhB5vFYN7sxrEdzNpb1p6nG0KmYUN_4adOnxeRS6mfhf9jH1ghuNIOddCKQIgJZtg7uHzVPti9uAuYz5iQTAtTkn3JFzSkB1d6_WuY4D0zbn8Rm_Nak3PBfroFnSBzu-g38ezth2VOKHeQfTIXJaA4fnGNOdYCR9AWNP-DSq0uEvidqE948E5BQ9R66r7HSKRA9usv7dJ3TuVPTILlM1ZydhcI-z0NVQopggmRI9jQBZbKjJrI6vUrFJ2SmLdnElkTG7kwW5L2Gu2A28O5uF6R24LrMLBK92Rl2fT2JOIfGyyEuKhC-dxMcZpigdh3r9FWIrA_Jy3Mc50Ke1Pdg-HS36mnck-p9QgRFWg7bZFjBsytdQ09i-35pGzZ0A_nlA0Z4LFQmx2A_U0Wy8E2QnxvrQ0vPpZJyIodAf00DABH3XBVB6ydOzfkqssfVy2XVPPOCoOxYpupo95mjcsJQaSLUKfQai-L4iYDJqzvCSDIwUG5txSmbGNdoGE77d_MxxYgSCPH6i9fgoMaxd_dNdnnIsWDeE5EgMdOElzvP2_DOeje34dh9gFN-KUauz5MbaKgCWc9jOdAl5r_Z5Q9S2V_AqC4nY-Oi8Z5mnxJgXhp4M52fptsTSyTpd-Zb9BYmi24WfclfK4N-8HgxKVOaFl2lsF_Q9aiJcBzWxEqoretUI1yWQGbfva1ld1FZDUtrQyBvfq7k6Y1ZTfRS2say75fm-j2bB7h8cP357ijeQC0-U9JZ0Hi5KlpqxyGprS6UAft7apWFhdKptKJANaiAAq-BenVMsGI4r6e_6QfH0oZnMkTPbt5XmtXTeYR9k1cgy_5pgbmLNE0FVOFfaDbgtf0FbZjlcEYsClk-fObtFJLTIbn1DZK8I_rNUY9d_frpuMaUAHJmrRxZtu75ebtyOF2_tvxux0rUMpmiAZ-wP3qOjuTBFu4jJXM4Eoi3ekypwe9a2f8Q1pdJtfhtpZsEsS8hVoPb6A2osiTS-59CFGK00ivMNEUwZuma1Bqc2SKiYKVIb0bMfJgvk9C2FelBnsHBvZ36a24tWk61UsDrZZuQn_KW48KJzKbX9q1PUyWlRQejwG6CNmblhYY3-r2ugTNF0c54qfLn13heO7SoSkjR'; // Ensure this is set correctly

    $app = new DropboxApp($appKey, $appSecret, $accessToken);
    $dropbox = new Dropbox($app);

    // Upload to Dropbox
    $dropboxFile = new \Kunnu\Dropbox\DropboxFile($paperFile['tmp_name']);
    $dropboxPath = "/Pastpapers/" . $paperName;

    try {
        $uploadedFile = $dropbox->upload($dropboxFile, $dropboxPath, ['autorename' => true]);
        $uploadedFilePath = $uploadedFile->getPathDisplay();

        // Check if the shared link already exists
        $links = $dropbox->postToAPI('/sharing/list_shared_links', [
            "path" => $uploadedFilePath,
            "direct_only" => true
        ]);

        if (isset($links['links']) && count($links['links']) > 0) {
            // If link exists, use it
            $dropboxLink = $links['links'][0]['url'];
        } else {
            // If not, create a new shared link
            $sharedLink = $dropbox->postToAPI('/sharing/create_shared_link_with_settings', [
                "path" => $uploadedFilePath,
                "settings" => [
                    "requested_visibility" => "public"
                ]
            ]);
            $dropboxLink = $sharedLink['url'];
        }

        // Convert the link to a direct download link
        $dropboxLink = str_replace("?dl=0", "?raw=1", $dropboxLink);
          // Log the form data
            $logData = [
                'gradeId' => $gradeId,
                'year' => $year,
                'term' => $term,
                'medium' => $medium,
                'subject_id' => $subject_id,
                'paperName' => $paperName,
                'tmp_name' => $paperFile['tmp_name']
            ];

            file_put_contents('form_data_log.txt', print_r($logData, true), FILE_APPEND);

        // Insert paper data into the database
        $sql = "INSERT INTO papers (grade_id, year, term, medium, subject_id, paper_name, paper_file) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('iississ', $gradeId, $year, $term, $medium, $subject_id, $paperName, $dropboxLink);
            if ($stmt->execute()) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to add paper. ' . $conn->error));
            }
            $stmt->close();
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to prepare SQL statement. ' . $conn->error));
        }
    } catch (Exception $e) {
        echo json_encode(array('success' => false, 'message' => 'Error uploading to Dropbox: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}

$conn->close();
