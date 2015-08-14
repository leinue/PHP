<?php

namespace Cores\Models;

class Cata{
	protected $caid;
	protected $name;
	protected $parent;
	protected $child;
	protected $visible;

	function getCaid(){return $this->caid;}
	function getName(){return $this->name;}
	function getParent(){return $this->parent;}
	function getChild(){return $this->child;}
	function getVisible(){return $this->visible;}

}

?>