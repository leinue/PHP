<?php
/**
* 
*/
class father
{
	public $a=1;
	protected $b=2;
    private $c=3;

    public function a(){
    	echo "public";
    }

    protected function b(){
    	$this->a=11;
    }

    private function c(){
    	$this->a=111;
    }

    public function d(){
    	$this->b;
    }

    public function e(){
    	$this->c;
    }
}

class son entends father{
	protected function a(){
		echo "hello";
	}

	protected function b(){
		$this->a="hello";
	}
}



$boj_father=new father();
$obj_son=new son();
echo $obj_son->b."<br>";
?>