<?php

/**
*
*
*/

function C($key=null,$value=null){
	
	if($key==null){
		return false;
	}

	$c=new Cores\AccessConfig(BASEDIR.'/Cores/configs');

	if($value==null){
		return $c->offsetGet($key);
	}else{
		$c->offsetSet($key,$value);
	}
}
	

//创建数据库,根据当前配置文件中的数据库类型生成数据库对象
function D($table=null){	
	$dbconfig=C('dbconfig');
	return Cores\Databases::CreateDatabase($dbconfig,$table);
}

//创建模型
function M($modelName){

}

function hump($str){
	$result='';

	if(stripos($str,'_')){
		$str_array=explode("_",$str);
		foreach ($str_array as $key => $value) {
			$result.=ucfirst($value);
		}
	}else{
		$result=ucfirst($str);
	}

	return $result;
}

function guid($namespace = '') {    
    static $guid = '';
    $uid = uniqid("", true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid =	substr($hash,  0,  8) .
            '-' .
            substr($hash,  8,  4) .
            '-' .
            substr($hash, 12,  4) .
            '-' .
            substr($hash, 16,  4) .
            '-' .
            substr($hash, 20, 12) ;
    return $guid;
}

function alert($content){
	echo "<script>alert('$content');</script>";
}

function debug($content){
	echo "<script>console.log('$content')</script>";
}

function redirectTo($url){
	echo "<script>window.location.href='$url';</script>";
}

function success($text){
	return '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$text.'</div>';
}

function warning($text){
	return '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$text.'</div>';
}

function dangerConfirm($text){
	return '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">'.$text.'</span>
</button>';
}

function confirm($tips,$request,$btnValue){
	return $tips=warning($tips.'
        <p><a href="'.$request.'" class="btn btn-danger">'.$btnValue.'</a></p>');
}

function modal($title,$content){
	return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">'.$title.'</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      '.$content.'
    </div>
  </div>
</div>';
}

function generatorCommentsEditingForm($comments,$request=null){
    return '<div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        修改
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control">'.$comments.'</textarea>
                        <div style="padding-top:10px;" class="text-right">
                            <a ref="'.$request.'" id="modify_comments_content" onclick="editCommentsContent(this)" class="btn btn-sm btn-primary">确定</a>
                        </div>
                    </div>
                </div>
            </div>';
}

function generatorCommentsViewingForm($comments,$time,$ref='#',$request=null,$rid=null){
    return '<div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        查看
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                          <a href="'.$ref.'" class="list-group-item">
                            <h4 class="list-group-item-heading">发布于 : '.$time.'</h4>
                            <p class="list-group-item-text">正文 : <p></p>'.$comments.'</p>
                          </a>
                        </div>
                        <div class="text-right">
                            <a href="admin.php?v='.$_GET['v'].'&action=edit_comments&rid='.$rid.'" class="btn btn-primary btn-sm">修改</a>
                        </div>
                    </div>
                </div>
            </div>';
}

function objectToArray($obj){
    $arr = is_object($obj) ? get_object_vars($obj) : $obj;
    if(is_array($arr)){
        return array_map(__FUNCTION__, $arr);
    }else{
        return $arr;
    }
}

function arrayToObject($arr){
    if(is_array($arr)){
        return (object) array_map(__FUNCTION__, $arr);
    }else{
        return $arr;
    }
}

function cutOutStr($str,$count=20){
	$s=mb_substr($str , 0 , $count);
	return strlen($str)>20?$s.'[...]':$s;
}

function tips($tips){
    return $tips==null?'':'<p class="help-block">'.$tips.'</p>';
}

function input($name,$name_control,$id,$tips=null,$value=null){
    $tips=tips($tips);
    return '<div class="form-group">
                <label>'.$name.'</label>
                <input placeholder="'.$name.'" value="'.$value.'" name="'.$name_control.'" class="form-control">
                '.$tips.'
            </div>';
}

function img_($name,$name_control,$id,$tips=null,$value=null){
    $tips=tips($tips);
    return '<div class="form-group">
                <label>'.$name.'</label>
                <input id="'.$id.'" name="'.$name_control.'" value="'.$value.'" type="file">
                '.$tips.'
            </div>';
}

function textarea($name,$name_control,$id,$tips,$value=null){
    $tips=tips($tips);
    return '<div class="form-group">
                <label>'.$name.'</label>
                <textarea class="form-control" placeholder='.$name.' id="'.$id.'" name="'.$name_control.'" value="'.$value.'"></textarea>
                '.$tips.'
            </div>';
}

function selector($name,$name_control,$id,$tips,$selectorCount,$value=""){
    $tips=tips($tips);
    return '<div class="form-group">
                <label>'.$name.'</label>
                <select class="form-control" placeholder='.$name.' id="'.$id.'" name="'.$name_control.'"">'.$selectorCount.'</select>
                '.$tips.'
            </div>';
}

function range_($name,$name_control,$id,$tips,$from,$to,$rangeUnit,$value=""){
    $tips=tips($tips);
    return '<div class="form-group">
                <label>'.$name.' ( '.$rangeUnit.' )</label>
                <input class="form-control" type="number" placeholder="from" id="'.$id.'" name="from_'.$name_control.'"">
                <label></label>
                <input class="form-control" type="number" placeholder="to" id="'.$id.'" name="to_'.$name_control.'"">
                '.$tips.'
            </div>';
}

function generatorItemAddingForm($fieldList,$suffix='_add',$action=null){
    if(is_array($fieldList)){
        echo '<div class="col-md-6"><form role="form" method="post" action="'.$action.'&count='.count($fieldList).'">';
        $cataOption='';
        $cataObj=new Cores\Models\CataModel();
        $cataList=$cataObj->selectAll();
        $secondList=$cataObj->getSecond();
        if(is_array($cataList)){
            foreach ($cataList as $key => $value) {
                if($value->getParent()==='0'){
                    $cataOption.='<option value="'.$value->getCaid().'">'.$value->getName().'</option>';
                }
            }
        }
        echo '<div class="form-group">
                <label>项目类别*</label>
                <select name="item_cata'.$suffix.'" class="form-control">
                    '.$cataOption.'
                </select>
            </div>';
        if(is_array($secondList)){
			foreach ($secondList as $key => $value) {
				$list='';
				$rdList=$cataObj->getCataChild($value['caid']);
				if(is_array($rdList)){
					foreach ($rdList as $childKey => $childValue) {
						if($childValue['child']!='second'){
							$list.='<option "'.$childValue['caid'].'"> '.$childValue['name'].'</option>';
						}
					}
				}
				echo '<div class="form-group">
		                <label>'.$value['name'].'*</label>
		                <select name="item_'.$value['name'].'_cata'.$suffix.'" class="form-control">
		                    '.$list.'
		                </select>
		            </div>';
			}
		}
        echo '<div class="form-group">
                <label>项目主题</label>
                <input placeholder="项目主题" value="" name="item_theme'.$suffix.'" class="form-control">
            </div>';
        foreach ($fieldList as $key => $value) {
            $type=$value->getType();
            $id='item_'.$value->getName().$suffix;
            $name=$id;
            switch ($type) {
                case 'input':
                     echo input($value->getName(),$name,$id,$value->getTips());
                    break;
                case 'img':
                    echo img_($value->getName(),$name,$id,$value->getTips());
                case 'selector':
                    if($type=='selector'){
                        echo selector($value->getName(),$name,$id,$value->getTips(),$value->getSelectorCount());
                    }
                case 'range_':
                    if($type=='range_'){
                        echo range_($value->getName(),$name,$id,$value->getTips(),$value->getRangeFrom(),$value->getRangeTo(),$value->getRangeUnit());
                    }
                case 'textarea':
                    if($type=='textarea'){
                        echo textarea($value->getName(),$name,$id,$value->getTips());
                    }
                default:
                    break;
            }
        }
        echo '<button type="submit" class="btn btn-default">提交</button></form></div>';
    }
    
}
