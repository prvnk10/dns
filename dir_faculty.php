<link href="bootstrap.css" rel="stylesheet" type="text/css">

<?php
$conn = new mysqli("localhost", "root", "", "diginit");

if(isset($_GET['b'])){
  $branch = $_GET['b'];
  # echo $branch;

$query = "SELECT name FROM faculty WHERE department = '$branch' ORDER BY name";
$q_processing = $conn->query($query);

echo "<div class='form-group'>";

echo "<label class='col-sm-4 control-label'> Faculty Name: </label> ";

echo "<div class='col-sm-2'>";

echo "<select class='form-control' onchange='getFacultyFeedback(this.value)'>";
echo "<option> </option>";
while($q_data = $q_processing->fetch_assoc()){
  echo "<option value='" . $q_data['name'] . "' >" . $q_data['name'] . "</option>";
}

echo "</select>";
echo "</div>";

}

?>
