<?php

namespace Api\Model;
use Think\Model;

class UserModel extends Model{
	protected $tablePrefix='exa_';
	protected $patchValidate = true;

	protected $_validate = array(
    	array('user_email','email','邮箱格式不正确',0,1),
    	array('user_email','','邮箱已经存在！',0,'unique',1),
   	);

   	protected $_auto = array ( 
         array('user_nickname','蛤蛤'),
         array('user_description','要提高姿势水平'),
         array('user_photo','./Public/images/user_default_photo.jpg'),
         array('user_sex','0')
    );

}

?>