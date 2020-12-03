
<?php
                session_start();?>
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
        echo ' - Shifts </h1>';
        ?>
        <form action="editshifts.php" method="POST">
              <button type="submit" class="btn btn-lg signin-button">EDIT SHIFTS</button>
        </form>
        <h2>Registered Shifts</h2>
        <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Filled slots</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Location</th>

        </tr>
        <?php 
        $organisation = $_SESSION["organisation"];
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from registered_shifts where shift_id IN (select id from shifts where Organization_Name = '$organisation');";
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            while($row = $result->fetch_assoc())
            {
                $shiftid = $row['shift_id'];
            echo '<tr>';
            echo '<td>' ;
            echo $row['name'];
            echo '</td>';
            $sql1 = "select * from shifts where id= '$shiftid'";
            $result1=$conn->query($sql1);
            if($result1->num_rows)
            {
               while($row1 = $result1->fetch_assoc())
               { 
                echo '<td>' ;
                echo $row1['Type'] ;
                echo '</td>';
                echo '<td>' ;
                echo $row1['Max_Slots']-$row1['available_slots'] ;
                echo '/';
                echo $row1['Max_Slots'];
                echo '</td>';
                echo '<td>' ;
                echo $row1['Date'] ;
                echo '</td>';
                echo '<td>' ;
                echo $row1['Time'] ;
                echo '</td>';
                echo '<td>' ;
                echo $row1['Location'] ;
                echo '</td>';
                echo '</tr>';
               }
            }
            
        }
         }
        ?>
    </table>
        <h2>Available Shifts</h2>
        <table style="width:100%">
        <tr>
            <th>Type</th>
            <th>Available slots</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Location</th>

        </tr>
        <?php 
        $organisation = $_SESSION["organisation"];
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from shifts where available_slots > 0 and Organization_Name = '$organisation';";
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            while($row = $result->fetch_assoc())
            {
            echo '<tr>';
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
            echo '</tr>';
        }
         }
        ?>
    </table>
        </div>
    </body>
</html>