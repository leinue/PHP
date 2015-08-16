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

function in_array_i($x,$arr){
	if (!is_array ($arr)){
	        return false;
	}
    foreach ($arr as $key => $val ){
        if (is_array ($val)){
            in_array_i($x,$val);
        }
        else{
            return $x==$val;
        }
    }
}

$uptypes=array(  
        'image/jpg',  
        'image/jpeg',  
        'image/png',  
        'image/pjpeg',  
        'image/gif',  
        'image/bmp',  
        'image/x-png'  
    );

function loadImageUploader($image_src_name_control,$image=null,$uid=null,$basedir='Cores/'){
	$image=$image==null?DOMAIN.'/Cores/default.png':$image;
	return '  <script type="text/javascript">
   function uploadevent(status,picUrl,callbackdata){
      status += "";
      switch(status){
        case "1":
          var time = new Date().getTime();
          var filename162 = picUrl+"_162.jpg";
          var filename48 = picUrl+"_48.jpg";
          var filename20 = picUrl+"_20.jpg";
          console.log($("#'.$image_src_name_control.'"));
          $("#'.$image_src_name_control.'").val(filename162);
       break;
        case "-1":
          window.location.reload();
        break;
        default:
         window.location.reload();
         break;
      }
   }
  </script>
  <div class="form-group">
    <label></label>
    <input style="display:none;" value="'.$image.'" id="'.$image_src_name_control.'" name="'.$image_src_name_control.'" class="form-control">
  </div>
  <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
  WIDTH="650" HEIGHT="450" id="myMovieName">
  <PARAM NAME=movie VALUE="avatar.swf">
  <PARAM NAME=quality VALUE=high>
  <PARAM NAME=bgcolor VALUE=#FFFFFF>
  <param name="flashvars" value="imgUrl='.$image.'&uploadUrl='.$basedir.'/upfile.php?uid='.$uid.'&uploadSrc=false" />
  <EMBED src="'.$basedir.'/avatar.swf" quality=high bgcolor=#FFFFFF WIDTH="650" HEIGHT="450" wmode="transparent" flashVars="imgUrl='.$image.'&uploadUrl='.$basedir.'/upfile.php'.$uid.'&uploadSrc=false"
  NAME="myMovieName" ALIGN="" TYPE="application/x-shockwave-flash" allowScriptAccess="always"
  PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
  </EMBED>
  </OBJECT>';
}

function uploadImages($filenameControl){

	alert($filenameControl);

	//上传文件类型列表  
    $uptypes=array(  
        'image/jpg',  
        'image/jpeg',  
        'image/png',  
        'image/pjpeg',  
        'image/gif',  
        'image/bmp',  
        'image/x-png'  
    );  
      
    $max_file_size=2000000;     //上传文件大小限制, 单位BYTE  
    $destination_folder="Commons/uploads/"; //上传文件路径  
    $watermark=1;      //是否附加水印(1为加水印,其他为不加水印);  
    $watertype=1;      //水印类型(1为文字,2为图片)  
    $waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
    $waterstring="http://www.ivydom.com/";  //水印字符串  
    $waterimg="xplore.gif";    //水印图片  
    $imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);  
    $imgpreviewsize=1/2;    //缩略图比例

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  
    {  
        if (!is_uploaded_file($_FILES[$filenameControl][tmp_name]))  
        //是否存在文件  
        {  
             return "图片不存在!";  
        }  
      
        $file = $_FILES[$filenameControl];  
        if($max_file_size < $file["size"])  
        //检查文件大小  
        {  
            return "文件太大!";  
        }  
      
        if(!in_array($file["type"], $uptypes))  
        //检查文件类型  
        {  
            return "文件类型不符!".$file["type"];  
        }  
      
        if(!file_exists($destination_folder))  
        {  
            mkdir($destination_folder);  
        }  
      
        $filename=$file["tmp_name"];  
        $image_size = getimagesize($filename);  
        $pinfo=pathinfo($file["name"]);  
        $ftype=$pinfo['extension'];  
        $destination = $destination_folder.time().".".$ftype;  
        if (file_exists($destination) && $overwrite != true)  
        {  
            return "同名文件已经存在了";
        }
      
        if(!move_uploaded_file ($filename, $destination))  
        {  
            return "移动文件出错";
        }  
      
        $pinfo=pathinfo($destination);  
        $fname=$pinfo[basename];  
        // echo " <font color=red>已经成功上传</font><br>文件名:  <font color=blue>".$destination_folder.$fname."</font><br>";  
        // echo " 宽度:".$image_size[0];  
        // echo " 长度:".$image_size[1];  
        // echo "<br> 大小:".$file["size"]." bytes";  
      
        if($watermark==1)  
        {  
            $iinfo=getimagesize($destination,$iinfo);  
            $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
            $white=imagecolorallocate($nimage,255,255,255);  
            $black=imagecolorallocate($nimage,0,0,0);  
            $red=imagecolorallocate($nimage,255,0,0);  
            imagefill($nimage,0,0,$white);  
            switch ($iinfo[2])  
            {  
                case 1:  
                $simage =imagecreatefromgif($destination);  
                break;  
                case 2:  
                $simage =imagecreatefromjpeg($destination);  
                break;  
                case 3:  
                $simage =imagecreatefrompng($destination);  
                break;  
                case 6:  
                $simage =imagecreatefromwbmp($destination);  
                break;  
                default:  
                return "不支持的文件类型";
            }  
      
            imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
            imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
      
            switch($watertype)  
            {  
                case 1:   //加水印字符串  
                imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);  
                break;  
                case 2:   //加水印图片  
                $simage1 =imagecreatefromgif("xplore.gif");  
                imagecopy($nimage,$simage1,0,0,0,0,85,15);  
                imagedestroy($simage1);  
                break;  
            }  
      
            switch ($iinfo[2])  
            {  
                case 1:  
                //imagegif($nimage, $destination);  
                imagejpeg($nimage, $destination);  
                break;  
                case 2:  
                imagejpeg($nimage, $destination);  
                break;  
                case 3:  
                imagepng($nimage, $destination);  
                break;  
                case 6:  
                imagewbmp($nimage, $destination);  
                //imagejpeg($nimage, $destination);  
                break;  
            }  
      
            //覆盖原上传文件  
            imagedestroy($nimage);  
            imagedestroy($simage);  
        }  
      
        // if($imgpreview==1)  {  
        // 	echo "<br>图片预览:<br>";  
        // 	echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);  
        // 	echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";  
        // }

        $result=array();
        array_push($result,$destination);

        return $result;
    }

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
