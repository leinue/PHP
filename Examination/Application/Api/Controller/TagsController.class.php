<?php

namespace Api\Controller;
use Think\Controller;
use Application\Common\common;
use Api\Controller\UserController;

class TagsController extends UserController {

	public function create(){
		$post_id=I($this->requestMethod."post_id");
		$tag_content=I($this->requestMethod."tag_content");
		$user_id=I($this->requestMethod."user_id");//这里应该通过post_id获得user_id,然后对比token_id和user_id是否相等,如果相等则证明是本人
		$token_id=I($this->requestMethod."token_id");
		if(isInfoNull(array($post_id,$tag_content,$user_id,$token_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if($this->isUserRootOrAdmin($user_group_type) || $this->isUserSelf($user_id,$token_id)){
				$tagList['post_id']=$post_id;
				$tagList['tag_content']=$tag_content;
				$aTags=M('Tags');
				$aResult=$aTags->create($tagList);
				if($aResult){
					$aResult=$aTags->add();
					print_r($aResult);
				}else{
					$this->ajaxReturn(getServerResponse('0',$aTags->getError(),''));
				}
			}else{
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}
		}
	}

	public function getAll(){
		$page=I($this->requestMethod."page",1);
		$limit=I($this->requestMethod."limit",10);
		$allUser=D('Tags');
		$start=10*$page-9;
		$end=10*$page+1;
		$userlist=$allUser->page($start,$end)->select();
		print_r($userlist);
		if($userlist){
			$this->ajaxReturn(getServerResponse('0','读取成功',$userlist));
		}else{
			$this->ajaxReturn(getServerResponse('0',"读取失败",''));
		}
	}

	public function update(){
		$tag_id=I($this->requestMethod."tag_id");
		$tag_content=I($this->requestMethod."tag_content");
		//$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($tag_id,$tag_content))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			/*$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{*/
				$upToUser['tag_content']=$tag_content;
				D('Tags')->where("`tag_id`=%s",array($tag_id))->data($upToUser)->save();
				$this->ajaxReturn(getServerResponse('1','更新成功',''));
			//}
		}
	}

	public function get(){
		$post_id=I($this->requestMethod."post_id");
		$tag_id=I($this->requestMethod."tag_id");
		if(isInfoNull(array($post_id,$tag_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$rOption=M('Tags');
			$result=$rOption->where("`post_id`=$post_id OR `tag_id`=$tag_id")->find();
			if($result){
				$this->ajaxReturn(getServerResponse('1','读取成功',$result));
			}else{
				$this->ajaxReturn(getServerResponse('0','读取失败',''));
			}
		}
	}

	public function remove(){
		$tag_id=I($this->requestMethod."tag_id");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($tag_id,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Tags');
				$result=$rOption->where("`tag_id`=$tag_id")->delete();
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
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Tags');
				$result=$rOption->where('1')->delete();
				if($result){
					$this->ajaxReturn(getServerResponse('1','删除成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','删除失败',''));
				}
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
