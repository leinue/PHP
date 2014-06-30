<? php 

class father{
	public $a=1;
	protected $b=2;
	private $c=3;

	public function a(){
		echo "father";
	}
}

class son extends father{

	public function a(){
		parent::a();
		echo "entends";
	}
}

$fa=new father();
$so=new son();

$fa->a;
$so->a;

?>