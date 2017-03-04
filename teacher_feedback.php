<?php
require_once('connection.php');
echo "</div>";

if(!isset($_GET['fk_id'], $_GET['cc']) && isset($_SESSION['rollno'])){
  header('Location: student_profile.php');
}

$result = '' ;

if(isset($_POST['submit_feedback'])){
  extract($_POST);

   $rollno = $_SESSION['rollno'];
   $faculty_id = $_GET['fk_id'];
   $course_code = $_GET['cc'];

    $message = $feedback_message;
    $query = "INSERT INTO teachers_feedback VALUES('', '$rollno', '$faculty_id', '$course_code', '$message', NOW())";

    if($conn->query($query) === TRUE){
      $result = "Feedback submitted successfully";
    } else {
      $result = "server down";
    }

}

echo "<div class='container text-center'>";
if($result != ''){
  echo '<div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' .  $result . '</div>';
}

?>

 <form class="form-horizontal" method="post">

   <div class="form-group">
     <div class="well well-sm"> Feedback </div>
   </div>

   <div class="form-group">
   <textarea rows="15" cols="90" name='feedback_message'></textarea>
   </div>

   <div class="form-group">
     <div>
     <button type="submit" id="send_msg" name="submit_feedback" class="btn btn-info"> Submit </button>
     </div>
   </div>

 </form>
</div>
