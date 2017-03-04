<?php
session_start();
$conn = new mysqli("localhost", "root", "", "diginit");


$hash = array("01" => "A", "02" => "B" , "03" => "C" , "04" => "D", "05" => "E");
$month = array("Jan" => "a", "Feb" => "b");

// if user isn't logged in, then redirect user to login page
if(!isset($_SESSION['rollno'])){
  header("Location: login.php");
}

$rollno = $_SESSION['rollno'];
$course_code = $_REQUEST['cc'];

# $query = "SELECT a.dates, ld.lectures FROM attendance AS a INNER JOIN lecture_delivered AS ld USING(course_code) WHERE rollno = '$rollno' AND course_code = '$course_code'";
$query = "SELECT lectures FROM lecture_delivered WHERE course_code = '$course_code'";
$q_processing = $conn->query($query);
# echo $q_processing->num_rows;

$q_data = $q_processing->fetch_assoc();
$lectures_delivered = $q_data['lectures'];

$query = "SELECT dates FROM attendance WHERE rollno = '$rollno' AND course_code = '$course_code'";
$q_processing = $conn->query($query);
$q_data = $q_processing->fetch_assoc();
$code = $q_data['dates'];

$length = strlen($code);
$lectures_bunked = $length/2;
$dates = array();

for($i=0; $i<$length; $i += 2){
  $a = $code[$i];             $b = $code[$i+1];
  $temp = array_search($a, $hash). ' ' .array_search($b, $month). ' ' . '2017';
  array_push($dates, $temp);
}

# echo var_dump($dates);

# count the total no of lectures delivered
# line 24    $lectures_bunked = count($dates);

# echo $lectures_delivered;
if($lectures_delivered){

$per_class = (($lectures_delivered - $lectures_bunked)/$lectures_delivered)*100;
echo "<div class='col-sm-12'>";
echo "<table class='table  table-bordered'>";
echo "<tr> <thead> <td> Lectures Delivered </td> <td> Lectures Attended </td> <td> % Attendance </td> </thead> </tr>";
echo "<tr> <td> " . $lectures_delivered . "</td> <td>" . ($lectures_delivered - $lectures_bunked) . "</td>";
 if($per_class < 75) {echo "<td class='bg-danger'>" . $per_class ; }
 else { echo "<td class='bg-success'>". $per_class . "</td> </tr>"; }

echo "</table>";
echo "</div>";


echo "<ul class='col-sm-8'> Dates(when you missed the classes)";
for($i=0; $i<$lectures_bunked ; $i++){
  echo "<li>" . $dates[$i] . "</li>";
}
echo "</ul>";
} else { echo "No lectures delivered";}
 ?>
