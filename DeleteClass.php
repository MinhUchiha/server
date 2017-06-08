<?php

$connect = mysqli_connect("localhost", "root", "1234abcd", "gr");

$classid= $_POST["classid"];

function deleteClass() {
    global $connect, $classid;
    $statement = mysqli_prepare($connect, "DELETE FROM class  WHERE classid= ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "s",$classid);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function classAvailable() {
    global $connect, $classid;
    $statement = mysqli_prepare($connect, "SELECT * FROM class WHERE classid= ?")or die(mysqli_error($connect));
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

$response = array();
$response["success"] = false;

if (classAvailable()){
    deleteClass();
    $response["success"] = true;
}

echo json_encode($response);
?>