<?php
require_once('connection.php');

if(!isset($_GET['b'])){
  echo "<div class='form-group'>";

  echo "<label class='col-sm-4 control-label'> Department: </label> ";

  echo "<div class='col-sm-4'>";

  echo "<select class='form-control' onchange='getListOfFaculty(this.value)'>";
  echo "<option> </option>";
  echo "<option value='computer'> Computer Engineering </option>";
  echo "<option value='ece'> Electronics and Communication Engineering </option>";
  echo "<option value='civil'> Civil Engineering </option>";
  echo "<option value='mechanical'> Mechanical </option>";
  echo "<option value='e'> Electrical </option>";
  echo "<option value='mba'> MBA </option>";
  echo "</select>";
  echo "</div>";

  echo "</div>";
}

 ?>

<script>
function getListOfFaculty(b){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById("s").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "dir_faculty.php?b=" + b, true);
  xhttp.send();
}

function getFacultyFeedback(n){
  // alert("dsfsf");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('feedback').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "ff.php?n=" + n, true);
  xhttp.send();
}
</script>

</div>
<div>
<div id="s"> </div>
</div>

<div id='feedback' class="col-sm-8"> </div>
