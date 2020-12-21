<?php
session_start();
// $id=$_POST["id"];
// echo $id;
?>
<html>
    <head>    
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
    <?php include '../template/template.php'; ?>
    <div class="container">   
        <h1 class="text-info">Edit Slot</h1>
        <?php 
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $id=$_POST["id"];
        $sql = "select * from shifts where id = '$id';";
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            echo'<form action="saveshiftdetails.php" method="POST">';
            while($row = $result->fetch_assoc())
            {
                echo '<div class="form-group">';
                echo '<label for="staticTime" class="col-sm-2 col-form-label">Type:</label>';     
                echo '<input type="text" name="type" id="type" class="col-sm-2 col-form-label"  value= ';
                echo $row['Type']; // fetching value from db table shifts row wise
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="staticTime" class="col-sm-2 col-form-label">Max-Slots:</label>';     
                echo '<input type="text" name="maxslots" id="maxslots" class="col-sm-2 col-form-label" value= ';
                echo $row['Max_Slots'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="staticTime" class="col-sm-2 col-form-label">Date:</label>';     
                echo '<input type="date" name="date" id="date" class="col-sm-2 col-form-label" value= ';
                echo $row['Date'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="staticTime" class="col-sm-2 col-form-label">Time:</label>';     
                echo '<input type="time" name="time" id="time" class="col-sm-2 col-form-label"  value= ';
                echo $row['Time'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="staticTime" class="col-sm-2 col-form-label">Location:</label>';     
                echo '<input type="text" name="location" id="location" class="col-sm-2 col-form-label"  value= ';
                echo $row['Location'] ;
                echo '>';
                echo '</div>';
                echo '<input type="hidden" name="registeredslots" id="registeredslots" class="col-sm-2 col-form-label"  value= '; // To know number of registered slots but not display , registered slots are used in db updation
                echo $row['Max_Slots']-$row['available_slots']; // before editing
                echo '>';
        }
         }
            echo '<button type="submit" class="btn btn-secondary my-2 my-sm-0" name="id" value= ';
            echo $_POST["id"];
            echo '>SAVE';
            echo '</button>';
            echo '</form>'
            ?>
    </div>
    </body>

</html>