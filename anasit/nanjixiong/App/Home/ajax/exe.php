
<?php

	$tmp=explode('\\', __DIR__);
	array_pop($tmp);
	array_pop($tmp);
	array_pop($tmp);
	$basedir='';
	
	foreach ($tmp as $key => $value) {
		$basedir.=$value.'\\';
	}
	
	define('BASEDIR',$basedir);

	require(BASEDIR.'/Cores/Loader.php');

	if(!empty($_GET['action'])){

		switch ($_GET['action']) {
			case 'add_remark':

			// alert($_GET['level']);
				
				if(empty($_GET['level']) || empty($_GET['iid'])){
					echo "-1";
					die();
				}

				$lvl=$_GET['level'];
				$iid=$_GET['iid'];
				$remarksObj=new Cores\Models\RemarksModel();
				$res=$remarksObj->add($lvl,$iid);

				print_r(json_encode($res));

				break;
			
			default:
				# code...
				break;
		}

	}

?>
