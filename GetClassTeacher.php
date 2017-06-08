<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$teacher= $_POST["teacher"];

$statement = mysqli_prepare($conn, "SELECT * FROM class WHERE teacher= ? ORDER BY setember DESC") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $teacher);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
 while ($row= $result->fetch_assoc())
  {
     $array[] = $row;
  }
$response["classid"] = $array;
echo json_encode($response);
?>