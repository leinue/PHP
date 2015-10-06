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

		if(empty($_GET['iid'])){
			$name=$_POST['name_edit'];
			$photo=$_POST['photo_edit'];
			$region=$_POST['region_edit'];
			$url=$_POST['url_edit'];
			$description=$_POST['description_edit'];
			
			$usersObj->modify($_GET['uid'],$name,DOMAIN.$photo,$region,$url,$description);
			redirectTo('index.php?v=account&uid='.$_GET['uid']);
		}else{

			$iid=$_GET['iid'];
		    $uid= $_GET['uid'];

		    $itemsObj=new Cores\Models\ItemsModel();

		    switch ($_GET['action']) {
		    	case  'delete_item':
		            $tips='该操作不可恢复,确定要执行吗?';
		            $request='index.php?v='.$_GET['v'].'&action=delete_item_confirm&iid='.$iid.'&uid='.$_GET['uid'];
		            $btnValue='确定执行';
		            $prompt=confirm($tips,$request,$btnValue);
		            break;
	        	case 'delete_item_confirm':
	        		if($_SESSION['uid']!=$uid){
	        			alert('对不起,您没有此权限');
	        		}else{
					$result=$itemsObj->delete($iid);
		            		$prompt=success('删除成功');
	        		}
		            break;
		        case 'edit_item_confirm':
		            $fieldOptions=new Cores\Models\FieldsOptionsModel();
		            $field=new Cores\Models\FieldsModel();
		           // $fieldList=$field->getByItemId($_GET['iid']);
			    $fieldList = $fieldOptions -> selectAll(true);
		            $itemObj=new Cores\Models\ItemsModel();
		            $cataObj=new Cores\Models\CataModel();
		            $uid=$_SESSION['uid'];
		            $caid=$_POST['item_cata_edit'];
		            $caidList=array();
		            $rdValueList=array();
		            $title=$_POST['item_theme_edit'];
		            $count=null;
		            if(!empty($_GET['count'])){
		                $count=$_GET['count'];
		            }else{
		                alert('count未定义');
		                redirectTo('admin.php?v='.$_GET['v']);
		            }

		            if($title==null || $caid==null){
		                alert('项目类别或项目主题不能为空');
		                redirectTo('admin.php?v='.$_GET['v']);
		            }
			
			$fstCata = $cataObj->select1stLevelCata();
			for($f = 0;$f<count($fstCata); $f++){
				if($fstCata[$f]['name'] === $caid){
					$caid = $fstCata[$f]['caid'];
					break;
				}	
			}

	
		            array_push($caidList,$caid);

		            $secondList=$cataObj->getSecond();

		            if(is_array($secondList)){
		                foreach ($secondList as $key => $value) {
		                    $list='';
		                    array_push($rdValueList, $value['caid']);
		                    $rdList=$cataObj->getCataChild($value['caid']);
		                    if(is_array($rdList)){
		                        foreach ($rdList as $childKey => $childValue) {
		                            if($childValue['child']!='second' && $childValue['caid']==$_POST['item_'.$value['name'].'_cata_edit']){
		                                array_push($rdValueList, $childValue['caid']);
		                                array_push($rdValueList, $childValue['name']);
		                            }
		                            if(is_array($_POST['item_'.$value['name'].'_cata_edit'])){
	                                    array_push($rdValueList,$_POST['item_'.$value['name'].'_cata_edit']);

	                                }
		                        }
		                    }
		                    array_push($caidList, $rdValueList);
		                    $rdValueList=array();
		                }
		            }

		            $caidJSON='';

		            $caidJSON=json_encode($caidList);

		            $itemAdded=$itemObj->modify($_GET['iid'],$caidJSON,$title);
		            $itemId=$_GET['iid'];
		            
		            if($itemId==null){
		                alert('修改投稿失败,请重试!');
		            }else{
		                if(is_array($fieldList)){
				    $index = 1;
		                    foreach ($fieldList as $key => $value) {
		                        //$oid=$value['oid'];
					$oid = $field->getOidByItemIDAndFoid($_GET['iid'],$value['foid']);
					$oid = $oid[0]['oid'];
		                        $name=$fieldOptions->getNameByFoid($value['foid']);
		                        $v=$_POST['item_'.$name[0]['name'].'_edit'];
					$v2='{{no data}}';
					if(count($name)>=2){
						$v2=$_POST['item_'.$name[1]['name'].'_edit'];	
					}
					
					if($oid != ''){
		                        	$field->modify($oid,$v);
						if($v2!='{{no data}}'){
							$field->modify($oid,$v2);
						}
					}else{
						$field->add($value['foid'],$v,$_GET['iid']);
					}
					
					$index+=1;
		                    }
		                    $prompt=success('修改成功');
		                }else{
		                    alert('字段值为空');
		                }
		            }
		    	default:
		    		break;
		    }

		}
				
	}

	$defaultImage=$userObj->getPhoto();
	$defaultImage=$defaultImage==='0'?'default.png':str_replace(DOMAIN, '', $userObj->getPhoto());
	$defaultImage=DOMAIN.'/Cores/../'.$defaultImage;

	$page=1;
	if(isset($_GET['page'])){
	    $page=$_GET['page'];
	}

	$realPage = $page;

//	if(isset($_GET['page'])){
//	    echo "<script>$('#myTabs a:last').tab('show');</script>";
//	}

	$itemsObj=new Cores\Models\ItemsModel();
	$pageCount=count($itemsObj->selectAll());
	$allPages=ceil($pageCount/20);

	$prevPage=$page-1;
	if($prevPage<=0){
	    $prevPage=1;
	}

	$nextPage=$page+1;
	if($nextPage>$allPages){
	    $nextPage=$allPages;
	}
	function printItems($itemsObj,$status,$page){
	    $allItemObj=$itemsObj->getUserItem($_GET['uid'],$page);
	    if(is_array($allItemObj)){
	        $j=$page>1?($page*10)-10:0;
	        foreach ($allItemObj as $key => $value) {
	           // if($value['status']===$status){
	                $j++;
	                $cataObj=new Cores\Models\CataModel();
	                $userObj=new Cores\Models\UsersModel();
	                $singleCaid=json_decode($value['caid']);
	                $cataString='';
	                
	                if(is_array($singleCaid)){
	                    foreach ($singleCaid as $k => $scaid) {
	                        $cataName=$cataObj->selectOne($scaid,true);
	                        $cataString.=$cataName[0]['name'];
	                        break;
	                    }
	                }else{
	                    $cataString=$cataObj->selectOne($value['caid'],true);
	                    $cataString=$cataString[0]['name'];
	                }

	                if($value['uid']!=$_GET['uid']){
	                	continue;
	                }

			$isApproved = $value['status']==='0'?'未通过':'已通过';
	                echo '<tr>
	                        <td>'.$j.'</td>
	                        <td>'.$value['title'].'</td>
	                        <td>'.$cataString.'</td>
	                        <td>'.$value['createTime'].'</td>
				<td>'.$isApproved.'</td>
	                        <td>
	                            <a href="index.php?v='.$_GET['v'].'&action=edit_item&iid='.$value['iid'].'&uid='.$_GET['uid'].'" class="btn btn-sm btn-primary">编辑</a>
	                            <a target="_blank" href="index.php?v=view&iid='.$value['iid'].'&uid='.$value['uid'].'" class="btn btn-primary btn-sm">查看</a>
	                            <a href="index.php?v='.$_GET['v'].'&action=delete_item&uid='.$_GET['uid'].'&iid='.$value['iid'].'&page='.$page.'" class="btn btn-danger btn-sm">删除</a>
	                        </td>
	                    </tr>';
	                $cataString='';
	           // }
	        }
	    }else{
	        echo '暂无数据';
	    }
	}

?>
	<div class="row">

		<div class="col-md-10 col-md-offset-1">
			<?php
                if(!empty($_GET['action']) && !empty($_GET['iid'])){
                    switch ($_GET['action']) {
                        case 'edit_item':
                            case 'edit_item':
                                $fieldOptions=new Cores\Models\FieldsOptionsModel();
                                // $field=new Cores\Models\FieldsModel();
                                $fieldList=$fieldOptions->selectAll();
                                $suffix='_edit';
                                $action='index.php?v='.$_GET['v'].'&action=edit_item_confirm&iid='.$_GET['iid'].'&uid='.$_GET['uid'];
                                generatorItemAddingForm($fieldList,$suffix,$action,true);
                            break;
                        default:
                            break;                            
                    }
                }
            ?>
		</div>

	  	<div class="col-md-10 col-md-offset-1">
	  		<?php echo $prompt; ?>
			
		  	<div class="panel panel-default">
		  		<div class="panel-heading">
			    	<h3 class="panel-title">用户信息</h3>
			  	</div>
				<div class="panel-body">

					<div>
					  <ul class="nav nav-tabs" id="myTabs" role="tablist">
					    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
					    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">项目列表</a></li>
					  </ul>

					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="home">
					    	
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
					    <div role="tabpanel" class="tab-pane" id="profile">

					    	<div style="margin-top:0px!important" class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>主题</th>
                                            <th>所属分类</th>
                                            <th>发布时间</th>
					    <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            printItems($itemsObj,'1',$page);
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right">
                                <nav>
                                  <ul class="pagination">
                                    <li>
                                      <a href="index.php?v=<?php echo $_GET['v'] ?>&page=<?php echo $prevPage; ?>&uid=<?php echo $_GET['uid'] ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                      </a>
                                    </li>
                                    <?php
                                        $classActive='';
					$tmp=$itemsObj->getUserItem($_GET['uid'],false);
					$allPages = $tmp[0]['c'];
					$allPages = ceil($allPages/10);
                                        for ($i=1; $i <= $allPages; $i++) {
                                            if($i==$page){
                                                $classActive='class="active"';
                                            }
                                            echo '<li '.$classActive.'><a '.$classActive.' href="index.php?v='.$_GET['v'].'&page='.$i.'&uid='.$_GET['uid'].'">'.$i.'</a></li>';
                                        }
					
					$finalURL = "index.php?v=".$_GET['v'].'&uid='.$_GET['uid'].'&page=';			

                                    ?>
                                    <li>
                                      <a href="index.php?v=<?php echo $_GET['v'] ?>&page=<?php echo $nextPage; ?>&uid=<?php echo $_GET['uid']; ?>&iid=<?php echo $_GET['uid'] ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                      </a>
                                    </li>
                                  </ul>
                                </nav>
                            </div>

					    </div>
					  </div>

					</div>
					
				</div>
			</div>
		</div>

	</div>
<?php

	if(isset($_GET['page'])){
	    echo "<script>
			$(function(){
				$('#myTabs li a:last-child').tab('show');
			});
		</script>";
	}

?>

<script>

	$('.pagination').jqPaginator({
			
			totalPages: <?php echo $allPages; ?>,
			visiblePages: 10,
			currentPage: <?php echo $page; ?>,
			first: '<li class="first"><a href="javascript:void(0);">首页<\/a><\/li>',
           		prev: '<li class="prev"><a href="javascript:void(0);"><i class="arrow arrow2"><\/i>上一页<\/a><\/li>',
            		next: '<li class="next"><a href="javascript:void(0);">下一页<i class="arrow arrow3"><\/i><\/a><\/li>',
            		last: '<li class="last"><a href="javascript:void(0);">末页<\/a><\/li>',
           		 page: '<li class="page"><a href="javascript:void(0);">{{page}}<\/a><\/li>',
			onPageChange: function(num,type){
				console.log(num);
				if(num != <?php echo $page; ?>){
					window.location.href=<?php echo "'".$finalURL."'"; ?>+num;
				}
			}		

		});


</script>
