<?php
require("password.php");

$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$username = $_POST["username"];
$password = $_POST["newpass"];

function resetPassword() {
    global $connect, $name, $role, $username, $password;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $statement = mysqli_prepare($connect, "UPDATE user SET password = ?  WHERE username = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $passwordHash, $username);
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
        return flase;
    }else {
        return true;
    }
}

$response = array();
$response["success"] = false;

if (usernameAvailable()){
    resetPassword();
    $response["success"] = true;
}

echo json_encode($response);
?>