<?php
$conn = mysqli_connect("localhost", "root", "abcd1234", "gr");

$teacher= $_POST["teacher"];
$setember = $_POST["setember"];

$statement = mysqli_prepare($conn, "SELECT * FROM class WHERE teacher= ? AND setember = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "ss", $teacher, $setember);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
{
    $statement1 = mysqli_prepare($conn, "SELECT * FROM time WHERE classid= ? ") or
    die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement1, "s", $row["classid"]);
    $statement1->execute();
    $result1 = $statement1->get_result();
    $array2 = array();
    $row["time"]="";
    for($i = 2; $i < 8; $i++) {
        $array2["$i"] = "";
    }
    while ($row1= $result1->fetch_assoc())
    {
        $day = $row1["day"];
        $array2["$day"] = $row1["time"];
        }
    $row["time"] = $array2;
    $array[] = $row;
}
$response["classid"] = $array;
echo json_encode($response);
?>