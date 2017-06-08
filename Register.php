<?php
require("password.php");

$connect = mysqli_connect("localhost", "root", "1234abcd", "gr");

$name = $_POST["name"];
$role = $_POST["role"];
$username = $_POST["username"];
$password = $_POST["password"];
$birthday = $_POST["birthday"];

function registerUser() {
    global $connect, $name, $role, $username, $password, $birthday;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $statement = mysqli_prepare($connect, "INSERT INTO user (name, role, username, password,birthday) VALUES (?, ?, ?, ?,?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "sisss", $name, $role, $username, $passwordHash,$birthday);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function usernameAvailable() {
    global $connect, $username;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    $count = mysqli_stmt_num_rows($statement);
    mysqli_stmt_close($statement);
    if ($count < 1){
        return true;
    }else {
        return false;
    }
}

$response = array();
$response["success"] = false;
$response["msg"] = "User da ton tai";
if (usernameAvailable()){
    registerUser();
    $response["success"] = true;
    $response["msg"] = "Create success";
}

echo json_encode($response);
?>