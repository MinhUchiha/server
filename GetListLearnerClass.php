<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$classid= $_POST["classid"];

$statement = mysqli_prepare($conn, "SELECT * FROM learner WHERE classid = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $classid);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
  {
    $statement1 = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement1, "s", $row["username"]);
    $statement1->execute();
    $result1 = $statement1->get_result();
    while ($row1= $result1->fetch_assoc())
    {
        $row["name"] = $row1["name"];
    }
    $statement2 = mysqli_prepare($conn, "SELECT * FROM point WHERE learnerid = ?") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement2, "s", $row["learnerid"]);
    $statement2->execute();
    $result2 = $statement2->get_result();
    $row["point"] = "";
    while ($row2= $result2->fetch_assoc())
    {
        $row["point"] = $row2["point"];
    }
    $array[] = $row;
  }
$response["learnerlist"] = $array;
echo json_encode($response);
?>