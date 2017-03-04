<?php
require_once('connection.php');

$show_form = $show_update_form = false;
$password_changed_successfully = $identity_verification_failed = '';

if(isset($_POST['change_password'])){
  extract($_POST);

  $current_password = sha1($current_password);

  if(isset($_SESSION['username'])){
    $user = "faculty_login";
    $username = $_SESSION['username'];

    $query = "SELECT * FROM $user WHERE username = '$username' AND password = '$current_password'";
  }

  else if(isset($_SESSION['rollno'])){
    $user = "users";
    $rollno = $_SESSION['rollno'];
    $query = "SELECT * FROM $user WHERE rollno = '$rollno' AND password = '$current_password'";
  }

  $q_processing = $conn->query($query);

  if($q_processing->num_rows == 1){
    $show_update_form = true;
    $show_form = false;
  } else { $identity_verification_failed = "Incorrect Password" ; $show_form = true;}

} else { $show_form = true;}

if(isset($_POST['update_password'])){
  extract($_POST);

  $new_password = sha1($new_password);

  if(isset($_SESSION['username'])){
    $user = "faculty_login";
    $username = $_SESSION['username'];

    $query = "UPDATE $user SET password = '$new_password' WHERE username = '$username' LIMIT 1";
  }

  else if(isset($_SESSION['rollno'])){
    $user = "users";
    $rollno = $_SESSION['rollno'];
    $query = "UPDATE $user SET password = '$new_password' WHERE rollno = '$rollno' LIMIT 1";
  }

  # echo $query;
  $q_processing = $conn->query($query);

  if($q_processing === true){
    $show_update_form = true;
    $show_form = false;
    $password_changed_successfully = "Password updated successfully";
  }
}

if($show_form){

 if($identity_verification_failed != ''){
   echo "<div class='alert alert-danger alert-dismissable fade in'> <a href='#' class='close' data-dismiss='alert' aria-label='close'> &times; </a>" . $identity_verification_failed . "</div>";
 }
?>

<form action="" method="post" class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-5" for="password"> Please enter your current password </label>
    <div class="col-sm-5">
      <input type="password" class="form-control" name="current_password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-6">
    <button class="btn btn-info" type="submit" name="change_password"> Continue </button>
    </div>
  </div>

</form>

<?php
}

if($password_changed_successfully != ''){
  echo "<div class='alert alert-success alert-dismissable fade in'> <a href='#' class='close' data-dismiss='alert' aria-label='close'> × </a>" . $password_changed_successfully . "</div>";
  $show_update_form = false;
}

if($show_update_form){



 ?>


 <form action="" method="post" class="form-horizontal">
   <div class="form-group">
     <label class="control-label col-sm-4" for="password"> New Password </label>
     <div class="col-sm-6">
       <input type="password" class="form-control" name="new_password">
     </div>
   </div>

   <div class="form-group">
     <div class="col-sm-offset-4 ">
     <button class="btn btn-info " type="submit" name="update_password"> Change Password </button>
     </div>
   </div>

 </form>

 <?php
 }
  ?>
