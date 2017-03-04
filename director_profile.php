<?php
require_once('connection.php');
echo "<h4> Institution of National Importance </h4>";
echo "</div>";

 ?>

<div class="col-sm-3">
  <div class="list-group">
    <a href='director_profile.php' class="col-sm-8 list-group-item"> Home </a>
    <a href='director_profile.php?u=2' class="col-sm-8 list-group-item"> Students </a>
    <a href='director_profile.php?u=3' class="col-sm-8 list-group-item"> Faculty </a>
    <a href="director_profile.php?u=4" class="col-sm-8 list-group-item"> IIT's / NIT's </a>
    <a href="director_profile.php?u=5" class="col-sm-8 list-group-item"> Ministries </a>
    <a href="director_profile.php?u=6" class="col-sm-8 list-group-item"> Industries </a>
  </div>

<!--   <div class="col-sm-6"> </div> -->
</div>

<div class="col-sm-9">

  <?php
   $u = isset($_GET['u']) ? $_GET['u'] : 0;

  switch ($u) {
    case 2:
      require_once('students.php');
      break;

    case 3:
      require_once('faculty.php');
      break;

    case 4:
      require_once('institutes.php');
      break;

    default:
      # code...
      break;
  }
   ?>

</div>
