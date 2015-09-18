<?php

$page=1;
if(!empty($_GET['page'])){
    $page=$_GET['page'];
}

$commentsObj=new Cores\Models\CommentsModel();
$pageCount=count($commentsObj->selectAll());
$allPages=ceil($pageCount/20);

$prevPage=$page-1;
if($prevPage<=0){
    $prevPage=1;
}

$nextPage=$page+1;
if($nextPage>$allPages){
    $nextPage=$allPages;
}

/*********************评分***********************/

$remarksPage=1;
if(!empty($_GET['remarksPage'])){
    $remarksPage=$_GET['remarksPage'];
}

$remarksObj=new Cores\Models\RemarksModel();
$remarksPageCount=count($remarksObj->selectAll());
$allRemarksPages=ceil($remarksPageCount/20);

$remarksPrevPage=$remarksPage-1;
if($remarksPrevPage<=0){
    $remarksPrevPage=1;
}

$remarksNextPage=$remarksPage+1;
if($remarksNextPage>$allRemarksPages){
    $remarksNextPage=$allRemarksPages;
}

$prompt='';

if(!empty($_GET['action']) && !empty($_GET['rid'])){
    $rid=$_GET['rid'];
    switch ($_GET['action']) {
        case 'edit_comments':
            $request='action=edit_comments_confirm&rid='.$rid;
            $commentContent=$commentsObj->selectOne($rid);
            $prompt=generatorCommentsEditingForm($commentContent[0]->getContent(),$request);
            break;
        case 'delete_comments':
            $tips='该操作不可恢复,确定要执行吗?';
            $request='admin.php?v='.$_GET['v'].'&action=delete_comments_confirm&rid='.$rid;
            $btnValue='确定执行';
            $prompt=confirm($tips,$request,$btnValue);
            break;
        case 'view_comments':
            $request='action=edit_comments_confirm&rid='.$rid;
            $commentContent=$commentsObj->selectOne($rid);
            $prompt=generatorCommentsViewingForm($commentContent[0]->getContent(),$commentContent[0]->getCreateTime(),'#',$request,$commentContent[0]->getRid());
            break;
        case 'delete_comments_confirm':
            $commentsObj->delete($rid);
            $prompt=success('删除成功');
            break;
        default:
            break;
    }
}

if(!empty($_GET['action']) && !empty($_GET['remarkId'])){
    $remarkId=$_GET['remarkId'];
    switch ($_GET['action']) {
        case 'edit_remarks':
            $request='action=edit_remarkId_confirm&remarkId='.$remarkId;
            $remarksPoints=$remarksObj->selectOne($remarkId);
            $prompt=generatorCommentsEditingForm($remarksPoints[0]->getPoints(),$request);
            break;
        case 'delete_remarks':
            $tips='该操作不可恢复,确定要执行吗?';
            $request='admin.php?v='.$_GET['v'].'&action=delete_remakrs_confirm&remarkId='.$remarkId;
            $btnValue='确定执行';
            $prompt=confirm($tips,$request,$btnValue);
            break;
        case 'delete_remakrs_confirm':
            $remarksObj->delete($remarkId);
            $prompt=success('删除成功');
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
                            评论/评分管理 <small>在这里管理站点的评论和评分:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">

                    <?php echo $prompt; ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                评论/评分管理
                            </div>
                            <div class="panel-body">
                                
                                <div>

                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">评论管理</a></li>
                                    <li role="presentation"><a href="#points" aria-controls="points" role="tab" data-toggle="tab">评分管理</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="comments">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="item-approved-list">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>所属投稿</th>
                                                        <th>内容</th>
                                                        <th>创建时间</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $result=$commentsObj->selectAll($page);
                                                        $itemObj=new Cores\Models\ItemsModel();
                                                        $j=$page>1?($page*5)+1:0;
                                                        if(is_array($result)){
                                                            foreach ($result as $key => $value) {
                                                                $j++;
                                                                $itemName=$itemObj->selectOne($value['itemId']);
                                                                if(!is_object($itemName[0])){
                                                                    continue;
                                                                }    
                                                                $itemName=$itemName[0]->getTitle();
                                                                echo '  <tr>
                                                                            <td>'.$j.'</td>
                                                                            <td>'.$itemName.'</td>
                                                                            <td>'.cutOutStr($value['content']).'</td>
                                                                            <td>'.$value['createTime'].'</td>
                                                                            <td>
                                                                                <a href="admin.php?v='.$_GET['v'].'&action=view_comments&rid='.$value['rid'].'&page='.$page.'" class="btn btn-primary btn-sm">查看</a>
                                                                                <a href="admin.php?v='.$_GET['v'].'&action=edit_comments&rid='.$value['rid'].'&page='.$page.'" class="btn btn-primary btn-sm">修改</a>
                                                                                <a href="admin.php?v='.$_GET['v'].'&action=delete_comments&rid='.$value['rid'].'&page='.$page.'" class="btn btn-danger btn-sm">删除</a>
                                                                            </td>
                                                                        </tr>';
                                                            }
                                                        }
                                                                                                       
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
                                    <div role="tabpanel" class="tab-pane" id="points">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="item-approved-list">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>所属文章</th>
                                                        <th>分值</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $result=$remarksObj->selectAll($remarksPage);
                                                        $itemObj=new Cores\Models\ItemsModel();
                                                        $j=$remarksPage>1?($remarksPage*5)+1:0;
                                                        if(is_array($result)){
                                                            foreach ($result as $key => $value) {
                                                                $j++;
                                                                $itemName=$itemObj->selectOne($value->getItemId());
                                                                $itemName=$itemName[0]->getTitle();
                                                                echo '  <tr>
                                                                            <td>'.$j.'</td>
                                                                            <td>'.$itemName.'</td>
                                                                            <td>'.$value->getPoints().'</td>
                                                                            <td>
                                                                                <a href="admin.php?v='.$_GET['v'].'&action=view_reamrks&remarkId='.$value->getRemarkId().'&remarksPage='.$remarksPage.'" class="btn btn-primary btn-sm">查看</a>
                                                                                <a href="admin.php?v='.$_GET['v'].'&action=edit_remarks&remarkId='.$value->getRemarkId().'&remarksPage='.$remarksPage.'" class="btn btn-primary btn-sm">修改</a>
                                                                                <a href="admin.php?v='.$_GET['v'].'&action=delete_remarks&remarkId='.$value->getRemarkId().'&remarksPage='.$remarksPage.'" class="btn btn-danger btn-sm">删除</a>
                                                                            </td>
                                                                        </tr>';
                                                            }
                                                        }                                              
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-right">
                                            <nav>
                                              <ul class="pagination">
                                                <li>
                                                  <a href="admin.php?v=<?php echo $_GET['v'] ?>&remarksPage=<?php echo $remarksPrevPage; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                  </a>
                                                </li>
                                                <?php
                                                    $classActive='';
                                                    for ($i=1; $i <= $allRemarksPages; $i++) {
                                                        if($i==$remarksPage){
                                                            $classActive='class="active"';
                                                        }
                                                        echo '<li><a '.$classActive.' href="admin.php?v='.$_GET['v'].'&remarksPage='.$i.'">'.$i.'</a></li>';
                                                    }
                                                ?>
                                                <li>
                                                  <a href="admin.php?v=<?php echo $_GET['v'] ?>&remarksPage=<?php echo $remarksNextPage; ?>" aria-label="Next">
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
