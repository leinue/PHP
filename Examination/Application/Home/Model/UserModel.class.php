<?php

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
	protected $tablePrefix='exa_';
/*	protected $fields=array('nickname','password','email'
		'_type'=>array('nickname'=>'varchar','password'=>'varchar',"email"=>"varchar"));*/
	protected $patchValidate = true;
	protected $_validate = array(
    	array('email','email','邮箱格式不正确',0,1), // 在新增的时候验证name字段是否唯一
   	);
}

?>