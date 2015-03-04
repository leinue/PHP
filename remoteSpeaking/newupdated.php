<?php

$flag=file_get_contents('flag.txt');
if(strlen($flag)==null){
	$flag=0;
}

$flagFile=fopen("flag.txt", "w") or die("Unable to open file!");
if(!$flagFile){
	echo '-1';//更新失败
}
$flag=$flag+1;
fwrite($flagFile, $flag);
fclose($flagFile);
echo '1';//更新成功
?>