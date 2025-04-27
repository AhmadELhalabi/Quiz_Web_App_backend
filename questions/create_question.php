<?php
include_once("../connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"];
$question_text = $data["question_text"];
$option_1 = $data["option_1"];
$option_2 = $data["option_2"];
$option_3 = $data["option_3"];
$correct_answer = $data["correct_answer"]; 

$sql = "INSERT INTO questions (id, question_text, option_1, option_2, option_3, correct_answer) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("isssss", $id, $question_text, $option_1, $option_2, $option_3, $correct_answer);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Question added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add question."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
}

$conn->close();
?>