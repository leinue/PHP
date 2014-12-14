<?php

function writeNew($longitude,$latitude){
	$existed=readNew();
	$count=$existed['count']+1;
	//print_r("count=".$count);
	return file_put_contents("newest.wn","longitude=$longitude;latitude=$latitude;count=$count\r\n");
}

function readNew(){
	$content=file_get_contents("newest.wn");
	$data=explode(";",$content);
	//data[0]->longitude
	//data[1]->latitude
	$data[0]=explode("=",$data[0]);
	$data[1]=explode("=",$data[1]);
	$data[2]=explode("=",$data[2]);
	$res[$data[0][0]]=$data[0][1];
	$res[$data[1][0]]=$data[1][1];
	$res[$data[2][0]]=$data[2][1];
	return $res;
}

$longitude=$_GET['longitude'];
$latitude=$_GET['latitude'];

//请求内容read为读取最新坐标,置空为写入新坐标
$method=$_GET['method'];

if(strlen($method)==0 && strlen($longitude)!=0 && strlen($latitude)!=0){
	if(is_numeric($longitude) && is_numeric($latitude)){
		//写操作
		if(writeNew($longitude,$latitude)){
			print("1");
		}else{
			print("-2");
		}
	}else{
		print("-2"); //请求失败
	}
}elseif($method="read" && strlen($longitude)==0 && strlen($latitude)==0){
	//读操作
	$res=readNew();
	/*返回的JSON数据格式
	*{
    *	"longitude": "15615616516",
    *	"latitude": "516515665656",
    *	"count":"1"
	*}
	*/
	print("{\"longitude\":\"".$res['longitude']."\",\"latitude\":\"".$res['latitude']."\",\"count\":\"".trim($res['count'])."\"}");
}else{
	//请求失败
	print("-1");
}

?>