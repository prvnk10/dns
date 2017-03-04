function getValue(x){
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('a').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "q.php?search=" + x, true);
  xhttp.send();
}
