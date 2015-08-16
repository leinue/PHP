<?php

$filedOption=new Cores\Models\FieldsOptionsModel();

$allFieldOptions=$filedOption->selectAll();

$prompt='';

function judgeFieldType($curr,$to){
    if($curr==$to){
        return 'selected';
    }
}

function generatorFieldEdintFOrm($name,$tips,$type,$count,$from,$to,$unit,$foid){
    return '<div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑用户发布字段
            </div>
            <div class="panel-body"><div class="col-lg-6">
                <form role="form" method="post" action="admin.php?v='.$_GET['v'].'&action=edit_field_option&foid='.$foid.'">
                    <div class="form-group">
                        <label>字段名称*</label>
                        <input placeholder="字段名称" value="'.$name.'" name="field_name_edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>字段说明</label>
                        <input placeholder="字段说明" value="'.$tips.'" name="filed_tips_edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>字段类型*</label>
                        <select name="filed_type_edit" class="form-control">
                            <option '.judgeFieldType('input',$type).' value="input">文本框</option>
                            <option '.judgeFieldType('img',$type).' value="img">图片框</option>
                            <option '.judgeFieldType('selector',$type).' value="selector">选择框</option>
                            <option '.judgeFieldType('range_',$type).' value="range_">范围框</option>
                            <option '.judgeFieldType('textarea',$type).' value="textarea">富文本框</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>选择框值列表</label>
                        <textarea name="filed_count_edit" value="'.$count.'" placeholder="若类型为选择框则此项必填" class="form-control"></textarea>
                        <p class="help-block">
                            选择框值列表填写格式为:<br>
                            &lt;option value="值1"&gt;值1&lt;/option&gt;<br>
                            &lt;option value="值2"&gt;值2&lt;/option&gt;<br>
                            &lt;option value="值3"&gt;值3&lt;/option&gt;<br>
                        </p>
                    </div>
                    <div class="form-group">
                        <label>区间from</label>
                        <input name="filed_from_edit" value="'.$from.'" type="number" placeholder="若类型为范围框则此项必填" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>区间to</label>
                        <input name="filed_to_edit" value="'.$to.'" type="number" placeholder="若类型为范围框则此项必填" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>单位</label>
                        <input name="filed_unit_edit" value="'.$unit.'" type="text" placeholder="若类型为范围框则此项必填" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                </form>
            </div></div></div>';
}

if(!empty($_GET['action']) && !empty($_GET['foid'])){

    $foid=$_GET['foid'];

    switch ($_GET['action']) {
        case 'delete_field':
            $tips='该操作不可恢复,确定要执行吗?';
            $request='admin.php?v='.$_GET['v'].'&action=delete_field_confirm&foid='.$foid;
            $btnValue='确定执行';
            $prompt=confirm($tips,$request,$btnValue);
            break;
        case 'edit_field':
            $filedOptionOne=$filedOption->selectOne($foid);
            $name=$filedOptionOne[0]->getName();
            $tips=$filedOptionOne[0]->getTips();
            $type=$filedOptionOne[0]->getType();
            $count=$filedOptionOne[0]->getSelectorCount();
            $from=$filedOptionOne[0]->getRangeFrom();
            $to=$filedOptionOne[0]->getRangeTo();
            $unit=$filedOptionOne[0]->getRangeUnit();
            $prompt=generatorFieldEdintFOrm($name,$tips,$type,$count,$from,$to,$unit,$foid);
            break;
        case 'delete_field_confirm':
            $filedOption->delete($foid);
            $prompt=success('删除成功');
            break;
        case 'edit_field_option':
            $name=$_POST['field_name_edit'];
            $type=$_POST['filed_type_edit'];
            $tips=$_POST['filed_tips_edit'];
            $selectorCount=$_POST['filed_count_edit'];
            $rangeFrom=$_POST['filed_from_edit'];
            $rangeTo=$_POST['filed_to_edit'];
            $rangeUnit=$_POST['filed_unit_edit'];
            $filedOption->modify($foid,$name,$type,$tips,$selectorCount,$rangeFrom,$rangeTo,$rangeUnit);
            $prompt=success('修改成功,请点击左侧菜单栏重新载入(勿按F5刷新)');
        case 'set_no_visible':
            $filedOption->setNoVisible($foid);
            $prompt=success('置不可视成功,请点击左侧菜单栏重新载入');
            break;
        case 'set_visible':
            $filedOption->setVisible($foid);
            $prompt=success('置可视成功,请点击左侧菜单栏重新载入');
            break;
        case 'set_as_front_photo':
            $filedOption->setAsFrontPhoto($foid);
            $prompt=success('设为前台显示头像成功,请点击左侧菜单栏重新载入');
            break;
        case 'set_as_front_desc':
            $filedOption->setAsFrontDesc($foid);
            $prompt=success('设为前台显示描述成功,请点击左侧菜单栏重新载入');
            break;
        default:
            break;
    }

}

if(!empty($_GET['action'])){

    switch ($_GET['action']) {
        case 'add_field_option':
            $name=$_POST['field_name_add'];
            $tips=$_POST['filed_tips_add'];
            $type=$_POST['filed_type_add'];
            $selectorCount=$_POST['filed_count_add'];
            $rangeFrom=$_POST['filed_from_add'];
            $rangeTo=$_POST['filed_to_add'];
            $rangeUnit=$_POST['filed_unit_add'];
            $filedOption->add($name,$type,$tips,$selectorCount,$rangeFrom,$rangeTo,$rangeUnit);
            $prompt=success('添加成功');
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
                            用户发布管理 <small>在这里管理用户发布时需要填写的字段:)</small>
                        </h1>
                    </div>
                </div>

                <?php  echo $prompt; ?>

                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                用户发布字段管理(加*为必须字段)
                            </div>
                            <div class="panel-body">
                                <div>

                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#user_add_field_list" aria-controls="user_add_field_list" role="tab" data-toggle="tab">已有用户发布字段</a></li>
                                    <li role="presentation"><a href="#add_user_field" aria-controls="add_user_field" role="tab" data-toggle="tab">添加用户发布字段</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="user_add_field_list">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>名称*</th>
                                                        <th>说明</th>
                                                        <th>类型*</th>
                                                        <th>选项值列表</th>
                                                        <th>from</th>
                                                        <th>to</th>
                                                        <th>单位</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if(is_array($allFieldOptions)){
                                                            $j=0;
                                                            foreach ($allFieldOptions as $key => $value) {
                                                                $j++;
                                                                $name=$value->getName();
                                                                $tips=$value->getTips()==='0'?'无':$value->getTips();
                                                                $type=$value->getType();
                                                                $selectorCount=$value->getSelectorCount()==='0'?'无':$value->getSelectorCount();
                                                                $from=$value->getRangeFrom()==='0'?'无':$value->getRangeFrom();
                                                                $to=$value->getRangeTo()==='0'?'无':$value->getRangeTo();
                                                                $unit=$value->getRangeUnit()==='0'?'无':$value->getRangeUnit();
                                                               
                                                                $visibleBtnName=$value->getVisible()==='1'?'置不可视':'置可视';
                                                                $visileBtnRequest=$value->getVisible()==='1'?'admin.php?v='.$_GET['v'].'&action=set_no_visible&foid='.$value->getFoid():'admin.php?v='.$_GET['v'].'&action=set_visible&foid='.$value->getFoid();
                                                                
                                                                $frontPhotoBtn=$value->isPhoto()==='1'?'':'<a href="admin.php?v='.$_GET['v'].'&action=set_as_front_photo&foid='.$value->getFoid().'" class="btn btn-sm btn-primary">设为前台显示头像</a>';
                                                                $frontDescBtn=$value->isDesc()==='1'?'':'<a href="admin.php?v='.$_GET['v'].'&action=set_as_front_desc&foid='.$value->getFoid().'" class="btn btn-sm btn-primary">设为前台显示描述</a>';

                                                                echo '<tr>
                                                                    <td>'.$j.'</td>
                                                                    <td>'.$name.'</td>
                                                                    <td>'.$tips.'</td>
                                                                    <td>'.$type.'</td>
                                                                    <td>'.$selectorCount.'</td>
                                                                    <td>'.$from.'</td>
                                                                    <td>'.$to.'</td>
                                                                    <td>'.$unit.'</td>
                                                                    <td>
                                                                        <a href="admin.php?v='.$_GET['v'].'&action=edit_field&foid='.$value->getFoid().'" class="btn btn-sm btn-primary">编辑</a>
                                                                        <a href="'.$visileBtnRequest.'" class="btn btn-sm btn-primary">'.$visibleBtnName.'</a>
                                                                        '.$frontPhotoBtn.'
                                                                        '.$frontDescBtn.'
                                                                        <a href="admin.php?v='.$_GET['v'].'&action=delete_field&foid='.$value->getFoid().'" class="btn btn-sm btn-danger">删除</a>
                                                                    </td>
                                                                </tr>';
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="add_user_field">
                                        <div style="padding-top:20px" class="col-lg-6">
                                            <form role="form" method="post" action="admin.php?v=<?php echo $_GET['v']; ?>&action=add_field_option">
                                                <div class="form-group">
                                                    <label>字段名称*</label>
                                                    <input placeholder="字段名称" name="field_name_add" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>字段说明</label>
                                                    <textarea placeholder="字段说明" name="filed_tips_add" class="form-control"></textarea>
                                                    <span class="help-block">如需加入链接请使用&lt;a href="http://地址"&gt;地址名称&lt;/a&gt;,详情<a target="_blank" href="http://www.w3school.com.cn/tags/tag_a.asp">&lt;a&gt;标签</a></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>字段类型*</label>
                                                    <select name="filed_type_add" class="form-control">
                                                        <option value="input">文本框</option>
                                                        <option value="img">图片框</option>
                                                        <option value="selector">选择框</option>
                                                        <option value="range_">范围框</option>
                                                        <option value="textarea">富文本框</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>选择框值列表</label>
                                                    <textarea name="filed_count_add" placeholder="若类型为选择框则此项必填" class="form-control"></textarea>
                                                    <p class="help-block">
                                                        选择框值列表填写格式为:<br>
                                                        &lt;option value="值1"&gt;值1&lt;/option&gt;<br>
                                                        &lt;option value="值2"&gt;值2&lt;/option&gt;<br>
                                                        &lt;option value="值3"&gt;值3&lt;/option&gt;<br>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>区间from</label>
                                                    <input name="filed_from_add" type="number" placeholder="若类型为范围框则此项必填" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>区间to</label>
                                                    <input name="filed_to_add" type="number" placeholder="若类型为范围框则此项必填" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>单位</label>
                                                    <input name="filed_unit_add" type="text" placeholder="若类型为范围框则此项必填" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-default">提交</button>
                                            </form>
                                        </div>
                                    </div>
                                  </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
