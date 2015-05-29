<?php 
	require('header.php'); 
	require('function.php');

	if(!isset($_GET['u']) || !isset($_GET['p'])){
		echo "<script>alert('请登录');window.location.href='index.php';</script>";
	}

	$nickname=getQQNick($_GET['u']);
	$qqNumber=$_GET['u'];
?>
	<nav>
		<div class="welcome">
			欢迎您，(<?php echo $nickname; ?>) <a href="">退出</a>
		</div>
	</nav>
	<section>
		<div class="info">
			<!-- <div class="user_info">
				<img src="">
			</div> -->
			<div class="tools">
				<img src="images/side.jpg">
				<table class="my_info" width="735" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				    <td width="56" rowspan="2">
				    	<img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $_GET['u']; ?>&s=100&t=<?php echo time(); ?>" alt="头像" height="40" hspace="2" vspace="2" width="40">
				    </td>
				    <td width="679">昵       称：  <?php echo $nickname; ?></td>
			      </tr>
				  <tr>
				    <td>帐       号：<?php echo $qqNumber; ?> &nbsp;<a onfocus="this.blur()" href="" onclick="">查看登录记录</a></td>
			      </tr>
			  	</table>
			  	<div class="btn_list">
			  		<a onfocus="this.blur()" class="button1" href="#" onclick=""><span>
			&nbsp;&nbsp;清除异常&nbsp;&nbsp;</span></a>
					<a onfocus="this.blur()" class="button1" href="#" onclick=""><span>
				&nbsp;&nbsp;取消申诉&nbsp;&nbsp;</span></a>
					<a onfocus="this.blur()" class="button1" href="#" onclick=""><span>
				&nbsp;&nbsp;取消申诉&nbsp;&nbsp;</span></a>
			  	</div>
		  </div>
		</div>
	</section>
<script type="text/javascript">
	$('document').ready(function(){
		$('footer img:nth-child(1)').hide();
		$('footer').css('margin-top','20px');
		$('section').css('background','url(images/wrapper_bg.jpg) repeat-x top');
	});
</script>
<?php require('footer.php'); ?>