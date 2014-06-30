<?php 

class automobile{
	public $model;
	public $owner;
	public $status;
	public $speed;
	public $time;
	private $time_start;

	public function start(){
		$this->status="start";
		$this->speed=60;
		$this->time_start=time();
		echo "start<br>";
	}

	public function stop(){
		$this->status="stop";
		$this->speed=0;
		echo "stop<br>";
	}

	public function red(){
		$this->status="stop";
		$this->speed=0;
		echo "red<br>";
	}
}

/**
* 
*/
class a
{
	public $b;
	public $c;

	function v(){
		echo "first";
	}	

	function __construct($b,$c)
	{
		$this->b=$b;
		$this->c=$c;
	}

	function __destruct(){
		echo "destruction";
	}
}

$car=new automobile;
$d=new a(1,2);

$car->model="BMW";
$car->owner="xieyang";
$car->start();

for($i=0;$i<10;$i++){

}

$car->red();
echo $car->owner."的".$car->model."行驶了".$car->time."s<br>";

$d->v();

?>