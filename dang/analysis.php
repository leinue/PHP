<?php
header('Content-Type:text/html;charset=GB2312');
function loadDepot($dir){
	//$content=file_get_contents($dir);
	//$content=iconv("gb2312", "utf-8//IGNORE",$content);
	$fp=fopen($dir, "r");
	$content=fread($fp,filesize($dir));
	fclose($fp);
	return $content;
}

function printData($ra){
	$assem=loadDepot('depots.txt');
	$assemLine=explode("******************",$assem);
	$subject=nl2br($assemLine[$ra]);
	echo $subject;
}

//$a=str_replace("\r\n", "******************", loadDepot("depot.txt"));
//print($a);

/*$depots=loadDepot('depot.txt');
$depotsCombined=array();
$result="";
$depotsExploded=explode("\r\n", $depots);
$count=0;

foreach ($depotsExploded as $key => $value) {
	if(!(strlen($value)==0)){
		//$depotsCombined[$count]=$value;
		$result=$result.$value."\r\n";
		//print($value);
	}else{
		$result=$result."\r\n"."******************"."\r\n";
	}
}

print($result);
file_put_contents('depots.txt',$result);*/

$method=$_GET['method'];
$randomNum=0;
switch ($method) {
	case 'single':
		$randomNum=rand(0,699);
		printData($randomNum);
		break;
	case 'multi':
		$randomNum=rand(700,702);
		printData($randomNum);
		break;
	default:
		echo -1;
		break;
}
?>