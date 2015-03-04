<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<title>My remoteSpeaking</title>
	<meta charset="utf-8">
</head>
<body>
	
	<div data-role="page">

  		<div data-role="header" data-position="fixed">
  			<a href="" data-role="button">首页</a>
    		<h1>My Remote Speaking</h1>
  		</div>

  		<div data-role="content">
  			<textarea data-role class="text-input-field" placeholder="请输入远程语音文本"></textarea>
  			<div class="ui-grid-a">
     			<div class="ui-block-a">
     				<a href="#pagetwo" id="submit-remote-text" data-role="button" data-shadow="false" data-inline="true">提交</a>
     			</div>
     			<div class="ui-block-b">
					<a href="#" data-role="button" id="send-status" data-shadow="false" data-icon="info">等待发送</a>
     			</div>
  			 </div>
  		</div>

  		<div data-role="footer" data-position="fixed">
    		<h1>@copyright <a href="http://ivydom.com">ivydom.com</a></h1>
  		</div>

	</div>

	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	<script>
		$(document).ready(function(){
			var remoteText=$('.text-input-field').val();

			function updateStatus(s){
				$('#send-status').html(s);
			}

			updateStatus('fuck');

			$('#submit-remote-text').on('click',function(){
				var url='send.php';
				$.get(
					url,
					{c:remoteText},
					function(data,status){
						if(data!='-1'){
							updateStatus('发送成功');
						}else{
							updateStatus('发送失败');
						}
					}
				);
			});
		});
	</script>
</body>
</html>