<?php
$conn = mysqli_connect("localhost", "root", "1234abcd", "gr");

$classid= $_POST["classid"];

$statement = mysqli_prepare($conn, "SELECT * FROM point WHERE classid= ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $classid);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
 while ($row= $result->fetch_assoc())
  {
     $array[] = $row;
  }
$response["listpoint"] = $array;
echo json_encode($response);
?>