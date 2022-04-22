<?php
include_once 'conn.php';


$score = mysqli_real_escape_string($conn, $_POST['scr']);
$nume= mysqli_real_escape_string($conn, $_POST['nume']);

$sql = mysqli_query($conn, "INSERT INTO score(score, nume)
VALUES ('{$score}', '{$nume}') ");

if($sql)
echo "succes";





 ?>