<?php
include_once("../connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$quiz_id = $data["id"];


$sql = "DELETE FROM quizzes WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $quiz_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Quiz deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete quiz."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
}

$conn->close();
?>