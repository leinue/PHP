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

        function listDir($dir){
            //echo "<ul>";
            if(is_dir($dir)){
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false){
                        if((is_dir($dir."/".$file)) && $file!="." && $file!=".."){
                            echo "<li><span>$file</span><ul>";
                            listDir($dir."/".$file."/");
                            echo "</ul></li>";
                        }
                        else{
                            if($file!="." && $file!=".."){
                                echo "<li ref=\"$dir"."$file\" onclick=\"loadPDF(this)\"><span>$file</span></li>";
                            }
                        }
                    }
                    closedir($dh);
                }
            }
          //echo "</ul>";
        }
        //开始运行
        echo "<ul id='listview'>";
        listDir("../source/b0a5e1f0-d63f-11e4-9a8c-00163e002b11");
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