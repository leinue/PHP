<?php

if(empty($_GET['iid']) || empty($_GET['uid'])){
	redirectTo('index.php?v=home');
}else{

	$iid=$_GET['iid'];
	$uid=$_GET['uid'];

	$usersObj=new Cores\Models\UsersModel();
	$userObj=$usersObj->selectOne($uid);

	$userTime=$userObj[0]->getCreateTime();
	$userTime=explode("-", $userTime);
	$userTime=$userTime[0];

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
					
					<div style="margin-bottom:15px;" class="col-md-2">
						<img width="100" height="100" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGYzMGRmYzYyZiB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZjMwZGZjNjJmIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQzLjUiIHk9Ijc0LjgiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="..." class="img-rounded">					
					</div>

					<div style="padding-top:0px" class="col-md-6">
						<h3 style="margin-top:0;"><?php echo $userObj[0]->getName(); ?> <span style="font-size:0.8em;color:rgb(170,170,170)"><?php echo $userTime; ?></span></h3>
						<h5><?php echo $userObj[0]->getDescription(); ?></h5>
						<p class="text-muted"><span class="glyphicon glyphicon-map-marker"> <?php echo $userObj[0]->getRegion(); ?></span></p>
						<p class="text-muted"><span class="glyphicon glyphicon-link"> <a href="<?php echo $userObj[0]->getUrl(); ?>" target="_blank" ><?php echo $userObj[0]->getUrl(); ?></a></span></p>
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
							<br>评分：
								<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
								<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
								<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
								<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
								<span style="color:rgb(253,108,97)" class="glyphicon glyphicon-star"></span>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">

			<div style="" class="col-md-8">
				
				<div class="panel panel-default">
				 	<div class="panel-heading">公司介绍</div>
					<div class="panel-body">
						
					</div>
				</div>

				<div class="panel panel-default">
				 	<div class="panel-heading">公司介绍</div>
					<div class="panel-body">
						
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-body">
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
							<textarea class="form-control" name="comments_content" rows="10"></textarea>
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
												echo '<tr><td><a href="">'.$value['title'].'</a></tr></td>';
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
												echo '<tr><td><a href="">'.$value->getTitle().'</a></tr></td>';												
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
