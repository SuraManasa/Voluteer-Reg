<?php
session_start();
?>
<html>
    <head>    
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
    <?php include '../template/template.php'; ?>
    <div class="container">

        <h1>Register For Shifts</h1>
  
        <h2 class="text-info">Available Shifts</h2>
        <table class="table-bordered table table-hover" style="width:100%;">
        <tr class="table-primary">
            <th>Orgainisation</th>
            <th>Type</th>
            <th>Available slots</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Location</th>
            <th> </th>

        </tr>
        <?php 
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from shifts where available_slots > 0;"; // fetch all the available shifts
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            echo'<form action="registeruser.php" method="POST">'; // outputs all the form content to registeruser.php
            while($row = $result->fetch_assoc()) //returns the row content
            {
            echo '<tr class="table-light">';
            echo '<td>' ;
            echo $row['Organization_Name'] ;
            echo '</td>';
            echo '<td>' ;
            echo $row['Type'] ;
            echo '</td>';
            echo '<td>' ;
            echo $row['available_slots'] ;
            echo '/';
            echo $row['Max_Slots'];
            echo '</td>';
            echo '<td>' ;
            echo $row['Date'] ;
            echo '</td>';
            echo '<td>' ;
            echo $row['Time'] ;
            echo '</td>';
            echo '<td>' ;
            echo $row['Location'] ;
            echo '</td>';
            echo '<td>' ;
            echo '<button type="submit"  name="id" value= ';
            echo $row['id']; //to know which shift the user want to register
            echo '>Register';
            echo '</button>';
            echo '</td>';
            echo '</tr>';
        }
         }
        ?>
    </table>
    </div>
    </body>

</html>