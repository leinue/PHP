<?php

namespace Api\Model;
use Think\Model;

class UserGroupModel extends Model{
	protected $tablePrefix='exa_';
	protected $patchValidate = true;

	protected $_validate = array(
    	array('ug_type',array('root','admin','user','visitor'),'ug_type字段取值范围错误',0,'in'),
   	);
}

?>