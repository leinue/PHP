<?php

namespace Cores\Models;

class Users{
	
	protected $uid;
	protected $discuzId;
	protected $createTime;
	protected $name;
	protected $privilege;
	protected $region;
	protected $url;
	protected $description;
	protected $photo;

	function getUid(){return $this->uid;}
	function getDiscuzId(){return $this->discuzId;}
	function getCreateTime(){return $this->createTime;}
	function getName(){return $this->name;}
	function getPrivilege(){return $this->privilege;}
	function getRegion(){return $this->region;}
	function getUrl(){return $this->url;}
	function getDescription(){return $this->description;}
	function getPhoto(){return $this->photo;}

}

?>