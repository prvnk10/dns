<!-- <script>
$(document).ready(function(){
 $("button").click(function(){
  $("button").hide();
  })
})
</script>  -->

<script>
var absentees_rollno = [];
function absentee(rn){
  absentees_rollno.push(rn);
}

function showListOfAbsentees(){
  Students who are absent: ;
  for(var i=0; i<absentees_rollno.length; i++){
    absentees_rollno[i];
  }
}

</script>


<?php

if(!isset($_GET['sem'], $_GET['cc'])){
  require_once('list_of_semesters.php');
}
else {

$faculty_department = $_SESSION['faculty_department'];
$semester = $_GET['sem'];
$course_code = $_GET['cc'];

echo "<b> Date: </b>" . date("d-M-Y") . '<hr/>';

$query = "SELECT name, rollno FROM students WHERE branch = '$faculty_department' AND semester = '$semester' ";
# require_once('list_of_students.php');

$q_processing = $conn->query($query);

echo "<div class='col-sm-10'>";
echo "<table class='table table-hover table-bordered'>";
echo "<thead> <tr> <th> Roll No. </th> <th> Name </th> <th> Mark </th> </tr> </thead>";

$absentees = array();
 echo "<input type='checkbox' class='users'> <span class='glyphicon glyphicon-ok'> </span> means present <br>";
while($q_data = $q_processing->fetch_assoc()){
  echo "<tr>";

  echo "<td>" . $q_data['rollno'] . "</td>";
  echo "<td>" . $q_data['name'] . "</td>";
  echo "<td>";
#  echo "<input type='button' value='" . $q_data['rollno'] . "'> Present </input>";
#  echo "<button class='btn btn-success' value='" . $q_data['rollno'] . "' onclick = 'showStatus()'> Present </button> ";
#  echo "<button class='btn btn-danger' value='" . $q_data['rollno'] . "' onclick='absentee(this.value) showStatus()'> Absent </button>";
  echo "<input type='checkbox' class='users'>";
  echo "</td>";
#  echo "<td id='" . $q_data['rollno'] . "'> </td>";
  echo "</tr>";
}
echo "<table>";
echo "<button class='btn btn-info' onclick='showListOfAbsentees()'> Update Attendance </a>";
}
 ?>
