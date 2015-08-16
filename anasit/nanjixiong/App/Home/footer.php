	
	<footer>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="footer-main">
					<div style="padding-left:0" class="col-md-6">
						<p>Powerd By <a target="_blank" href="http://anasit.com">AnasIT</a> Team</p>
						<p>Developed By <a target="_blank" href="http://ivydom.com">Xieyang</a></p>
					</div>
					<div style="padding-right:0;text-align:right" class="col-md-6">
						<p>南极熊3D打印网</p>
						<p>© 2011-2015 3D打印第一互动平台</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="float-comp">
	    <div class="ele-model">
	        <a style="display: block; opacity: 1;" href="javascript:void(0)" class="glyphicon glyphicon-arrow-up"></a>
	    </div>
	</div>
	
	<script src="<?php echo DOMAIN; ?>/App/Home/js/scripts.js"></script>
	<script src="<?php echo DOMAIN; ?>/App/Home/js/jquery.js"></script>
	<script src="<?php echo DOMAIN; ?>/App/Home/ex/bootstrap/js/bootstrap.min.js"></script>
	<link href="<?php echo DOMAIN; ?>/Cores/widgets/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.min.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/lang/zh-cn/zh-cn.js"></script>
	
	<script type="text/javascript">

		$('.float-comp .ele-model a:first-child').click(function(){
			$('html, body').animate({scrollTop:0}, 'fast');
		});

		$('#comments_publish span').click(function(){
			var lvl=$(this).index();
			$.get('App/Home/ajax/exe.php?action=add_remark&level='+lvl+'&iid=<?php echo $_GET["iid"] ?>',function(res){
				if(res=='-1'){
					alert('提交失败,请检查网络连接');
				}else{
					alert("提交成功,你提交了"+lvl+"分");
				}
			});
		});
	</script>

</body>

</html>