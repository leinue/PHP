<?php
namespace Install\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->init();
    }

    public function init(){
    	$sqlInitTable=array(
    		"exa_user"=>"CREATE TABLE IF NOT EXISTS `exa_user`( 
						`id` int not null auto_increment,
						`guid` VARCHAR(255) not null,
						`email` VARCHAR(255) not null,
						`nickname` VARCHAR(255) not null,
			    		`password` VARCHAR(255) not null,
			    		`privilege` int(1) not null,
			     		`last_Login_Time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			     		`created_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
						primary key(`id`))default charset=utf8;",
    		"exa_publication"=>"CREATE TABLE IF NOT EXISTS `exa_publication`(
						`id` int not null auto_increment,
						`epid` VARCHAR(255) not null,
						`p_author` varchar(255) not null,
						`p_title` varchar(255) not null,
						`p_describe` varchar(255) not null,
						`p_src` varchar(255) not null,
						`p_score` int not null,
						`p_liked_num` int not null,
						`p_tags` int not null,
						`p_type` int not null,
						`epcid` int not null,
						`p_created_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    					primary key(`id`))default charset=utf8;",
    		"exa_publication_catalogue"=>"CREATE TABLE IF NOT EXISTS `exa_publication_catalogue`(
						`id` int not null auto_increment,
						`epcid` VARCHAR(255) not null,
						`pc_title` varchar(255) not null,
						`pc_describe` varchar(255) not null,
						`pc_count` int not null,
    					primary key(`id`))default charset=utf8;",
			"exa_posts"=>"CREATE TABLE IF NOT EXISTS `exa_posts`(
						`id` int not null auto_increment,
						`post_author` VARCHAR(255) not null,
						`post_guid` varchar(255) not null,
						`post_title` varchar(255) not null,
						`post_content` text not null,
						`post_modified`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
						`post_type` varchar(20) not null,
    					primary key(`id`))default charset=utf8;",
			"exa_options"=>"CREATE TABLE IF NOT EXISTS `exa_options`(
						`id` int not null auto_increment,
						`options_name` varchar(255) not null,
						`options_value` varchar(255) not null,
    					primary key(`id`))default charset=utf8;"
    	);
    	$initModel=M();
    	$initFlag=0;
    	foreach ($sqlInitTable as $tableName => $tableSQL) {
    		if($initModel->execute($tableSQL)){$initFlag+=1;}else{$initFlag-=1;}
    	}
    	if($initFlag>=0){$this->show('初始化失败');}else{$this->show('初始化成功');}
    	$this->show('loading datas...');
    	$optionsList=array(
    		"site_name"=>"INSERT INTO `exa_options`(`options_name`, `options_value`) VALUES ('site_name','Examination')",
    		"site_description"=>"INSERT INTO `exa_options`(`options_name`, `options_value`) VALUES ('site_description','Examination - Offical WebSite')",
    		"user_can_register"=>"INSERT INTO `exa_options`(`options_name`, `options_value`) VALUES ('user_can_register','0')"
    		);
    	foreach ($optionsList as $key => $option) {
    		$this->show($initModel->execute($option));
    	}
	}

	public function uninstall(){
		$sqlInitTable=array("DROP TABLE `exa_user`,`exa_publication_catalogue`,`exa_options`,`exa_posts`,`exa_publication`");
		$initModel=M();
    	$initFlag=0;
    	foreach ($sqlInitTable as $tableName => $tableSQL) {
    		if($initModel->execute($tableSQL)){$initFlag+=1;}else{$initFlag-=1;}
    	}
    	if($initFlag>=0){$this->show('卸载失败');}else{$this->show('卸载成功');}
	}
}