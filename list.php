<?php
require_once('connection.php');

$url = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];

$query = "SELECT cf.course_code, c.semester, c.subject FROM course_faculty AS cf INNER JOIN courses AS c USING (course_code) WHERE faculty_id = '$faculty_id'";
$q_processing = $conn->query($query);

# echo (bool)$q_processing;

echo "<div class='list-group'>";
while($q_data = $q_processing->fetch_assoc()){
  echo "<a href='" . $url . "&course_code=" . $q_data['course_code'] . "&semester=" . $q_data['semester'] . "' class='list-group-item'>" . $q_data['subject'] . " (" . $q_data['course_code'] . ") " .$q_data['semester'] . "<sup> th </sup> semester </a> ";
}
echo "</div>";

 ?>
