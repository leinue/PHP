<?php

namespace Api\Controller;
use Think\Controller;
use Api\Controller\UserController;

class OptionsController extends UserController {

	public function index(){
		$this->redirect('/Home/',5,'页面跳转中....');
	}

	public function getAll(){
		$optionsList=M('Options');
		if($result=$optionsList->getField('options_name,options_value')){
			$ajaxData['status']='1';
			$ajaxData['msg']='读取成功';
			$ajaxData['data']=$result;
			$this->ajaxReturn($ajaxData);
		}else{
			$ajaxData['status']='0';
			$ajaxData['msg']='读取失败';
			$ajaxData['data']=$result;
			$this->ajaxReturn($ajaxData);
		}
	}

	public function writeRule($rulename='',$rulevalue='',$pguid=''){
		$ajaxData=array();
		if($this->isInfoNull(array($rulename,$rulevalue,$pguid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			if($this->getPrivilegeByGuid($pguid)==='0'){
				$wOption=M('Options');
				$wOptionData['options_name']=$rulename;
				$wOptionData['options_value']=$rulevalue;
				$data=$wOption->create($wOptionData);
				if(!$data){
					$ajaxData['status']='0';
					$ajaxData['msg']=$wOption->getError();
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}else{
					$result=$wOption->add();
					$ajaxData['data']=$result;
					if($result){
						$ajaxData['status']='1';
						$ajaxData['msg']='加入成功';
						$ajaxData['data']='';
						$this->ajaxReturn($ajaxData);
					}else{
						$ajaxData['status']='0';
						$ajaxData['msg']='加入失败';
						$ajaxData['data']='';
						$this->ajaxReturn($ajaxData);
					}
				}
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='没有权限';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function getRule($rulename='',$oid=''){
		if($this->isInfoNull(array($rulename,$oid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			if(!$this->getPrivilegeByGuid($oid)==='0'){
				$ajaxData['status']='0';
				$ajaxData['msg']='没有权限';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}else{
				$rOption=M('Options');
				$result=$rOption->where("`options_name`='$rulename'")->getField('`options_value`');
				if($result){
					$ajaxData['status']='1';
					$ajaxData['msg']='读取成功';
					$ajaxData['data']=$result;
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='读取失败';
					$ajaxData['data']='';
					$this->ajaxReturn($ajaxData);
				}
			}
		}
	}
}

?>