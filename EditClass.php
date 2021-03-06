<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");
$classid = $_POST["classid"];
$classname = $_POST["classname"];
$setember = $_POST["setember"];
$teacher = $_POST["teacher"];

function updateClass() {
    global $connect, $classid, $classname, $setember,$teacher;
    $statement = mysqli_prepare($connect, "UPDATE class SET classname = ?, setember = ? , teacher = ? WHERE classid = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "ssss", $classname, $setember, $teacher , $classid);
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
function teacherAvailable() {
    global $connect, $teacher;
    $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ? AND role = 2") or 
    die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement, "s", $teacher);
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

if (classidAvailable() && teacherAvailable()){
    updateClass();
    $response["success"] = true;
}

echo json_encode($response);
?>