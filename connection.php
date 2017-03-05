<?php
session_start();

$conn = new mysqli(servername , username, password , db_name);

if($conn->connect_error){
  echo "Connection problem";
}
/*
else {
  echo "Connection established";
}
*/
 ?>


 <link href="styles/bootstrap.css" rel="stylesheet" type="text/css">
 <link href="register.css" rel="stylesheet" type="text/css">

 <script src="styles/jquery-3.1.0.js"> </script>
 <script src="styles/bootstrap.js"> </script>
 <script src="index.js"> </script>

 <div class="page-header text-center">

 <h3> NATIONAL INSTITUTE OF TECHNOLOGY, KURUKSHETRA-136119 </h3>
<!-- <h4> Institution of National Importance </h4>  -->
<h4> </h4>


  <!-- <div class="container">
<img src="logo.jpg" class='col-sm-3' width="100px" height="150px"/>
 <h3 class="col-sm-9"> NATIONAL INSTITUTE OF TECHNOLOGY, KURUKSHETRA-136119 </h3>
<h4> Institution of National Importance </h4>
</div>  -->
