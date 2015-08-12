<?php

$tips='';

if(!empty($_POST['new_cata_name'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->add($_POST['new_cata_name']);
    $tips=success('添加成功');
}

if(!empty($_GET['cata_to_del'])){
    $tips=confirm('<strong>警告!</strong>该操作不可恢复,您确定要执行该操作吗?','admin.php?v='.$view.'&cata_to_del_confirm='.$_GET['cata_to_del'],'确定删除');
}

if(!empty($_GET['cata_to_del_confirm'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->delete($_GET['cata_to_del_confirm']);
    $tips=success('删除成功');
}

if(!empty($_GET['cata_to_view'])){
    // $tips=modal('test','test');
}

?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

                <div class="modal fade modal-view-cata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">查看详情</h4>
                      </div>
                      <div class="modal-body">
                        <div>

                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab">筛选字段列表</a></li>
                            <li role="presentation"><a href="#add_selector_fields" aria-controls="add_selector_fields" role="tab" data-toggle="tab">添加筛选字段</a></li>
                            <li role="presentation"><a href="#edit_selector_fields" aria-controls="edit_selector_fields" role="tab" data-toggle="tab">修改筛选字段</a></li>
                          </ul>

                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="list">
                                <div style="margin-top:-2px!important;" class="panel panel-default">
                                    <div class="panel-heading">
                                        <form role="form">
                                            <div class="form-group">
                                                <label>筛选字段总名称</label>
                                                <input placeholder="显示在筛选页面左边的名称" name="cata_selector_name" class="form-control">
                                            </div>
                                        </form>                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="cata_field_list">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>名称</th>
                                                        <th>父结点</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="add_selector_fields">
                                <div role="tabpanel" class="tab-pane active" id="list">
                                    <div style="margin-top:-2px!important;" class="panel panel-default">
                                        <div class="panel-heading">
                                            添加筛选字段名称
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <input placeholder="显示在筛选页面右边的名称" name="cata_selector_name" id="cata_selector_name" class="form-control">
                                                </div>
                                            </div>
                                            <div style="text-align:center" class="col-md-2">
                                                <a class="btn btn-primary" id="cata_selector_add">添加</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="edit_selector_fields">edit_selector_fields</div>
                          </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary">保存设置</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            分类管理 <small>在这里管理页面的分类:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                <?php echo $tips; ?>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                添加分类页面
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <form role="form" action="admin.php?v=<?php echo $view; ?>" method="post">
                                        <div class="form-group">
                                            <label>分类名</label>
                                            <input placeholder="南极熊" name="new_cata_name" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-default">提交</button>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             已有分类页面
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>一级分类名称</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $cataMgr=new Cores\Models\CataModel();
                                        $allCataObj=$cataMgr->selectAll();
                                        if(is_array($allCataObj)){
                                            foreach ($allCataObj as $key => $value) {
                                                if($value->getParent()==='0'){
                                                    echo '<tr class="odd gradeX">
                                                        <td>'.$value->getName().'</td>
                                                        <td style="text-align:center">
                                                            <a ref="admin.php?v='.$view.'&cata_to_view='.$value->getCaid().'" class="btn btn-primary btn-sm view_cata" data-toggle="modal" data-whatever="'.$value->getCaid().'=='.$value->getName().'" data-target=".modal-view-cata">详细</a>
                                                            <a href="admin.php?v='.$view.'&cata_to_del='.$value->getCaid().'" class="btn btn-danger btn-sm">删除</a>
                                                        </td>
                                                    </tr>';
                                                }
                                            }
                                        }else{
                                            echo '<tr class="odd gradeX">
                                                <td>暂无分类</td>
                                                <td style="text-align:center">
                                                    暂无分类
                                                </td>
                                            </tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                    <nav>
                                      <ul class="pagination">
                                      <?php

                                        $count=ceil(count($allCataObj)/10);

                                        if($count>0){
                                            echo '<li>
                                                  <a href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                  </a>
                                                </li>';

                                            for ($i=1; $i <= $count; $i++) {
                                                echo '<li><a href="#">'.$i.'</a></li>'; 
                                            }

                                            echo '<li>
                                                  <a href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                  </a>
                                                </li>';
                                        }

                                      ?>
                                      </ul>
                                    </nav>
                                </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
