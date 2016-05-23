<!DOCTYPE html>
<?php
session_start();
require 'database.php';

if(!$_SESSION['name']){
    header("location: login.php");
}else{
?>
<html>
   <head>
      <meta charset="utf-8">
      <title>Profile view</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link href="vendors/css/bootstrap.css" rel="stylesheet">
   </head>
   <body class="home">
      <header>
         <!-- Navigation bar -->
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand" href="profile.php?id=<?php echo $_GET["id"]?>">PROFILE VIEW</a>
               </div>
               <p class="navbar-text">Welcome, <?php echo $_SESSION["name"] ?>!</p>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
                     <li><a href="view.php">View all users</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li class="active"><a href="logout.php">LOGOUT</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <!-- Print out user information -->
      <?php
         $profile_id = $_GET["id"];
         $sel = "select name from rrongele__registration WHERE id = '$profile_id' ";
         $run = mysqli_query($con, $sel);
         
         if ($row = mysqli_fetch_array($run)) {
             $name = $row['name'];
         }
         ?>
      <div class="container-table">
         <div class="panel panel-default">
            <!--  Panel heading -->
            <div class="panel-heading">Profile view</div>
            <!-- Table -->
            <table class="table">
               <tr>
                  <td>*</td>
                  <td>*</td>
               </tr>
               <tr>
                  <td>Username:</td>
                  <td><?php echo $name; ?></td>
               </tr>
            </table>
         </div>
         <div class="panel panel-default">
            <!-- Panel heading -->
            <div class="panel-heading">Friendlist</div>
            <!-- Table -->
            <table class="table">
               <tr>
                  <td>*</td>
                  <td>*</td>
               </tr>
               <!-- Print out the names of friends -->
               <?php
               $sel_friend = "select * from rrongele__friendship WHERE user_id = '$profile_id' ";   
               $run = mysqli_query($con, $sel_friend);
                  
               while($row = mysqli_fetch_array($run)) {
                   $friend_name = $row['friend_name'];
                ?>
               <tr>
                  <td>Username:</td>
                  <td><?php echo $friend_name; ?></td>
               </tr>
               <?php } ?>
            </table>
         </div>
         <center>
            <!-- Add friend button, launches php script for adding a friend -->
            <p><a class="btn btn-primary btn-lg" href="add_friend.php?id=<?php echo $profile_id;?>" role="button">ADD FRIEND</a></p>
         </center>
      </div>
   </body>
</html>
<?php } ?>