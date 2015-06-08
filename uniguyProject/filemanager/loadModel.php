<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>treeview</title>
    <link rel="stylesheet" href="treeview/jquery.treeview.css" />
    <link rel="stylesheet" href="treeview/screen.css" />
    
    <script src="treeview/lib/jquery.js" type="text/javascript"></script>
    <script src="treeview/lib/jquery.cookie.js" type="text/javascript"></script>
    <script src="treeview/jquery.treeview.js" type="text/javascript"></script>
    <style type="text/css">
        #listview{
            color: rgb(80,80,80);
        }
        body,.treeview ul{
            background: rgb(236,236,236);
        }

        ul li span{
            cursor: pointer;
        }

        ul li span:hover{color: #FF3300;}
    </style>
</head>

<?php
    require('mysql/sql.php');
    
    //connect to mysql
    $pdo=new PDO("mysql:dbname=$dbname;host=$host",'doc','doc');
    $user=new userMgr($pdo);
    $group=new groupMgr($pdo);
    $file=new fileMgr($pdo);
    $allGroupName=$group->getAllName();
    $allFile=$file->getAllFile();

    function listNextLevel($gpList,$group){
        if(is_array($gpList)){
            foreach ($gpList as $k => $childGroup) {
                $next=$group->getGroupListByGPName($childGroup[0]);
                if(is_array($next)){
                    echo "<li><span>{$childGroup[0]}</span><ul>";
                    listNextLevel($next,$group);
                    echo "</ul></li>";
                }else{
                    echo "<li><span>{$childGroup[0]}</span></li>";
                }
            }
        }
    }

    function listNextFileLevel($parentNode,$allFile,$fileObj,$group){
        if(is_array($allFile)){
            foreach ($allFile as $k => $singleFile) {
                $fileGroup=$group->getGroupNameByGpid($singleFile->getGroup());
                // print_r($fileGroup['groupname']);
                // echo $singleFile->getPath();
                if($fileGroup['groupname']==$parentNode){
                    $filename=explode("/",$singleFile->getPath());
                    echo "<li ref=\"{$singleFile->getPath()}\" onclick=\"loadPDF(this)\"><span>{$filename[count($filename)-1]}</span></li>";
                    array_splice($allFile, $k,1);
                }
            }
        }
    }

    /*
    * @param $fileobj fileMgr
    * @param $group groupMgr
    * @param $all allGroupName
    * @return nothing
    */

    function listDir($fileObj,$allFile,$group,$all,$dir){
        foreach ($all as $key => $singleGroup) {
            $parentID=$singleGroup->getParent();
            if($parentID==='0'){
                echo "<li><span>{$singleGroup->getGroupName()}</span><ul>";
                $parentNodeName=$singleGroup->getGroupName();
                $gpList=$group->getGroupListByGPName($singleGroup->getGroupName());
                listNextLevel($gpList,$group);
                // listNextFileLevel($parentNodeName,$allFile,$fileObj,$group);
                echo "</ul></li>";           
            }
        }
        /*if(is_dir($dir)){
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false){
                    foreach ($all as $key => $groupObj) {
                        $groupObj->getParent();
                    }
                    if((is_dir($dir."/".$file)) && $file!="." && $file!=".."){
                        echo "<li><span>$file</span><ul>";
                        listDir($fileobj,$group,$all,$dir."/".$file."/");
                        echo "</ul></li>";
                    }else{
                        if($file!="." && $file!=".."){
                            $fidObj=$fileobj->getFidByPath($dir.'/'.$file);
                            $fid=$fidObj['fid'];
                            $groupNameID=$fileobj->getFileGroup($fid);
                            $groupName=$group->getGroupNameByGpid($groupNameID['group']);
                            echo "<li ref=\"$dir"."$file\" onclick=\"loadPDF(this)\"><span>$file</span></li>";
                        }
                    }
                }
                closedir($dh);
            }
        }*/
    }
    //开始运行
    echo "<ul id='listview'>";
    listDir($file,$allFile,$group,$allGroupName,"../source/b0a5e1f0-d63f-11e4-9a8c-00163e002b11");
    echo "</ul>";
?>
<script type="text/javascript">
    function loadPDF(obj){
        var dir=$(obj).attr('ref');
        console.log(dir);
        var a = $("<a href='"+dir+"#viewer.action=download' target='_blank'>viewerjs</a>)").get(0);
        var e = document.createEvent('MouseEvents');
        e.initEvent('click', true, true);
        a.dispatchEvent(e);
    }

	$(document).ready(function(){ 
		$("#listview").attr("class","treeview-gray");
			$("#listview").treeview({
				animated: "fast",
				collapsed: true,
				unique: false,
				persist: "cookie",
				toggle: function() {
					//window.console && console.log("%o was toggled", this);
				}
			});
		});

</script>
</html>