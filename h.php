<?php
require_once('connection.php');
echo "</div>";

if(isset($_POST['submit'])){
  extract($_POST);

  $query = "INSERT INTO attendance VALUES('$rollno', '$course_code', )"
}
 ?>


<form action="" method="post">
  <div class="form-group">
    <label class="control-label col-sm-4" for="rollno"> Roll No </label>
    <div class="col-sm-8 ">
      <input type="text" name="rollno" class="form-control">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="course_code"> Course Code </label>
    <div class="col-sm-8">
      <input type="text" name="rollno" class="form-control">
    </div>
  </div>

  <div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
  </div>
</div>
