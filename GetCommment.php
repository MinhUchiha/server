<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$postid = $_POST["postid"];

$statement = mysqli_prepare($conn, "SELECT * FROM comment WHERE postid = ? ORDER BY timestamp DESC") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "i", $postid );
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
{
    $array[] = $row;
}
$response["comment"] = $array;
echo json_encode($response);
?>