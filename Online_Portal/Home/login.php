<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$username=$_POST["username"];
$password=$_POST["password"];

$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select * from user_login where UserName='$username';";
$result=$conn->query($sql);
if($result->num_rows)
{  
$pass=$result->fetch_assoc();
if($password==$pass['Password'])
{
    $_SESSION["username"]=$username;
    echo $pass['Corporation_Name'];
    echo $pass['Organization_Name'];
    if($pass['Corporation_Name']){
        $_SESSION["corporation"]=$pass['Corporation_Name'];
        header("location:corporatehome.php");
    } else if($pass['Organization_Name']) {
        $_SESSION["organisation"]=$pass['Organization_Name'];
        header("location:oraginzationhome.php");
    } else {
       header("location:userhome.php");
    }
    echo "success";
   // header("location:conquer.php");
}
 else 
     {
        echo "<script>
        alert('enter correct password!');
        window.location.href='login.html';
        </script>";
}
}
else
{
    echo "<script>
    alert('Invalid loginId');
    window.location.href='login.html';
    </script>";
}

?>
