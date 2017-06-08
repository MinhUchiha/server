<?php
$conn = mysqli_connect("localhost", "root", "1234abcd", "gr");

$username= $_POST["learner"];
$setember = $_POST["setember"];

$statement = mysqli_prepare($conn, "SELECT * FROM learner WHERE username = ?") or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement, "s", $username);
$statement->execute();
$array = array();
$response = array();
$response["success"] = true;
$result = $statement->get_result();
while ($row= $result->fetch_assoc())
{
    $statement1 = mysqli_prepare($conn, "SELECT * FROM class WHERE classid = ? AND setember=?") or die(mysqli_error($conn));
    mysqli_stmt_bind_param($statement1, "ss", $row["classid"], $setember);
    $statement1->execute();
    $result1 = $statement1->get_result();
    while ($row1= $result1->fetch_assoc())
    {
        $statement2 = mysqli_prepare($conn, "SELECT * FROM time WHERE classid= ? ") or
        die(mysqli_error($conn));
        mysqli_stmt_bind_param($statement2, "s", $row1["classid"]);
        $statement2->execute();
        $result2 = $statement2->get_result();
        $array2 = array();
        for($i = 2; $i < 8; $i++) {
            $array2["$i"] = "";
        }
        while ($row2= $result2->fetch_assoc())
        {
            $day = $row2["day"];
            $array2["$day"] = $row2["time"];
        }
        $row1["time"]=$array2;
        $array[] = $row1;
    }
}
$response["classid"] = $array;
echo json_encode($response);
?>