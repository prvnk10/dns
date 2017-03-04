<?php
require_once('connection.php');
# echo "</div>";

require_once('test_input.php');

require_once('validate_faculty_login.php');

$faculty_id = $_SESSION['faculty_id'];
$faculty_department = $_SESSION['faculty_department'];

if(!isset($_GET['sem'], $_GET['cc'])){

/*
$query = "SELECT section,course_code,semester FROM course_faculty INNER JOIN courses using(course_code) WHERE faculty_id = '$faculty_id' ";
$q_processing = $conn->query($query);

echo "<h4> Select semester </h4>";
echo "<div class='list-group'>";

$url = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];

while($q_result = $q_processing->fetch_assoc()){

  echo "<a href='" . $url . "&sem=" . $q_result['semester'] . "' role='button' class='btn btn-default list-group-item col-sm-10'>" . $q_result['semester'] . "<sup> th </sup> semester </a>";

}

echo "</div>"; */
require_once('list_of_semesters.php');
}

else
{
 $semester = $_GET['sem'];
 $course_code = $_GET['cc'];

 $query = "SELECT s.name, s.rollno, m.sessional1, m.sessional2, m.attendance, m.internal, m.end_semester, m.total FROM students AS s INNER JOIN marks AS m USING(rollno) WHERE branch='$faculty_department' AND semester = '$semester' AND course_code = '$course_code' ORDER BY rollno";
# echo $query;

 $q_processing = $conn->query($query);
# echo (bool)$q_processing;

# echo $q_processing->num_rows;

/*  while($q_data = $q_processing->fetch_assoc()){
      echo "<table class='table table-bordered table-hover'>";
      echo "<tr> <th> Name </th> <td>" . $q_data['name'] . "</td>" ;
      echo "<tr> <th> Roll No </th> <td>" . $q_data['rollno'] . "</td> </tr> ";
      echo "<tr> <th> Sessional 1 </th> <td> <input type='number' name='s1'> </td> </tr> ";
      echo "</table>";
  } */


  while($q_data = $q_processing->fetch_assoc()){
#  echo var_dump($q_data);

     echo "<form class='form-horizontal' method='post'>";

      /*
      for($i=0 ; $i<8; $i++){
        echo "<div class='form-group'>";
        echo "<label class='col-sm-3' for=''> </label>";
        echo "<div class='col-sm-7'>";
        echo "<input value='$q_data[]'>";
        echo "</div>";
        echo "</div>";
      }
      */

    #  echo "<div class='list-group'>";
      foreach ($q_data as $key => $value) {
        echo "<div class='form-group'>";
        echo "<label class='col-sm-3 control-label' for='" . $key . "'> " . $key . "</label>";
        echo "<div class='col-sm-7'>";
        echo "<input class='form-control' name='" . $key . "' value='" . $value . "'>";
        echo "</div>";
        echo "</div>";
      }
    #  echo "</div>";

        /*
      echo "<div class='list-group'>";

      echo '<div class="form-group">' ;
      echo '<label class="control-label col-sm-4" for="">  </label>';
      echo '<div class="col-sm-4">';
      echo '<input type="" name="" class="form-control" required="required" value="' . $q_data['name'] . '"/>';
      echo '</div>';
      echo '<div class="col-sm-4"> </div>';
      echo '</div>' ;

      echo '</div>';  */

      echo "<button class='btn btn-info col-sm-offset-3' type='submit' name='update_marks'> Update </button>";
      echo "</form>";
  }
}

?>

<!--
<form class="form-horizontal" method="post">

  <div class="form-group">
    <label class="col-sm-3" for="name"> Name: </label>
    <div class="col-sm-9">
      <input type="text" value="<?php echo $q_data['name']; ?>" readonly="readonly">
    </div>
  </div>

</form>
-->


<?php
/*
if(isset($_POST['update_marks'])){
  extract($_POST);

  $name = test_input($name);
  $rollno = $rollno;
  $sessional1 = $sessional1;
  $sessional2 = $sessional2;
  $attendance = $attendance;
  $internal = $internal;
  $end_semester = $end_semester;

  if(!is_numeric($sessional1) || $sessional1 < 0 || $sessional1 > 10)
     #error_log
  if(!is_numeric($sessional2) || $sessional2 < 0 || $sessional2 > 10)

  if(!is_numeric($attendance) || $attendance < 0 || $attendance > 20)

  if(!is_numeric($internal) || $internal < 0 || $internal > 10)

  if(!is_numeric($end_semester) || $end_semester < 0 || $end_semester > 50)


   $query = "UPDATE marks SET sessional1 = '$sessional1', sessional2 = '$sessional2', attendance = '$attendance' ,  "

}
*/
 ?>
