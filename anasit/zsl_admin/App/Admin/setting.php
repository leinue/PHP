
<?php

$settingObj=new Cores\Models\SettingModel();

$prompt='';

if(!empty($_GET['action'])){
    if($_GET['action']=='update_setting'){
        $settingObj->set('site_title',$_POST['site_title']);
        $settingObj->set('site_sub_title',$_POST['site_sub_title']);
        $settingObj->set('site_admin_title',$_POST['site_admin_title']);
        $settingObj->set('site_logo',$_POST['site_logo']);
        $settingObj->set('site_footer',$_POST['site_footer']);
        $settingObj->set('site_ana',$_POST['site_ana']);
        $prompt=success('更新成功');
    }
}

$defaultImage=$settingObj->get('site_logo');
$defaultImage=$defaultImage=='0'?null:$defaultImage;

?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            系统设置 <small>在这里管理本系统:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                <?php
                    echo $prompt;
                ?>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                系统设置
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" action="admin.php?v=<?php echo $_GET['v']; ?>&action=update_setting" method="post">
                                            <label>站点logo</label>
                                            <?php echo loadImageUploader('site_logo',$defaultImage); ?>
                                            <div class="form-group">
                                                <label>站点标题</label>
                                                <input placeholder="南极熊" value="<?php  echo $settingObj->get('site_title'); ?>" name="site_title" class="form-control">
                                                <p class="help-block">作为站点首页的显示标题</p>
                                            </div>
                                            <div class="form-group">
                                                <label>站点副标题</label>
                                                <input placeholder="南极熊" value="<?php  echo $settingObj->get('site_sub_title'); ?>" name="site_sub_title" class="form-control">
                                                <p class="help-block">作为站点首页的副标题</p>
                                            </div>
                                            <div class="form-group">
                                                <label>管理后台标题</label>
                                                <input placeholder="南极熊" value="<?php  echo $settingObj->get('site_admin_title'); ?>" name="site_admin_title" class="form-control">
                                                <p class="help-block">作为管理后台的标题</p>
                                            </div>
                                            <div class="form-group">
                                                <label>前台页脚设置</label>
                                                <textarea  class="form-control" name="site_footer"><?php  echo $settingObj->get('site_footer'); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>第三方统计平台</label>
                                                <textarea  class="form-control" name="site_ana"><?php  echo $settingObj->get('site_ana'); ?></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">提交</button>
                                        </form>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                </div>
