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
    <?php include '../template/template.php'; ?>
    <div class="container">  

        <?php 
        echo '<h1 class="text-info">';
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
              <button type="submit" class="btn btn-secondary my-2 my-sm-0  signin-button">ADD</button>
              </form>

              <h2>Created Shifts</h2>
        <table class="table-bordered table table-hover" style="width:100%">
        <tr class="table-primary">
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
            echo '<tr class="table-light">';
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
            echo $row['id']; // to know which shift the user is going to edit
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