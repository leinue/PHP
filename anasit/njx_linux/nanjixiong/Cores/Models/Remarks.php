<?php

namespace Cores\Models;

class Remarks{
	protected $remarkId;
	protected $points;
	protected $itemId;
	
	function getRemarkId(){return $this->remarkId;}
	function getPoints(){return $this->points;}
	function getItemId(){return $this->itemId;}
}

?>