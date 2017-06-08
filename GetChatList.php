<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$username = $_POST["username"];

$statement = mysqli_prepare($conn, "SELECT * FROM user WHERE username <> ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $username );
$statement->execute();
$user = array();
$array = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
  { 
     $user["name"]= $row["name"];
     $user["username"]= $row["username"];
     $user["role"]= $row["role"];
     $user["birthday"]= $row["birthday"];
     $array[] = $user;
  }
$response["userlist"] = $array;
echo json_encode($response);
?>