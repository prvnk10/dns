<?php
# if user's not logged in, show them a msg. and then redirect to login page
if(!isset($_SESSION['username'])){
  echo "<div class='alert alert-danger text-center'> You're not logged in so you are being redirected to login page in 5 seconds";
  header("Refresh: 5 , url=faculty_login.php");
  exit();
}

/* if user's already logged in, then redirect to faculty_profile page
if(isset($_SESSION['username'])){
  header("Location: faculty_profile.php");
  exit();
} */

 ?>
