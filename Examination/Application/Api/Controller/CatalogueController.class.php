<?php

namespace Api\Controller;
use Think\Controller;
use Application\Common\common;
use Api\Controller\UserController;

class CatalogueController extends UserController {

	public function create(){
		$cata_title=I($this->requestMethod."title");
		$cata_description=I($this->requestMethod."description");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($cata_title,$cata_description,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserAdmin($user_group_type) || $this->isUserRoot($user_group_type)){
				$wOption=M('Catalogue');
				$wOptionData['ca_title']=$cata_title;
				$wOptionData['ca_description']=$cata_description;
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

	public function update(){
		$cata_title=I($this->requestMethod."title");
		$cata_description=I($this->requestMethod."description");
		$user_id=I($this->requestMethod."user_id");
		$cata_id=I($this->requestMethod."cata_id");
		if(isInfoNull(array($cata_title,$cata_description,$user_id,$cata_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$upToUser['ca_title']=$cata_title;
				$upToUser['ca_description']=$cata_description;
				D('Catalogue')->where("`ca_id`=%s",array($cata_id))->data($upToUser)->save();
				$this->ajaxReturn(getServerResponse('1','更新成功',''));
			}
		}
	}

	public function get(){
		$cata_id=I($this->requestMethod."cata_id");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($cata_id,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Catalogue');
				$result=$rOption->where("`ca_id`=$cata_id")->find();
				if($result){
					$this->ajaxReturn(getServerResponse('1','读取成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','读取失败',''));
				}
			}
		}
	}

	public function remove(){
		$cata_id=I($this->requestMethod."cata_id");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($cata_id,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Catalogue');
				$result=$rOption->where("`ca_id`=$cata_id")->delete();
				if($result){
					$this->ajaxReturn(getServerResponse('1','删除成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','删除失败',''));
				}
			}
		}
	}

	public function removeAll(){
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			;if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Catalogue');
				$result=$rOption->where('1')->delete();
				if($result){
					$this->ajaxReturn(getServerResponse('1','删除成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','删除失败',''));
				}
			}
		}
	}	

	public function getAll(){
		$page=I($this->requestMethod."page",1);
		$limit=I($this->requestMethod."limit",10);
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($user_id,$page,$limit))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Catalogue');
				$result=$rOption->page($page,$limit)->select();
				if($result){
					$this->ajaxReturn(getServerResponse('1','读取成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','读取失败',''));
				}
			}
		}
	}
}