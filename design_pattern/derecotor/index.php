<?php

class rect{

	var $RectDecorators=array();

	function __construct(){
		echo 'rect start<br>';
	}

	function trigger(){
		$this->before();
		echo 'rect trigger<br>';
		$this->after();
	}

	function addDecorator($de){
		$this->RectDecorators[]=$de;
	}

	function before(){
		foreach ($this->RectDecorators as $key => $de) {
			$de->before();
		}
	}

	function after(){
		foreach ($this->RectDecorators as $key => $de) {
			$de->after();
		}
	}

}

interface Derecotor{

	function before();

	function after();

}

class RectDecorator implements Derecotor{

	function before(){
		echo 'rect decorator before<br>';
	}

	function after(){
		echo 'rect decorator after<br>';
	}

}

$rect=new rect();
$rect->trigger();

$de1=new RectDecorator();
$de2=new RectDecorator();

$rect->addDecorator($de1);
$rect->addDecorator($de2);

$rect->trigger();

?>