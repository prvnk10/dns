<?php
require_once('connection.php');
echo "<h4> STUDENT LOGIN </h4> </div>" ;
echo '</div>';
# echo "<h4 class='text-center'> STUDENT LOGIN </h4> </div>" ;


if(isset($_SESSION['rollno'])){
  header("Location: student_profile.php");
}

$rollnoErr = $login_result = '';
$show_form = $show_link = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_POST['submit'])){
   extract($_POST);

   $rollno = $rollno;
   $password = $password;

   if(!is_numeric($rollno)){
     $rollnoErr = "Please enter a valid roll no.";
     $show_form = true;
   }

   if(!$show_form){
     $password = sha1($password);
     $query = "SELECT * FROM users WHERE rollno = '$rollno' AND password = '$password' ";
     $q_result = $conn->query($query);

   if( $q_result->num_rows == 1 ){        # login ok
    $_SESSION['rollno'] = $rollno;
    header("Location: student_profile.php");
   } else {
       $login_result =  "Invalid credentials";
       $show_form = true;
       $show_link = true;
     }
   }
 }
} else { $show_form = true;}

if($show_form){

 if($login_result != ''){ ?>
  <div class="alert alert-danger alert-dismissable fade in text-center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>
  <?php echo $login_result; ?>
  </div>
 <?php } ?>

<form class="form-horizontal" method="post" action="">

 <div class="form-group">
   <label class="control-label col-sm-4" for="rollno"> Roll No  </label>
   <div class="col-sm-4">
     <span class="glyphicon glyphicon-user"> </span>
     <input type="number" name="rollno" class="form-control" required="required" />
   </div>
   <div class="col-sm-4"> </div>
 </div>

 <div class="form-group">
   <label class="control-label col-sm-4" for="password"> Password  </label>
   <div class="col-sm-4">
     <input type="password" name="password" class="form-control" required="required" />
   </div>
   <div class="col-sm-4"> </div>
 </div>

<?php if($show_link){  ?>
 <div class="form-group">
   <div class="col-sm-offset-4 col-sm-8"> <a href="forgot_password.php"> Forgot password </a> </div>
 </div>
<?php } ?>


 <div class="form-group">
   <div class="col-sm-offset-4 col-sm-8">
   <button type="submit" id="login_btn" name="submit" class="btn btn-info" />
   Log In
   </button>
   </div>
 </div>
</form>

<?php
}
 ?>
