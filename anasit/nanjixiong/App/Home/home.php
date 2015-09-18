<?php
	
	$page=1;

	if(!empty($_GET['page'])){
	    $page=$_GET['page'];
	}

	$prevPage=$page-1;
	if($prevPage<=0){
	    $prevPage=1;
	}

	if(empty($_GET['caid'])){
		$caid=$allCataObj[0]->getCaid();
		redirectTo('index.php?v=home&caid='.$firstCaid[0]);
	}

	$cataObj=new Cores\Models\CataModel();
	$childList=$cataObj->selectAll();
	$secondList=$cataObj->getSecond();
	// $secondLevelList=$cataObj->getSecondLevel($caid,true);

	function displayBadge($current,$to){
		// alert($current);
		if($to=='all'){
			if($current==$to){
				return 'class="badge"';
			}
		}else{
			// alert($current);
			if(stristr($to,$current)){
				return 'class="badge"';
			}
		}
	}

	if(empty($_GET['view_type_id'])){
		redirectTo('index.php?v=home&view_type_id=all&caid='.$_GET['caid']);
	}

	$cataToView='';

	if(!empty($_GET['view_type_id'])){
		$cataToView=$_GET['view_type_id'];
	}

	$cataList='';

	if($cataToView=='all'){
		$cataList=$cataObj->getCataChild($_GET['caid']);
		$allPages=0;
	}else{		

		$caidClicked=$_GET['clicked'];
		$caidParent=$_GET['parent'];

		$cataToViewArr=json_decode($cataToView,true);
		
		if($caidParent!='no'){
			$cataParentKey=array_search($caidParent,$cataToViewArr);
			array_splice($cataToViewArr,$cataParentKey,1);
		}

		$searchResult=array();
		// foreach ($cataToView as $key => $value) {
			$search=$cataObj->searchItemListByCaid($_GET['clicked'],$_GET['caid'],$page);
			$allPages=ceil(count($search)/10);
			// if(!$search){
			// 	continue;
			// }
			array_push($searchResult, $search);
		// }
		// 
		
		$cataToView=json_encode($cataToViewArr);

		echo "<script>

				window.onload=function(){
					
					var fields=$('.filter-field a');
					for (var i=0; i < fields.length; i++) { 
						var currentAttr=$(fields[i]).attr('viewid');
						console.log(currentAttr);
						// if('$caidClicked'!=currentAttr){
						// 	console.log('caidClicked=$caidClicked'+';currentAttr='+currentAttr);
						// }
						console.log('$cataToView');
						if('$cataToView'.indexOf(currentAttr)!=-1){
							console.log($(fields[i]));
							$(fields[i]).find('span').addClass('badge');
						}
					}

				};

			</script>";
		
	}
?>
	<div class="row page-first-div">

	  	<div class="col-md-10 col-md-offset-1">
	  	<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-12 filter-field">

					<?php
						if(is_array($secondList)){
							foreach ($secondList as $key => $value) {
								if($value['visible']==='0'){
									continue;
								}

								if($value['parent']!=$_GET['caid']){
									continue;
								}
								$list='';
								$rdList=$cataObj->getCataChild($value['caid']);
								if(is_array($rdList)){
									foreach ($rdList as $childKey => $childValue) {
										if($childValue['child']!='second' && $childValue['visible']==='1'){
											$jsonItemCaid=$_GET['view_type_id'];

											$badge=displayBadge($_GET['clicked'],$childValue['caid']);

											$list.='<li style="width: 112px;line-height: 20px;"><a style="color:rgb(68,68,68)" caid="'.$caid.'" viewId='.$childValue['caid'].' href="index.php?v=home&caid='.$caid.'&view_type_id='.$childValue['caid'].'"> <span '.$badge.'>'.$childValue['name'].'</span></a></li>';
										}
									}
								}
								if($list==''){
									$list='暂无数据';
								}
								$to=empty($_GET['clicked'])?'all':$childValue['parent'];
								$current=empty($_GET['clicked'])?$_GET['view_type_id']:$_GET['clicked'];
								echo '<div class="cata-list">
										<div class="col-md-2">
											'.$value['name'].'：<a caid="'.$caid.'" viewId='.$childValue['parent'].' href="index.php?v=home&caid='.$caid.'&view_type_id=all"> <span '.displayBadge($current,$to).'>全部</span></a>
										</div>
										<div class="cata-3rd-list col-md-10">
											<ul class="list-inline">'.$list.'</ul>
										</div>
									</div>';
							}
						}
					?>
					
				</div>
			</div>
		</div>

		<style type="text/css">

			.table > thead:first-child > tr:first-child > th{
				color: #464646;
				font-size: 14px;
				font-weight: 700;
			}

			.table a{
				font-size: 13px;
				color: #178CDC;
				font-weight: 700;
			}

		</style>

		<div class="panel panel-default">
		  	<div style="padding:0px!important" class="panel-body">
				<div class="table-responsive">
				  <table class="table item-list">
				  <thead>
			        <tr>
			          <th>项目资料</th>
			          <?php
			          	$fieldsCount=0;

			          	if(is_array($secondList)){
			          		foreach ($secondList as $key => $value) {
			          			if($value['fvisible']==='1' && $value['parent']==$_GET['caid']){
			          				echo '<th>'.$value['name'].'</th>';
			          				$fieldsCount++;
			          			}
			          		}
			          	}

			          ?>
			        </tr>
			      </thead>
				    <tbody style="border-bottom: 1px solid rgb(221,221,221);">
						
						<?php

							if(is_array($cataList)){
								// print_r($cataList);
								$filedObj=new Cores\Models\FieldsModel();
								$filedOptionObj=new Cores\Models\FieldsOptionsModel();

								$frontPhoto=$filedOptionObj->getFieldFrontPhoto();
								$frontDesc=$filedOptionObj->getFieldDesc();

								$itemsObj=new Cores\Models\ItemsModel();
								$allItems=$itemsObj->selectAll($page,true);

								$allPages=ceil(count($allItems)/10);

								$noDataTips='';

								for ($t=0; $t < $fieldsCount; $t++) { 
									$noDataTips.='<td><p></p>暂无数据</td>';
								}
								
								if(is_array($allItems)){
									foreach ($allItems as $itemKey => $itemValue) {
										$jsonItemCaid=$itemValue->getCaid();
										$jsontmp=$jsonItemCaid;
										$jsonItemCaid=json_decode($jsonItemCaid);
										$queryId=$_GET['view_type_id']=='all'?$_GET['caid']:$_GET['view_type_id'];
										if($jsonItemCaid!==null && $itemValue->getStatus()==='1' && stristr($jsontmp,$queryId) && stristr($jsontmp,$_GET['caid'])){
											$allFields=$filedObj->getByItemId($itemValue->getIid());
											// print($itemValue->getIid());
											if(is_array($allFields)){
												array_shift($jsonItemCaid);

												$secondListField='';
												$secondFieldCount=0;

												foreach ($jsonItemCaid as $rdCaidKey => $rdCaidValue) {

													// print_r($rdCaidValue);
													// print_r($rdCaidValue[0]);echo '<br>';
													if($cataObj->getParentBy2ndLvl($rdCaidValue[0])!=$_GET['caid']){
														continue;
													}

													$rdValue=$cataObj->selectOne($rdCaidValue[0]);
													if($rdValue[0]->getFVisible()==='1'){
														$secondFieldCount++;
														$cataString=$rdCaidValue[2];
														if(is_array($rdCaidValue[2])){
															$tmp=array();
															foreach ($rdCaidValue[2] as $cataKey => $cataValue) {
																$tmpCataValue=$cataObj->selectOne($cataValue);
																array_push($tmp,$tmpCataValue[0]->getName());
															}
															$cataString=join(',', $tmp);
														}
									          			$secondListField.='<td><p></p>'.$cataString.'</td>';
									          		}

												}

												// alert($fieldsCount-$secondFieldCount);

												if($secondFieldCount<$fieldsCount){
													for ($i=0; $i < ($fieldsCount-$secondFieldCount); $i++) { 
														$secondListField.='<td><p></p>无</d>';
													}
												}

												$frontPhotoSrc='';
												$frontDescContent='';

												foreach ($allFields as $fKey => $fValue) {
													if($fValue['foid']==$frontPhoto[0]['foid']){
														$frontPhotoSrc=DOMAIN.'/Cores/'.$fValue['value'];
													}
													if($fValue['foid']==$frontDesc[0]['foid']){
														$frontDescContent=$fValue['value'];
													}
												}

												echo '<tr>
											          <td>
														<div class="media">
														  <div class="media-left">
														    <a href="#">
														      <img width="60" height="60" class="media-object" src="'.$frontPhotoSrc.'" alt="'.$itemValue->getTitle().'">
														    </a>
														  </div>
														  <div class="media-body">
														    <h4 class="media-heading"><a href="index.php?v=view&&caid='.$_GET['caid'].'&iid='.$itemValue->getIid().'&uid='.$itemValue->getuid().'">'.$itemValue->getTitle().'</a></h4>
														    '.$frontDescContent.'</div>
														</div>
											          </td>
											          '.$secondListField.'
											        </tr>';
											}else{
												echo '<tr>
										          <td>
													<div class="media">
													  <div class="media-left">
													    <a href="#">
													      <img class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGYyYmJiZGE4YyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZjJiYmJkYThjIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" alt="...">
													    </a>
													  </div>
													  <div class="media-body">
													    <h4 class="media-heading"><a href="index.php?v=view">'.$itemValue->getTitle().'</a></h4>
													    </div>
													</div>
										          </td>
										          '.$noDataTips.'
										        </tr>';
											}
										}
									}
								}
							}else{

								if(is_array($searchResult)){
									// $allPages=count($allItems);

									$filedObj=new Cores\Models\FieldsModel();

									$filedOptionObj=new Cores\Models\FieldsOptionsModel();

									$frontPhoto=$filedOptionObj->getFieldFrontPhoto();
									$frontDesc=$filedOptionObj->getFieldDesc();

									foreach ($searchResult as $key => $value) {

										if(!is_array($value)){
											continue;
										}

										foreach ($value as $vkey => $itemValue) {
											if($itemValue['status']!=='1'){
											continue;
										}

										$jsonItemCaid=$itemValue['caid'];
										$jsontmp=$jsonItemCaid;
										$jsonItemCaid=json_decode($itemValue['caid'],true);

										if($jsonItemCaid!==null){
											array_shift($jsonItemCaid);
											$secondListField='';
											$secondFieldCount=0;

											foreach ($jsonItemCaid as $rdCaidKey => $rdCaidValue) {

												if($cataObj->getParentBy2ndLvl($rdCaidValue[0])!=$_GET['caid']){
													continue;
												}

												$rdValue=$cataObj->selectOne($rdCaidValue[0]);
												if($rdValue[0]->getFVisible()==='1'){
													$secondFieldCount++;
								          			$secondListField.='<td><p></p>'.$rdCaidValue[2].'</td>';
								          		}

											}

											if($secondFieldCount<$fieldsCount){
												for ($i=0; $i < ($fieldsCount-$secondFieldCount); $i++) { 
													$secondListField.='<td><p></p>无</d>';
												}
											}

											$frontPhotoSrc='';
											$frontDescContent='';

											$allFields=$filedObj->getByItemId($itemValue['iid']);

											foreach ($allFields as $fKey => $fValue) {
												if($fValue['foid']==$frontPhoto[0]['foid']){
													$frontPhotoSrc=DOMAIN.'/Cores/'.$fValue['value'];
												}
												if($fValue['foid']==$frontDesc[0]['foid']){
													$frontDescContent=$fValue['value'];
												}
											}

											echo '<tr>
										          <td>
													<div class="media">
													  <div class="media-left">
													    <a href="#">
													      <img width="60" height="60" class="media-object" src="'.$frontPhotoSrc.'" alt="'.$itemValue['title'].'">
													    </a>
													  </div>
													  <div class="media-body">
													    <h4 class="media-heading"><a href="index.php?v=view&&caid='.$_GET['caid'].'&iid='.$itemValue['iid'].'&uid='.$itemValue['uid'].'">'.$itemValue['title'].'</a></h4>
													    '.$frontDescContent.'</div>
													</div>
										          </td>
										          '.$secondListField.'
										        </tr>';
										}
										
										}
										
									}
								}else{
									echo '<tr>
							          <td>
										<div class="media">
										  <div class="media-left">
										    <a href="#">
										      <img class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGYyYmJiZGE4YyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZjJiYmJkYThjIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" alt="...">
										    </a>
										  </div>
										  <div class="media-body">
										    <h4 class="media-heading"><a href="index.php?v=view">暂无数据</a></h4>
										    暂无数据</div>
										</div>
							          </td>
							          '.$noDataTips.'
							        </tr>';
								}
								
							}
						?>
						
				      </tbody>

				  </table>

				</div>

				<?php 

					$nextPage=$page+1;

					if($nextPage>$allPages){
					    $nextPage=$allPages;
					}

					$paramClicked='';
					if(!empty($_GET['clicked'])){
						$paramClicked=$_GET['clciked'];
					}

					// alert($prevPage);
					// alert($nextPage);
					// alert($allPages);

				?>

				<div class="col-md-6 col-md-offset-3">
					<nav style="box-shadow:none;text-align: center;">
					  <ul class="pagination">
					    <li>
					      <a href="index.php?v=home&caid=<?php echo $_GET['caid']; ?>&view_type_id=<?php echo $_GET['view_type_id']; ?>&clicked=<?php echo $paramClicked; ?>&page=<?php echo $prevPage; ?>&parent=<?php echo $_GET['parent'] ?>" aria-label="Previous">
					        <span aria-hidden="true">上一页</span>
					      </a>
					    </li>
					    <?php

					    	$pageActive='';
					    	for ($i=1; $i <= $allPages; $i++) {
					    		if($i==$page){
					    			$pageActive='active';
					    		}
					    		echo '<li class="'.$pageActive.'"><a href="index.php?v=home&caid='.$_GET['caid'].'&view_type_id='.$_GET['view_type_id'].'&page='.$page.'">'.$i.'</a></li>';
					    		$pageActive='';
					    	}
					 
					    ?>
					    <li>
					      <a href="index.php?v=home&caid=<?php echo $_GET['caid']; ?>&view_type_id=<?php echo $_GET['view_type_id']; ?>&clicked=<?php echo $paramClicked; ?>&page=<?php echo $nextPage; ?>&parent=<?php echo $_GET['parent'] ?>" aria-label="Next">
					        <span aria-hidden="true">下一页</span>
					      </a>
					    </li>
					  </ul>
					</nav>
				</div>

		  	</div>
		</div>
		

	  	</div>

	</div>
