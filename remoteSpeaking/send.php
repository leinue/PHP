<?php

require('function.php');

$content=test_input($_GET['c']);//安全防范

if(strlen($content)!=0){
	$flagFile=fopen("content.txt", "w") or die("Unable to open file!");
	if(!$flagFile){
		return '-1';//更新失败
	}
	fwrite($flagFile, $content);
	fclose($flagFile);
	updateNew();
}else{
	echo '-1';//内容不能为空
}

?>