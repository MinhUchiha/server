<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$parent= $_POST["parent"];

$statement = mysqli_prepare($conn, "SELECT * FROM relationship WHERE parent = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $parent);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
  {
     $statement1 = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?") or die(mysqli_error($conn));
     mysqli_stmt_bind_param($statement1, "s", $row["learner"]);
     $statement1->execute();
     $result1 = $statement1->get_result();
     while ($row1= $result1->fetch_assoc())
     {
         $row["learnername"] = $row1["name"];
     }
     $array[] = $row;
  }
$response["listrelationship"] = $array;
echo json_encode($response);
?>