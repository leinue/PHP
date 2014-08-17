<doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>type hinting</title>
</head>

<body>

<?php

class department{
	private $name;
	private $employees;

	function __construct($_name){
		$this->name=$_name;
		$this->employees=array();
	}

	function addEmployee(Employee $e){
		$this->employees[]=$name;
		echo "<p>$e->getName() has been added to the $this->name department</p>";
	}
}

class Employee{
	private $name;

	function __construct($_name){
		$this->name=$_name;}

	function getName(){return $this->name;}
}

$e1=new Employee("fu111ck");
$e2=new Employee("shit");

$hr=new department("human");

$hr->addEmployee($e1);
$hr->addEmployee($e2);

?>

</body>

</html>