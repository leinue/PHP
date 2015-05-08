<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

	public function index(){
		
	}

	/*
	* 权限
	* 0 无限制
	* 1 普通用户
	*/

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
		if($this->isInfoNull(array($email,$password))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$registerUser=D('User');
			$registerData['email']=$email;
			$registerData['password']=sha1($password);
			$registerData['guid']=$this->guid();
			$registerData['private_guid']=$this->guid();
			$data=$registerUser->create($registerData);
			if(!$data){
				$ajaxData['status']='0';
				$ajaxData['msg']=$registerUser->getError();
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}else{
				$result=$registerUser->add();
				if($result){
					$ajaxData['status']='1';
					$ajaxData['msg']='注册成功';
					$ajaxData['data']=$this->getUserByGuid($registerData['guid']);
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']=$registerUser->getError();
					$ajaxData['data']='';
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
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$loginUser=D('User');
			$password=sha1($password);
			$data=$loginUser->where("`email`='$email' AND `password`='$password'")->find();
			$modifiedLoginTime['last_Login_Time']=date('y-m-d h:i:s',time());
			$loginUser->where("`email`='$email'")->data($modifiedLoginTime)->save();
			if($data){
				$ajaxData['status']='1';
				$ajaxData['msg']='验证成功';
				$ajaxData['data']=$data;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='验证失败';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getAllUser($page=1,$limit=10){
		if($this->isInfoNull($limit)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$allUser=D('User');
			$start=10*$page-9;
			$end=10*$page+1;
			$userlist=$allUser->where("`id` BETWEEN $start AND $end")->order('`created_time`')->limit($limit)->select();
			if($userlist){
				$ajaxData['status']='1';
				$ajaxData['msg']='读取成功';
				$ajaxData['data']=$userlist;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='1';
				$ajaxData['msg']=$userlist->getError();
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getAllLockedUser($page=1,$limit=10){
		if($this->isInfoNull(array($page,$limit))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$allUser=D('User');
			$start=10*$page-9;
			$end=10*$page+1;
			$userlist=$allUser->where("`available`=0 AND `id` BETWEEN $start AND $end")->order('created_time')->limit($limit)->select();
			if($userlist){
				$ajaxData['status']='1';
				$ajaxData['msg']='读取成功';
				$ajaxData['data']=$userlist;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='1';
				$ajaxData['msg']=$userlist->getError();
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getAllUnlockedUser($page=1,$limit=10){
		if($this->isInfoNull(array($page,$limit))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$allUser=D('User');
			$start=10*$page-9;
			$end=10*$page+1;
			$userlist=$allUser->where("`available`=1 AND `id` BETWEEN $start AND $end")->order('created_time')->limit($limit)->select();
			if($userlist){
				$ajaxData['status']='1';
				$ajaxData['msg']='读取成功';
				$ajaxData['data']=$userlist;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='1';
				$ajaxData['msg']=$allUser->getError();
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getUserByGuid($id){
		$ajaxData=array();
		if($this->isInfoNull($id)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
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
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getPrivilegeByGuid($pguid=''){
		if($this->isInfoNull($pguid)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$postData=M('User')->where("`private_guid`='$pguid'")->getField('privilege');
			if($postData!==null){
				return $postData;
			}else{
				return null;
			}
		}
	}

	public function changeprivilegeByGuid($pguid='',$p=1){
		if($this->isInfoNull($pguid)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$dataPrivilege['privilege']=$p;
			$postData=M('User')->where("`private_guid`='$pguid'")->data($dataPrivilege)->save();
			if($postData!==null){
				$ajaxData['status']='1';
				$ajaxData['msg']='读取成功';
				$ajaxData['data']=$postData;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='2';//用户不存在
				$ajaxData['msg']='用户不存在';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function removeUser($guid='',$oguid=''){
		if($this->isInfoNull(array($guid,$oguid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			if($this->getPrivilegeByGuid($oid)==='0'){
				$dResult=M('User')->where("`guid`='$guid'")->delete();
				if($dResult){
					$ajaxData['status']='1';
					$ajaxData['msg']='删除成功';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='删除失败';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='没有权限';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function lockUser($guid='',$oid=''){
		if(!$this->isInfoNull(array($guid,$oid))){
			if(!$this->getPrivilegeByGuid($oid)==='0'){
				$ajaxData['status']='0';
				$ajaxData['msg']='没有权限';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}else{
				$lUser = M('User');
				$dataAvailable['available']='0';
				$result=$lUser->where("`guid`='$guid'")->data($dataAvailable)->save();
				if($result!==null){
					$ajaxData['status']='1';
					$ajaxData['msg']='封禁成功';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='封禁失败';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}
			}
		}else{
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}
	}

	public function deblockUser($guid='',$oid=''){
		if(!$this->isInfoNull(array($guid,$oid))){
			if(!$this->getPrivilegeByGuid($oid)==='0'){
				$ajaxData['status']='0';
				$ajaxData['msg']='没有权限';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}else{
				$lUser = M('User');
				$dataAvailable['available']='1';
				$result=$lUser->where("`guid`='$guid'")->data($dataAvailable)->save();
				if($result!==null){
					$ajaxData['status']='1';
					$ajaxData['msg']='封禁成功';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='封禁失败';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}
			}
		}else{
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}
	}

}

?>