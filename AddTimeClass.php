<?php
$connect = mysqli_connect("localhost", "root", "1234abcd", "gr");

$classid = $_POST["classid"];
$day= $_POST["day"];
$time = $_POST["time"];

function addTime() {
    global $connect, $classid, $day, $time;
    $statement = mysqli_prepare($connect, "INSERT INTO time (classid, day, time) VALUES (?, ?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "sss", $classid, $day, $time);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function classidAvailable() {
    global $connect, $classid;
    $statement = mysqli_prepare($connect, "SELECT * FROM class WHERE classid = ?")or die(mysqli_error($connect));
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

if (classidAvailable()){
    addTime();
    $response["success"] = true;
}

echo json_encode($response);
?>