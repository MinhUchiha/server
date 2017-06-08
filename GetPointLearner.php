<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$username= $_POST["learner"];

$statement = mysqli_prepare($conn, "SELECT * FROM learner WHERE username= ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $username);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
  {
     $statement1 = mysqli_prepare($conn, "SELECT * FROM class WHERE classid= ?") or die(mysqli_error($conn));
     mysqli_stmt_bind_param($statement1, "s", $row["classid"]);
     $statement1->execute();
     $result1 = $statement1->get_result();
     while ($row1= $result1->fetch_assoc())
     {
         $row["classname"] = $row1["classname"];
     }
     $statement2 = mysqli_prepare($conn, "SELECT * FROM point WHERE learnerid= ?") or die(mysqli_error($conn));
     mysqli_stmt_bind_param($statement2, "i", $row["learnerid"]);
     $statement2->execute();
     $result2 = $statement2->get_result();
     $row["point"] = "";
     while ($row2= $result2->fetch_assoc())
     {
         $row["point"] = $row2["point"];
     }
     $array[] = $row;
}
$response["listpoint"] = $array;
echo json_encode($response);
?>