<?php
	
	if(empty($_SESSION['username'])){
		redirectTo('login.php');
	}

	if(empty($_GET['uid'])){
		redirectTo('index.php?v=home');
	}

	$usersObj=new Cores\Models\UsersModel();
	$userObj=$usersObj->selectOne($_GET['uid']);
	$userObj=$userObj[0];

	if(!empty($_GET['action'])){
		$name=$_POST['name_edit'];
		$photo=$_POST['photo_edit'];
		$region=$_POST['region_edit'];
		$url=$_POST['url_edit'];
		$description=$_POST['description_edit'];
		
		$usersObj->modify($_GET['uid'],$name,DOMAIN.$photo,$region,$url,$description);
		redirectTo('index.php?v=account&uid='.$_GET['uid']);		
	}

	$defaultImage=$userObj->getPhoto();
	$defaultImage==='0'?'default.png':$defaultImage;

?>
	<div class="row">

	  	<div class="col-md-10 col-md-offset-1">
	  		<?php echo $prompt; ?>
		  	<div class="panel panel-default">
		  		<div class="panel-heading">
			    	<h3 class="panel-title">修改帐户信息</h3>
			  	</div>
				<div class="panel-body">
					<div class="col-md-6">
						<form enctype="multipart/form-data" method="post" action="index.php?v=account&uid=<?php echo $_GET['uid']; ?>&action=edit_account_profile">
							<?php echo loadImageUploader('photo_edit',$defaultImage); ?>
							<div class="form-group">
				                <label>昵称</label>
				                <input placeholder="昵称" value="<?php echo $userObj->getName(); ?>" name="name_edit" class="form-control">
				            </div>
				            <div class="form-group">
				                <label>地区</label>
				                <input placeholder="地区" value="<?php echo $userObj->getRegion(); ?>" name="region_edit" class="form-control">
				            </div>
							<div class="form-group">
								<label>网址</label>
								<input placeholder="网址" value="<?php echo $userObj->getUrl(); ?>" name="url_edit" class="form-control">
							</div>
							<div class="form-group">
								<label>一句话介绍</label>
								<input placeholder="一句话介绍" name="description_edit" value="<?php echo $userObj->getDescription(); ?>" class="form-control">
							</div>
							<input class="btn btn-primary" type="submit" value="提交">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>