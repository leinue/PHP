<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\UserController;

class PostsController extends Controller {

	public function index(){
		$this->redirect('/Home/',5,'页面跳转中....');
	}

	//返回文章guid,author为私有guid
	public function newpost($author='',$title='',$content='',$posttype='article'){
		$ajaxData=array();
		if($this->isInfoNull(array($author,$title,$content,$posttype))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			if($this->getAvailableByGuid($author)==='1'){
				$postData['post_author']=$author;
				$postData['post_title']=$title;
				$postData['post_content']=$content;
				$postData['post_type']=$posttype;
				$postData['post_modified']=date('y-m-d h:i:s',time());
				$postData['post_guid']=$this->guid();
				$wPost=M('Posts');
				$data=$wPost->create($postData);
				if($data){
					$result=$wPost->add();
					if($result){
						$ajaxData['status']='1';
						$ajaxData['msg']='发表成功';
						$ajaxData['data']['post_guid']=$postData['post_guid'];
						$this->ajaxReturn($ajaxData);
					}else{
						$ajaxData['status']='0';
						$ajaxData['msg']='发表失败';
						$this->ajaxReturn($ajaxData);
					}
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='发表失败';
					$this->ajaxReturn($ajaxData);
				}
			}else{
				
			}
		}
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
	public function updatePost($guid='',$title='',$content='',$oid=''){
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

	public function deletePost($guid='',$oid=''){
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

	public function getAll($page,$limit){

	}
}
