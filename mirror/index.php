<?php
define('BASEDIR',__DIR__);
require(BASEDIR.'/Cores/Loader.php');

$model=D('location');

$con['table']='fuck';
$con['account']='xieyang';
$con['password']=123;

$result=$model->where($con)->select("`fuck`");

print_r($model->getSQL());
// print_r($result);


A()->test();
?>