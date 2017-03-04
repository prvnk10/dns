<?php
require_once('connection.php');

# if user is not logged in, then redirect to login page
if(!isset($_SESSION['rollno'])){
  header("Location: login.php");
}

# grab student's roll no from session
$rollno = $_SESSION['rollno'];
$branch = $_SESSION['branch'];
# $query = "SELECT semester FROM students where rollno = '$rollno' ";

# $query = "SELECT course_code FROM courses WHERE semester = (SELECT semester FROM students where rollno = '$rollno') ";

# query to grab the course_code, subject from courses table ; faculty_id from course_faculty table and faculty name from faculty table
#$query = "SELECT c.course_code, c.subject, cf.faculty_id, f.name FROM courses as c INNER JOIN course_faculty as cf using (course_code) INNER JOIN faculty as f using(faculty_id) WHERE semester = (SELECT semester FROM students where rollno = '$rollno')";

$query = "SELECT f.faculty_id, f.name, cf.course_code, c.subject, c.credit FROM faculty AS f INNER JOIN course_faculty AS cf USING(faculty_id) INNER JOIN courses AS c USING(course_code) WHERE  department = '$branch' AND semester = (SELECT semester FROM students where rollno = '$rollno')";

$q_result = $conn->query($query);

# echo $q_result->num_rows ;

echo "<div class='row'>";
while($q_data = $q_result->fetch_assoc()){

/*
  echo "<div class='col-sm-4'>";
  echo "<div class='media-left'>";

  echo "<img src='img_avatar.png'>";
  # echo "<caption>" . $q_data['faculty'] . "</caption>";
  # echo "<h4 class='media-heading text-center'>" . $q_data['subject'];

  echo $q_data['course_code'];
  echo $q_data['name'];

  echo "</div>";  */

/*  echo '<div class="row">';
  echo '<div class="col-sm-4">';
  echo '<div class="card">';
  echo '<div class="card-block">' ;
  echo '<h3 class="card-title">' . $q_data['subject'] . '</h3>';
  echo '<p class="card-text">' . $q_data['course_code'] . '</p>';
  echo '<p class="card-text"> by ' . $q_data['name'] . '</p>';
  # echo '<a href="#" class="btn btn-primary">Go somewhere</a>';
  echo '</div>';
  echo '</div>';
  echo '<a href="" role="button" class="btn btn-info"> Feedback </a>';
  echo '</div>';  */


  echo '<div class="card col-sm-4" style="max-width: 30rem; height: 20rem; border: 1px solid grey;">' ;
  #  echo '<img class="card-img-top" src="..." alt="Card image cap">' ;
  echo '<div class="card-block">' ;
  echo '<h4 class="card-title">' . $q_data['subject'] . '</h4>' ;
  echo '<p class="card-text"> Some info. about the subject .</p>';
  echo '<p>' . $q_data['course_code'] . ' by ' . $q_data['name'] . '</p>';
  echo '<p> Credit: ' . $q_data['credit'] . '</p>';
  echo '</div>';

  echo '<div class="card-footer">';
#  echo '<a href="study_material.php?fk_id=' . $q_data['faculty_id'] . '&course_code=' . $q_data['course_code'] . '" class="btn btn-info col-sm-5" target="_blank"> Study Material </a>';
#  echo '<a href="study_material.php?fk_id=' . $q_data['faculty_id'] . '&course_code=' . $q_data['course_code'] . '" class="btn btn-info col-sm-5" target="_blank"> Study Material </a>';
  echo '<a href="study_material.php?fk_id=' . $q_data['faculty_id'] . '&course_code=' . $q_data['course_code'] . '" class="btn btn-info col-sm-5" target="_blank"> Study Material </a>';
  echo '<a href="teacher_feedback.php?fk_id=' . $q_data['faculty_id'] . '&cc=' . $q_data['course_code'] . '" class="btn btn-info col-sm-offset-2 col-sm-5"> Feedback </a>' ;

  echo '</div>' ;
  echo '</div>';

}
echo '</div>';
# echo "</div>";

?>
