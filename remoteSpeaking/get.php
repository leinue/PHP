<?php

require('function.php');

$content=file_get_contents('content.txt');
if(strlen($content)!=null){
	echo $content;
	syncFlag();
}else{
	echo '-1';//暂时没有内容
}

?>