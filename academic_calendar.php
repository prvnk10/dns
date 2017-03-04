<?php
require_once("connection.php");

$query = "SELECT file_name FROM academic";
$q_processing = $conn->query($query);

$q_data = $q_processing->fetch_assoc();
# echo $q_data['file_name'];
# echo '<br>';

$url_of_academic_calendar = academic . $q_data['file_name'];

# echo "<a href='" . academic . $q_data['file_name'] . "' > Academic </a>";

?>
