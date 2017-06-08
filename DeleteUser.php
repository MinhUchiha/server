<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$username = $_POST["username"];

function deleteUser() {
    global $connect , $username;
    $statement = mysqli_prepare($connect, "DELETE FROM user  WHERE username = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s",$username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function usernameAvailable() {
    global $connect, $username;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?") or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    $count = mysqli_stmt_num_rows($statement);
    mysqli_stmt_close($statement);
    if ($count < 1){
        return false;
    }else {
        return true;
    }
}

$response = array();
$response["success"] = false;

if (usernameAvailable()){
    deleteUser();
    $response["success"] = true;
}

echo json_encode($response);
?>