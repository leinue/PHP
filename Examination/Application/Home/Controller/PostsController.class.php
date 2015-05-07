<?php
namespace Home\Controller;
use Think\Controller;

class PostsController extends Controller {

	public function index(){
		$this->redirect('/Home/',5,'页面跳转中....');
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

	//返回文章guid
	public function newpost($author='',$title='',$content='',$posttype='article'){
		$ajaxData=array();
		if(!$this->isInfoNull()){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
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
		}
	}

	//通过id获取文章
	public function getPostByGuid($guid=''){
		$ajaxData=array();
		if(!$this->isInfoNull()){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$rPost=M('Posts');
			$postData=$rPost->where("`post_guid` = '$guid'")->find();
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

}
