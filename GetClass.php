<?php
$conn = mysqli_connect("localhost", "root", "1234abcd", "gr");

$classid = $_POST["classid"];

$statement = mysqli_prepare($conn, "SELECT * FROM class WHERE classid = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $classid);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $colClassid, $colClassName, $colSetember, $colTeacher);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
    $response["success"] = true;
    $response["classid"] = $colClassid;
    $response["classname"] = $colClassName;
    $response["setember"] = $colSetember;
    $response["teacher"] = $colTeacher;
}

echo json_encode($response);
?>