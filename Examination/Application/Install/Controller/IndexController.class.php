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
						primary key(`id`))default charset=utf8;"
    	);
    	$initModel=M();
    	$initFlag=0;
    	foreach ($sqlInitTable as $tableName => $tableSQL) {
    		if($initModel->execute($tableSQL)){$initFlag+=1;}else{$initFlag-=1;}
    	}
    	if($initFlag>=0){$this->show('初始化成功');}else{$this->show('初始化失败');}
	}
}