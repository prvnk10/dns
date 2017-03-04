<?php
require_once('connection.php');
echo "<h4> Institution of National Importance </h4> </div>";

if(isset($_SESSION['rollno'])){
  header("Location: student_profile.php");
  exit();
}

if(isset($_SESSION['username'])){
  header("Location: faculty_profile.php");
  exit();
}

 ?>

<!--
<style>
 .h { background-color: orange;}
 .j { background-color: pink;}
 </style>
-->

<div class="container text-center">
<!--
  <div class="col-sm-6 h">
    <a href="login.php" role="button" class="btn btn-default"> Login </a>
  </div>

  <div class="col-sm-6 j">
    <a href="faculty_login.php" role="button" class="btn btn-default"> Faculty Login </a>
  </div>  -->

  <div class="col-sm-4 j">
    <a href="faculty_login.php" role="button" class="btn btn-default"> Faculty Login </a>
  </div>

  <div class="col-sm-4 h">
    <a href="login.php" role="button" class="btn btn-default"> Login </a>
  </div>

  <div class="col-sm-4">
    <a href="soc_clubs_login.php" role="button" class="btn btn-default"> Society/Club Login </a>
  </div>

</div>
