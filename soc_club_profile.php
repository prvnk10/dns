<?php
require_once('connection.php');
echo "<h4> Institution of National Importance </h4>";
echo "</div>";

if(!isset($_SESSION['soc_club_username'])){
  header("Location: soc_clubs_login.php");
}

$event_uploaded_successfully = $event_uploaded_failed = '';
$show_form = false;

if(isset($_POST['event_submitted'])){
  extract($_POST);

  $event_poster_size = $_FILES['event_poster']['size'];
  $event_poster_type = $_FILES['event_poster']['type'];
  $event_poster_name = $_FILES['event_poster']['name'];
  $event_poster_error = $_FILES['event_poster']['error'];

  $event_name = $event_name;
  $event_description = $event_description;

  # $target = events_path . time() . $event_poster_name;
  # echo $target;

  $target = events_path . $event_poster_name;
# echo var_dump($_SESSION);
  $username = $_SESSION['soc_club_username'];

  if( $event_poster_size > 0 && $event_poster_size < 2097152){
   if( ($event_poster_type == 'image/jpeg') || ($event_poster_type == 'image/pjpeg') || ($event_poster_type == 'image/gif') || ($event_poster_type == 'image/png')){
    if( move_uploaded_file($_FILES['event_poster']['tmp_name'] , $target) ){

       $insert_query = "INSERT INTO events VALUES('', '$username', '$event_name', '$event_poster_name', '$event_description', NOW() )";

       if($conn->query($insert_query) === TRUE)
        { $event_uploaded_successfully = $event_name . " has been successfully uploaded to server";  $show_form = true; }
       else
        { $event_uploaded_failed = "Upload failed"; $show_form = true; }

    }  else { $event_uploaded_failed = "there was an error uploading your file. Please try after sometime";}
   }   else { $event_uploaded_failed = "event poster must be in .jpg or .png or .gif format";}
  }    else { $event_uploaded_failed = "size of event poster must be less than 2mb";}
} else {  $show_form = true; }

if($show_form){
?>

<!--
<div class="alert alert-success alert-dismissable fade in text-center text-center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>
   Welcome <?php echo $_SESSION['soc_club_username']; ?>
 </div>  -->

<div class="col-sm-3">
   <div class="list-group">
    <a href="soc_club_profile.php?id=0" class="col-sm-8 list-group-item"> Home </a>
    <a href='soc_club_profile.php?id=1' class="col-sm-8 list-group-item"> Add Event/Notice </a>
    <a href='logout.php' class="col-sm-8 list-group-item"> Logout </a>
   </div>
</div>

<div class="col-sm-6">

<?php if($event_uploaded_successfully != '') echo "<div class='alert alert-success alert-dismissable fade in'> <a href='#' class='close' data-dismiss='alert' aria-label='close'> × </a>" . $event_uploaded_successfully . "</div>"; ?>
<?php if($event_uploaded_failed != '') echo "<div class='alert alert-danger alert-dismissable fade in'> <a href='#' class='close' data-dismiss='alert' aria-label='close'> × </a>" . $event_uploaded_failed . "</div>"; ?>

<?php
  $id = isset($_GET['id']) ? $_GET['id'] : 0 ;

  if($id == 1){

?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label class="control-label col-sm-4" for="event_name"> Event Name  </label>
    <div class="col-sm-4">
      <input type="text" name="event_name" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="event_pic"> Image/Poster  </label>
    <div class="col-sm-4">
      <input type="file" name="event_poster" class="form-control" required="required" />
    </div>
    <div class="col-sm-4"> </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="event_description"> Description  </label>
    <div class="col-sm-8">
      <textarea rows='10' cols="30" name="event_description" class="form-control" required="required">  </textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    <button type="submit" id="event_upload_btn" name="event_submitted" class="btn btn-info" />
    Upload
    </button>
    </div>
  </div>

</form>
</div>
<?php
}

}
?>
