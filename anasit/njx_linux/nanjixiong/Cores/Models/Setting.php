<?php

namespace Cores\Models;

class Setting{

	protected $sid;
	protected $name;
	protected $value;

	function getName(){return $this->name;}	
	function getValue(){return $this->value;}
	function getSid(){return $this->sid;}

}

?>