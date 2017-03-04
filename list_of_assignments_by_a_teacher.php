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
 ?>
