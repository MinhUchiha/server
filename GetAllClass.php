<?php
$conn = mysqli_connect("localhost", "root", "1234abcd", "gr");

$statement = mysqli_prepare($conn, "SELECT * FROM class ") or die(mysqli_error($conn));
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
 while ($row= $result->fetch_assoc())
  {
     $array[] = $row;
  }
$response["classlist"] = $array;
echo json_encode($response);
?>