<?php
include_once "../connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['id']) ||
    !isset($data['question_text']) ||
    !isset($data['option_1']) ||
    !isset($data['option_2']) ||
    !isset($data['option_3']) ||
    !isset($data['correct_answer'])
) {
    echo json_encode(["error" => "Missing required fields"]);
    exit();
}

$id = $data['id'];
$question_text = $data['question_text'];
$option1 = $data['option_1'];
$option2 = $data['option_2'];
$option3 = $data['option_3'];
$correct_answer = $data['correct_answer'];

$sql = "UPDATE questions SET question_text = ?, option_1 = ?, option_2 = ?, option_3 = ?, correct_answer = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "Prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param("ssssii", $question_text, $option1, $option2, $option3, $correct_answer, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => "Question updated successfully"]);
} else {
    echo json_encode(["error" => "Execution failed: " . $stmt->error]);
}
?>