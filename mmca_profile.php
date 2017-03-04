<?php
require_once('connection.php');
echo "</div>";

$username = $_SESSION['mmca_username'];
$query = "SELECT mmca_id, name, h_name, FROM mmca WHERE username = '$username' LIMIT 1 ";

$q_processing = $conn->query($query);

 echo (bool)$q_processing;

$q_data = $q_processing->fetch_assoc();

$name = $q_data['name'];
$mmca_id = $q_data['mmca_id'];
$h_name = $q_data['h_name'];





?>
