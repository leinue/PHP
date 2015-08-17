<?php

include_once './config/config_ucenter.php';
include_once './uc_client/client.php';


$usernames = $_GET["username"];
$passwords = $_GET["password"];


list($uid, $username, $password, $email) = uc_user_login($usernames, $passwords);

if($uid > 0) {
        echo uc_user_synlogin($uid);
        echo '1';//登录成功
} elseif($uid == -1) {
        echo '-1';//用户不存在,或者被删除
} elseif($uid == -2) {
        echo '-2';//密码错误
} else {
        echo '0';//未定义
}


?>