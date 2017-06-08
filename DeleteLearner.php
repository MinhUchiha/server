<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$learnerid = $_POST["learnerid"];

function deleteClass() {
    global $connect, $learnerid;
    $statement = mysqli_prepare($connect, "DELETE FROM learner WHERE learnerid = ?")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "i", $learnerid);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}


$response = array();
deleteClass();
$response["success"] = true;
echo json_encode($response);
?>