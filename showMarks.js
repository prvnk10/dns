function showMarks(cc){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('showMarks').innerHTML = xhttp.responseText;
    }
  };

  xhttp.open("GET", "showMarks.php?cc=" + cc , true);
  xhttp.send();
}
