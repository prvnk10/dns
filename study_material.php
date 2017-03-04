<?php
require_once('connection.php');
echo "</div>";

if(!isset($_SESSION['rollno'])){
  header("Location: index.php");
  exit();
}

if(!isset($_GET['fk_id'] , $_GET['course_code'])){
  header("Location: profile.php");
}

$course_code = $_GET['course_code'];
$faculty_id = $_GET['fk_id'];
$path = study_m ;

$query = "SELECT file_name FROM study_material WHERE faculty_id = '$faculty_id' AND course_code = '$course_code'";
$q_processing = $conn->query($query);

echo "<div class='list-group text-center'>";
while($q_data = $q_processing->fetch_assoc()){
  echo "<a href='" . study_m . $q_data['file_name'] . "' class='list-group-item'>" . $q_data['file_name'] . "</a>";
}

 ?>
