<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$classid = $_POST["classid"];
$username = $_POST["username"];

function addLearner() {
    global $connect, $username, $classid;
    $statement = mysqli_prepare($connect, "INSERT INTO learner (classid, username) VALUES (?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $classid, $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function usernameAvailable() {
    global $connect, $username;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ? AND role = 3")or die(mysqli_error($connect));
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

function classAvailable() {
    global $connect, $classid;
    $statement = mysqli_prepare($connect, "SELECT * FROM class WHERE classid = ? ")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s", $classid);
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

function learnerAvailable() {
    global $connect, $classid,$username;
    $statement = mysqli_prepare($connect, "SELECT * FROM learner WHERE classid = ? AND username = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $classid, $username);
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

if (usernameAvailable() && classAvailable() && learnerAvailable()){
    addLearner();
    $response["success"] = true;
}

echo json_encode($response);
?>