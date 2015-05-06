<?php
namespace Home\Controller;
use Think\Controller;
class OptionsController extends Controller {

	protected function isInfoNull($info){
		if(is_array($info)){
			foreach($info as $key => $value){if($value==null){return true;}}
		}else{return $info==null;}
	}

	public function getAll(){
		$optionsList=M('options');
		$this->ajaxReturn($optionsList->getField('options_name,options_value'));
	}

	public function writeRule($rulename='',$rulevalue=''){
		$ajaxData=array();
		if($this->isInfoNull(array($rulename,$rulevalue))){
			$ajaxData['status']='0';
			$ajaxData['msg']='数据不能为空';
			$this->ajaxReturn($ajaxData);
		}else{
			$wOption=M('options');
			$wOptionData['options_name']=$rulename;
			$wOptionData['options_value']=$rulevalue;
			$data=$wOption->create($wOptionData);
			if(!$data){
				$ajaxData['status']='0';
				$ajaxData['msg']=$wOption->getError();
				$this->ajaxReturn($ajaxData);
			}else{
				$result=$wOption->add();
				$ajaxData['data']=$result;
				if($result){
					$ajaxData['status']='1';
					$ajaxData['msg']='加入成功';
					$this->ajaxReturn($ajaxData);
				}else{
					$ajaxData['status']='0';
					$ajaxData['msg']='加入失败';
					$this->ajaxReturn($wOption->getError());
				}
			}
		}
	}
}

?>