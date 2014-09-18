<?php

//this is a test about PROTOTYPE PATTERN in OOP
//colpleted in 2014-9-18

class sea{}
class earthSea extends sea{}
class marsSea extends sea{}

class plains{}
class earthPlains extends plains{}
class marsPlains extends plains{}

class terrainFactory{
	private $sea;
	private $plains;

	function __construct(sea $sea,plains $plains){
		$this->sea=$sea;
		$this->plains=$plains;
	}

	function getSea(){
		return clone $this->sea;
	}

	function getPlains(){
		return clone $this->plains;
	}
}

$fac=new terrainFactory(new sea(),new plains());

print_r($fac->getSea());
print_r($fac->getPlains());

?>