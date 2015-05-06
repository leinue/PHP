<?php

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
	protected $tablePrefix='exa_';
	protected $patchValidate = true;

	protected $_validate = array(
    	array('email','email','邮箱格式不正确',0,1),
    	array('email','','邮箱已经存在！',0,'unique',1)
   	);

   	protected $_auto = array ( 
         array('nickname','蛤蛤'),  // 新增的时候把status字段设置为1
     );
}

?>