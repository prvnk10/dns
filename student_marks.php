<script src="showMarks.js"> </script>
<?php
require_once('connection.php');

if(!isset($_SESSION['rollno'])){
  echo "<div class='alert alert-warning'> You're not logged in so you will be redirected to home page in 5 seconds";
  header("Refresh: 5 , index.php");
}

$branch =  $_SESSION['branch'];

$rollno = $_SESSION['rollno'];
# $query = "SELECT cf.faculty_id, c.course_code, c.subject,  FROM course_faculty AS cf INNER JOIN courses as c USING(course_code) WHERE semester = (SELECT semester FROM students where rollno = '$rollno') AND department = '$branch' ";

$query = "SELECT f.faculty_id, cf.course_code, c.subject FROM faculty AS f INNER JOIN course_faculty AS cf USING(faculty_id) INNER JOIN courses AS c USING(course_code) WHERE department = '$branch' AND semester = (SELECT semester FROM students where rollno = '$rollno') ORDER BY course_code";

$q_processing = $conn->query($query);


echo "<div class='form-group'>";

echo "<label class='col-sm-4 control-label'> Subject Name: </label> ";
echo "<div class='col-sm-5'>";

echo "<select class='form-control' onchange='showMarks(this.value)'>";
echo "<option> </option>";
while($q_data = $q_processing->fetch_assoc()){
  echo "<option value='" . $q_data['course_code'] . "'>" . $q_data['subject'] . ' (' . $q_data['course_code'] . ") </option>";
}

echo "</select>";
echo "</div>";
echo "</div>";
?>

<div>
<div id="showMarks" class="col-sm-6"> </div>
</div>
