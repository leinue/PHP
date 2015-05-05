<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

	public function index(){
		echo 'user Controller';
	}

	protected function isInfoNull($info){
		if(is_array($info)){
			foreach($info as $key => $value){if($value==null){return false;}}
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
			$registerData['password']=$password;
			$registerData['guid']=$this->guid();
			$data=$registerUser->create($registerData);
			if(!$data){
				$this->ajaxReturn($registerUser->getError());
			}else{
				$result=$registerUser->add();
				if($result){
					$insertId=$result;
					print_r($insertId);
				}
			}
		}
	}

	public function login($nickname,$password,$verifycode){

	}
}

?>