<?php

$tips='';

if(!empty($_POST['new_cata_name'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->addSecond($_POST['new_cata_name'],$_POST['new_top_lvl']);
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

if(!empty($_GET['set_no_visible'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->setNoVisible($_GET['set_no_visible']);
    $tips=success('设置不可视成功');
}

if(!empty($_GET['set_visible'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->setVisible($_GET['set_visible']);
    $tips=success('设置可视成功');
}

if(!empty($_GET['set_front_no_visible'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->setNoFVisible($_GET['set_front_no_visible']);
    $tips=success('设置前台不显示成功');
}

if(!empty($_GET['set_front_visible'])){
    $cataObj=new Cores\Models\CataModel();
    $cataObj->setFVisible($_GET['set_front_visible']);
    $tips=success('设置前台显示成功');
}

// alert($_POST['edit_cata_name']);

if(!empty($_GET['action'])){
    if($_POST['cata_name_edit_text']==null || $_GET['action']!='edit_cata_name'){
        alert('修改内容不能为空或请求非法');
    }else{
        $cataObj=new Cores\Models\CataModel();
        $cataObj->modify($_GET['caid'],$_POST['cata_name_edit_text']);
        $cataObj->modifyParent($_GET['caid'],$_POST['edit_top_lvl']);
    }
}

if(!empty($_GET['cata_to_edit'])){
    $cataObj=new Cores\Models\CataModel();
    $name=$cataObj->selectOne($_GET['cata_to_edit']);
    $option='';
    $allCataObj=$cataObj->selectAll();
    $firstCaid=array();
    $parent=$cataObj->getParent($_GET['cata_to_edit']);
    $parentId=$parent[0]['caid'];
    if(is_array($allCataObj)){
        $i=0;
        foreach ($allCataObj as $key => $value) {
            if($value->getParent()==='0' && $value->getVisible()==='1'){
                array_push($firstCaid, $value->getCaid());
                $active='';
                if($value->getCaid()==$parentId){
                    $active='selected';
                }
                $option.='<option '.$active.' value="'.$value->getCaid().'">'.$value->getName().'</option>';
                $i++;
            }
        }
    }else{
        echo '';
    }
    $tips='<div role="tabpanel" class="tab-pane" id="edit_cata_field">
                <div role="tabpanel" class="tab-pane active" id="list">
                    <div style="margin-top:-2px!important;" class="panel panel-default">
                        <div class="panel-heading">
                            编辑筛选分类名称
                        </div>
                        <div class="panel-body">
                            <form action="admin.php?v='.$_GET['v'].'&action=edit_cata_name&caid='.$_GET['cata_to_edit'].'" method="post">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input placeholder="筛选分类名称" value="'.$name[0]->getName().'" name="cata_name_edit_text" id="cata_name_edit_text" class="form-control">
                                    </div>
                                    <select name="edit_top_lvl" class="form-control">
                                        '.$option.'
                                    </select>
                                </div>
                                <div style="text-align:center" class="col-md-2">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
}

if(!empty($_GET['cata_to_up'])){

    $cataObj=new Cores\Models\CataModel();
    $cataObj->upCata($_GET['cata_to_up']);
    $tips=success('提级成功');

}

if(!empty($_GET['cata_to_down'])){

    $cataObj=new Cores\Models\CataModel();
    $cataObj->downCata($_GET['cata_to_down']);
    $tips=success('提级失败');
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
                                        这里显示已有的筛选字段
                                        <!-- <form role="form">
                                            <div class="form-group">
                                                <label>
                                                    <a id="edit_second_level_name" class="btn btn-primary">修改</a>
                                                    筛选字段总名称
                                                </label>
                                                <input placeholder="显示在筛选页面左边的名称" id="second_name_area" name="cata_selector_name" class="form-control">
                                                
                                            </div>
                                        </form>  -->                                       
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="cata_field_list">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>名称</th>
                                                        <th>父结点</th>
                                                        <th>操作</th>
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
                            <div role="tabpanel" class="tab-pane" id="edit_selector_fields">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="cata_edit_field_list">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>原名称</th>
                                                <th>修改为</th>
                                                <th>确认</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <!-- <button type="button" class="btn btn-primary">保存设置</button> -->
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            筛选字段管理 <small>在这里管理筛选字段:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $tips; ?>
                        <?php
                            $cataMgr=new Cores\Models\CataModel();
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                添加筛选分类
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <form role="form" action="admin.php?v=<?php echo $view; ?>" method="post">
                                        <div class="form-group">
                                            <label>分类名</label>
                                            <input placeholder="南极熊" name="new_cata_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>父结点</label>
                                            <select name="new_top_lvl" class="form-control">
                                                <?php
                                                    $allCataObj=$cataMgr->selectAll();
                                                        if(is_array($allCataObj)){
                                                            $i=0;
                                                            $firstCaid=array();
                                                            foreach ($allCataObj as $key => $value) {
                                                                if($value->getParent()==='0' && $value->getVisible()==='1'){
                                                                    array_push($firstCaid, $value->getCaid());
                                                                    $active='';
                                                                    if($i===0){
                                                                        $active='active';
                                                                    }
                                                                    echo '<option value="'.$value->getCaid().'">'.$value->getName().'</option>';
                                                                    $i++;
                                                                }
                                                            }
                                                        }else{
                                                            echo '';
                                                        }
                                                ?>
                                            </select>
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
                             已有筛选分类名称
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>筛选分类名称</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $allCataObj=$cataMgr->getSecond();
                                        if(is_array($allCataObj)){
                                            foreach ($allCataObj as $key => $value) {
                                                
                                                $btnName=$value['visible']==='1'?'置不可视':'置可视';
                                                $btnRequest=$value['visible']==='1'?'admin.php?v='.$view.'&set_no_visible='.$value['caid']:'admin.php?v='.$view.'&set_visible='.$value['caid'];

                                                $frontBtnName=$value['fvisible']==='1'?'前台不显示':'前台显示';
                                                $frontBtnRequest=$value['fvisible']==='1'?'admin.php?v='.$view.'&set_front_no_visible='.$value['caid']:'admin.php?v='.$view.'&set_front_visible='.$value['caid'];

                                                echo '<tr class="odd gradeX">
                                                        <td>'.$value['name'].'</td>
                                                        <td style="text-align:center">
                                                            <a href="admin.php?v='.$view.'&cata_to_edit='.$value['caid'].'" class="btn btn-primary btn-sm">编辑</a>
                                                            <a href="admin.php?v='.$view.'&cata_to_up='.$value['caid'].'" class="btn btn-sm btn-primary">向上</a>
                                                            <a href="admin.php?v='.$view.'&cata_to_down='.$value['caid'].'" class="btn btn-sm btn-primary">向下</a>
                                                            <a href="'.$btnRequest.'" class="btn btn-primary btn-sm">'.$btnName.'</a>
                                                            <a href="'.$frontBtnRequest.'" class="btn btn-primary btn-sm">'.$frontBtnName.'</a>
                                                            <a ref="admin.php?v='.$view.'&cata_to_view='.$value['caid'].'" class="btn btn-primary btn-sm view_cata" data-toggle="modal" data-whatever="'.$value['caid'].'=='.$value['name'].'" data-target=".modal-view-cata">详细</a>
                                                            <a href="admin.php?v='.$view.'&cata_to_del='.$value['caid'].'" class="btn btn-danger btn-sm">删除</a>
                                                        </td>
                                                    </tr>';
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
                                    <!-- <nav>
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
                                    </nav> -->
                                </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
