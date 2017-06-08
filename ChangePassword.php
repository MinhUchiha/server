<?php
require("password.php");

$connect = mysqli_connect("localhost", "root", "1234abcd", "gr");

$username = $_POST["username"];
$password = $_POST["password"];
$newpass =  $_POST["newpass"];

function resetPassword() {
    global $connect, $name, $role, $username, $newpass;
    $passwordHash = password_hash($newpass, PASSWORD_DEFAULT);
    $statement = mysqli_prepare($connect, "UPDATE user SET password = ?  WHERE username = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $passwordHash, $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function usernameAvailable() {
    global $connect, $username, $password;
    $statement = mysqli_prepare($connect , "SELECT * FROM user WHERE username = ?") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colName, $colUsername, $colRole,$colPassword,$colBirthday);

    while(mysqli_stmt_fetch($statement)){
       if (password_verify($password, $colPassword)) {
            return true;
        }else{return false;}
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