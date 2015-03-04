<?php

require('function.php');

$content=test_input($_POST['content']);//安全防范

if(strlen($content)!=0){

}else{
	echo '-1';//内容不能为空
}

?>