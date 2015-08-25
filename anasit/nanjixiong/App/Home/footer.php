	
	<footer>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="footer-main">
					<div style="padding-left:0" class="col-md-6">
						<p>Powerd By <a target="_blank" href="http://anasit.com">AnasIT</a> Team</p>
						<p>Developed By <a target="_blank" href="http://ivydom.com">Xieyang</a></p>
					</div>
					<div style="padding-right:0;text-align:right" class="col-md-6">
						<?php
							echo $settingObj->get('site_footer');
						?>
						<div style="display:none">
							<?php echo $settingObj->get('site_ana'); ?>
						</div>
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

	<script type="text/javascript" src="http://tajs.qq.com/stats?sId=50469365" charset="UTF-8"></script>
	
	<script src="<?php echo DOMAIN; ?>/App/Home/js/scripts.js"></script>
	<script src="<?php echo DOMAIN; ?>/App/Home/ex/bootstrap/js/bootstrap.min.js"></script>

	<?php
		$jsiid=empty($_GET['iid'])?'':$_GET['iid'];
	?>

	<script type="text/javascript">

		$('.float-comp .ele-model a:first-child').click(function(){
			$('html, body').animate({scrollTop:0}, 'fast');
		});

		console.log(localStorage.hasVoted);

		$('#comments_publish span').click(function(){
			var lvl=$(this).index();
			$.get('App/Home/ajax/exe.php?action=add_remark&level='+lvl+'&iid=<?php echo $jsiid; ?>',function(res){
				if(res=='-1'){
					alert('提交失败,请检查网络连接');
				}else{
					var hasVoted=localStorage.hasVoted;
					if(hasVoted.indexOf('<?php echo $jsiid; ?>')!=-1){
						alert('请不要重复提交');
					}else{
						alert("提交成功,你提交了"+lvl+"分");
						localStorage.hasVoted+='<?php echo $jsiid; ?>';
					}
				}
			});
		});

		var textareaList=$('.textarea-title');
		// console.log($('.textarea-title'));
		for (var i = 0; i < textareaList.length; i++) {
			var text=$(textareaList[i]).html();
			var len=text.length;
			$('.textarea-title').css('width',len+'em');
		};

		function get3rdlistActive(obj){
			return $(obj).parent().parent().find('li a span.badge').parent().attr('viewid');
		}

		$('.filter-field  a').click(function(){
			var urlToload="index.php?v=home&caid="+$(this).attr('caid');
			var filterActive=$('.filter-field a').find('span.badge');
			var viewTypeIdList={};
			var parent=$(this).parent().parent().parent().prev().find('a');
			var parentVal=parent.attr('viewid');

			if(!$(this).parent().parent().parent().prev().find('a span').hasClass('badge')){
				parentVal='no';
			}

			// if(!(this).parent().parent().parent().prev().find('a span').html()=='全部'){
			// 	parentVal='all';
			// }

			for (var i = 0; i < filterActive.length; i++) {
				if($(filterActive[i]).parent().attr('viewid')==get3rdlistActive(this)){
					continue;
				}
				// console.log($(filterActive[i]).parent().attr('viewid'));
				viewTypeIdList[i]=$(filterActive[i]).parent().attr('viewid');
			};

			var viewTypeIdListString=JSON.stringify(viewTypeIdList);
			urlToload+='&view_type_id='+viewTypeIdListString;
			urlToload+='&clicked='+$(this).attr('viewid');
			urlToload+='&parent='+parentVal;
			window.location=urlToload;
			// console.log(urlToload);
			return false;
		});

	</script>

</body>

</html>