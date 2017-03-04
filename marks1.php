<?php
require_once('connection.php');

if(!isset($_SESSION['username'])){
    echo "<div class='alert alert-info'> You are not logged in, please log in continue. <br> You will be redirected to index page in 5 seconds </p> </div>";
    header("Refresh:5, url = index.php");
}

$faculty_id = $_SESSION['faculty_id'];
$faculty_department = $_SESSION['faculty_department'];
$url = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];


if(!isset($_GET['sem'])){

$query = "SELECT section,course_code,semester FROM course_faculty INNER JOIN courses using(course_code) WHERE faculty_id = '$faculty_id' ";
$q_processing = $conn->query($query);

echo "<h4> Select semester </h4>";
echo "<div class='list-group'>";

$url = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];

while($q_result = $q_processing->fetch_assoc()){

  echo "<a href='" . $url . "&sem=" . $q_result['semester'] . "' role='button' class='btn btn-default list-group-item col-sm-10'>" . $q_result['semester'] . "<sup> th </sup> semester </a>";

}

echo "</div>";

}

else if($_GET['sem'] && !$_GET['rollno'])
{
  $semester = $_GET['sem'];

  $query = "SELECT s.name, s.rollno, m.sessional1, m.sessional2, m.attendance, m.internal, m.external, m.total FROM students AS s INNER JOIN marks AS m USING(rollno) WHERE branch='$faculty_department' AND semester = '$semester' ORDER BY rollno";
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


echo "<div class='list-group'>";
  while($q_data = $q_processing->fetch_assoc()){
#  echo var_dump($q_data);


#     echo "<form class='form-horizontal' method='post'>";

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

/*      foreach ($q_data as $key => $value) {
        echo "<div class='form-group'>";
        echo "<label class='col-sm-3 control-label' for='" . $key . "'> " . $key . "</label>";
        echo "<div class='col-sm-7'>";
        echo "<input value='" . $value . "'>";
        echo "</div>";
        echo "</div>";

      }   */

      echo "<a href='" . $url . "&rollno=" . $q_data['rollno'] . "' role='button' class='btn btn-default list-group-item col-sm-10'>" . $q_data['rollno'] . " </a>";


    #  echo "<button class='btn btn-info col-sm-offset-3' type='submit' name='update_marks'> Update </button>";

      echo "</form>";
  }
}


if(isset($_GET['sem']) && isset($_GET['rollno'])){
  $rollno = $_GET['rollno'];
  $semester = $_GET['sem'];

  $query = "SELECT s.name, m.sessional1, m.sessional2, m.attendance, m.internal, m.external, m.total FROM students AS s INNER JOIN marks AS m USING(rollno) WHERE rollno = '$rollno' ";
  $query_processing = $conn->query($query);

#  echo (bool)$query_processing;

   while($query_data = $query_processing->fetch_assoc()){
      echo "<form class='form-horizontal' method='post'>";

      foreach ($query_data as $key => $value) {
        # code...

        echo "<div class='form-group'>";
        echo "<label class='control-label col-sm-3'>" . $key . "</label>";
        echo "<div class='col-sm-7'>";
        echo "<input type='text' class='form-control' value='" . $value . "'>";
        echo "</div>";
        echo "</div>";
      }
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
