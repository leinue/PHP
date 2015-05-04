<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$test=new \My\Test();
    	$test->sayHello();
    	$this->show('this is index');
    }

    public function fuck(){
    	echo 'fuck';
    	//$this->success('操作成功','/hello');
    	echo I('get.shit');
    }

    public function hello(){
    	echo 'hello,fuck';
    }

    public function _before_index(){
    	echo 'before';
    }

    public function _after_index(){
    	echo 'after';
    }

    public function read($id=0){
    	echo 'id='.$id;
    	//$this->ajaxReturn($id);
    	$this->redirect('/Home/Index/fuck',5,'页面跳转中....');
    }

    public function _empty($name){
    	$this->city($name);
    }

    protected function city($name){
    	echo 'current city:'.$name;
    }

    public function getUser(){
    	//$User=M('User');
    	//print_r($user);
    	$model=M();
    	print_r($model);
    }

}