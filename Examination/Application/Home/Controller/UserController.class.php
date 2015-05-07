<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

	public function index(){
		
	}

	protected function isInfoNull($info){
		if(is_array($info)){
			foreach($info as $key => $value){if($value==null){return true;}}
		}else{return $info==null;}
	}

	protected function guid() {
	    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
	    $hyphen = chr(45);// "-"
	    $uuid = substr($charid, 0, 8).$hyphen
	    .substr($charid, 8, 4).$hyphen
	    .substr($charid,12, 4).$hyphen
	    .substr($charid,16, 4).$hyphen
	    .substr($charid,20,12);
	    return $uuid;
	}

	public function register($email='',$password=''){
		$ajaxData=array();
		if($this->isInfoNull(array($email,$password,$verifycode))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$registerUser=D('User');
			$registerData['email']=$email;
			$registerData['password']=sha1($password);
			$registerData['guid']=$this->guid();
			$data=$registerUser->create($registerData);
			if(!$data){
				$ajaxData['status']='0';
				$ajaxData['msg']='注册失败';
				$ajaxData['data']=$registerUser->getError();
				$this->ajaxReturn($ajaxData);
			}else{
				$result=$registerUser->add();
				if($result){
					$ajaxData['status']='1';
					$ajaxData['msg']='注册成功';
					$ajaxData['data']=$result;
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='注册失败';
					$ajaxData['data']=$registerUser->getError();
					$this->ajaxReturn($ajaxData);
				}
			}
		}
	}

	public function login($email='',$password=''){
		$ajaxData=array();
		if($this->isInfoNull(array($email,$password))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$loginUser=D('User');
			$password=sha1($password);
			$data=$loginUser->where("`email`='$email' AND `password`='$password'")->find();
			if($dataata){
				$ajaxData['status']='1';
				$ajaxData['msg']='验证成功';
				$ajaxData['data']=$data;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='验证失败';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getUserByGuid($id){
		$ajaxData=array();
		if(!$this->isInfoNull()){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$postData=M('User')->where("guid='$id'")->find();
			if($postData){
				$ajaxData['status']='1';
				$ajaxData['msg']='读取成功';
				$ajaxData['data']=$postData;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='2';//用户不存在
				$ajaxData['msg']='用户不存在';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

}

?>