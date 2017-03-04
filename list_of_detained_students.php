<?php
$conn = new mysqli("localhost", "root", "", "diginit");
session_start();

if(!isset($_SESSION['username'])){
  header("Location: faculty_login.php");
}

if(isset($_GET['sem'], $_GET['cc'])){
$semester = $_GET['sem'];
$course_code = $_GET['cc'];

$query = "SELECT lectures FROM lecture_delivered where course_code = '$course_code'";
$q_processing = $conn->query($query);
# echo $q_processing->num_rows;
$q_data = $q_processing->fetch_assoc();
$lectures_delivered = $q_data['lectures'];

$q1 = "SELECT rollno,dates FROM attendance where course_code = '$course_code'";
$q_processing = $conn->query($q1);

echo "<table class='table table-hover table-bordered table-condensed'>";
echo "<tr> <thead> <th> Roll No. </th> <th> % Attendance </th> </thead> </tr>";
while($q_data = $q_processing->fetch_assoc()){
  $code = $q_data['dates'];
  $lectures_bunked = strlen($code)/2;

  $d = (100 - ($lectures_bunked/$lectures_delivered)*100);

  if($d < 75){
    echo "<tr> <td>" . $q_data['rollno'] . "</td>";
    echo "<td class='bg-danger '>" . $d . "</td> </tr>";
  }
}

echo "</table>";

echo "<button class='btn btn-danger col-sm-4'> Send Warning to students </button>";
echo "<button class='btn btn-danger col-sm-offset-2 col-sm-4'> Send Detain List to Academic </button>";
}
 ?>
