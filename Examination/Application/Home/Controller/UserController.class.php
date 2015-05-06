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
		if($this->isInfoNull(array($email,$password,$verifycode))){
			return 101;//one or muliti args are null
		}else{
			$registerUser=D('User');
			$registerData['email']=$email;
			$registerData['password']=sha1($password);
			$registerData['guid']=$this->guid();
			$data=$registerUser->create($registerData);
			if(!$data){
				$this->ajaxReturn($registerUser->getError());
			}else{
				$result=$registerUser->add();
				if($result){
					$insertId=$result;
					$this->ajaxReturn($insertId);
				}else{
					$this->ajaxReturn($registerUser->getError());
				}
			}
		}
	}

	public function login($email='',$password=''){
		if($this->isInfoNull(array($email,$password))){
			return 201;
		}else{
			$loginUser=D('User');
			$password=sha1($password);
			$data=$loginUser->where("`email`='$email' AND `password`='$password'")->find();
			$this->ajaxReturn($data);
		}
	}

	public function getuserbyguid($id){
		print_r(M('User')->where("guid='$id'")->getField('email'));
	}
}

?>