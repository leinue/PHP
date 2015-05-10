<?php

namespace Home\Model;
use Think\Model;

class PostsModel extends Model{
	protected $tablePrefix='exa_';

	protected $_validate = array(
    	array('post_type',array('post','page','img','media'),'post_type字段取值范围错误',0,'in')
   	);
}

?>