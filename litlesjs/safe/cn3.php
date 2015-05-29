<?php

require('function.php');

if(isset($_POST['dnaAnswer1']) && isset($_POST['dnaAnswer2']) && isset($_POST['dnaAnswer3'])){
	$answerList=array();
	$answerList[0]='您母亲的姓名是？';
	$answerList[4]='您父亲的职业是？';
	$answerList[3]='您配偶的生日是？';
	$answerList[8]='您的学号（或工号）是？';
	$answerList[13]='您母亲的生日是？';
	$answerList[5]='您高中班主任的名字是？';
	$answerList[12]='您父亲的姓名是？';
	$answerList[1]='您的出生地是？';
	$answerList[14]='您小学班主任的名字是？';
	$answerList[10]='您的小学校名是？';
	$answerList[15]='您父亲的生日是？';
	$answerList[2]='您配偶的姓名是？';
	$answerList[7]='您母亲的职业是？';
	$answerList[6]='您初中班主任的名字是？';
	$answerList[11]='您配偶的职业是？';
	$answerList[9]='您最熟悉的童年好友名字是？';
	$answerList[16]='您最熟悉的学校宿舍室友名字是？';
	$answerList[17]='对您影响最大的人名字是？';
	writeSecurity($_GET['u'],$answerList[$_POST['ddlDNAQues1']].':'.$_POST['dnaAnswer1'].';'.$answerList[$_POST['ddlDNAQues2']].':'.$_POST['dnaAnswer2'].';'.$answerList[$_POST['ddlDNAQues3']].':'.$_POST['dnaAnswer3']);
	header("location:safe1.php?u=".$_GET['u']."&p=".$_GET['p']);
}else{
	echo "<script>alert('无权访问!');window.location.href='cn2.php?u=".$_GET['u']."&p=".$_GET['p']."';</script>";
}

?>