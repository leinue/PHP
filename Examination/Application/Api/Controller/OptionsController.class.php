<?php

namespace Api\Controller;
use Think\Controller;
use Api\Controller\UserController;

class OptionsController extends UserController {

	public function index(){
		$this->redirect('/Home/',5,'页面跳转中....');
	}

	public function getAll(){
		$user_id=I($this->requestMethod."user_id");
		if(!isInfoNull($user_id)){
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserAdmin($user_group_type) || $this->isUserRoot($user_group_type)){
				$optionsList=M('Options');
				if($result=$optionsList->getField('`option_name`,`option_value`')){
					$this->ajaxReturn(getServerResponse('1','读取成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','读取失败或数据为空',$result));
				}	
			}else{
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}
		}else{
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}
	}

	public function writeOption(){
		$oname=I($this->requestMethod."oname");
		$ovalue=I($this->requestMethod."ovalue");
		$user_id=I($This->requestMethod."user_id");
		if(isInfoNull(array($oname,$ovalue,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserAdmin($user_group_type) || $this->isUserRoot($user_group_type)){
				$wOption=M('Options');
				$wOptionData['option_name']=$oname;
				$wOptionData['option_value']=$ovalue;
				$data=$wOption->create($wOptionData);
				if(!$data){
					$this->ajaxReturn(getServerResponse('0',$wOption->getError(),''));
				}else{
					$result=$wOption->add();
					if($result){
						$this->ajaxReturn(getServerResponse('1','添加成功',''));
					}else{
						$this->ajaxReturn(getServerResponse('0','添加失败',''));
					}
				}
			}else{
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}
		}
	}

	public function getOption(){
		$oname=I($this->requestMethod."oname");
		$user_id=I($This->requestMethod."user_id");
		if(isInfoNull(array($oname,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Options');
				$result=$rOption->where("`option_name`='$oname'")->getField('`option_value`');
				if($result){
					$this->ajaxReturn(getServerResponse('1','读取成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','读取失败',''));
				}
			}
		}
	}

	public function update(){
		$oname=I($this->requestMethod."oname");
		$ovalue=I($this->requestMethod."ovalue");
		$user_id=I($This->requestMethod."user_id");
		if(isInfoNull(array($oname,$ovalue,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$upToUser['option_value']=$ovalue;
				D('Options')->where("`option_name`='%s'",array($oname))->data($upToUser)->save();
				$this->ajaxReturn(getServerResponse('1','更新成功',''));
			}
		}
	}
}

?>