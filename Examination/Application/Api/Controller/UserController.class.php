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
	protected $groupList=["root"=>'0',"admin"=>'1',"user"=>'2',"visitor"=>'3'];
	protected $groupListReversion=['0'=>'root','1'=>'admin','2'=>'user','3'=>'visitor'];

	public function index(){
		$this->show('非法操作');
	}

	/*
	* @param $fieldName string 字段名
	* @param $filedValue string 字段值
	*/
	protected function getUserId($fieldName,$fieldValue){
		return D('User')->where("`%s`='%s'",array($fieldName,$fieldName))->getField('`user_id`');
	}

	protected function isEmailExists($email){
		return !D('User')->where("`user_email`='$email'")->getField('`user_id`')==null;
	}

	protected function getUserByUserId($id){
		if(isInfoNull($id)){
			return 0;//数据不能为空
		}else{
			$postData=M('User')->where("user_id=$id")->field(array('user_password'),true)->find();
			if($postData){
				return $postData;
			}else{
				return 0;//读取失败
			}
		}
	}

	protected function getUserIdByTokenId($token_id){
		return D('User')->where("`token_id`='$token_id'")->getField('`user_id`');
	}

	protected function isUserSelf($user_id,$token_id){
		return $this->getUserIdByTokenId($token_id)==$user_id;
	}

	protected function getUserGroup($user_id){
		return D('UserGroup')->where("`user_id`=$user_id")->getField('`ug_type`');
	}

	protected function getGroupUser($page,$limit,$groupName){
		if(isInfoNull(array($page,$limit))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$allUser=D('UserGroup');
			$userlist=$allUser->where("`ug_type`='$groupName'")->page($page,$limit)->field('`user_id`')->select();
			if($userlist){
				$userCount=count($userlist);
				foreach ($userlist as $key => $user) {
					$userData[$key]=$this->getUserByUserId($user['user_id']);
				}
				$this->ajaxReturn(getServerResponse('0','读取成功',$userData));
			}else{
				$this->ajaxReturn(getServerResponse('0','读取失败或该组用户为空',$userlist));
			}
		}
	}

	public function changeUserGroup($user_id,$ug_type){
		$upToUser['ug_type']=$ug_type;
		D('UserGroup')->where("`user_id`=%s",array($user_id))->data($upToUser)->save();
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
					$userGroupData['ug_type']=$this->groupList['visitor'];
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
						$this->ajaxReturn(getServerResponse('0','注册失败',''));
					}
				}else{
					$this->ajaxReturn(getServerResponse('0',$registerUser->getError(),''));
				}
			}
		}
	}

	public function loginVerify($email='',$password=''){
		if(isInfoNull(array($email,$password))){
			return -1;//帐号或密码不能为空
		}else{
			$loginUser=D('User');
			$password=sha1($password);
			$data=$loginUser->where("`user_email`='$email' AND `user_password`='$password'")->field(array('user_password'),true)->find();
			$modifiedLoginTime['token_id']=guid();
			$loginUser->where("`user_email`='$email'")->data($modifiedLoginTime)->save();
			return $data;
		}
	}

	public function activate(){
		$activate_key=I($this->requestMethod."activate_key");
		$user_id=I($this->requestMethod."user_id");
		$token_id=I($this->requestMethod."token_id");
		$ug_type=$this->getUserGroup($user_id);
		if($ug_type!='3'){
			$this->ajaxReturn(getServerResponse('1','您已经验证过了,请不要重复验证',''));
		}else{
			$activate_result=D('User')->where("`user_id`=$user_id AND `user_activate_key`='$activate_key' AND `token_id`='$token_id'")->select();
			if($activate_result){
				$this->changeUserGroup($user_id,$this->groupList['user']);
				$this->ajaxReturn(getServerResponse('1','帐户验证成功',$activate_result));
			}else{
				$this->ajaxReturn(getServerResponse('0','帐户验证失败',$activate_result));
			}
		}
	}

	public function getAllUser(){
		$page=I($this->requestMethod."page",1);
		$limit=I($this->requestMethod."limit",10);
		if(isInfoNull(array($page,$limit))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$allUser=D('User');
			$userlist=$allUser->order('`user_register_time`')->page($page,$limit)->field(array('user_password','user_sex'),true)->select();
			if($userlist){
				$this->ajaxReturn(getServerResponse('0','数据不能为空',$userlist));
			}else{
				$this->ajaxReturn(getServerResponse('0',$userlist->getError(),$userlist));
			}
		}
	}

	public function getAllVisitor(){
		$page=I($this->requestMethod."page");
		$limit=I($this->requestMethod."limit");
		$this->getGroupUser($page,$limit,$this->groupList['visitor']);
	}

	public function getAllCommonUser(){
		$page=I($this->requestMethod."page");
		$limit=I($this->requestMethod."limit");
		$this->getGroupUser($page,$limit,$this->groupList['user']);
	}

	public function getAllAdmin(){
		$page=I($this->requestMethod."page");
		$limit=I($this->requestMethod."limit");
		$this->getGroupUser($page,$limit,$this->groupList['admin']);	
	}

	public function getAllRoot(){
		$page=I($this->requestMethod."page");
		$limit=I($this->requestMethod."limit");
		$this->getGroupUser($page,$limit,$this->groupList['root']);
	}

	protected function isUserRoot($type){return $this->groupListReversion[$type]==='root';}

	protected function isUserAdmin($type){return $this->groupListReversion[$type]==='admin';}

	protected function isUserCommon($type){return $this->groupListReversion[$type]==='user';}

	protected function isUserVisitor($type){return $this->groupListReversion[$type]==='visitor';}

	protected function isUserRootOrAdmin($type){return $this->isUserRoot($type) || $this->isUserAdmin($type);}

	public function addPrivilege(){
		$ug_type=I($this->requestMethod."ug_type");
		$ugp_name=I($this->requestMethod."ugp_name");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($ug_type,$ugp_name,$user_id)) || !is_numeric($user_id)){
			$this->ajaxReturn(getServerResponse('0','数据不能为空或有误',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserRoot($user_group_type) || $this->isUserAdmin($user_group_type)){
				$privilegeData['ug_type']=$ug_type;
				$privilegeData['ugp_name']=$ugp_name;
				$addRights=M('UserGroupPrivileges');
				$createResult=$addRights->create($privilegeData);
				if(!$createResult){
					$this->ajaxReturn(getServerResponse('0',$addRights->getError(),''));
				}else{
					$addResult=$addRights->add();
					if(!$addResult){
						$this->ajaxReturn(getServerResponse('0','添加权限失败',''));
					}else{
						$this->ajaxReturn(getServerResponse('1','添加权限成功',''));
					}
				}
			}else{
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}
		}
	}

	public function removePrivilege(){
		$ugp_name=I($this->requestMethod."ugp_name");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($ugp_name,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空或有误',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserRoot($user_group_type)){
				$delPriResult=M('UserGroupPrivileges')->where("`ugp_name`=$ugp_name")->delete();
				if(!$delPriResult){
					$this->ajaxReturn(getServerResponse('0','删除权限失败',''));
				}else{
					$this->ajaxReturn(getServerResponse('0','删除权限成功',''));
				}
			}else{
				$this->ajaxReturn(getServerResponse('0','没有权限',''));	
			}
		}
	}

	public function getAllPrivileges(){
		$this->ajaxReturn(getServerResponse('1','读取成功',M('UserGroupPrivileges')->distinct(true)->field('ugp_name')->select()));
	}

	public function getPrivilege($user_id='',$token_id=''){
		if(isInfoNull($token_id)){
			return null;
		}else{
			$user_id=M('User')->where("`token_id`='$token_id'")->getField('user_id');
			$user_group_type=$this->getUserGroup($user_id);
			$user_privilege=M('UserGroupPrivileges')->where("`ug_type`=$user_group_type")->field("`ugp_name`")->select();
			if($user_privilege=='0'){
				return 'all';
			}else{
				return $user_privilege;	
			}
		}
	}

	public function removeUser(){
		$user_id=I($this->requestMethod."user_id");
		$token_id=I($this->requestMethod."token_id");
		if($this->isInfoNull(array($user_id,$token_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserAdmin($user_group_type) || $this->isUserRoot($user_group_type)){
				$dResult=M('User')->where("`user_id`='$user_id' AND `token_id`=$token_id")->delete();
				if($dResult){
					$this->ajaxReturn(getServerResponse('1','删除成功',''));
				}else{
					$this->ajaxReturn(getServerResponse('0','删除失败或没有权限',''));
				}
			}else{
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}
		}
	}

	protected function updateUserFile(){
		$user_nickname=I($this->requestMethod."user_nickname");
		$user_description=I($this->requestMethod."user_description");
		$user_photo=I($this->requestMethod."user_photo");
		$user_sex=I($this->requestMethod."user_sex");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($user_nickname,$user_description,$user_photo,$user_sex,$user_id)) || !is_numeric($user_id)){
			$this->ajaxReturn(getServerResponse('0','数据不能为空或有误',''));
		}else{
			$updateFile['user_nickname']=$user_nickname;
			$updateFile['user_description']=$user_description;
			$updateFile['user_photo']=$user_photo;
			$updateFile['user_sex']=$user_sex;
			$result=D('User')->where("`user_id`=%s",array($user_id))->data($updateFile)->save();	
			if($result!==null){
				$this->ajaxReturn(getServerResponse('1','更新成功',''));
			}else{
				$this->ajaxReturn(getServerResponse('0','更新失败',''));
			}
		}
	}

	public function updatePassword(){
		$user_id=I($this->requestMethod."user_id");
		$old_password=sha1(I($this->requestMethod."old_password"));
		$new_password=sha1(I($this->requestMethod."new_password"));
		if(isInfoNull($user_id,$old_password,$new_password)){
			$this->ajaxReturn(getServerResponse('0','数据不能为空或有误',''));
		}else{
			$newPassword['user_password']=$new_password;
			$updateResult=D('User')->where("`user_password`='$old_password' AND `user_id`=$user_id")->data($newPassword)->save();
			if($updateResult){
				$this->ajaxReturn(getServerResponse('1','更新成功',''));
			}else{
				$this->ajaxReturn(getServerResponse('0','更新失败',''));
			}
		}
	}

	protected function forgotPassword(){
		$user_email=I($this->requestMethod."user_email");
		if(isInfoNull($user_email)){
			$this->ajaxReturn(getServerResponse('0','数据不能为空或有误',''));
		}else{
			if($this->isEmailExists($user_email)){
				//发送邮件
			}else{
				$this->ajaxReturn(getServerResponse('0','用户不存在',''));
			}
		}
	}

}

?>