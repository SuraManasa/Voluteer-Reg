<?php
session_start();

$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$type=$_POST["type"];
$maxslots=$_POST["maxslots"];
$date=$_POST["date"];
$time=$_POST["time"];
$location=$_POST["location"];
$oragnisation = $_SESSION["organisation"];
$sql = "insert into shifts(Type,Date,Time,Location,Max_Slots,Organization_Name,available_slots) values('$type','$date','$time','$location','$maxslots','$oragnisation','$maxslots')";
$res=$conn->query($sql);
header("location:oraginzationhome.php");



?>