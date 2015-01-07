<?php
$pa=$_GET['q'];
header('Content-Type: text/html; charset=big5;');
$url="http://www.google.com/search?q=$pa";
$lines_string = file_get_contents($url);
echo $lines_string;
?> 