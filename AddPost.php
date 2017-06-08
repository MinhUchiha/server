<?php

$connect = mysqli_connect("localhost", "root", "1234abcd", "gr");

$classid = $_POST["classid"];
$username = $_POST["username"];
$title = $_POST["title"];
$content = $_POST["content"];

function addPost() {
    global $connect, $username, $classid, $content, $title;
    $statement = mysqli_prepare($connect, "INSERT INTO post (classid, title, username, content) VALUES (?, ?, ?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ssss", $classid,$title, $username,$content);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function usernameAvailable() {
    global $connect, $username;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?")or die(mysqli_error($connect));
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
    $statement = mysqli_prepare($connect, "SELECT * FROM class WHERE classid = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s", $classid);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    $count = mysqli_stmt_num_rows($statement);
    mysqli_stmt_close($statement);
    if ($count < 1){
        echo "1";
        return false;
    }else {
        return true;
    }
}


$response = array();
$response["success"] = false;

if (usernameAvailable() && classAvailable()){
    addPost();
    $response["success"] = true;
}

echo json_encode($response);
?>