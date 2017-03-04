<?php
$conn = new mysqli("localhost", "root", "", "diginit");
$rollno = $_REQUEST['rn'];

#$query = "SELECT * FROM students WHERE rollno = '$rollno'";
$query = "SELECT s.name, s.email, s.branch, s.section, s.Semester, p.status, p.company FROM students AS s INNER JOIN placment AS p USING (rollno) WHERE rollno = '$rollno'";
$q_processing = $conn->query($query);

echo (bool)($q_processing);
#if($q_processing->num_rows == 1){
  echo "<table class='table table-hover table-bordered'>";

  while ($q_data = $q_processing->fetch_assoc()) {
     echo "<tr> <td> Name </td> <td>" . $q_data['name'] . "</td> </tr>";
     echo "<tr> <td> Email </td> <td>" . $q_data['email'] . "</td> </tr>";
     echo "<tr> <td> Branch </td> <td>" . $q_data['branch'] . "</td> </tr>";
     echo "<tr> <td> Section </td> <td>" . $q_data['section'] . "</td> </tr>";
     echo "<tr> <td> Semester </td> <td>" . $q_data['semester'] . "</td> </tr>";
  }
#}

?>
