<?php
# session_start();

require_once('connection.php');
echo "<h4> Institution of National Importance </h4>";
echo "</div>";                       # close the div whose class is page-header in connection.php

require_once('validate_faculty_login.php');

# if user's logged in, then grab the username and query the db looking for more info about the faculty_member
$username = $_SESSION['username'];

$query = "SELECT faculty_id, name, designation, department FROM faculty WHERE username = '$username'";
$q_process = $conn->query($query);

if ($q_process->num_rows == 1){
  $q_results = $q_process->fetch_assoc();

  # take care of variable scope
  $faculty_name = $q_results['name'];
  $faculty_id = $_SESSION['faculty_id'] = $q_results['faculty_id'];
  $faculty_designation = $q_results['designation'];
  $faculty_department = $_SESSION['faculty_department'] = $q_results['department'];

  # echo "<div class='alert alert-warning'> Welcome " . $faculty_designation . ' ' . $faculty_name . "</div>" ;
}

require_once('academic_calendar.php');
?>

 <!-- <div class="alert alert-info text-right">
 Welcome <?php echo $faculty_designation . ' ' . $faculty_name ; ?> </div> -->

<div class="text-right"> <?php echo $faculty_name; ?> </div>

<!--  <div class="row">  -->

<div class="col-sm-3">
 <div class="list-group">
  <a href='faculty_profile.php' class="col-sm-8 list-group-item"> Home </a>
  <a href='<?php echo $url_of_academic_calendar; ?>' class="col-sm-8 list-group-item" target="_blank"> Academic Calendar </a>
  <a href='' class="col-sm-8 list-group-item"> Timetable </a>
  <a href='faculty_profile.php?u=2' class="col-sm-8 list-group-item"> Students </a>
<!--  <a href='faculty_profile.php?u=3' class="col-sm-8 list-group-item"> Progress Report </a>  -->
  <a href='faculty_profile.php?u=4' class="col-sm-8 list-group-item"> Attendance List / Roll Sheet </a>
  <a href='faculty_profile.php?u=13' class="col-sm-8 list-group-item"> Detained List </a>
  <a href='faculty_profile.php?u=5' class="col-sm-8 list-group-item"> Message </a>
  <a href='faculty_profile.php?u=6' class="col-sm-8 list-group-item"> Marks </a>
  <a href="faculty_profile.php?u=7" class="col-sm-8 list-group-item"> Upload Study Material </a>
  <a href="faculty_profile.php?u=8" class="col-sm-8 list-group-item"> Upload Assignments </a>
<!--  <a href="#assignments_content" class="col-sm-8 list-group-item" data-toggle="collapse"> Upload Assignments </a> -->

  <div id="assignments_content" class="collapse text-left"> <div> <li class="list-group-item"> f </li> <li> h </li> </ul> </div> </div>

  <a href="faculty_profile.php?u=9" class="col-sm-8 list-group-item"> Upcoming events </a>
  <a href="faculty_profile.php?u=10" class="col-sm-8 list-group-item"> Feedback </a>
  <a href="faculty_profile.php?u=11" class="col-sm-8 list-group-item"> Assign assignments </a>
  <a href="faculty_profile.php?u=12" class="col-sm-8 list-group-item"> Change Password </a>
  <a href='logout.php' class="col-sm-8 list-group-item"> Logout </a>
 </div>
</div>

<div class="col-sm-6">

 <?php

  $u = isset($_GET['u']) ? $_GET['u'] : 0 ;

  switch ($u) {
   case 2:
    require_once('students_list_shown_to_teacher.php');
    break;

   case 4:
    require_once('attendance_list.php');
    break;

   case 5:
    require_once('message.php');
    break;

   case 6:
    require_once('marks.php');
    break;

   case 7:
    require_once('upload_study_material.php');
    break;

   case 8:
    require_once('assignments.php');
    break;

   case 9:
    require_once('events.php');
    break;

   case 10:
    require_once('feedback.php');
    break;

   case 11:
    require_once('assign_assignment.php');
    break;

   case 12:
    require_once('change_password.php');
    break;

   case 13:
    require_once('detained_list.php');
    break;

     default:
        # code ....
         break;
     }

    ?>

</div>
