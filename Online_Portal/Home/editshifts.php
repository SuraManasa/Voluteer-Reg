<?php
session_start();
// echo $_SESSION["username"];
// echo $_SESSION["organisation"];
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

        <?php 
        echo '<h1>';
        echo $_SESSION["organisation"];
        echo ' -Edit Shifts </h1>';
        ?>
        <form action="addshifts.php"  method="POST">
                <span>
                Type      
                <input type="text" name="type" id="type" placeholder="Enter Type">
                </span>
              <span>
                <span>Max slots</span>
                <input type="text"name="maxslots" id="maxslots">
                </span>
              <span>
                <span>Date</span>
                <input type="date" name="date" id="date" >
                </span>
              <span>
                <span>Time</span>
                <input type="time"name="time" id="time">
            </span>
        
            <span>
                <span>Location</span>
                <input type="text" name="location" id="location"  placeholder="Enter Location">
            </span>
              <button type="submit" class="btn btn-lg signin-button">ADD</button>
              </form>

              <h2>Created Shifts</h2>
        <table style="width:100%">
        <tr>
            <th>Type</th>
            <th>Max slots</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Location</th>
            <th> </th>

        </tr>
        <?php 
        $organisation = $_SESSION["organisation"];
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from shifts where Organization_Name = '$organisation';";
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            echo'<form action="editshiftdetails.php" method="POST">';
            while($row = $result->fetch_assoc())
            {
            echo '<tr>';
            echo '<td>' ;
            echo $row['Type'] ;
            echo '</td>';
            echo '<td>' ;
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
            echo $row['id'];
            echo '>Edit';
            echo '</button>';
            echo '</td>';
            echo '</tr>';
        }
         }
        ?>
    </table>
        </form>
    </div>
    </body>

</html>