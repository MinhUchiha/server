<?php
require("password.php");
$conn = mysqli_connect("localhost", "root", "1234abcd", "gr");

$username = $_POST["username"];
$password = $_POST["password"];

$statement = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $username);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $colName, $colUsername, $colRole, $colPassword,$colBirthday);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
    if (password_verify($password, $colPassword)) {
        $response["success"] = true;
        $response["name"] = $colName;
        $response["role"] = $colRole;
        $response["birthday"] = $colBirthday;
    }
}

echo json_encode($response);
?>