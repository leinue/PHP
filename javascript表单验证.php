<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>

<script type="text/javascript">
	function checkdata(){
		if(doucument.jstest.name.value.length<2||/[^u4e00-u9fa5w/.test(doucument.jstest.name.value)){
			alert("error");
			doucument.jstest.name.focus();
			return false;
		}

		if(doucument.jstest.name.value.length<1){
			alert("error");
			doucument.jstest.password.focus();
			return false;
		}

		if(doucument.jstest.date.value==""){
			alert("error");
			doucument.jstest.date.focus();
			return false;
		}

		if(!(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(doucument.jstest.mail.value))){
			alert("error");
			doucument.jstest.mail.focus();
			return false;
		}

		return true;
	}
</script>

<form name="jstest" onsubmit="return checkdata();">
	姓名<br />
	<input name="name" type="text" size="25" /><br />
	密码<br />
	<input name="password" type="password" size="25" /><br />
	日期<br /><br />
	<input name="date" type="text" size="25" /><br />
	邮箱<br /><br />
	<input name="mail" type="text" size="25" /><br />
	手机<br /><br />
	<input name="mobile" type="text" size="25" /><br />	
	电话<br /><br />
	<input name="tel" type="text" size="25" /><br />	

	<input name="ok" type="submit" value="submit" />	
</form>

</body>
</html>
