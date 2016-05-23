<?php
session_start();
require 'database.php';
//Get URL and SESSION variables
$profile_id = $_GET["id"];
$user_name  = $_SESSION['name'];

//Get the id of the logged in user
$sel = "SELECT id FROM rrongele__registration WHERE name = '$user_name' ";
$run = mysqli_query($con, $sel);
if ($row = mysqli_fetch_array($run)) {
    $user_id = $row['id'];   
}
//Get the name of the friend
$sel = "SELECT name FROM rrongele__registration WHERE id = '$profile_id' ";
$run = mysqli_query($con, $sel);
if ($row = mysqli_fetch_array($run)) {
    $name = $row['name'];   
}
//Check if the user has already added that friend
$sel2  = "SELECT * FROM rrongele__friendship WHERE user_id = '$user_id' AND friend_id = '$profile_id'";
$run   = mysqli_query($con, $sel2);
$check = mysqli_num_rows($run);

// If check fails, throw error, if passes, add to friends
if ($check > 0) {
    echo "<script>
    alert('Already on friendslist!');
        window.location.href='profile.php?id=$profile_id';
    </script>";
    exit();
} else {
    $insert = "INSERT INTO rrongele__friendship (user_id, friend_id, friend_name) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert);
    mysqli_stmt_bind_param($stmt, 'iis', $user_id, $profile_id, $name);
   
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
        alert('Added to friendlist!');
        window.location.href='view.php?id=$profile_id';
        </script>";
    }
}
?>
