<?php
require_once('connection.php');
echo "</div>";

?>

<form class="form-horizontal" method="post">
<div class="form-group">
  <label class="control-label col-sm-4" for="rollno"> Roll No </label>
  <div class="col-sm-4">
    <input type="number" name="rollno" class="form-control" required="required" />
  </div>
  <div class="col-sm-4"> </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-4" for="password"> Mobile number  </label>
  <div class="col-sm-4">
    <input type="number" name="registered_mobile_number" class="form-control" required="required" />
  </div>
  <div class="col-sm-4"> </div>
</div>

<div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
  <button type="submit" id="login_btn" name="submit" class="btn btn-info" />
  Log In
  </button>
  </div>
</div>

</form>
