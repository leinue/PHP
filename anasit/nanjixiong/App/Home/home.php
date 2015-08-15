<?php
	
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
		if($current==$to){
			return 'class="badge"';
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
	}
?>
	<div class="row">

	  	<div class="col-md-10 col-md-offset-1">
	  	<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-12">

					<?php
						if(is_array($secondList)){
							foreach ($secondList as $key => $value) {
								if($value['visible']==='0'){
									continue;
								}
								$list='';
								$rdList=$cataObj->getCataChild($value['caid']);
								if(is_array($rdList)){
									foreach ($rdList as $childKey => $childValue) {
										if($childValue['child']!='second' && $childValue['visible']==='1'){
											$list.='<a style="color:rgb(68,68,68)" href="index.php?v=home&caid='.$caid.'&view_type_id='.$childValue['caid'].'"> <span '.displayBadge($_GET['view_type_id'],$childValue['caid']).'>'.$childValue['name'].'</span></a>';
										}
									}
								}
								if($list==''){
									$list='暂无数据';
								}
								echo '<div class="cata-list">
										<div class="col-md-2">
											'.$value['name'].'：<a href="index.php?v=home&caid='.$caid.'&view_type_id=all"> <span '.displayBadge($_GET['view_type_id'],'all').'>全部</span></a>
										</div>
										<div class="cata-3rd-list" class="col-md-10">
											'.$list.'
										</div>
									</div>';
							}
						}
					?>
					
				</div>
			</div>
		</div>

		<div class="panel panel-default">
		  	<div style="padding:0px!important" class="panel-body">
				<div class="table-responsive">
				  <table class="table">
				  <thead>
			        <tr>
			          <th>项目资料</th>
			          <?php
			          	if(is_array($secondList)){
			          		foreach ($secondList as $key => $value) {
			          			if($value['fvisible']==='1'){
			          				echo '<th>'.$value['name'].'</th>';
			          			}
			          		}
			          	}
			          ?>
			        </tr>
			      </thead>
				    <tbody style="border-bottom: 1px solid rgb(221,221,221);">
						
						<?php
							if(is_array($cataList)){
								$filedObj=new Cores\Models\FieldsModel();
								$filedOptionObj=new Cores\Models\FieldsOptionsModel();
								$itemsObj=new Cores\Models\ItemsModel();
								$allItems=$itemsObj->selectAll();
								$allFields=$filedObj->selectAll();
								if(is_array($allItems)){
									foreach ($allItems as $itemKey => $itemValue) {
										$jsonItemCaid=$itemValue->getCaid();
										$jsonItemCaid=json_decode($jsonItemCaid);
										if($jsonItemCaid!==null && $itemValue->getStatus()==='1' && in_array($_GET['caid'], $jsonItemCaid) ){
											if(is_array($allFields)){
												array_shift($jsonItemCaid);
												foreach ($allFields as $fieldKey => $fieldValue) {
													
												}

												$secondListField='';

												foreach ($jsonItemCaid as $rdCaidKey => $rdCaidValue) {

													$rdValue=$cataObj->selectOne($rdCaidValue[0]);
													if($rdValue[0]->getFVisible()==='1'){
									          			$secondListField.='<td><p></p>'.$rdCaidValue[2].'</td>';
									          		}

												}

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
										          <td><p></p>钟凯程</td>
										          <td><p></p>电子商务</td>
										          <td><p></p>天使轮</td>
										        </tr>';
											}
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
							          <td><p></p>暂无数据</td>
							          <td><p></p>暂无数据</td>
							          <td><p></p>暂无数据</td>
							        </tr>';
							}
						?>
						
				      </tbody>

				  </table>

				</div>

				<div class="col-md-6 col-md-offset-3">
					<nav style="box-shadow:none;text-align: center;">
					  <ul class="pagination">
					    <li>
					      <a href="#" aria-label="Previous">
					        <span aria-hidden="true">上一页</span>
					      </a>
					    </li>
					    <li class="active"><a href="#">1</a></li>
					    <li><a href="#">2</a></li>
					    <li><a href="#">3</a></li>
					    <li><a href="#">4</a></li>
					    <li><a href="#">5</a></li>
					    <li>
					      <a href="#" aria-label="Next">
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