<?php

interface EventGenerator{

	function addObserver(Observer $observer);

	function notify();

}

abstract class Observer{

	function update(){}

}

class Event implements EventGenerator{

	var $observers=array();

	function trigger(){
		echo 'this is event from class Event<br>';
	}

	function addObserver(Observer $observer){
		$this->observers[]=$observer;
	}

	function notify(){
		foreach ($this->observers as $key => $observer) {
			$observer->update();
		}
	}

}

class Observer1 extends Observer{

	function update(){
		echo 'this is a logic in observer<br>';
	}

}

$event=new Event();
$event->trigger();
$observer1 = new Observer1;
$event->addObserver($observer1);
$event->notify();

?>