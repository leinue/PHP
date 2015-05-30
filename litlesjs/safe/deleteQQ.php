<?php

require('function.php');

session_start();

if (!isset($_GET['qq'])) {
	die('缺少参数');
}

if ($_SESSION['admin']!='true'){
	die('无权限');
}

// unlinkQQ($_GET['qq']);

if(unlinkQQ($_GET['qq'])){
	echo '成功';
}else{
	echo '失败';
}

?>