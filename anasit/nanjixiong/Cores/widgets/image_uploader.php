<?php
	$basedir=__DIR__;
	$basedir=explode("\\", $basedir);
	array_pop($basedir);
	array_pop($basedir);
	$tmpBasedir='';
	foreach ($basedir as $key => $value) {
		$tmpBasedir.=$value.'\\';
	}
	define('BASEDIR',$tmpBasedir);
	require(BASEDIR.'/Cores/Loader.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>上传图片</title>
	<meta charset="utf-8">
</head>
<body>

	<?php
		
		echo loadImageUploader('dd');
	?>

	<button onclick="onSave()">确定</button>
	
	<script type="text/javascript">
		function onSave(){
			window.opener.document.getElementById(localStorage.currentImageId).value=document.getElementById('dd').value;
			window.close();
		}
	</script>
	
</body>
</html>