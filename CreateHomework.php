<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$classid = $_POST["classid"];
$content = $_POST["content"];

function createHomework() {
    global $connect, $classid, $content;
    $statement = mysqli_prepare($connect, "INSERT INTO homework (classid, content) VALUES ( ?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $classid, $content);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}
$response = array();
$response["success"] = false;
createHomework();
$response["success"] = true;

echo json_encode($response);
?>