<?php
require_once('connection.php');
# echo "</div>";

if( !( (isset($_SESSION['rollno'])) || (isset($_SESSION['username'])) ) ){
  header("Location: index.php");
}

$show_form = false;
$result = '';

if(isset($_POST['submit_feedback'])){
  extract($_POST);

  if(isset($_SESSION['username']))
    $user_id = $_SESSION['username'];
  else {
     $user_id = $_SESSION['rollno'];
  }
    $message = $feedback_message;
    if(empty($message)){
      $show_form = true;
      $result = "You can't submit empty feedback";
    }

    if(!$show_form){
    $query = "INSERT INTO feedback VALUES('$user_id' ,'$message', CURDATE(), CURTIME())";

    if($conn->query($query)){
      $result = "Feedback submitted successfully";
    } else {
      $result = "server down";
    }

    $show_form = true;
  }
} else { $show_form = true;}

echo "<div class='container'>";
if($result != ''){
  echo '<div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' .  $result . '</div>';
}

if($show_form){
  ?>

<form class="form-horizontal" method="post">

  <div class="form-group">
    <div class="well"> Feedback </div>
<!--     <div class="col-sm-4">
      <input type="" name="" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>  -->
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

<?php
}
?>
