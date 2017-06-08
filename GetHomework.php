<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$classid = $_POST["classid"];

$statement = mysqli_prepare($conn, "SELECT * FROM homework WHERE classid = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $classid);
mysqli_stmt_execute($statement);

$array = array();
$response = array();
$response["success"] = false;
$result = $statement->get_result();
 while ($row= $result->fetch_assoc())
  {
     $response["success"] = true;
     $array[] = $row;
  }
$response["listhomework"] = $array;
echo json_encode($response);
?>