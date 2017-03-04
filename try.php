<?php
require_once('connection.php');
echo "<h4> FACULTY LOGIN </h4> </div>" ;

require_once('test_input.php');

# require_once('validate_faculty_login.php');
/*if(isset($_SESSION['username'])){
  header("Location: faculty_profile.php");
  exit();
} */

$usernameErr = $login_result = '';
$show_form = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
 if(isset($_POST['submit'])) {
   extract($_POST);

   $username = $username;
   $password = $password;

   $username = test_input($username);

   if(empty($username)){
     $usernameErr = 'username can not be empty';
     $show_form = true;
   }

   if(!$show_form){
         # hash the pasword and query db looking for validity of credentials
    $password = sha1($password);
    $query = "SELECT * FROM faculty_login WHERE username = '$username' AND password = '$password' ";
    $q_result = $conn->query($query);

    if( $q_result->num_rows == 1 ){        # login ok
     $q_data = $q_result->fetch_assoc();

     $_SESSION['username'] = $username;
     $category = $q_data['category'];

      $category .= '_profile.php' ;
      #echo $category;
      header("Location: $category");
    } else {
       $login_result =  "Invalid credentials";
       $show_form = true;
      }
   }
 }
} else { $show_form = true;}

if($show_form){
 ?>

<?php if($login_result != ''){ ?>
<div class="alert alert-danger alert-dismissable fade in text-center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>
   <?php echo $login_result; ?>
 </div>
<?php } ?>

<form class="form-horizontal" method="post" action="">

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
