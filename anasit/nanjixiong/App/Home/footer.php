	
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
	<script type="text/javascript">
		$('.float-comp .ele-model a:first-child').click(function(){
			$('html, body').animate({scrollTop:0}, 'fast');
		});
	</script>

</body>

</html>