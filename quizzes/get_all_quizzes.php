<?php
include_once("../connection.php");

$sql = "SELECT * FROM quizzes";
$result = $conn->query($sql);

$quizzes = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
    echo json_encode(["success" => true, "quizzes" => $quizzes]);
} else {
    echo json_encode(["success" => false, "message" => "No quizzes found."]);
}

$conn->close();
?>