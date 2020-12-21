<?php
session_start();
$id=$_POST["id"];
$maxslots = $_POST["maxslots"];
$date = $_POST["date"];
$time=$_POST["time"];
$location = $_POST["location"];
$registeredslots = $_POST["registeredslots"];
$available_slots = $maxslots - $registeredslots; // after  editing
$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo $id;
echo $time;
echo $username;
$sql1 = "update shifts set Date ='$date',Time ='$time',Location='$location',Max_Slots='$maxslots',available_slots = '$available_slots' where id = '$id';";
$res=$conn->query($sql1);
header("location:oraginzationhome.php");

?>