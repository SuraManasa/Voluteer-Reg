
<?php
                session_start();?>
<html>
    <head>    
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
    <?php include '../template/template.php'; ?>
    <div class="container">     
        <?php 
        echo '<h1>';
        echo $_SESSION["organisation"];
        echo ' - Shifts </h1>';
        ?>
        <form action="editshifts.php" method="POST">
              <button type="submit" class="btn btn-secondary signin-button">EDIT SHIFTS</button>
        </form>
        <h2>Registered Shifts</h2>
        <table class="table-bordered table table-hover" style="width:100%">
        <tr class="table-primary">
            <th>Name</th>
            <th>Type</th>
            <th>Filled slots</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Location</th>

        </tr> <!-- table header end -->
        <?php  // table body starts 
        $organisation = $_SESSION["organisation"];
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from registered_shifts where shift_id IN (select id from shifts where Organization_Name = '$organisation');";
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            while($row = $result->fetch_assoc()) // to return table rows individually
            {
                $shiftid = $row['shift_id']; // fetching shift id from the register shifts db
            echo '<tr class="table-light">';
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
        <table class="table-bordered table table-hover" style="width:100%">
        <tr class="table-primary">
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
            echo '<tr class="table-light">';
            echo '<td>' ;
            echo $row['Type'] ;
            echo '</td>';
            echo '<td>' ;
            echo $row['available_slots'] ; //fetching from db which will be populated by addshifts.php
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