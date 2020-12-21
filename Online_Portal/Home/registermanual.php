<?php
session_start();
$id=$_POST["id"];
$time=$_POST["time"];
$username =$_POST["firstname"];
$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo $id;
echo $time;
echo $username;
$sql = "insert into registered_shifts(name,shift_id,start_time) values('$username','$id','$time');";
$res=$conn->query($sql);
$sql1 = "update shifts set available_slots=available_slots-1 where id = '$id';";
$res=$conn->query($sql1);
header("location:corporatehome.php");

?>