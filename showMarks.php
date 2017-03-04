<?php
session_start();
$conn = new mysqli("localhost", "root", "", "diginit");

if(!isset($_SESSION['rollno'])){
  header("Location: login.php");
}

$rollno = $_SESSION['rollno'];
$course_code = $_REQUEST['cc'];

$query = "SELECT * FROM marks WHERE rollno = '$rollno' AND course_code = '$course_code'";
$q_processing = $conn->query($query);

echo "<table class='table table-striped table-bordered'>";

while($q_data = $q_processing->fetch_assoc()){
  echo "<tr> <td> Sessional 1 </td> <td>" . $q_data['sessional1'] . "</td> </tr>";
  echo "<tr> <td> Sessional 2 </td> <td>" . $q_data['sessional2'] . "</td> </tr>";
  echo "<tr> <td> Attendance </td> <td>" . $q_data['attendance'] . "</td> </tr>";
  echo "<tr> <td> Internal </td> <td>" . $q_data['internal'] . "</td> </tr>";
  echo "<tr> <td> End Semester </td> <td>" . $q_data['end_semester'] . "</td> </tr>";
  echo "<tr> <td> Total </td> <td>" . $q_data['total'] . "</td> </tr>";
}

echo "</table>";

 ?>
