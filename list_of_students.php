<?php

$faculty_id = $_SESSION['faculty_id'];
$faculty_department = $_SESSION['faculty_department'];

require_once('list_of_assignments_by_a_teacher.php');

$len = count($available_assignments);

$semester = $_GET['semester'];

$query = "SELECT name,rollno FROM students WHERE branch='$faculty_department' AND semester = '$semester' ORDER BY rollno";

$q_processing = $conn->query($query);

echo "<table class='table table-bordered table-hover'>";
echo "<tr> <th> Name </th> <th> Roll No </th> <th> Select Assignment </th> <th> Progress </th>  </tr>";


while($q_data = $q_processing->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $q_data['name'] . "</td>";
    echo "<td>" . $q_data['rollno'] . "</td>";

    echo "<td> <select onchange='getValue(this.value)'>" ;
    echo "<option> </option>";
    for($i=0; $i < $len ; $i++) {
      echo "<option value='" .$available_assignments[$i] . "'>" . $available_assignments[$i] . "</option>" ;
    }
    echo "</select> </td>" ;

  #  echo "<td> <a href='progress_report.php?rollno=" . $q_data['rollno'] . "' target='_blank'> Assign </a> </td>";
    echo "<td> <a href='' class='btn btn-default' role='button' onclick='assign_assignment()'> Assign </a> </td>";

    #echo "<td> </td> ";
    echo "</tr>";
}



echo "</table>";

 ?>

<div id="a"> </div>

<script src="ajax.js"> </script>
