<?php
require_once('connection.php');

$rollno = $_SESSION['rollno'];

$msg_query = "SELECT mr.message, mr.msg_id, mr.date, mr.time, ms.faculty_id, f.name FROM messages_received AS mr INNER JOIN messages_send AS ms USING(msg_id) INNER JOIN faculty AS f USING(faculty_id) WHERE receiver_rollno = '$rollno' ORDER BY date DESC, time DESC";
#$msg_query = "SELECT mr.message, mr.msg_id, DATE_FORMAT(mr.date,'%d %b %y'), mr.time, ms.faculty_id, f.name FROM messages_received AS mr INNER JOIN messages_send AS ms USING(msg_id) INNER JOIN faculty AS f USING(faculty_id) WHERE receiver_rollno = '$rollno' ORDER BY time DESC, date DESC";

$msg_query_processing = $conn->query($msg_query);

$no_of_messages = ($msg_query_processing->num_rows);

while($query_data = $msg_query_processing->fetch_assoc()){

echo "<div class='panel panel-info'>";
echo "<div class='panel-heading'> From: " . $query_data['name'] . "</div>";
echo "<div class='panel-body'>";
echo $query_data['message'];
echo "</div>";
# echo "<p>" . $query_data['msg_id'] . "</p>";

echo "<div class='panel-footer'>" . $query_data['date'] . " " . $query_data['time'] . "</div>" ;

echo "</div>";

}

?>
