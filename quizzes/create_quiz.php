<?php
require_once '../connection.php';  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $created_by = $_POST['created_by'] ?? '';

    
    if (empty($title) || empty($created_by)) {
        echo json_encode(['status' => 'error', 'message' => 'Title and creator are required']);
        exit;
    }
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Only POST requests are allowed']);
}
?>