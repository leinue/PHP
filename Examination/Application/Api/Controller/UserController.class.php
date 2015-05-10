<?php

namespace Api\Controller;
use Think\Controller;
use Application\Common\common;

function isInfoNull($info){
	if(is_array($info)){
		foreach($info as $key => $value){if($value==null){return true;}}
	}else{return $info==null;}
}

function guid() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4).$hyphen
    .substr($charid,16, 4).$hyphen
    .substr($charid,20,12);
    return $uuid;
}

function getServerResponse($status,$msg,$data){
	$ajaxData['status']=$status;
	$ajaxData['msg']=$msg;
	$ajaxData['data']=$data;
	return $ajaxData;
}

class UserController extends Controller {

	protected $requestMethod='get.';

	public function index(){
		$this->show('非法操作');
	}

	/*
	* @param $fieldName string 字段名
	* @param $filedValue string 字段值
	*/
	protected function getUserId($fieldName,$fieldValue){
		return D('User')->where("`$fieldName`='$fieldValue'")->getField('`user_id`');
	}

	protected function getUserGroup($user_id){
		return D('userGroup')->where("`user_id`=$user_id")->getField('`ug_type`');
	}

	public function changeUserGroup($user_id,$ug_type){
		$upToUser['ug_type']=$ug_type;
		D('UserGroup')->where("`user_id`=$user_id")->data($upToUser)->save();
	}

	public function register(){
		$email=I($this->requestMethod."email");
		$password=I($this->requestMethod."password");
		if(isInfoNull(array($email,$password))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$currentTime=date('y-m-d h:i:s',time());
			$registerUser=D('User');
			$registerData['user_email']=$email;
			$registerData['user_password']=sha1($password);
			$registerData['token_id']=guid();
			$registerData['user_activate_key']=guid();
			$registerData['user_register_time']=$currentTime;
			$registerData['user_last_login_time']=$currentTime;
			$data=$registerUser->create($registerData);
			if(!$data){
				$this->ajaxReturn(getServerResponse('0',$registerUser->getError(),''));
			}else{
				$result=$registerUser->add();
				if($result){
					$userGroupData['user_id']=$this->getUserId('user_email',$email);
					$userGroupData['ug_type']='visitor';
					$handGroup=D('UserGroup');
					if($handGroup->create($userGroupData)){
						if($handGroup->add()){
							$registerData['user_password']=null;
							$registerData['user_id']=$userGroupData['user_id'];
							$registerData['user_group']=$userGroupData['ug_type'];
							$this->ajaxReturn(getServerResponse('1','注册成功',$registerData));
						}else{
							$this->ajaxReturn(getServerResponse('0',$handGroup->getError(),''));
						}
					}else{

					}
				}else{
					$this->ajaxReturn(getServerResponse('0',$registerUser->getError(),''));
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

	public function activate(){
		$activate_key=I($this->requestMethod."activate_key");
		$user_id=I($this->requestMethod."user_id");
		$token_id=I($this->requestMethod."token_id");
		$ug_type=$this->getUserGroup($user_id);
		if($ug_type!='visitor'){
			$this->ajaxReturn(getServerResponse('1','您已经验证过了,请不要重复验证',''));
		}else{
			$activate_result=D('User')->where("`user_id`=$user_id AND `user_activate_key`='$activate_key' AND `token_id`='$token_id'")->select();
			if($activate_result){
				$this->changeUserGroup($user_id,'user');
				$this->ajaxReturn(getServerResponse('1','帐户验证成功',$activate_result));
			}else{
				$this->ajaxReturn(getServerResponse('0','帐户验证失败',$activate_result));
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

	public function getAvailableByGuid($pguid=''){
		if($this->isInfoNull($pguid)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$postData=M('User')->where("`private_guid`='$pguid'")->getField('available');
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