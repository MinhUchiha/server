<?php
$connect = mysqli_connect("localhost", "root", "abcd1234", "gr");

$homeworkid= $_POST["homeworkid"];
$content= $_POST["content"];

function editHomework() {
    global $connect, $homeworkid,$content;
    $statement = mysqli_prepare($connect, "UPDATE homework SET  content = ? WHERE homeworkid= ? ")or die(mysqli_error($connect));
    mysqli_stmt_bind_param($statement, "si", $content,$homeworkid);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

$response = array();
editHomework();
$response["success"] = true;


echo json_encode($response);
?>