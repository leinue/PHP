<?php

$page=1;
if(empty($_GET['[page'])){
    $page=$_GET['page'];
}

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

$prompt='';

if(!empty($_GET['action']) && !empty($_GET['iid'])){
    
    $iid=$_GET['iid'];

    $itemsObj=new Cores\Models\ItemsModel();

    switch ($_GET['action']) {
        case 'reject_item':
            $result=$itemsObj->reject($iid);
            $prompt=success('拒绝成功');
            break;
        case 'approve_item':
            $result=$itemsObj->approve($iid);
            $prompt=success('通过成功');
            break;
        case 'view_comments':
            // $result=$itemsObj->
            break;
        case 'up_order':
            $result=$itemsObj->upOrder($iid);
            $prompt=success('升级成功');
            break;
        case 'down_order':
            $result=$itemsObj->downOrder($iid);
            $prompt=success('降级成功');
            break;
	case 'set_top':
		$result=$itemsObj->setTop($iid);
		$prompt=success('设置置顶成功');
		break;
	case 'set_untop':
		$result=$itemsObj->setUnTop($iid);
		$prompt=success('取消置顶成功');
		break;
        case  'delete_item':
            $tips='该操作不可恢复,确定要执行吗?';
		if(isset($_GET['fucku'])){
			$caonimabi_nanjixiong = '&fucku=v';
		}
            $request='admin.php?v='.$_GET['v'].'&action=delete_item_confirm&iid='.$iid.$caonimabi_nanjixiong;
            $btnValue='确定执行';
            $prompt=confirm($tips,$request,$btnValue);
            break;
        case 'delete_item_confirm':
            $result=$itemsObj->delete($iid);
            $prompt=success('删除成功');
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
	            foreach ($fieldList as $key => $value) {
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

function printItems($itemsObj,$status,$page){
    $allItemObj=$itemsObj->selectAll($page,false,true);
	if($status == '0'){
		$allItemObj = $itemsObj -> selectAllUnApproved($page);
		$method = '&fucku=v';
	}
    if(is_array($allItemObj)){
        $j=$page>1?($page*5+1):0;
        foreach ($allItemObj as $key => $value) {
            if($value['status']===$status){
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

                $publisher=$userObj->selectOne($value['uid']);
                if(is_object($publisher[0])){
                    $publisher=$publisher[0]->getName();
                }

                $btnName=$status=='1'?'拒绝':'通过';
                $action=$status=='1'?'admin.php?v='.$_GET['v'].'&action=reject_item&iid='.$value['iid'].'&page='.$page:'admin.php?v='.$_GET['v'].'&action=approve_item&iid='.$value['iid'].'&page='.$page.$method;
                $order=$status=='1'?'
                            <a href="admin.php?v='.$_GET['v'].'&action=view_comments&iid='.$value['iid'].'&page='.$page.$method.'" class="btn btn-primary btn-sm">评论列表</a>
                            <a href="admin.php?v='.$_GET['v'].'&action=up_order&iid='.$value['iid'].'&page='.$page.$method.'" class="btn btn-primary btn-sm">向上</a>
                            <a href="admin.php?v='.$_GET['v'].'&action=down_order&iid='.$value['iid'].'&page='.$page.$method.'" class="btn btn-primary btn-sm">向下</a>':'';
		$setTopBtn = $value['_top'] === '10'?'取消置顶':'置顶';
		$topBtnReq = $value['_top'] === '10'?'admin.php?v='.$_GET['v'].'&page='.$_GET['page'].'&action=set_untop&iid='.$value['iid'].$method:'admin.php?v='.$_GET['v'].'&page='.$_GET['page'].'&action=set_top&iid='.$value['iid'].$method;
                echo '<tr>
                        <td></td>
                        <td>'.$value['title'].'</td>
                        <td>'.$cataString.'</td>
                        <td>'.$publisher.'</td>
                        <td>'.$value['createTime'].'</td>
                        <td>
			    <a href="'.$topBtnReq.'" class="btn btn-sm btn-primary">'.$setTopBtn.'</a>
                            <a href="admin.php?v='.$_GET['v'].'&action=edit_item&iid='.$value['iid'].$method.'" class="btn btn-sm btn-primary">编辑</a>
                            <a target="_blank" href="index.php?v=view&iid='.$value['iid'].'&uid='.$value['uid'].'" class="btn btn-primary btn-sm">查看</a>
                            <a href="'.$action.'" class="btn btn-primary btn-sm">'.$btnName.'</a>
                            '.$order.'
                            <a href="admin.php?v='.$_GET['v'].'&action=delete_item&iid='.$value['iid'].'&page='.$page.$method.'" class="btn btn-danger btn-sm">删除</a>
                        </td>
                    </tr>';
                $cataString='';
            }
        }
    }else{
        echo '暂无数据';
    }
}

?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            投稿管理 <small>在这里管理站点的投稿:)</small>
                        </h1>
                    </div>
                </div>
    
                <div class="row">

                <?php 
                    echo $prompt;
                ?>

                <?php
                    if(!empty($_GET['action']) && !empty($_GET['iid'])){
                        switch ($_GET['action']) {
                            case 'edit_item':
                                case 'edit_item':
                                    $fieldOptions=new Cores\Models\FieldsOptionsModel();
                                    // $field=new Cores\Models\FieldsModel();
                                    $fieldList=$fieldOptions->selectAll();
                                    $suffix='_edit';
                                    $action='admin.php?v='.$_GET['v'].'&action=edit_item_confirm&iid='.$_GET['iid'];
                                    generatorItemAddingForm($fieldList,$suffix,$action,true);
                                break;
                            default:
                                break;                            
                        }
                    }
                ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                投稿管理
                            </div>
                            <div class="panel-body">
                                <div>

                                  <ul class="nav nav-tabs" id="mytabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#approved" aria-controls="approved" role="tab" data-toggle="tab">已通过</a></li>
                                    <li role="presentation"><a href="#rejected" aria-controls="rejected" role="tab" data-toggle="tab">待审核</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="approved">
                                        <div style="margin-top:-2px" class="panel panel-default">

                                            <div class="panel-heading">
                                                已通过的投稿,可以在这里进行一些操作
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="item-approved-list">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>主题</th>
                                                                <th>所属分类</th>
                                                                <th>发布者</th>
                                                                <th>发布时间</th>
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
                                                          <a href="admin.php?v=<?php echo $_GET['v'] ?>&page=<?php echo $prevPage; ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                          </a>
                                                        </li>
                                                        <?php
								if(isset($_GET['fucku'])){
									echo "
										<script>
										$(function(){
											$('#mytabs li a:last-child').tab('show');
										});
										</script>
										";
								}
				
                                                            $classActive='';
                                                            for ($i=1; $i <= $allPages; $i++) {
                                                                if($i==$page){
                                                                    $classActive='class="active"';
                                                                }
                                                                echo '<li><a '.$classActive.' href="admin.php?v='.$_GET['v'].'&page='.$i.'">'.$i.'</a></li>';
                                                            }
                                                        ?>
                                                        <li>
                                                          <a href="admin.php?v=<?php echo $_GET['v'] ?>&page=<?php echo $nextPage; ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                          </a>
                                                        </li>
                                                      </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="rejected">
                                        <div class="table-responsive">
                                                    <table class="table table-hover" id="item-approved-list">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>主题</th>
                                                                <th>所属分类</th>
                                                                <th>发布者</th>
                                                                <th>发布时间</th>
                                                                <th>操作</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                printItems($itemsObj,'0',$page);
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                    </div>
                                  </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
