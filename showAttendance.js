function showAttendance(cc){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('showAttendance').innerHTML = xhttp.responseText;
    }
  };

  xhttp.open("GET", "showAttendance.php?cc=" + cc , true);
  xhttp.send();
}
