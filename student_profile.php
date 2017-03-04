

<?php
require_once('connection.php');
echo "<h4> Institution of National Importance </h4>";
echo "</div>";

if(!isset($_SESSION['rollno'])){
  header("Location: login.php");
  exit();
}

$rollno = $_SESSION['rollno'];

$query = "SELECT name,branch FROM students WHERE rollno = '$rollno'";
$q_result = $conn->query($query);

if($q_result->num_rows == 1){
  $get_values = $q_result->fetch_assoc();

  $student_name = $get_values['name'];
  $student_branch = $_SESSION['branch'] = $get_values['branch'];

# echo $student_name;
# $query = "SELECT message,faculty_id FROM messages_received INNER JOIN messages_send USING(msg_id) WHERE receiver_rollno = '$rollno'";
# $query =  "SELECT message,msg_id,faculty_id FROM messages_received INNER JOIN messages_send USING(msg_id) WHERE receiver_rollno = '$rollno'";

  $msg_query = "SELECT message FROM messages_received WHERE receiver_rollno = '$rollno'";
  $msg_query_processing = $conn->query($msg_query);

  $no_of_messages = ($msg_query_processing->num_rows);
  # echo $no_of_messages;

/*
  while($query_data = $msg_query_processing->fetch_assoc()){
  echo "From:" ;
  echo $query_data['message'];
}  */

require_once('academic_calendar.php');
 ?>

<!-- <div class="row"> -->

<div class="col-sm-3">
<!--
 <div class="list-group">
  <a href='student_profile.php' class="col-sm-8 list-group-item"> Home </a>
  <a href='<?php echo $url_of_academic_calendar; ?>' class="col-sm-8 list-group-item" target="_blank" style="background-color: lightblue;"> Academic Calendar </a>
  <a href='student_profile.php?q=2' class="col-sm-8 list-group-item" style="background-color: lightgreen;"> Subjects </a>
  <a href="student_profile.php?q=3" class="col-sm-8 list-group-item" style="background-color: pink;"> Attendance </a>
  <a href='student_profile.php?q=4' class="col-sm-8 list-group-item" style="background-color: orange;"> Inbox <span class='badge'> <?php echo $no_of_messages; ?> </span> </a>
  <a href="student_profile.php?q=5" class="col-sm-8 list-group-item" style="background-color: yellow;"> Marks </a>
  <a href='progress_report.php' class="col-sm-8 list-group-item" target="_blank" style="background-color: #DDA0DD;"> Progress Report </a>
<a href="student_profile.php?q=" class="col-sm-8 list-group-item"> Hostel </a>
  <a href='register1.php' class="col-sm-8 list-group-item" target="_blank" style="background-color: #7FFF00;"> Registration </a>
  <a href="student_profile.php?q=6" class="col-sm-8 list-group-item" style="background-color: skyblue;"> Change Password </a>
  <a href="student_profile.php?q=7" class="col-sm-8 list-group-item" style="background-color: #F0E68C;"> Feedback </a>
  <a href='' class="col-sm-8 list-group-item" style="background-color: seashell;"> Timetable </a>
  <a href='logout.php' class="col-sm-8 list-group-item" style="background-color: springgreen;"> Logout </a>
 </div>
 -->

 <div class="list-group">
  <a href='student_profile.php' class="col-sm-8 list-group-item"> Home </a>
  <a href='<?php echo $url_of_academic_calendar; ?>' class="col-sm-8 list-group-item" target="_blank"> Academic Calendar </a>
  <a href='student_profile.php?q=2' class="col-sm-8 list-group-item"> Subjects </a>
  <a href="student_profile.php?q=3" class="col-sm-8 list-group-item"> Attendance </a>
  <a href='student_profile.php?q=4' class="col-sm-8 list-group-item"> Inbox <span class='badge'> <?php echo $no_of_messages; ?> </span> </a>
  <a href="student_profile.php?q=5" class="col-sm-8 list-group-item"> Marks </a>
  <a href='progress_report.php' class="col-sm-8 list-group-item" target="_blank"> Progress Report </a>
<!--  <a href="student_profile.php?q=" class="col-sm-8 list-group-item"> Hostel </a>  -->
  <a href='register1.php' class="col-sm-8 list-group-item" target="_blank"> Registration </a>
  <a href="student_profile.php?q=6" class="col-sm-8 list-group-item"> Change Password </a>
  <a href="student_profile.php?q=7" class="col-sm-8 list-group-item"> Feedback </a>
  <a href='' class="col-sm-8 list-group-item"> Timetable </a>
  <a href='logout.php' class="col-sm-8 list-group-item"> Logout </a>
 </div>


</div>

<div class="col-sm-9">
  <!--  <p> this is where we will show the recent activity of student </p>  -->

 <?php

  $id = isset($_GET['q']) ? $_GET['q'] : 0 ;

  switch ($id) {

  case 2:
   require_once('subjects.php');
   break;

  case 3:
   require_once('show_attendance.php');
   break;

  case 4:
   require_once('show_inbox.php');
   break;

  case 5:
   require_once('student_marks.php');
   break;

  case 6:
   require_once('change_password.php');
   break;

  case 7:
   require_once('feedback.php');
   break;

  default:
   require_once('events.php');
   break;
  }
# }
  ?>

</div>

 <?php
}
  ?>
