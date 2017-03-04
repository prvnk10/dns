<?php
require_once('connection.php');
echo "</div>";

require_once('test_input.php');

# if user's already logged in, then redirect to faculty_profile page
/*
if(isset($_SESSION['username'])){
  header("Location: faculty_profile.php");
} */

$usernameErr = $login_result = '';
$show_form = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['submit'])) {
     extract($_POST);

     $username = $username;
     $password = $password;

# write function to check username
    $username = test_input($username);

     if(!$show_form){
         # hash the pasword and query db looking for validity of credentials
         $password = sha1($password);
         $query = "SELECT * FROM mmca_login WHERE username = '$username' AND password = '$password' ";
         $q_result = $conn->query($query);

         if( $q_result->num_rows == 1 ){        # login ok
            $_SESSION['mmca_username'] = $username;
            header("Location: mmca_profile.php");
         } else {
             $login_result =  "Invalid credentials";
             $show_form = true;
         }
     }
  }
} else { $show_form = true;}

if($show_form){
 ?>

<form class="form-horizontal" method="post" action="">

<?php if($login_result != ''){ ?>
<div class="form-group alert alert-danger text-center"> <?php echo $login_result; ?> </div>
<?php } ?>

 <div class="form-group">
   <label class="control-label col-sm-4" for="username"> Username  </label>
   <div class="col-sm-4">
     <input type="text" name="username" class="form-control" required="required" />
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
