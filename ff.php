<?php
$conn = new mysqli("localhost", "root", "", "diginit");
if(isset($_GET['n'])){
  $name = $_GET['n'];
  $query = "SELECT f.faculty_id, tf.feedback,tf.course_code FROM faculty AS f INNER JOIN teachers_feedback AS tf USING(faculty_id) WHERE name = '$name'";

  $q_processing = $conn->query($query);
  while($q_data = $q_processing->fetch_assoc()){
    #echo "<div class='alert alert-warning'> " . $q_data['feedback'] . "</div>";
    echo "<div class='well well-sm'> " . $q_data['feedback'] . "</div>";
  }

}

 ?>
