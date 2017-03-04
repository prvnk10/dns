<?php
# session_start();
require_once('connection.php');

require_once('validate_faculty_login.php');

$faculty_id = $_SESSION['faculty_id'];
$faculty_department = $_SESSION['faculty_department'];

/* if(!isset($_GET['course_code'], $_GET['semester']))
 require_once('list.php');  */
/*
if(!isset($_GET['sem'])){
  require_once('list_of_semesters.php');
}

else{

?>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

  <div class="form-group">
    <label class="control-label col-sm-4" for="">  </label>
    <div class="col-sm-4">
      <input type="" name="" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>


<?php
 }
?>
*/

$show_form = false;
$upload_successful = $upload_failed = '' ;

if(isset($_POST['upload_assignment'])){
   extract($_POST);
   # echo var_dump($_FILES);
   # echo var_dump($_POST);

   if(empty($_FILES['assignment']['size'])){
     $show_form = true;
   }

   if(!$show_form){
    # $notes = $notes;
    # echo $notes;

    $file_size = $_FILES['assignment']['size'];
    # echo $file_size;

    $file_type = $_FILES['assignment']['type'];
    $file_name = $_FILES['assignment']['name'];
    $file_error = $_FILES['assignment']['error'];
    $course_code = $_GET['course_code'];

    $target = assignment . $_FILES['assignment']['name'];
    # echo $target;

    if($file_type = 'application/pdf' || $file_type = 'application/ppt' || $file_type = 'application/txt' || $file_type = 'application/docx'){
     if($file_size > 0 && $file_size < 5242880){
      if($file_error == 0){
       if(move_uploaded_file($_FILES['assignment']['tmp_name'] , $target)){
          $insert_query = "INSERT INTO assignments VALUES('', '$faculty_id' , '$course_code', '$file_name' )";

            if($conn->query($insert_query) === TRUE)
              { $upload_successful = "File uploaded successfully"; $show_form = true; }
            else
              { $upload_failed = "There was an error uploading the file"; $show_form = true; }

         }   else { $upload_failed = "error in uploading your file"; $show_form = true; @unlink($_FILES['notes']['tmp_name']); }
       }   else { $upload_failed = "error in uploading your file"; $show_form = true; }
     } else { $upload_failed =  "size of file must be under 5mb"; $show_form = true; }
   } else { $upload_failed = "Please select a file in pdf, ppt, txt or docx format"; $show_form = true; }
  }
}
# else { $show_form = true;}

$show_form = true;

# if($show_form && isset($_GET['semester'], $_GET['course_code']) )
if(isset($_GET['semester'], $_GET['course_code']))
{

 $semester = $_GET['semester'];
# $subject = $_GET['subject'];
 $course_code = $_GET['course_code'];

if($upload_successful != '') echo '<div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $upload_successful . '</div>';
if($upload_failed != '') echo '<div class="alert alert-danger alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $upload_failed . "</div>";

  echo "<div class='alert alert-info'>" . $course_code . ' ' .  $semester . '<sup> th </sup> semester </div>' ;

  echo "<form enctype='multipart/form-data' class='form-inline' method='post' >";

  echo "<div class='form-group'>";
  echo "<input type='file' name='assignment'> ";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<button type='submit' class='btn btn-info' name='upload_assignment'> Upload Assignment </button>";
  echo "</div>";

  echo "</form>";

}

else {
  require_once('list.php');
}

?>
