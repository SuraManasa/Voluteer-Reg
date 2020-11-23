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
    <div class="container">
        <div class="page-header" style="height:60px;">
            <h1></h1>
        </div>
        <div class="bs-component">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><h5> <strong>Home</strong></h5>
                    </a>
                </li>
            </div>
            </nav> 
        </div>      
        <h1>Edit Slot</h1>
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
                echo '<div>Type</div>';     
                echo '<input type="text" name="type" id="type" class="form-control" value= ';
                echo $row['Type'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<div>Max-Slots</div>';     
                echo '<input type="text" name="maxslots" id="maxslots" class="form-control" value= ';
                echo $row['Max_Slots'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<div>Date</div>';     
                echo '<input type="date" name="date" id="date" class="form-control" value= ';
                echo $row['Date'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<div>Time</div>';     
                echo '<input type="time" name="time" id="time" class="form-control" value= ';
                echo $row['Time'];
                echo '>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<div>Location</div>';     
                echo '<input type="text" name="location" id="location" class="form-control" value= ';
                echo $row['Location'] ;
                echo '>';
                echo '</div>';
                echo '<input type="hidden" name="registeredslots" id="registeredslots" class="form-control" value= ';
                echo $row['Max_Slots']-$row['available_slots'];
                echo '>';
        }
         }
            echo '<button type="submit"  name="id" value= ';
            echo $_POST["id"];
            echo '>SAVE';
            echo '</button>';
            echo '</form>'
            ?>
    </div>
    </body>

</html>