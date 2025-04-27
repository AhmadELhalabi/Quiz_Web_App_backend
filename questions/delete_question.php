<?php
include_once "../connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["error" => "Missing question ID"]);
    exit();
}

$id = $data['id'];

$sql = "DELETE FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "Prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => "Question deleted successfully"]);
} else {
    echo json_encode(["error" => "Execution failed: " . $stmt->error]);
}
?>