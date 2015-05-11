<?php

namespace Api\Controller;
use Think\Controller;
use Api\Controller\UserController;
use Api\Controller\TagsController;

class PostsController extends UserController {

	public function create(){
		$user_id=I($this->requestMethod."user_id");
		$post_title=I($this->requestMethod."post_title");
		$post_content=I($this->requestMethod."post_content");
		$post_catalogue=I($this->requestMethod."post_catalogue");
		$post_type=I($this->requestMethod."post_type");
		$post_src=I($this->requestMethod."post_src");
		$post_tags_count=I($this->requestMethod."tags_count");
		if(isInfoNull(array($user_id,$post_type,$post_title,$post_catalogue,$post_tags_count))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			if(($post_type=='img' || $post_type=='media') && isInfoNull($post_src)){
				$this->ajaxReturn(getServerResponse('0','POST_SRC不能为空'));
			}
			$currentTime=date('y-m-d h:i:s',time());
			$postData['user_id']=$user_id;
			$postData['post_title']=$title;
			$postData['post_content']=$content;
			$postData['post_type']=$post_type;
			$postData['post_modified']=$currentTime;
			$postData['post_date']=$currentTime;
			$postData['post_tags_count']=$post_tags_count;
			$postData['post_catalogue']=$post_catalogue;
			$postData['post_src']=$post_src;
			$wPost=M('Posts');
			$data=$wPost->create($postData);
			if($data){
				$result=$wPost->add();
				if($result){
					$this->ajaxReturn(getServerResponse('1','发表成功',$result));
				}else{+
					$this->ajaxReturn(getServerResponse('0','发表失败',''));
				}
			}else{
				$this->ajaxReturn(getServerResponse('0','发表失败',''));
			}
		}
	}

	public function getByUserId(){
		$user_id=I($this->requestMethod."user_id");
		$page=I($this->requestMethod."page");
		$limit=I($this->requestMethod."limit");
		if(isInfoNull($user_id)){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$rPost=M('Posts');
			$postData=$rPost->page($page,$limit)->where("`user_id`=$user_id")->select();
		}
	}

	public function getByPostId(){
		$post_id=I($this->requestMethod."post_id");
		if(isInfoNull($post_id)){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$rPost=M('Posts');
			$postData=$rPost->where("`post_id`=$post_id")->find();
			$rPost->where("`post_id`=$post_id")->setInc("`post_view`",1,30);
			if($post_date){
				$this->ajaxReturn(getServerResponse('1','读取成功',$postData));
			}else{
				$this->ajaxReturn(getServerResponse('0','读取失败',''));
			}
		}
	}

	public function getAll(){
		$page=I($this->requestMethod."page",1);
		$limit=I($this->requestMethod."limit",10);
		$allUser=D('Posts');
		$userlist=$allUser->page($page,$limit)->select();
		if($userlist){
			$this->ajaxReturn(getServerResponse('0','读取成功',$userlist));
		}else{
			$this->ajaxReturn(getServerResponse('0',"读取失败",''));
		}
	}

	public function remove(){
		$post_id=I($this->requestMethod."post_id");
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($post_id,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$dPost=M('Posts');
			$result=$dPost->where("`user_id`=$user_id AND `post_id`=$post_id")->delete();
			if($result){
				$this->ajaxReturn(getServerResponse('1','删除成功',$result));
			}else{
				$this->ajaxReturn(getServerResponse('0',"删除失败",''));
			}
		}
	}

	public function removeAll(){
		$user_id=I($this->requestMethod."user_id");
		if(isInfoNull(array($post_id,$user_id))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			$user_group_type=$this->getUserGroup($user_id);
			if(!$this->isUserRootOrAdmin($user_group_type)){
				$this->ajaxReturn(getServerResponse('0','没有权限',''));
			}else{
				$rOption=M('Posts');
				$result=$rOption->where('1')->delete();
				if($result){
					$this->ajaxReturn(getServerResponse('1','删除成功',$result));
				}else{
					$this->ajaxReturn(getServerResponse('0','删除失败',''));
				}
			}
		}
	}

	public function update(){
		$post_id=I($this->requestMethod."post_id");
		$user_id=I($this->requestMethod."user_id");
		$post_title=I($this->requestMethod."post_title");
		$post_content=I($this->requestMethod."post_content");
		$post_catalogue=I($this->requestMethod."post_catalogue");
		$post_type=I($this->requestMethod."post_type");
		$post_src=I($this->requestMethod."post_src");
		$post_tags_count=I($this->requestMethod."tags_count");
		if(isInfoNull(array($user_id,$post_id,$post_type,$post_title,$post_catalogue,$post_tags_count))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
			if(($post_type=='img' || $post_type=='media') && isInfoNull($post_src)){
				$this->ajaxReturn(getServerResponse('0','POST_SRC不能为空'));
			}
			$currentTime=date('y-m-d h:i:s',time());
			$postData['post_title']=$title;
			$postData['post_content']=$content;
			$postData['post_type']=$post_type;
			$postData['post_modified']=$currentTime;
			$postData['post_tags_count']=$post_tags_count;
			$postData['post_catalogue']=$post_catalogue;
			$postData['post_src']=$post_src;
			$wPost=M('Posts');
			$result=$uPost->where("`post_id`=$post_id AND `user_id`=$user_id")->data($postData)->save();
			if($result){
				$this->ajaxReturn(getServerResponse('1','修改成功',$result));
			}else{+
				$this->ajaxReturn(getServerResponse('0','修改失败',''));
			}
		}
	}

}
