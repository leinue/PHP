<?php

namespace Cores\Models;

class FieldsOptions{

	protected $foid;
	protected $name;
	protected $tips;
	protected $type;
	protected $selectorCount;
	protected $rangeFrom;
	protected $rangeTo;
	protected $rangeUnit;
	protected $visible;
	protected $isPhoto;
	protected $isDesc;
	protected $isRegion;

	function getFoid(){return $this->foid;}
	function getName(){return $this->name;}
	function getTips(){return $this->tips;}
	function getType(){return $this->type;}
	function getSelectorCount(){return $this->selectorCount;}
	function getRangeFrom(){return $this->rangeFrom;}
	function getRangeTo(){return $this->rangeTo;}
	function getRangeUnit(){return $this->rangeUnit;}
	function getVisible(){return $this->visible;}
	function isPhoto(){return $this->isPhoto;}
	function isDesc(){return $this->isDesc;}
	function isRegion(){return $this->isRegion;}

}

?>