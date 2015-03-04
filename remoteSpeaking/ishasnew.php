<?php

$flag=file_get_contents('flag.txt');
if(strlen($flag)==null){
	$flag=0;
}

$flagFile=fopen("flag.txt", "w") or die("Unable to open file!");
$flag=$flag+1;
fwrite($flagFile, $flag);
fclose($flagFile);

?>