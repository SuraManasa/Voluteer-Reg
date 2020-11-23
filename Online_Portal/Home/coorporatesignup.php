<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//  $x=$_POST["logid"];
//  $y=$_POST["password"];

$conn = new mysqli("localhost", "root", "","volunteer_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$corporationname=$_POST["corporationname"];
$sql = "insert into user_login(First_Name,Last_Name,UserName,Email,Password,Corporation_Name) values('$firstname','$lastname','$username','$email','$password','$corporationname')";
$res=$conn->query($sql);
header("location:login.html");



?>