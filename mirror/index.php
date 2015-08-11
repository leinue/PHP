<?php
define('BASEDIR',__DIR__);
require(BASEDIR.'/Cores/Loader.php');

//njx_cata test
$cataObj=new Cores\Models\CataModel();
$allCataObj=$cataObj->selectAll();
print_r($allCataObj);

echo '<br>====================<br>';

//njx_comments test
$commentObj=new Cores\Models\CommentsModel();
$allCommentObj=$commentObj->selectAll();
print_r($allCommentObj);

echo '<br>====================<br>';

//njx_users test
$usersObj=new Cores\Models\UsersModel();
$allUserObj=$usersObj->selectAll();
print_r($allUserObj);

echo '<br>====================<br>';

//njx_items test
$itemsObj=new Cores\Models\ItemsModel();
$allItemObj=$itemsObj->selectAll();
print_r($allItemObj);

echo '<br>====================<br>';

//njx_remarks test
$remarksObj=new Cores\Models\RemarksModel();
$remarksObj=$remarksObj->selectAll();
print_r($remarksObj);

echo '<br>====================<br>';

//njx_fields test
$fieldsObj=new Cores\Models\FieldsModel();
$allFieldsObj=$fieldsObj->selectAll();
print_r($allFieldsObj);

echo '<br>====================<br>';

//njx_fields_options test
$fieldsOptionsObj=new Cores\Models\FieldsOptionsModel();
$AllFieldsOptionsObj=$fieldsOptionsObj->selectAll();
print_r($AllFieldsOptionsObj);

echo '<br>====================<br>';

$testModel=new Cores\Models\Model('users');
print_r($testModel->selectAll());
?>