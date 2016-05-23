<?php 
session_start();
       
if(!$_SESSION['name']){
    header("location: login.php");
} else {
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>PROFILE</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link href="vendors/css/bootstrap.css" rel="stylesheet">
   </head>
   <body class="home">
      <header>
         <!-- Navigation bar -->
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand" href="home.php">HOME</a>
               </div>
               <p class="navbar-text">Welcome, <?php echo $_SESSION["name"] ?>!</p>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="view.php">View all users <span class="sr-only">(current)</span></a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li class="active"><a href="logout.php">LOGOUT</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
   </body>
</html>
<?php } ?>