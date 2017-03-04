<script src="search.js"> </script>

<?php
require_once('connection.php');

$url = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
if(!isset($_GET['p'])){

echo '<a href="' . $url . '&p=1" role="button" class="btn btn-default"> B.Tech </a> ';
echo '<a href="' . $url . '&p=2" role="button" class="btn btn-default"> M.Tech </a> ';
echo '<a href="' . $url . '&p=3" role="button" class="btn btn-default"> M.B.A </a> ';
echo '<a href="' . $url . '&p=4" role="button" class="btn btn-default"> M.C.A </a> ';

}

if(isset($_GET['p'])){
/*  switch ($_GET['p']) {
    case 1:
      # code...
      break;

    default:
      # code...
      break;
    }   */

?>

<form action="" method="post" class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-1"> Roll No. </label>
    <div class="col-sm-6">
      <input class="form-control" type="number" name="rollno" onblur="searchRollno(this.value)">
    </div>
  </div>

</form>

<?php } ?>
<div id="id"> </div>
