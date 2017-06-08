<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$classid= $_POST["classid"];

$statement = mysqli_prepare($conn, "SELECT * FROM post WHERE classid = ? ORDER BY timestamp DESC") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $classid);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
{
    $statement = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement, "s", $row["username"]);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colName, $colUsername, $colRole, $colPassword ,$colBirthday);
    while(mysqli_stmt_fetch($statement)){
       $row["name"] = $colName;
    }
    $array[] = $row;
}
$response["post"] = $array;
echo json_encode($response);
?>