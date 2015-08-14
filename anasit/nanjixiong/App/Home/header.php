<?php

$settingObj=new Cores\Models\SettingModel();

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title><?php echo $settingObj->get('site_title'); ?> - <?php echo $settingObj->get('site_sub_title'); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN; ?>/App/Home/ex/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN; ?>/App/Home/css/style.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN; ?>/App/Home/ex/bootstrap/css/bootstrap-theme.min.css"> -->
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#"><img alt="<?php echo $settingObj->get('site_title'); ?>" style="width:161px;height:60px;" src="http://www.nanjixiong.com/template/dean_pink_140929/deancss/logo.png"></a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="http://www.nanjixiong.com/">首页 <span class="sr-only">(current)</span></a></li>
	        <?php
	        	$cataMgr=new Cores\Models\CataModel();
                $allCataObj=$cataMgr->selectAll();
                if(is_array($allCataObj)){
                	$i=0;
                    foreach ($allCataObj as $key => $value) {
                        if($value->getParent()==='0'){
                            // echo '<tr class="odd gradeX">
                            //     <td>'.$value->getName().'</td>
                            //     <td style="text-align:center">
                            //         <a ref="admin.php?v='.$view.'&cata_to_view='.$value->getCaid().'" class="btn btn-primary btn-sm view_cata" data-toggle="modal" data-whatever="'.$value->getCaid().'=='.$value->getName().'" data-target=".modal-view-cata">详细</a>
                            //         <a href="admin.php?v='.$view.'&cata_to_del='.$value->getCaid().'" class="btn btn-danger btn-sm">删除</a>
                            //     </td>
                            // </tr>';
                            $active='';
                            if($i===0){
                            	$active='active';
                            }
                            echo '<li class="'.$active.'"><a href="index.php?v=home&caid='.$value->getCaid().'">'.$value->getName().'</a></li>';
                        	$i++;
                        }
                    }
                }else{
                    echo '';
                }
	        	
	        ?>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="index.php?v=publish">发布</a></li>
	        <li><a href="admin.php">进入后台</a></li>
	        <li><a target="_blank" href="admin.php">登录</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>