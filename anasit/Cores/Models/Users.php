<?php

namespace Cores\Models;

class Users{
	protected $uid;
	protected $discuzId;
	protected $createTime;
	protected $name;
	protected $privilege;

	function getUid(){return self::$uid;}
	function getDiscuzId(){return self::$discuzId;}
	function getCreateTime(){return self::$createTime;}
	function getName(){return self::$name;}
	function getPrivilege(){return self::$privilege;}
}

?>