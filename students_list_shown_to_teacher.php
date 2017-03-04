<?php
# session_start();
require_once('connection.php');

$faculty_id = $_SESSION['faculty_id'];
$faculty_department = $_SESSION['faculty_department'];

if(!isset($_GET['sem'])){

/*
$query = "SELECT section,course_code,semester FROM course_faculty INNER JOIN courses using(course_code) WHERE faculty_id = '$faculty_id' ";
$q_processing = $conn->query($query);
# echo $query;

# echo "<h4> Select semester </h4>";
# echo "<div class='list-group'>";

# $url = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];

while($q_result = $q_processing->fetch_assoc()){
  # echo $q_result['course_code'];
  # echo $q_result['section'];
  # echo $q_result['semester'];

/*
  if($q_result['section'] == 0){
    for($i = 0 ; $i<4 ; $i++){
      echo "<div class='list-group-item'>" . $q_result['semester'] . '<sup> th </sup> semester C' . ($i+1) . '</div>';
    }
  }  else {
      for($i = 0 ; $i<4 ; $i++){
        echo "<div class='list-group-item'>" . $q_result['semester'] . '<sup> th </sup> semester C' . ($i+5) . '</div>';
      }
  }



  if($q_result['section'] == 0){
    $sections = array('C1', 'C2', 'C3', 'C4');
  } else {
    $sections = array('C5', 'C6', 'C7', 'C8');
  }

  for($i = 0 ; $i<4 ; $i++){
    echo "<a href='" . $_SERVER['PHP_SELF'] . "?s=" . $sections[$i] . "' class='list-group-item'>" . $q_result['semester'] . '<sup> th </sup> semester C' . ($i+1) . '</a>';
  }

  echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
  echo ($_SERVER['REQUEST_URI']);
  echo $_SERVER['SCRIPT_NAME'];

*/
/*
echo "<a href='" . $url . "&sem=" . $q_result['semester'] . "' role='button' class='btn btn-default list-group-item col-sm-10'>" . $q_result['semester'] . "<sup> th </sup> semester </a>";

}

echo "</div>";  */
require_once('list_of_semesters.php');
# require_once('list.php');
}

else {
 $semester = $_GET['sem'];

 $query = "SELECT name,rollno FROM students WHERE branch='$faculty_department' AND semester = '$semester' ORDER BY rollno";
 $q_processing = $conn->query($query);

 echo "<table class='table table-bordered table-hover'>";
 echo "<tr> <th> Name </th> <th> Roll No </th> <th> Progress Report </th> </tr>";

 while($q_data = $q_processing->fetch_assoc()){
  echo "<tr>";
  echo "<td>" . $q_data['name'] . "</td>";
  echo "<td>" . $q_data['rollno'] . "</td>";
  echo "<td> <a href='progress_report.php?rollno=" . $q_data['rollno'] . "' target='_blank'> Progress </a> </td>";
  echo "</tr>";
 }

 echo "</table>";

}
?>
