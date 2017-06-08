<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$username = $_POST["username"];

$statement = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $username);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $colName, $colUsername, $colRole, $colPassword ,$colBirthday);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
     $response["success"] = true;
     $response["name"] = $colName;
     $response["role"] = $colRole;
     $response["birthday"] = $colBirthday;
}

echo json_encode($response);
?>