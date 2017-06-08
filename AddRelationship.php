<?php

$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$parent= $_POST["parent"];
$learner= $_POST["learner"];

function addRelationship() {
    global $connect, $learner, $parent;
    $statement = mysqli_prepare($connect, "INSERT INTO relationship ( parent, learner) VALUES (?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $parent, $learner);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}
function relationshipAvailable() {
    global $connect, $learner, $parent;
    $statement = mysqli_prepare($connect, "SELECT * FROM relationship WHERE parent= ? AND learner = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ss", $parent,$learner);
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
function parentAvailable() {
    global $connect, $parent;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ? AND role = 4")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s", $parent);
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
    global $connect, $learner;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ? AND role = 3")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s", $learner);
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

if (parentAvailable() && learnerAvailable()&&relationshipAvailable()){
    addRelationship();
    $response["success"] = true;
}

echo json_encode($response);
?>