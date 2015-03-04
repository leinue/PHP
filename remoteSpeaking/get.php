<?php

require('function.php');

$content=file_get_contents('content.txt');
if(strlen($content)!=null){
	echo $content;
	if(isHasNew()=='0'){
		
	}
}else{
	echo '-1';//暂时没有内容
}

?>