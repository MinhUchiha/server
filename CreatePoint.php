<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$learnid = $_POST["learnerid"];
$point = $_POST["point"];

function createPoint() {
    global $connect, $learnid, $point;
    $statement = mysqli_prepare($connect, "INSERT INTO point (learnerid, point) VALUES (  ?, ?)")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "id", $learnid , $point);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}
function editPoint() {
    global $connect,  $learnid, $point;
    $statement = mysqli_prepare($connect, "UPDATE point SET  point = ? WHERE learnerid= ? ")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "di", $point, $learnerid);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function pointAvailable() {
    global $connect, $classid, $learnid;
    $statement = mysqli_prepare($connect, "SELECT * FROM point  WHERE learnerid= ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "i", $learner);
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

    if (pointAvailable()){
        createPoint();
        $response["success"] = true;
    }else{
        editPoint();
        $response["success"] = true;
    }

echo json_encode($response);
?>