<?php
// to update database
session_start();
$id=$_POST["id"];
$time=$_POST["time"];
$users =$_SESSION["volunteerlist"];
$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo $id;
echo $time;
echo $username;
foreach($users as $user){
    $sql = "insert into registered_shifts(name,shift_id) values('$user','$id');";// add users in to registerred shifts from volunter list 
    $res=$conn->query($sql);
    $sql1 = "update shifts set available_slots=available_slots-1 where id = '$id';";
    $res=$conn->query($sql1);
}
header("location:corporatehome.php");

?>