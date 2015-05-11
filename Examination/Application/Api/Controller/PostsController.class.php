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
		if(isInfoNull(array($user_id,$post_type,$post_title,$post_catalogue,$post_tags_count,$post_src))){
			$this->ajaxReturn(getServerResponse('0','数据不能为空',''));
		}else{
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
			if($post_date){
				$this->ajaxReturn(getServerResponse('1','读取成功',$postData));
			}else{
				$this->ajaxReturn(getServerResponse('0','读取失败',''));
			}
		}
	}

	public function getAll(){

	}

	public function remove(){

	}

	public function removeAll(){

	}

	public function update(){

	}

	//通过id获取文章
	public function getPostByGuid($guid=''){
		if($this->isInfoNull($guid)){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$rPost=M('Posts');
			$postData=$rPost->where("`post_guid` = '$guid'")->find();
			$rPost->where('`guid`='+$guid)->setInc('post_view',1,30);
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

	//oid为私有guid
	public function update($guid='',$title='',$content='',$oid=''){
		$ajaxData=array();
		if($this->isInfoNull(array($guid,$title,$content,$oid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$uPost=M('Posts');
			$data['post_title'] = $title;
			$data['post_content'] = $content;
			$result=$uPost->where("`post_guid`='$guid' AND `post_author`='$oid'")->data($data)->save();
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

	public function remove($guid='',$oid=''){
		$ajaxData=array();
		if($this->isInfoNull(array($guid,$oid))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$ajaxData['data']='';
			$this->ajaxReturn($ajaxData);
		}else{
			$dPost=M('Posts');
			$result=$dPost->where("`post_guid`='$guid' AND `post_author`='$oid'")->delete();
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
