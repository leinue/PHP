<?php

namespace Cores\Models;

class Users{
	protected $uid;
	protected $discuzId;
	protected $createTime;
	protected $name;
	protected $privilege;

	function getUid(){return $this->uid;}
	function getDiscuzId(){return $this->discuzId;}
	function getCreateTime(){return $this->createTime;}
	function getName(){return $this->name;}
	function getPrivilege(){return $this->privilege;}
}

?>