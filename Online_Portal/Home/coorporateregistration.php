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
        <h1>Register</h1>
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
            echo'<form action="registermanual.php" method="POST">';
            while($row = $result->fetch_assoc())
            {
            echo '<div>';
            echo '<span> Register For:';
            echo $row['Organization_Name'];
            echo '</span>';
            echo '</div>';
            echo '<div>';
            echo '<span> Date:';
            echo $row['Date'];
            echo '</span>';
            echo '</div>';
            echo '<div>';
            echo '<span> Start Time:';
            echo $row['Time'];
            echo '</span>';
            echo '</div>';
            echo '<div>';
            echo '<span> Type of Work:';
            echo $row['Type'];
            echo '</span>';
            echo '</div>';
        }
         }
        ?>
         <div class="form-group">
                <div>First Name</div>      
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
              </div>
              <div class="form-group">
                <div>Last Name</div>
                <input type="text"name="lastname" id="lastname" class="form-control"  placeholder="Enter Last Name">
              </div>
              <div class="form-group">
                <div>Email</div>
                <input type="text"name="email" id="email" class="form-control"  placeholder="Enter Your Email">
              </div>
              <div class="form-group">
                <div>Phone Number</div>
                <input type="text"name="username" id="username" class="form-control"  placeholder="Enter phone number">
              </div>
              <div>
                <span> Volunteer Start Time</span>
                <input type="time"name="time" id="time">
            </div>
            <?php 
            echo '<button type="submit"  name="id" value= ';
            echo $_POST["id"]; // to know which shift a user is registering to 
            echo '>ADD';
            echo '</button>';
            echo '</form>'
            ?>
            <h1>Volunteer List</h1>
            <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Dob</th>

        </tr>
            <?php 
            $firstrow=true;
            $csv = array();
            $inputfile = $_FILES["file"];
            $tempname = $_FILES["file"]["tmp_name"]; // syntax to retrive file 
            if($tempname !== '') {
                $handle = fopen($tempname,'r');
                echo'<form action="registerbulk.php" method="POST">';
                while(($data=fgetcsv($handle,'1000',',')) !== FALSE){ // see fgetcsv()syntax
                    if($firstrow!==true){ //not to display headers
                        array_push($csv,$data[0]); //we get data in form of arrays, push Name  from input file to csv array
                echo '<tr>';
                echo '<td>' ;
                echo $data[0] ;
                echo '</td>';
                echo '<td>' ;
                echo $data[1] ;
                echo '</td>';
                echo '<td>' ;
                echo $data[2] ;
                echo '</td>';
                echo '<td>' ;
                echo $data[3];
                echo '</td>';
                echo '<td>' ;
                echo $data[4] ;
                echo '</td>';
                echo '</tr>';
                    }
                    $firstrow=false;
                }
                $_SESSION["volunteerlist"]=$csv; // to take the values from csv array and popullate in regisetered shifts
                echo '</table>'; 
                echo '<button type="submit"  name="id" value= ';
                echo $_POST["id"]; // to know for which shift
                echo '>ADD ALL';
                echo '</button>';
                echo '</form>';
            }
            
            ?>
    </div>
    </body>

</html>