<!DOCTYPE html>
<?php
session_start();
require 'database.php';

if (!$_SESSION['name']) {
    header("location: login.php");
} else {
?>
<html>
   <head>
      <meta charset="utf-8">
      <title>View users</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link href="vendors/css/bootstrap.css" rel="stylesheet">
   </head>
   <body class="home">
      <header>
         <!-- Navigation bar -->
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand" href="view.php">USER VIEW</a>
               </div>
               <p class="navbar-text">Welcome, <?php echo $_SESSION["name"] ?>!</p>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li class="active"><a href="logout.php">LOGOUT</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="container-table">
         <div class="panel panel-default">
            <!-- Panel name -->
            <div class="panel-heading">View all users</div>
            <!-- Table -->
            <table class="table">
               <tr>
                  <th>Name</th>
                  <th>View</th>
               </tr>
               <!-- Print out user list -->
               <?php
               $user_name = $_SESSION['name'];
               $sel       = "select id, name from rrongele__registration WHERE NOT name = '$user_name' ";
               $run = mysqli_query($con, $sel);

               while ($row = mysqli_fetch_array($run)) {
                   $id   = $row['id'];
                   $name = $row['name'];
                ?>
               <tr>
                  <td><?php echo $name ?></td>
                  <td><a href="profile.php?id=<?php echo $id;?>">View</a></td>
               </tr>
               <?php } ?>
            </table>
         </div>
      </div>
   </body>
</html>
<?php } ?>