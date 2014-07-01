<?php
$value='username';
setcookie("testcookie",$value,time()+3600);

echo "cookie:".$_COOKIE['testcookie'];

//delete cookie

setcookie("testcookie","",time()-3600);
?>