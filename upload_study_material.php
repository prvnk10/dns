<?php
require_once('connection.php');
require_once('validate_faculty_login.php');

$faculty_id = $_SESSION['faculty_id'];

$url = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];

$show_form = false;

$upload_successful = $upload_failed = '' ;

if(isset($_POST['upload_notes'])){
   extract($_POST);
   # echo var_dump($_FILES);
   # echo var_dump($_POST);


   if(empty($_FILES['notes']['size'])){
     $show_form = true;
   }

   if(!$show_form){
    # $notes = $notes;
    # echo $notes;

    $file_size = $_FILES['notes']['size'];
    # echo $file_size;

    $file_type = $_FILES['notes']['type'];
    $file_name = $_FILES['notes']['name'];
    $file_error = $_FILES['notes']['error'];
    $course_code = $_GET['course_code'];

    $target = study_m . $_FILES['notes']['name'];
    # echo $target;

    if($file_type = 'application/pdf' || $file_type = 'application/ppt' || $file_type = 'application/txt' || $file_type = 'application/docx'){
     if($file_size > 0 && $file_size < 5242880){
      if($file_error == 0){
       if(move_uploaded_file($_FILES['notes']['tmp_name'] , $target)){
          $insert_query = "INSERT INTO study_material VALUES('', '$faculty_id' , '$course_code', '$file_name' )";

            if($conn->query($insert_query) === TRUE)
               $upload_successful = "File uploaded successfully";
            else
                $upload_failed = "There was an error uploading the file";

         }   else { $upload_failed = "error in uploading your file"; $show_form = true; @unlink($_FILES['notes']['tmp_name']); }
       }   else { $upload_failed = "error in uploading your file"; $show_form = true; }
      } else { echo "size of file must be under 5mb";}
    } else { echo "Please select a file in pdf, ppt, txt or docx format" ; }
  }
} else { $show_form = true;}


if(isset($_GET['course_code'] , $_GET['semester'])){

  $course_code = $_GET['course_code'];
  $semester = $_GET['semester'];
  
  if($upload_successful != '') echo '<div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $upload_successful . '</div>';
  if($upload_failed != '') echo '<div class="alert alert-danger alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $upload_failed . '</div>';

  echo "<div class='alert alert-info'>" . $course_code . ' ' .  $semester . '<sup> th </sup> semester </div>' ;

  echo "<form enctype='multipart/form-data' class='form-inline' method='post' >";

  echo "<div class='form-group'>";
  echo "<input type='file' name='notes'> ";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<button type='submit' class='btn btn-info' name='upload_notes'> Upload </button>";
  echo "</div>";

  echo "</form>";
}
else {
/*   $query = "SELECT cf.course_code, c.semester, c.subject FROM course_faculty AS cf INNER JOIN courses AS c USING (course_code) WHERE faculty_id = '$faculty_id'";
   $q_processing = $conn->query($query);

   # echo (bool)$q_processing;

   echo "<div class='list-group'>";
   while($q_data = $q_processing->fetch_assoc()){
     echo "<a href='" . $url . "&course_code=" . $q_data['course_code'] . "&semester=" . $q_data['semester'] . "' class='list-group-item'>" . $q_data['subject'] . " (" . $q_data['course_code'] . ") " .$q_data['semester'] . "<sup> th </sup> semester ";
   }
   */
   require_once('list.php');
}

?>
