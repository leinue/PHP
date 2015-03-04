<?php
header("Content-Type:text/plain;charset=utf-8");

require('function.php');

$content=getContentByPC();
if(strlen($content)!=null){
	echo $content;
	syncPCFlag();
}else{
	echo '-1';//暂时没有内容
}

?>