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
$firstname=$_POST["firstname"]; //fetches the firstname from the html form
$lastname=$_POST["lastname"];
$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$orgainsationname= $_POST["orgainsationname"];
$sql = "insert into user_login(First_Name,Last_Name,UserName,Email,Password,Organization_Name) values('$firstname','$lastname','$username','$email','$password','$orgainsationname')";
$res=$conn->query($sql);
header("location:login.html");



?>