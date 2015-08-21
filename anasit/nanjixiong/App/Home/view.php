<?php

if(empty($_GET['iid']) || empty($_GET['uid'])){
	redirectTo('index.php?v=home');
}else{

	$iid=$_GET['iid'];
	$uid=$_GET['uid'];

	$usersObj=new Cores\Models\UsersModel();
	$userObj=$usersObj->selectOne($uid);

	// $userTime=$userObj[0]->getCreateTime();
	// $userTime=explode("-", $userTime);
	// $userTime=$userTime[0];

	$itemsObj=new Cores\Models\ItemsModel();
	$allItems=$itemsObj->selectAll();
	$itemsCount=count($allItems);
	$itemsCount=$itemsCount<5?$itemsCount:5;

	$comemntsObj=new Cores\Models\CommentsModel();
	$ads=new Cores\Models\AdsModel();

}

$prompt='';

if(!empty($_GET['action'])){

	switch ($_GET['action']) {
		case 'submit_comments':
			
			if($_POST['comments_content']==null){
				alert('发布内容不能为空,请重新填写');
			}else{
				$comemntsObj->add($_GET['iid'],$_POST['comments_content']);
				alert('发布成功'); 
			}

			break;
		default:
			break;
	}

}

?>

	<div class="row">

	  	<div class="col-md-10 col-md-offset-1">
		  	<div class="panel panel-default">
				<div class="panel-body">

					<?php

						$fieldObj=new Cores\Models\FieldsModel();
						$fieldOptionsObj=new Cores\Models\FieldsOptionsModel();

						$filedList=$fieldObj->getByItemId($_GET['iid']);

					?>

					<?php

						$basicProfileName='';
						$basicProfileDescription='';
						$userTime='';
						$region='';
						$itemURL='';

						foreach ($filedList as $key => $value) {
							$optionName=$fieldOptionsObj->selectOne($value['foid']);
							if($optionName[0]->getType()!='textarea' && $optionName[0]->getVisible()==='1'){
								$citePost=$optionName[0]->getType()=='img'?'<div style="margin-bottom:15px;" class="col-md-2"><img width="80" height="80" src="'.DOMAIN.'/Cores/'.$value['value'].'" alt="'.$value['value'].'" class="img-rounded"></div>':'';
								echo $citePost;
							}
							if($optionName[0]->isDesc()==='1'){
								$basicProfileDescription=$value['value'];
								$basicProfile=$itemsObj->selectOne($value['itemId']);
								$basicProfileName=$basicProfile[0]->getTitle();
								$userTime=$basicProfile[0]->getModifyTime();
								$userTime=explode("-", $userTime);
								$userTime=$userTime[0];
							}
							if($optionName[0]->isRegion()==='1'){
								$itemURL=$value['value'];
							}
						}

						$itemCataList=generatorCataList($_GET['iid']);

					?>

					<div style="padding-top:0px" class="col-md-6">
						<h3 style="margin-top:0;"><?php echo $basicProfileName; ?> <span style="font-size:0.8em;color:rgb(170,170,170)"><?php echo $userTime; ?></span></h3>
						<h5 style="margin-top:-20px;"><?php echo $basicProfileDescription; ?></h5>
						<?php

							$itemCata='';

							foreach ($itemCataList as $key => $value) {
								if(is_array($value)){
									if($key!=count($itemCataList)-1){
										$itemCata.=$value[2].',';
									}else{
										$itemCata.=$value[2];
									}
								}
							}

							echo '<p class="text-muted"><span class="glyphicon glyphicon-menu-hamburger"> '.$itemCata.'</span></p>';

						?>
						<p class="text-muted"><span class="glyphicon glyphicon-link"> <a href="<?php echo $itemURL; ?>" target="_blank" ><?php echo $itemURL; ?></a></span></p>
					</div>

					<div class="col-md-4">

						<div class="jiathis_style_32x32">
							<a class="jiathis_button_qzone"></a>
							<a class="jiathis_button_tsina"></a>
							<a class="jiathis_button_tqq"></a>
							<a class="jiathis_button_weixin"></a>
							<a class="jiathis_button_renren"></a>
							<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
							<a class="jiathis_counter_style"></a>
						</div>
						<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
						
						<div class="comments">
							<br>综合评分：
								<?php
									$remarksObj=new Cores\Models\RemarksModel();
									$res=$remarksObj->selectAll();
									$remarkCount=0;
									$j=0;
									if(is_array($res)){
										foreach ($res as $key => $value) {
											if($value->getItemId()==$_GET['iid']){
												// echo $value->getPoints();
												$remarkCount+=$value->getPoints();
												$j++;
											}
										}
									}
									if($j!==0){
										$remarkCount=ceil($remarkCount/$j);
										for ($i=0; $i < $remarkCount; $i++) { 
											echo '<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>';
										}
										for ($i=0; $i < 5-$remarkCount; $i++) { 
											echo '<span style="color:rgb(243,243,243)" class="glyphicon glyphicon-star"></span>';
										}
									}else{
										echo '0点评';
									}
									
								?>
							</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">

			<div style="" class="col-md-8">

				<?php
					$fieldObj=new Cores\Models\FieldsModel();
					$fieldOptionsObj=new Cores\Models\FieldsOptionsModel();

					$filedList=$fieldObj->getByItemId($_GET['iid']);
				?>

				<style type="text/css">
					.textarea-field{
						word-break:break-all;
						word-wrap:break-word ;
					}
				</style>

				<?php

					if(is_array($filedList)){

						foreach ($filedList as $key => $value) {
							$optionName=$fieldOptionsObj->selectOne($value['foid']);
							if($optionName[0]->getType()=='textarea' && $optionName[0]->getVisible()==='1'){
								echo '<div class="panel panel-default">
									 	<div class="panel-heading">'.$optionName[0]->getName().'</div>
										<div class="panel-body textarea-field">
											'.$value['value'].'
										</div>
									</div>';
							}
						}

					}

				?>

				<div class="panel panel-default">
					<div class="panel-body">
						
						<?php

							if(!empty($_SESSION['username'])){
						?>
							<div style="padding-bottom:15px;padding-top:0;" id="comments_publish" class="comments">
								<br>评分：
									<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
									<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
									<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
									<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
									<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
							</div>
						<?php
							}else{
						?>
									<div style="padding-bottom:15px;padding-top:0;" id="comments_publish" class="comments">
										<br>请登录后进行评分
									</div>
						<?php
							}

						?>
						

						<?php
							$allCommentsObj=$comemntsObj->getAllByItemId($_GET['iid']);
							if(is_array($allCommentsObj)){
								foreach ($allCommentsObj as $key => $value) {
									echo '<div class="alert alert-success" role="alert">
											<strong>'.$value->getCreateTime().'</strong>
											<p>'.$value->getContent().'</p>
										</div>';
								}
							}
						?>
						<form method="post" action="index.php?v=view&uid=<?php echo $_GET['uid'] ?>&iid=<?php echo $_GET['iid']; ?>&action=submit_comments">
							<textarea class="form-control" name="comments_content" rows="4"></textarea>
							<div style="padding-top:15px;text-align:right">
								<input type="submit" value="提交" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>

			</div>

			<div style="" class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="responsive-table">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>最热排行榜</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$i=0;
										$top5list=$itemsObj->getTop5();
										foreach ($top5list as $key => $value) {
												echo '<tr><td><a href="index.php?v=view&iid='.$value['iid'].'&uid='.$value['uid'].'">'.$value['title'].'</a></tr></td>';
										}

									?>
								</tbody>
							</table>
						</div>

						<div class="responsive-table">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>最新排行榜</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$i=0;
										foreach ($allItems as $key => $value) {
											if($i<$itemsCount){
												echo '<tr><td><a href="index.php?v=view&iid='.$value->getIid().'&uid='.$value->getUid().'">'.$value->getTitle().'</a></tr></td>';												
											}
											$i++;
										}

									?>									
								</tbody>
							</table>
						</div>

						<div class="responsive-table">
							<table class="table table-hover">
								<thead>
									<tr><th>推广消息</th></tr>
								</thead>
								<tbody>
									<?php
										$allAds=$ads->selectAll();
										if(is_array($allAds)){
											foreach ($allAds as $key => $value) {
												if($value->getDisplay()==='0'){
													continue;
												}
												echo '<tr>
														<td>
															<p></p>
															<a target="_blank" href="'.$value->getUrl().'">
																<img width="140" height="140" class="img-rounded" src="'.$value->getImage().'">
															</a>
															<p>'.$value->getContent().'</p>
														</td>
													</tr>';
											}
										}
									?>
								</tbody>
							</table>
						</div>
												
					</div>
				</div>
			</div>
			
		</div>

	</div>
	
	<script type="text/javascript">

	</script>
