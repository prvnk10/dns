<?php
require_once('connection.php');
echo "</div>";

if(!isset($_SESSION['rollno']) && !isset($_SESSION['username'])){

  echo "<div class='alert alert-info'> You are not logged in, please log in continue. <br> You will be redirected to index page in 5 seconds </p> </div>";
  # sleep(5);
  header("Refresh:5, url = index.php");
  exit();
}

if(isset($_GET['rollno']))
  $rollno = $_GET['rollno'];
else
  $rollno = $_SESSION['rollno'];

$query = "SELECT * FROM progress_report WHERE rollno = '$rollno'  ";
$query_result = $conn->query($query);

$all_pointers = array();
# echo var_dump($all_pointers);
# echo $query_result->num_rows;

if($query_result->num_rows == 1){
  $result_values = $query_result->fetch_assoc();

  $sem1 = $result_values['sem1'];
  $sem2 = $result_values['sem2'];
  $sem3 = $result_values['sem3'];
  $sem4 = $result_values['sem4'];
  $sem5 = $result_values['sem5'];
  $sem6 = $result_values['sem6'];
  $sem7 = $result_values['sem7'];
  $sem8 = $result_values['sem8'];
#  echo $sem1;
  $all_pointers = array($sem1, $sem2, $sem3, $sem4, $sem5, $sem6, $sem7, $sem8);
#  echo var_dump($all_pointers);

  echo "<div class='container'>";
}

echo "<h4 class='text-center'> Progress Report </h4>";
echo "<b> Roll No. " . $rollno . " </b><br/> <br/> ";

for($i=0, $length = count($all_pointers) ; $i < $length ; $i++){

echo "<p>";
echo ($i + 1 ) . " semester" ;
echo '<div class="progress">';
echo '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="10" style="width: ' . $all_pointers[$i]*10 . '% " >';
echo '<span>' . $all_pointers[$i] . '</span>' ;
echo '</div>';
echo '</div>';
echo '<br/>';

}
