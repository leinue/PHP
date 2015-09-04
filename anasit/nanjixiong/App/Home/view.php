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

	  	<div  class="col-md-10 col-md-offset-1">
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

					<div style="padding-top:0px;" class="col-md-6">
						<h3 style="margin-top:0;"><?php echo $basicProfileName; ?> <span style="font-size:0.8em;color:rgb(170,170,170)"><?php echo $userTime; ?></span></h3>
						<h5><?php echo $basicProfileDescription; ?></h5>
						<?php

							$itemCata='';

							foreach ($itemCataList as $key => $value) {
								if(is_array($value)){

									// if($_GET['caid']==$value)

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

					<div  class="col-md-4">

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
		
		<div style="padding-right:0" class="col-md-10 col-md-offset-1">

			<div style="padding-left: 0px;"  class="col-md-8">

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

					.textarea-head{
						background: rgb(255,255,255)!important;
						padding: 0px!important;
						border-bottom: 2px solid rgb(221,221,221)!important;
						line-height: 37px;
						font-size: 16px;
						font-weight: 400!important;
					}

					.textarea-head .textarea-title{
						height: 100%;
						border-bottom: 2px solid rgb(255,94,82);
						padding-bottom: 8px;
						margin-left: 10px;
						width: 100%;
						font-weight: 400!important;
					}
					
					.alert-success{
						border-radius: 0;
						background: rgb(255,255,255);
						border-left: none;
						border-right: none;
						border-top: none;
					}

				</style>

				<?php

					if(is_array($filedList)){

						foreach ($filedList as $key => $value) {
							$optionName=$fieldOptionsObj->selectOne($value['foid']);
							if($optionName[0]->getType()=='textarea' && $optionName[0]->getVisible()==='1'){
								if($value['value']=='' || $value['value']=='<p>				&nbsp; &nbsp;</p><p></p><p>
				</p>'){
									continue;
								}
								echo '<div class="panel panel-default">
									 	<div class="panel-heading textarea-head"><strong class="textarea-title">'.$optionName[0]->getName().'</strong></div>
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

			<style type="text/css">
				.table-viewer-list{
					border-top: none!important;
				}

				.table-viewer-list a{
					color: rgb(84,84,84);
				}

				.table-viewer-list a:hover{
					color: rgb(253,108,97);
				}

				.table-viewer-list thead{
					background: rgb(255,255,255)!important;
					color: rgb(0,0,0)!important;
					text-align: left!important;
					border-top: none;
					border-bottom:2px solid rgb(221,221,221);
				}

				.table-viewer-list > thead:first-child > tr:first-child > th{
					text-align: left!important;
					font-weight: 400;
					padding: 0px;
					/*border-width:-2px;*/
				}

				.table-viewer-list > tbody > tr > td{
					text-align: left!important;
				}

				.viewer-top-title{
					border-bottom: 2px solid rgb(255,94,82);
					padding-bottom: 10px;
					/*width: 5em;*/
					/*line-height: 30px;*/
					font-size: 16px;
					font-weight: 400;
				}

				.jiathis_style{
					overflow: visible!important;
				}
				
				.jiathis_style div:first-child{
					border: none!important;
				}

				.jiathis_style td:first-child{
					padding-left: 10px;
				}

				.jiathis_style td:nth-child(2){
					padding-right: 10px;
				}

				.jiathis_style .jiadiv_01 .link_01{
					display: none;
				}

			</style>

			<div style="padding-left:0" class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="responsive-table">
							<table class="table table-hover table-viewer-list">
								<thead>
									<tr>
										<th><strong class="viewer-top-title">最热排行榜</strong></th>
									</tr>
								</thead>
								<tbody>
									<?php

										$i=1;
										$top5list=$itemsObj->getTop5();
										$deanrltt='';
										foreach ($top5list as $key => $value) {
											if($i>3){
												$deanrltt='deanrltt';
											}
											echo '<tr><td><div class="deanrlt '.$deanrltt.'"><i style="margin-right:10px" >'.($key+1).'</i><a href="index.php?v=view&iid='.$value['iid'].'&uid='.$value['uid'].'">'.$value['title'].'</a></div></tr></td>';
											$i++;
										}

									?>
								</tbody>
							</table>
						</div>

						<div class="responsive-table">
							<table class="table table-hover table-viewer-list">
								<thead>
									<tr>
										<th><strong class="viewer-top-title">最新排行榜</strong></th>
									</tr>
								</thead>
								<tbody>
									<?php

										$i=0;
										$j=1;
										$deanrltt='';
										foreach ($allItems as $key => $value) {
											if($i<$itemsCount){
												if($j>3){
													$deanrltt='deanrltt';
												}
												echo '<tr><td><div class="deanrlt '.$deanrltt.'"><i style="margin-right:10px" >'.($key+1).'</i><a href="index.php?v=view&iid='.$value->getIid().'&uid='.$value->getUid().'">'.$value->getTitle().'</a></div></tr></td>';												
											}
											$i++;
											$j++;
										}

									?>									
								</tbody>
							</table>
						</div>

						<div class="responsive-table">
							<table class="table table-hover table-viewer-list">
								<thead>
									<tr><th><strong class="viewer-top-title">推广消息</strong></th></tr>
								</thead>
								<tbody>
									<?php
										$allAds=$ads->selectAll();
										if(is_array($allAds)){
											foreach ($allAds as $key => $value) {
												if($value->getDisplay()==='0'){
													continue;
												}
												$image=str_replace(DOMAIN, DOMAIN.'/Cores/', $value->getImage());
												echo '<tr>
														<td>
															<p></p>
															<a target="_blank" href="'.$value->getUrl().'">
																<img width="140" height="140" class="img-rounded" src="'.$image.'">
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
