function searchRollno(rn){

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('id').innerHTML = xhttp.responseText;
    }
  };

  xhttp.open("GET", "searchRollno.php?rn=" + rn , true);
  xhttp.send();
  // alert(4);
  // alert("sdfsf");
}
