<?php

$conn = new mysqli("localhost", "root", "", "try");

$hash = array("01" => "A", "02" => "B" , "03" => "C" , "04" => "D", "05" => "E");
$month = array("Jan" => "a", "Feb" => "b");

# echo date('D');

# echo date('d');

$d = date('d');
$m = date('M');
# echo $hash()

# echo $hash[$d] . $hash[$m];


$query = "SELECT * FROM code";
$q_processing = $conn->query($query);


while($q_result = $q_processing->fetch_assoc()){
$code = $q_result['code'];

# echo $code;


for($i=0; $i<strlen($code); $i += 2){
  #echo $hash[$code[$i]];
  #if(array_search($code[$i], $hash)) echo array_search($code[$i], $hash);
  #else echo array_search($code[$i], $month);
  $a = $code[$i];             $b = $code[$i+1];
  echo array_search($a, $hash).' ' .array_search($b, $month);
  echo '<br>';
}

echo '<br/>';

}
?>
