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

    $sql = "INSERT INTO quizzes (title, description, created_by) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $created_by);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Quiz created successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create quiz']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Only POST requests are allowed']);
}
?>