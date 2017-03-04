<?php
require_once('connection.php');
require_once('validate_faculty_login.php');

if(!isset($_GET['course_code'], $_GET['semester']))
 require_once('list.php');

if(isset($_GET['semester'], $_GET['course_code'])){
  # require_once('list_of_assignments_by_a_teacher.php');

  require_once('list_of_students.php');
}

 ?>
