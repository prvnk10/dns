<?php
require_once('connection.php');
echo "</div>";
?>

<script>

/* $(document).ready(function(){
   $("select").blur(function({
     alert("345");
   }));
 }); */

function getValue(x){
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('try').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "q.php?search=" + x, true);
  xhttp.send();
}

function getAloo(x){
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('try').href .= xhttp.responseText;
    }
  };
  xhttp.open("GET", "q.php?search=" + x, true);
  xhttp.send();
}
</script>

<select name="prvn" class="col-sm-8" onblur="getValue(this.value)">
  <option value="a"> A </option>
  <option value="b"> B </option>
</select>

<input type="text">

<a href="p.php?course_code=CET-304&assignment_id=" role="button" class="btn btn-default" id="try"> Assign </a>


<?php
# session_start();
require_once('connection.php');
require_once('validate_faculty_login.php');

$faculty_id = $_SESSION['faculty_id'];
$course_code = $_GET['course_code'];

$query = "SELECT file_name,assignment_id FROM assignments WHERE faculty_id = '$faculty_id' AND course_code = '$course_code'";

$q_processing = $conn->query($query);

$available_assignments = array();
$available_assignments_keys = array();

while($q_data = $q_processing->fetch_assoc()){
  # echo "<div class='alert alert-warning'>" . $q_data['file_name'] . "</div>";
  $available_assignments[] = $q_data['file_name'];
  $available_assignments_keys[] = $q_data['assignment_id'];
}

#   echo var_dump($available_assignments);

$len = count($available_assignments);

echo "<select onblur='getAloo(this.value)'>";

for($i=0 ; $i<$len; $i++){
   echo "<option value='" . $available_assignments[$i] . "' >" . $available_assignments[$i] . "</option>";
}
echo "</select>";

 ?>
