<?php

define('BASEDIR',__DIR__);
require(BASEDIR.'/Cores/Loader.php');

//njx_cata test
$cataObj=new Cores\Models\CataModel();
$allCataObj=$cataObj->selectAll();

if(is_array($allCataObj)){
	foreach ($allCataObj as $key => $value) {
		echo $value->getChild();
	}
}

print_r($allCataObj);

echo '<br>====================<br>';

//njx_comments test
$commentObj=new Cores\Models\CommentsModel();
$allCommentObj=$commentObj->selectAll();
print_r($allCommentObj);

echo '<br>========================================<br>';

// $added=$commentObj->add('1111','22222');
// print_r($added);

echo '<br>====================<br>';

//njx_users test
$usersObj=new Cores\Models\UsersModel();
$allUserObj=$usersObj->selectAll();
print_r($allUserObj);

echo '<br>========================================<br>';

$added=$usersObj->add('11111','1122222','548486');
print_r($added);

echo '<br>====================<br>';

//njx_items test
$itemsObj=new Cores\Models\ItemsModel();
$allItemObj=$itemsObj->selectAll();
print_r($allItemObj);

echo '<br>========================================<br>';

// $itemsObj->add('111111','222222222');
echo '<br>======upOrde======<br>';
$itemsObj->upOrder('1');

echo '<br>====================<br>';

//njx_remarks test
$remarksObj=new Cores\Models\RemarksModel();
$AllremarksObj=$remarksObj->selectAll();
print_r($AllremarksObj);

echo '<br>========================================<br>';

$added=$remarksObj->add('ddsdssd','2222222222');
print_r($added);

echo '<br>====================<br>';

//njx_fields test
$fieldsObj=new Cores\Models\FieldsModel();
$allFieldsObj=$fieldsObj->selectAll();
print_r($allFieldsObj);

echo '<br>========================================<br>';

$added=$fieldsObj->add('11','111','111');
print_r($added);
// $fieldsObj->delete('6');
// $fieldsObj->modify('3977','22222');

echo '<br>====================<br>';

//njx_fields_options test
$fieldsOptionsObj=new Cores\Models\FieldsOptionsModel();
$AllFieldsOptionsObj=$fieldsOptionsObj->selectAll();
print_r($AllFieldsOptionsObj);

echo '<br>========================================<br>';

// $added=$fieldsOptionsObj->add('11','111','111111');
// print_r($added);
// $fieldsOptionsObj->delete('73BF6958-5EFD-B2B2-A0D9-0D6791BAA32A');

echo '<br>====================<br>';

$testModel=new Cores\Models\Model('cata');
print_r($testModel->selectAll());

echo '<br>===============================<br>';

$cataModel=$testModel->getRealModel();
// $cata=$cataModel->addChild('top');
// $cataId=$cata[0]->getCaid();
// $cataModel->addChild('top_1',$cataId);
// $cataModel->addChild('top_2',$cataId);
// $cataModel->addChild('top_5',$cataId);
// $cataModel->modify('FEDB8CDA-C537-FB5C-D2B6-6B38C9FE4658','top_modify');
// $childList=$cataModel->getCataChild('281D42D0-BB4D-18F2-62E0-C09606DA13BC');
// $cataModel->delete('FEDB8CDA-C537-FB5C-D2B6-6B38C9FE4658');

echo '<br>====================<br>';

echo guid();
?>