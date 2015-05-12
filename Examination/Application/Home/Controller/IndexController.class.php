<?php
namespace Home\Controller;
use Think\Controller;
use Api\Controller\UserController;
use Api\Controller\PostsController;

class IndexController extends UserController {

	protected $userLoginFlag;

    public function index(){
    	if($this->isUserLogin()){
    		$this->login();
    	}else{
    		$this->loadMainPage();
    	}

    	$post=new PostsController();
    }

    public function login(){
   		$this->show('请登录');
    	if($this->loginVerify('597055914@qq.com','123456')){
    		session('isUserLogin','true');
    		$this->userLoginFlag=true;
    		echo '登录成功';
    	}
    }

    public function loadMainPage(){
   		$this->show('已登录');
    }

    public function logout(){
    	$this->show('已退出');
    	session('isUserLogin',null);
    	
    }

    public function registerIn(){

    }

    public function isUserLogin(){
    	return $this->userLoginFlag==null;
    }

    public function fuck(){
    	echo 'fuck';
    	//$this->success('操作成功','/hello');
    	echo I('get.shit');
    }

    public function hello(){
    	//echo 'hello,fuck';
    }

    public function _before_index(){
    	$this->userLoginFlag=session('?isUserLogin');
    }

    public function _after_index(){
    	//echo 'after';
    }

    public function read($id=0){
    	echo 'id='.$id;
    	//$this->ajaxReturn($id);
    	$this->redirect('/Home/Index/fuck',5,'页面跳转中....');
    }

    public function _empty($name){
    	//$this->city($name);
    }

    protected function city($name){
    	//echo 'current city:'.$name;
    }

    public function db(){
    	$User = D('User');
    	print_r($User);
    }

}