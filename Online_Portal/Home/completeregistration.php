// to update available shifts in data base to keep track of register shifts
<?php
session_start();
$id=$_POST["id"]; // shift to which user wants to register
$time=$_POST["time"]; 
$username =$_SESSION["username"]; // to know which user is registring [uname]
$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/*echo $id;
echo $time;
echo $username;*/
$sql = "insert into registered_shifts(name,shift_id,start_time) values('$username','$id','$time');"; // insert to a particular id for a particular user in order to keep track of which user registers to which shifts
$res=$conn->query($sql);
$sql1 = "update shifts set available_slots=available_slots-1 where id = '$id';";
$res=$conn->query($sql1);
header("location:userhome.php");  //redirect to user home page

?>