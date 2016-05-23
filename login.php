<!DOCTYPE html>
<?php
session_start();
require 'database.php';
?>
<html>
   <head>
      <meta charset="utf-8">
      <title>Log in</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link href="vendors/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body class="index">
      <header>
         <!-- Navigation bar -->
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.html">Social Network</a>
               </div>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="index.html">Index <span class="sr-only">(current)</span></a></li>
                     <li><a href="registration.php">Register</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <!-- Login form -->
      <div class="container">
         <form action="login.php" class="form-signin" method="post" border="1px">
            <label for="InputName">Username</label>
            <input type="text" class="form-control" name="name" placeholder="Username">
            <div class="form-group">
               <label for="InputPassword">Password</label>
               <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
         </form>
      </div>
      <?php
      // If login button is pressed:
      if (isset($_POST['login'])) {
          //Text information to local variables
          $pass = $_POST['pass'];
          $name = $_POST['name'];
          // Mysql query for login
          $log  = "select name, pass from rrongele__registration where name = ? LIMIT 1";
          $stmt = mysqli_prepare($con, $log);
          mysqli_stmt_bind_param($stmt, 's', $name);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $name, $hash);
          mysqli_stmt_fetch($stmt);
          mysqli_stmt_close($stmt);

          if (password_verify($pass, $hash)) {
              session_regenerate_id();
              $_SESSION['name'] = $name;
              echo "<script>window.location.href='home.php';</script>";
          } else {
              echo "<script>alert('Passowrd is incorrect')</script>";
              exit();
          }
      }
      ?>
   </body>
</html>