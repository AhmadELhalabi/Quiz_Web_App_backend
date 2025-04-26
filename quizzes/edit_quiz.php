<?php
include_once("../connection.php");


$data = json_decode(file_get_contents("php://input"), true);

$quiz_id = $data["id"];
$title = $data["title"];
$description = $data["description"];

$sql = "UPDATE quizzes SET title = ?, description = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $title, $description, $quiz_id);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Quiz updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update quiz."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
}

$conn->close();
?>