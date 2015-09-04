<?php

namespace Cores\Models;

class Fields{

	protected $oid;
	protected $foid;
	protected $value;
	protected $itemId;
	protected $display;
	protected $_order;

	function getOid(){return $this->oid;}
	function getFoid(){return $this->foid;}
	function getValue(){return $this->value;}
	function getItemId(){return $this->itemId;}
	function isDisplayed(){return $this->display;}
	function getOrder(){return $this->_order;}
}

?>