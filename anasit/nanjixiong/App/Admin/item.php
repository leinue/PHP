<?php

$page=1;
if(!empty($_GET['[page'])){
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

function printItems($itemsObj,$status,$page){
    $allItemObj=$itemsObj->selectAll($page);
    if(is_array($allItemObj)){
        foreach ($allItemObj as $key => $value) {
            if($value['status']===$status){
                echo '<a target="_blank" href="#" class="list-group-item">
                    <span class="badge">'.$value['createTime'].'</span>
                    <i class="fa fa-fw fa-comment"></i> '.$value['caid'].'
                  </a>';
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

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                投稿管理
                            </div>
                            <div class="panel-body">
                                <div>

                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#approved" aria-controls="approved" role="tab" data-toggle="tab">已通过</a></li>
                                    <li role="presentation"><a href="#rejected" aria-controls="rejected" role="tab" data-toggle="tab">待审核</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="approved">
                                        <div style="margin-top:-2px;" class="list-group">

                                            <?php
                                                printItems($itemsObj,'1',$page);
                                            ?>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="rejected">
                                        <div style="margin-top:-2px;" class="list-group">

                                            <?php
                                                printItems($itemsObj,'0',$page);
                                            ?>

                                        </div>
                                    </div>
                                  </div>

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
                        </div>
                    </div>
                </div>
