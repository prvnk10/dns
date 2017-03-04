<?php
require_once('connection.php');

$query = "SELECT * FROM institutes";
$q_processing = $conn->query($query);

?>

<form class="form-horizontal">

<div class='form-group'>
<label class='control-label col-sm-2'> Select Institute: </label>
<div class='col-sm-6'>
 <select class='form-control'>

<?php

while($q_data = $q_processing->fetch_assoc()){
  echo "<option value='" . $q_data['email'] . "'>" . $q_data['institute'] . "</option>";
}
 ?>

</select>
</div>
</div>

  <div class="form-group">
    <label class="control-label col-sm-2"> Subject: </label>
    <div class="col-sm-6">
      <input type="text" name="subject" class="form-control"> </input>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2"> Message: </label>
  <textarea rows="15" cols="90" name='feedback_message'>  </textarea>
  </div>

<!--  <div class="form-group">
    <label class="control-label col-sm-4" for="">  </label>
    <div class="col-sm-4">
      <input type="" name="" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>  -->

  <div class="form-group">
    <button class="btn btn-info col-sm-offset-2" type="submit"> Send </button>
  </div>

</form>
