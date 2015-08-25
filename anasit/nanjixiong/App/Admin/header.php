<?php

$settingObj=new Cores\Models\SettingModel();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>控制面板 - <?php echo $settingObj->get('site_admin_title'); ?></title>
    <!-- <link href="<?php echo DOMAIN; ?>/App/Admin/assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> -->
    <link href="<?php echo DOMAIN; ?>/App/Admin/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/App/Admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo DOMAIN; ?>/App/Admin/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo DOMAIN; ?>/App/Admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="<?php echo DOMAIN; ?>/App/Admin/assets/css/custom-styles.css" rel="stylesheet" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo DOMAIN; ?>/App/Admin/assets/css/index.css" rel="stylesheet" >
    <link href="<?php echo DOMAIN; ?>/Cores/widgets/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script src="<?php echo DOMAIN; ?>/App/Admin/assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.min.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/lang/zh-cn/zh-cn.js"></script>
    
</head>

<body style="padding: 0;">
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">伸缩菜单</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php?v=home"><?php echo $settingObj->get('site_admin_title'); ?></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="index.php">
                        <div>
                            <i class="fa fa-home"></i> 前往前台
                        </div>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> 前往discuz</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>