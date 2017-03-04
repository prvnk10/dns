<?php
require_once('connection.php');
echo "<h3> APPLICATION FORM FOR REGISTRATION </h3>";
echo "</div>";

require_once('test_input.php');

if(!isset($_SESSION['rollno'])){
  echo "<div class='alert alert-info'> Please login to continue";
  echo "<p> You will redirected to login page in 5 seconds </p> </div>";
}

$rollno = $_SESSION['rollno'];

$father_name = $mobile_number =  '';
$nameErr = $rollnoErr = $branchErr = $fathernameErr = $mobileNumberErr = $emailErr = $semesterErr = '';
$show_form = $show_fees_form = false;

$query = "SELECT s.name, s.branch, s.semester, s.email, s.programme, p.father_name FROM students AS s INNER JOIN parents AS p USING(rollno) WHERE rollno = '$rollno' LIMIT 1";
# $query = "SELECT s.name, s.branch, s.email, s.programme FROM students AS s WHERE rollno = '$rollno' LIMIT 1";
$query_result = $conn->query($query);

# echo $query_result->num_rows ;
if($query_result->num_rows == 1){
  $data = $query_result->fetch_assoc();

  $name = $data['name'];
  $branch = $data['branch'];
  $email = $data['email'];
  $programme = $data['programme'];
  $father_name = $data['father_name'];
  $semester = $data['semester'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['submit'])){
    extract($_POST);
    $programme = $programme;
    $branch = test_input($branch);
    $name = test_input($name);
    $rollno = test_input($rollno);
    $father_name = test_input($father_name);
    $mobile_number = test_input($mobile_number);
    $email = test_input($email);


    if(!is_numeric($rollno)){
      $rollnoErr = "Please enter a valid roll no";
      $show_form = true;
    }

    if(!is_numeric($mobile_number)){
      $mobileNumberErr = "Please enter a valid mobile number";
      $show_form = true;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $emailErr = "Please enter a valid email";
      $show_form = true;
    }

    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $show_form = true;
    }

    if (!preg_match("/^[a-zA-Z ]*$/",$father_name)) {
      $fathernameErr = "Only letters and white space allowed";
      $show_form = true;
    }


    if(!$show_form){
      $show_fees_form = true;
    }
  }
} else { $show_form = true; }

if($show_form){
?>

<form method="post" class="form-horizontal" action="">

<div class="form-group">
 <label class="control-label col-sm-4" for="programme"> Programme </label>
 <div class="col-sm-4">
 <input type="text" name="programme" class="form-control" required="required" value="<?php echo $programme; ?>" readonly="readonly" />
 <!-- <span id="passwordErr" class="help-block error"> <?= $passwordErr ?> </span>  -->
 </div>
 <div class="col-sm-4"> </div>
</div>

<div class="form-group">
 <label class="control-label col-sm-4" for="branch"> Branch </label>
 <div class="col-sm-4">
 <input type="text" name="branch" class="form-control" required="required" value="<?php echo $branch; ?>" readonly="readonly"/>
 <span id="branchErr" class="help-block error"> <?= $branchErr ?> </span>
 </div>
 <div class="col-sm-4"> </div>
</div>

<div class="form-group">
 <label class="control-label col-sm-4" for="branch"> Semester </label>
 <div class="col-sm-4">
 <input type="number" name="semester" class="form-control" required="required" value="<?php echo $semester+1; ?>" readonly="readonly"/>
 <span id="branchErr" class="help-block error"> <?= $semesterErr ?> </span>
 </div>
 <div class="col-sm-4"> </div>
</div>

<div class="form-group">
 <label class="control-label col-sm-4" for="name"> Name </label>
 <div class="col-sm-4">
 <input type="text" name="name" class="form-control" required="required" value="<?php echo $name; ?>" readonly="readonly"/>
 </div>
 <span id="nameErr" class="help-block error"> <?= $nameErr ?> </span>
 <div class="col-sm-4"> </div>
</div>

<div class="form-group">
 <label class="control-label col-sm-4" for="rollno"> Roll No. </label>
 <div class="col-sm-4">
 <input type="number" name="rollno" class="form-control" required="required" value="<?php echo $_SESSION['rollno']; ?>" readonly="readonly"/>
 </div>
 <span id="rollnoErr" class="help-block error"> <?= $rollnoErr ?> </span>

 <div class="col-sm-4"> </div>
</div>


<div class="form-group">
  <label class="control-label col-sm-4" for="father_name"> Father's Name </label>
  <div class="col-sm-4">
    <input type="text" name="father_name" class="form-control" required="required" value="<?php echo $father_name; ?>" readonly="readonly"/>
  </div>
 <span id="fathernameErr" class="help-block error"> <?= $fathernameErr ?> </span>
  <div class="col-sm-4"> </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-4" for="mobile_number"> Telephone/Mobile No. </label>
  <div class="col-sm-4">
    <input type="number" name="mobile_number" class="form-control" required="required" value="<?php echo $mobile_number; ?>" />
  </div>
 <span id="mobileNumberErr" class="help-block error"> <?= $mobileNumberErr ?> </span>
  <div class="col-sm-4"> </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-4" for="email"> Email ID </label>
  <div class="col-sm-4">
    <input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>"/>
  </div>
 <span id="emailErr" class="help-block error"> <?= $emailErr ?> </span>
  <div class="col-sm-4"> </div>
</div>



<div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
    <button type="submit" id="continue_btn" name="submit" class="btn btn-info" required="required">
      Continue
    </button>
  </div>
</div>

</form>

<?php
}

if($show_fees_form){

?>

<form method="post" class="form-horizontal">

  <div class="form-group">
    <label class="control-label col-sm-4" for="amount"> Amount Deposited  </label>
    <div class="col-sm-4">
      <input type="number" name="amount_deposited" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="mode_of_payment"> Mode of Payment  </label>
    <div class="col-sm-4">
      <input type="text" name="mode_of_payment" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="date_of_payment"> Date of Payment </label>
    <div class="col-sm-4">
      <input type="date" name="date_of_payment" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" name="register" class="btn btn-info" required="required"> Continue </button>
    </div>
  </div>


</form>

<?php
}

if(isset($_POST["register"])){


 ?>

<div class="alert ">
<p class="alert alert-info"> our system will contact with library server and check student record and return a positive response if there are no pending library dues with
  respect to the student </p>

  <p class="alert alert-warning"> then our server will contact the hostel server.... </p>

  <p class="alert alert-info"> if everything is all right upto this stage, then we will show a final form to the student with all details entered and details grabbed from
    library and hostel server and show them a button to register themselves</p>

  <p class="alert alert-warning"> if student is successfully registered, then we will send them an email </p>
  <p class="alert alert-info"> if student not registered successfully, then show them where error occured </p>

</div>

<?php
}
 ?>
