
<?php

$page=1;
if(!empty($_GET['page'])){
    $page=$_GET['page'];
}

$adsObj=new Cores\Models\AdsModel();
$pageCount=count($adsObj->selectAll());
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

function generateAdsEditingForm($aid,$content,$url,$image,$page){
    return '<div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑广告位
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" method="post" action="admin.php?v='.$_GET['v'].'&action=edit_ads_confirm&aid='.$aid.'&page='.$page.'">
                        '.loadImageUploader('image_edit',$image).'
                        <div class="form-group">
                            <label>广告位描述</label>
                            <input placeholder="广告位描述" value="'.$content.'" name="content_edit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>广告位链接地址</label>
                            <input placeholder="广告位链接地址" value="'.$url.'" name="url_edit" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';
}

if(!empty($_GET['action']) && !empty($_GET['aid'])){
    $aid=$_GET['aid'];
    switch ($_GET['action']) {
        case 'edit_ads':
            $ad=$adsObj->selectOne($aid);
            $content=$ad[0]->getContent();
            $url=$ad[0]->getUrl();
            $image=$ad[0]->getImage();
            $prompt=generateAdsEditingForm($aid,$content,$url,$image,$page);
            break;
        case 'delete_ads':
            $tips='该操作不可恢复,确定要执行吗?';
            $request='admin.php?v='.$_GET['v'].'&action=delete_ads_confirm&aid='.$aid;
            $btnValue='确定执行';
            $prompt=confirm($tips,$request,$btnValue);
            break;
        case 'set_ads_no_display':
            $adsObj->setNoDisplay($aid);
            $prompt=success('设置为不可视成功');
            break;
        case 'set_ads_display':
            $adsObj->setDisplay($aid);
            $prompt=success('设置为可视成功');
            break;
        case 'delete_ads_confirm':
            $adsObj->delete($aid);
            $prompt=success('删除成功');
            break;
        case 'edit_ads_confirm':
            // debug($_POST['content_edit']);
            // debug($_POST['image_edit']);
            // debug($aid);
            // debug($_POST['url_edit']);
            $adsObj->modify($aid,$_POST['content_edit'],DOMAIN.$_POST['image_edit'],$_POST['url_edit']);
            $prompt=success('编辑成功');
            break;
        default:
            break;
    }
}

if(!empty($_GET['action'])){
    switch ($_GET['action']) {
        case 'ads_add':
            debug($_POST['content_add']);
            debug($_POST['image_add']);
            debug($_POST['url_add']);
            if($_POST['content_add']==null || $_POST['image_add']==null || $_POST['url_add']==null){
                alert('有空值!');
            }else{
                $ad=$adsObj->add($_POST['content_add'],DOMAIN.$_POST['image_add'],$_POST['url_add']);
                $prompt=success('添加成功');
            }
            break;
        default:
            break;
    }
}

?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            广告位管理 <small>在这里管理站点的广告位:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">

                    <?php echo $prompt; ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                广告位管理
                            </div>
                            <div class="panel-body">
                                <div>

                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">已有广告位</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">添加广告位</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        
                                        <div style="margin-top:-2px" class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>描述</th>
                                                                <th>图片</th>
                                                                <th>地址</th>
                                                                <th>是否可视</th>
                                                                <th>操作</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $result=$adsObj->selectAll($page);
                                                                if(is_array($result)){
                                                                    $j=$page>1?($page*5)+1:0;
                                                                    foreach ($result as $key => $value) {
                                                                        $j++;
                                                                        $display=$value->getDisplay()=='1'?'可视':'不可视';
                                                                        $displayRequest=$value->getDisplay()=='1'?'set_ads_no_display':'set_ads_display';
                                                                        $displayBtnName=$value->getDisplay()=='1'?'不可视':'可视';
                                                                        echo '<tr>
                                                                                <td>'.$j.'</td>
                                                                                <td>'.$value->getContent().'</td>
                                                                                <td><a target="_blank" href="'.$value->getImage().'"><img width="100" height="100" src="'.$value->getImage().'" ></a></td>
                                                                                <td>'.$value->getUrl().'</td>
                                                                                <td>'.$display.'</td>
                                                                                <td>
                                                                                    <a href="admin.php?v='.$_GET['v'].'&action=edit_ads&aid='.$value->getAid().'&page='.$page.'" class="btn btn-sm btn-primary">编辑</a>
                                                                                    <a href="admin.php?v='.$_GET['v'].'&action='.$displayRequest.'&aid='.$value->getAid().'&page='.$page.'" class="btn btn-sm btn-primary">'.$displayBtnName.'</a>
                                                                                    <a href="admin.php?v='.$_GET['v'].'&action=delete_ads&aid='.$value->getAid().'&page='.$page.'" class="btn btn-sm btn-danger">删除</a>
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

                                        <div class="text-right">
                                            <nav>
                                              <ul class="pagination">
                                                <li>
                                                  <a href="admin.php?v=<?php echo $_GET['v']; ?>&page=<?php echo $prevPage; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                  </a>
                                                </li>
                                                <?php
                                                    $classActive='';
                                                    for ($i=1; $i <= $allPages; $i++) {
                                                        if($i==$page){
                                                            $classActive='class="active"';
                                                        }
                                                        echo '<li><a '.$classActive.' href="admin.php?v='.$_GET['v'].'&page='.$i.'">'.$i.'</a></li>';
                                                    }
                                                ?>
                                                <li>
                                                  <a href="admin.php?v=<?php echo $_GET['v']; ?>&page=<?php echo $nextPage; ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                  </a>
                                                </li>
                                              </ul>
                                            </nav>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <div style="padding-top:20px" class="col-lg-6">
                                        <?php
                                            if(!empty($_GET['action']) && $_GET['action']=='edit_ads'){
                                        ?>
                                            <a href="admin.php?v=<?php echo $_GET['v'] ?>#profile" class="btn btn-primary">请点击左侧导航栏再点击"添加广告位"进行添加</a>
                                        <?php
                                            }else{

                                        ?>
                                            <form role="form" method="post" action="admin.php?v=<?php echo $_GET['v']; ?>&action=ads_add&page=<?php echo $page; ?>">
                                                <?php echo loadImageUploader('image_add') ?>
                                                <div class="form-group">
                                                    <label>广告位描述</label>
                                                    <input placeholder="广告位描述" name="content_add" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>广告位链接地址</label>
                                                    <input placeholder="广告位链接地址" name="url_add" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-default">提交</button>
                                            </form>
                                        <?php
                                            }
                                        ?>
                                            
                                        </div>
                                    </div>

                                  </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
