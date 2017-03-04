<?php

# grab the values of faculty_id and faculty_department from session variables
# $faculty_id = $_SESSION['faculty_id'];
# $faculty_department = $_SESSION['faculty_department'];

# store the value of current url(including get variables) in variable names as url
$url = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];

$query = "SELECT cf.section, cf.course_code, c.semester, c.subject FROM course_faculty AS cf INNER JOIN courses AS c using(course_code) WHERE faculty_id = '$faculty_id' ";
$q_processing = $conn->query($query);

# $query = "SELECT cf.course_code, c.semester, c.subject FROM course_faculty AS cf INNER JOIN courses AS c USING (course_code) WHERE faculty_id = '$faculty_id'";
# $q_processing = $conn->query($query);

# echo $query;

echo "<h4> Select semester </h4>";
echo "<div class='list-group'>";

while($q_result = $q_processing->fetch_assoc()){

echo "<a href='" . $url . "&sem=" . $q_result['semester'] . "&cc=" . $q_result['course_code'] . "' role='button' class='btn btn-default list-group-item col-sm-10'>" . $q_result['semester'] . "<sup> th </sup> semester (" . $q_result['course_code'] . ") (" . $q_result['subject'] .")</a>";

}

echo "</div>";

?>
