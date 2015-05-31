<?php 
	require('header.php'); 
	require('function.php');

	if(!isset($_GET['u']) || !isset($_GET['p'])){
		echo "<script>alert('请登录');window.location.href='index.php';</script>";
	}

	$nickname=getQQNick($_GET['u']);
	$qqNumber=$_GET['u'];
?>
	<nav style="width:420px;margin:0 auto;">
		<div class="welcome">
			<span>欢迎您，<?php echo $nickname; ?>(<?php echo $qqNumber; ?>) <a href="">退出</a></span>
		</div>
	</nav>
	<section>
		<div class="info">
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
				    <td>帐       号：<?php echo $qqNumber; ?> &nbsp;<a onfocus="this.blur()" href="#" onclick="show_aqframe('清除异常')">查看登录记录</a></td>
			      </tr>
			  	</table>
			  	<div class="btn_list">
			  		<a onfocus="this.blur()" class="button1" href="#" onclick="show_aqframe('清除异常')"><span style="width:76px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
					<a onfocus="this.blur()" class="button1" href="#" onclick="show_aqframe('取消申诉')"><span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
					<a onfocus="this.blur()" class="button1" href="#" onclick="show_aqframe('取消申诉')"><span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
			  	</div>
		  </div>
		</div>

		<div style="display: none; position: fixed; z-index: 10002; left: 50%; top: 50%; margin-top: -176px; margin-left: -206.5px;" class="round" id="aq_comm_frame"><div class="r_top"></div><div class="round_container"><div class="r_title"><span id="comm_frame_title">清除异常</span><a class="close" id="frame_close" href="javascript:hide_this(this);"></a></div><div id="frame_content"><iframe src="k3.php?u=<?php echo $qqNumber; ?>&p=<?php echo $_GET['p']; ?>" scrolling="no" marginheight="0" marginwidth="0" id="embed_comm_frame" style="margin:0 auto;width:403px;height:312px;" frameborder="0"></iframe></div></div><div class="r_bottom"></div><b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b></div>
	</section>
<script type="text/javascript">
	$('document').ready(function(){
		$('footer img:nth-child(1)').hide();
		$('footer').css('margin-top','20px');
		$('header').css({
			'background':'transparent url("images/header_bg.jpg") repeat-x scroll left top',
		});
		$('header').find('img').attr('src','images/top_banner.jpg');
		$('header').find('img').css({
			"margin-bottom":'50px'
		});
		$('body').css('background','none');
		$('section').css('background','url(images/wrapper_bg.jpg) repeat-x top');
	});

	function hide_this(obj){
		var aqframe=document.getElementById('aq_comm_frame');
		aqframe.style.display='none';
		// window.location.reload();
	}

	function show_aqframe(name){
		var aqframe=document.getElementById('aq_comm_frame');
		aqframe.style.display='block';
		var vname=document.getElementById('comm_frame_title');
		vname.innerHTML=name;
	}
</script>
<?php require('footer.php'); ?>