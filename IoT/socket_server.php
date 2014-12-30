<?php
require("mysql/usemysql.php");
//确保在连接客户端时不会超时
header("Content-type: text/html; charset=utf-8"); 
set_time_limit(0);

$ip = '127.0.0.1';
$port = 1935;

/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

/*----------------    以下操作都是手册上的    -------------------*/
if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() failed: reason: ".socket_strerror($sock);
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() failed: reason: ".socket_strerror($ret);
}

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() failed: reason: ".socket_strerror($ret);
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: ".socket_strerror($msgsock);
        break;
    } else {
        
        //发到客户端
        socket_write($msgsock, $msg, strlen($msg));
        $buf = socket_read($msgsock,8192);
    
        //$talkback = "收到的信息:$buf\n";

        //连接数据库进行存储
        try {
			$pdo=new PDO("mysql:host=localhost;dbname=ncu",$user,$password);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

		$lm=new locationManager($pdo);

		//lat,long;
		$buf_exploded=explode(";",$buf);
		foreach ($buf_exploded as $key => $value) {
			$locationDetail=explode(',',$value);
			$lm->insertLocation($locationDetail[0],$locationDetail[1]);
		}

        if(++$count >= 5){
            break;
        };
    
    }
    socket_close($msgsock);

} while (true);

socket_close($sock);
?>