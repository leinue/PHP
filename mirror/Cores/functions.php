<?php

/**
*
*
*/

function C($key=null,$value=null){
	
	if($key==null){
		return false;
	}

	$c=new Cores\AccessConfig(BASEDIR.'/Cores/configs');

	if($value==null){
		return $c->offsetGet($key);
	}else{
		$c->offsetSet($key,$value);
	}
}
	

//创建数据库,根据当前配置文件中的数据库类型生成数据库对象
function D($table=null){	
	$dbconfig=C('dbconfig');
	return Cores\Databases::CreateDatabase($dbconfig,$table);
}

//创建模型
function M($modelName){

}

function hump($str){
	$result='';
	
	if(stripos($str,'_')){
		$str_array=explode("_",$str);
		foreach ($str_array as $key => $value) {
			$result.=ucfirst($value);
		}
	}else{
		$result=ucfirst($str);
	}

	return $result;
}
