<?php

$settingObj=new Cores\Models\SettingModel();

if(!empty($_GET['action'])){
	switch ($_GET['action']) {
		case 'logout':
			session_unset();
			session_destroy();
			break;
		default:
			break;
	}
}

$view=$_GET['v'];
$caid='';

if(!empty($_GET['caid'])){
	$caid=$_GET['caid'];
}

$firstCaid=array();

function displayAvtive($current,$to){
    if(!empty($current)){
        if($current==$to){
            return 'active';
        }
    }
}

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
	<link href="<?php echo DOMAIN; ?>/Cores/widgets/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script src="<?php echo DOMAIN; ?>/App/Home/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/third-party/jquery.min.js"></script>
    <!--<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.min.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/lang/zh-cn/zh-cn.js"></script>-->
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/kindeditor/kindeditor-min.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/jqp/jqPaginator.js"></script>
</head>
<body>

	<style type="text/css">

		@media screen and (max-width: 755px) {
		    
			.navbar-default .navbar-brand img{
				height: 24px!important;
			}

		}
		
		.navbar-default .navbar-brand img{
			width:100%;
			height:60px;
		}

		.navbar-default .navbar-brand {
			overflow:hidden;
			height:70px;		

		}

		
		.block-hide{
			
			position: absolute;
			width: 151px;
			height: 27px;
			background: rgb(238,238,238);
			margin-left: 100px;
			margin-top: -32px;
			z-index: 2000;
		
		}


	</style>
		
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>

	      <a class="navbar-brand" href="#"><img style="height:130px;margin-top:-35px"  alt="<?php echo $settingObj->get('site_title'); ?>"  src="<?php echo $settingObj->get('site_logo');  ?>"></a>
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
                        if($value->getParent()==='0' && $value->getVisible()==='1'){
                        	array_push($firstCaid, $value->getCaid());
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
                            echo '<li class="'.displayAvtive($caid,$value->getCaid()).'"><a href="index.php?v=home&caid='.$value->getCaid().'">'.$value->getName().'</a></li>';
                        	$i++;
                        }
                    }
                }else{
                    echo '';
                }
	        	
	        ?>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li class="<?php echo displayAvtive($view,'publish'); ?>"><a href="index.php?v=publish">发布</a></li>
	        <?php
	        	if($_SESSION['privilege']==='0'){
	        		echo '<li><a href="admin.php">进入后台</a></li>';
	        	}
	        ?>
	        <li class="<?php echo displayAvtive($view,'account'); ?>"><a href="index.php?v=account&uid=<?php echo $_SESSION['uid']; ?>">帐户</a></li>
	        <?php 
	        	if(empty($_SESSION['username'])){
	        		echo '<li><a href="login.php">登录</a></li>';
	        	}else{
	        		echo "<li><a target=\"_blank\" href=\"http://www.nanjixiong.com/home.php?mod=spacecp&ac=pm\">私信</a></li>";
	        		echo '<li><a href="index.php?action=logout">退出</a></li>';
	        	}
	        ?>
	      </ul>
	    </div>
	  </div>
	</nav>
