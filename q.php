<?php
$search = $_REQUEST['search'];

/*
if($search == "a")
  echo 4545;
else {
   echo 7878;
} */

# echo $search;

$conn = new mysqli("localhost", "root", "", "diginit");

$query = "SELECT assignment_id FROM assignments WHERE file_name = '$search'";
$q_processing = $conn->query($query);

if($q_processing->num_rows == 1){
  $q_data = $q_processing->fetch_assoc();
  echo $q_data['assignment_id'];
}
 ?>
