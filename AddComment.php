<?php

$connect = mysqli_connect("localhost", "root", "1234abcd", "gr");

$postid = $_POST["postid"];
$username = $_POST["username"];
$content = $_POST["content"];

function addPost() {
    global $connect, $username, $postid, $content;
    $statement = mysqli_prepare($connect, "INSERT INTO comment (postid, username, content) VALUES (?, ?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "iss", $postid, $username,$content);
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

function postAvailable() {
    global $connect, $postid;
    $statement = mysqli_prepare($connect, "SELECT * FROM post WHERE postid= ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "i", $postid);
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

if (usernameAvailable() && postAvailable()){
    addPost();
    $response["success"] = true;
}

echo json_encode($response);
?>