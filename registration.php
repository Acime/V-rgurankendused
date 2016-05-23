<!DOCTYPE html>
<!-- Registration page for new users -->
<?php
session_start();
require 'database.php';
?>
<html>
   <head>
      <meta charset="utf-8">
      <title>Registration Form</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link href="vendors/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body class="index">
      <header>
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.html">Social Network</a>
               </div>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="login.php">Login <span class="sr-only">(current)</span></a></li>
                     <li><a href="registration.php">Register</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <!-- Registration form -->
      <div class="container">
         <form action="registration.php" class="form-signin" method="post" >
            <label for="InputName">Username</label>
            <input type="text" class="form-control" name="name" placeholder="Username" required="required">
            <div class="form-group">
               <label for="InputPassword">Password</label>
               <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required="required">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register now</button>
         </form>
      </div>
      <?php
      //If 'register' button is pressed:
      if (isset($_POST['register'])) {
           //Put text information to local variables
           $name = $_POST['name'];
           $pass = $_POST['pass'];
           //If password is less than 8 characters, throw error
           if (strlen($pass) < 8) {
               echo "<script>alert('The minimum lenght of password is 8 characters')</script>";
               exit();
           }
           //Check, if there already is an user registered with that name
           $sel   = "select name from rrongele__registration where name = '$name'";
           $run   = mysqli_query($con, $sel);
           $check = mysqli_num_rows($run);
           // If there is, throw error, else proceed with registration
           if ($check > 0) {
               echo "<script>alert('This username already exists, please select another')</script>";
               exit();
           } else {
               //Mysql query for registration
               $hash   = password_hash($pass, PASSWORD_DEFAULT);
               $insert = "insert into rrongele__registration (name, pass) values (?, ?) ";
               $stmt   = mysqli_prepare($con, $insert);
               mysqli_stmt_bind_param($stmt, 'ss', $name, $hash);

               if (mysqli_stmt_execute($stmt)) {
                   echo "<script>alert('Registration successful, you can now log in with your username and password!')</script>";
                   echo "<script>window.location = 'login.php'</script>";
               }
           }
           mysqli_stmt_close($stmt);
       }
       ?>
   </body>
</html>