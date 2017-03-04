<?php
require_once('connection.php');

if(!isset($_SESSION['rollno']) && !isset($_SESSION['username'])){
  header("Location: index.php");
}

$target = events_path;
# echo $target;

$query = "SELECT username, event_name, image, description FROM events ORDER BY date DESC LIMIT 15";
# echo $query;

$q_processing = $conn->query($query);

# echo "<div class='list-group'>";

while($q_data = $q_processing->fetch_assoc() ){
  $soc_club_name = $q_data['username'];
  $event_name = $q_data['event_name'];
  $image = $q_data['image'];
  $event_description = $q_data['description'];
  $target .= $image;

  # echo $target;
#  echo "<div class='list-group-item'>";
  echo "<div class='panel panel-success'>";
  echo "<div class='panel-heading'>" . $event_name . "</div>";
  echo "<div class='panel-body'>" . $event_description . " <a href = '" . $target . "' target='_blank'> Image </a> </div>";
  echo "<div class='panel-footer'> Uploaded by: " . $soc_club_name . "</div>";
  echo "</div>";

  $target = events_path;
#  echo "</div>";
}

# echo "</div>";
?>
