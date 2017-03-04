<script>
function showDetainList(sem){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
       document.getElementById('detained_list').innerHTML = xhttp.responseText;
    }
  };

  xhttp.open('GET', 'list_of_detained_students.php?sem=' + sem, true);
  xhttp.send();
}
</script>

<?php

$query = "SELECT cf.section, cf.course_code, c.semester, c.subject FROM course_faculty AS cf INNER JOIN courses AS c using(course_code) WHERE faculty_id = '$faculty_id' ";
$q_processing = $conn->query($query);

# $query = "SELECT cf.course_code, c.semester, c.subject FROM course_faculty AS cf INNER JOIN courses AS c USING (course_code) WHERE faculty_id = '$faculty_id'";
# $q_processing = $conn->query($query);

# echo $query;


echo "<div class='form-group'>";

echo "<label class='col-sm-4 control-label'> Select semester </label> ";
echo "<div class='col-sm-8'>";

echo "<select class='form-control' onchange='showDetainList(this.value)'>";
echo "<option> </option>";
while($q_result = $q_processing->fetch_assoc()){

#echo "<a href='" . $url . "&sem=" . $q_result['semester'] . "&cc=" . $q_result['course_code'] . "' role='button' class='btn btn-default list-group-item col-sm-10'>" . $q_result['semester'] . "<sup> th </sup> semester (" . $q_result['course_code'] . ") (" . $q_result['subject'] .")</a>";
echo "<option value='" . $q_result['semester'] . "&cc=" . $q_result['course_code'] ."'>" . $q_result['semester'] . "<sup> th </sup> semester (" . $q_result['course_code'] . ") (" . $q_result['subject'] . ") </option>";
}

echo "</select>";
echo "</div>";

echo "</div>";
?>

<div id='detained_list'> </div>
