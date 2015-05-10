<?php

namespace Api\Controller;
use Think\Controller;
use Application\Common\common;
use Api\Controller\UserController;

class PublicationController extends UserController {

	public function newPublication($author='',$title='',$describe='',$src=''){
		if($this->isInfoNull(array($author,$title,$describe,$src))){

		}else{

		}
	}

	public getAll($page=1,$limit=10){
		if($this->isInfoNull($limit)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$allUser=D('Publication');
			$start=10*$page-9;
			$end=10*$page+1;
			$userlist=$allUser->where("`id` BETWEEN $start AND $end")->order('`p_created_time`')->limit($limit)->select();
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

	public function getPublicationByGuid($epid=''){
		if($this->isInfoNull($epid)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$rPost=M('Publication');
			$postData=$rPost->where("`epid` = '$epid'")->find();
			$rPost->where('`epid`='+$epid)->setInc('p_view',1,30);
			if($postData){
				$ajaxData['status']='1';
				$ajaxData['msg']='读取成功';
				$ajaxData['data']=$postData;
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='读取失败';
				$this->ajaxReturn($ajaxData);
			}
		}
	}

	public function updatePublication($epid,$author='',$title='',$describe='',$src='',$tags='',$type='',$epcid=""){
		if($this->isInfoNull(array($epid,$author,$title,$describe,$src,$oid,$tags,$type,$epcid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$uPost=M('Publication');
			$data['p_title'] = $title;
			$data['p_describe'] = $describe;
			$data['p_src']=$src;
			$data['p_tags']=$tags;
			$data['p_type']=$type;
			$data['epcid']=$epcid;
			$result=$uPost->where("`epid`='$epid' AND `p_author`='$author'")->data($data)->save();
			if($result){
				$ajaxData['status']='1';
				$ajaxData['msg']='更新成功';
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='内容未变或更新失败或无权限';
				$this->ajaxReturn($ajaxData);
			}
		}	
	}

	public function deltePublication($epid='',$oid=''){
		if($this->isInfoNull(array($epid,$oid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$dPost=M('Publication');
			$result=$dPost->where("`epid`='$epid' AND `p_author`='$oid'")->delete();
			if($result){
				$ajaxData['status']='1';
				$ajaxData['msg']='删除成功';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}else{
				$ajaxData['status']='0';
				$ajaxData['msg']='删除失败或无权限';
				$ajaxData['data']='';
				$this->ajaxReturn($ajaxData);
			}
		}
	}
}