<?php
include_once "../connection.php";

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "id is required"]);
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "Prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode($questions);
?>