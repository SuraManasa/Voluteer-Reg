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
        <h1 class="text-info">Register</h1>
        <?php 
        $conn = new mysqli("localhost", "root", "","volunteer_registration");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $id=$_POST["id"];  
        $sql = "select * from shifts where id = '$id';";// fetches entire row matching with the ID in data base 
        $result=$conn->query($sql);
         if($result->num_rows)
         {
            echo'<form action="completeregistration.php" method="POST">';
            while($row = $result->fetch_assoc())
            {
            echo '<div class="row">';
            echo '<label for="staticRegisterFor" class="col-sm-2 col-form-label">Register For:</label>';
            echo '<div class="col-sm-10">';
            echo '<input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="';
            echo $row['Organization_Name'];
            echo '">';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
			echo '<label for="staticDate" class="col-sm-2 col-form-label">Date:</label>';
            echo '<div class="col-sm-10">';
            echo '<input type="text" readonly="" class="form-control-plaintext" id="staticDate" value="';
            echo $row['Date'];
            echo '">';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<label for="staticTime" class="col-sm-2 col-form-label">Start Time:</label>';
            echo '<div class="col-sm-10">';
            echo '<input type="text" readonly="" class="form-control-plaintext" id="staticTime" value="';
            echo $row['Time'];
            echo '">';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<label for="staticType" class="col-sm-2 col-form-label">Type of Work:</label>';
            echo '<div class="col-sm-10">';
            echo '<input type="text" readonly="" class="form-control-plaintext" id="staticType" value="';
            echo $row['Type'];
            echo '">';
            echo '</div>';
            echo '</div>';
        }
         }
        ?>
        <div class="form-group">
                <label class="col-form-label" for="inputDefault">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" style="width: 300px;" placeholder="Enter First Name">

                <label class="col-form-label" for="inputDefault">Last Name</label>
                <input type="text"name="lastname" id="lastname" class="form-control" style="width: 300px;" placeholder="Enter Last Name">

                <label class="col-form-label" for="inputDefault">Email</label>
                <input type="text"name="email" id="email" class="form-control" style="width: 300px;" placeholder="Enter Your Email">

                <label class="col-form-label" for="inputDefault">Phone Number</label>
                <input type="text"name="username" id="username" class="form-control" style="width: 300px;" placeholder="Enter phone number">

                <label class="col-form-label" for="inputDefault">Volunteer Start Time </label>
                <input type="time"name="time" id="time">
              </div>

            <?php 
            echo '<button type="submit"  name="id" value= ';
            echo $_POST["id"];
            echo '>ADD';
            echo '</button>';
            echo '</form>'
            ?>
        </div>
    </body>

</html>