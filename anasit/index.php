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

?>