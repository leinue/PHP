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
		if($this->isInfoNull(array($email,$password))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
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
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getAllUser($page=1,$limit=10){
		if($this->isInfoNull($limit)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
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

	protected function getPrivilegeByGuid($pguid=''){

	}

	protected function isUserCanDo($operateName=''){

	}

	public function removeUser($guid='',$operatorId=''){

		if($this->isInfoNull($id)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{

		}
	}

	public function lockUser($guid='',$operatorId=''){
		if(!$this->isInfoNull($guid)){
			$lUser = M('User');
			$dataAvailable['available']='0';
			$result=$lUser->where("`guid`='$guid'")->data($dataAvailable)->save();
			if($result!==null){
				$ajaxData['status']='1';
				$ajaxData['msg']='封禁成功';
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='封禁失败';
				$this->ajaxReturn($ajaxData);
			}
		}else{
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}
	}

	public function deblockUser($guid='',$operatorId=''){
		if(!$this->isInfoNull($guid)){
			$lUser = M('User');
			$dataAvailable['available']='1';
			$result=$lUser->where("`guid`='$guid'")->data($dataAvailable)->save();
			if($result!==null){
				$ajaxData['status']='1';
				$ajaxData['msg']='封禁成功';
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='封禁失败';
				$this->ajaxReturn($ajaxData);
			}
		}else{
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}
	}

}

?>