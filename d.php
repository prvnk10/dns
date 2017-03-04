<?php
$s = serialize(date());

echo $s;

$b = unserialize($s);
echo "<p>" ;
echo var_dump($b);


 ?>
