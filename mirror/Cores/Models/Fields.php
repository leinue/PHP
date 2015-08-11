<?php

namespace Cores\Models;

class Fields{

	protected $oid;
	protected $foid;
	protected $value;
	protected $itemId;

	function getOid(){return $this->oid;}
	function getFoid(){return $this->foid;}
	function getValue(){return $this->value;}
	function getItemId(){return $this->itemId;}
}

?>