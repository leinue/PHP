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

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                系统设置
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" action="admin.php?v=<?php echo $_GET['v']; ?>" method="post">
                                            <div class="form-group">
                                                <label>站点标题</label>
                                                <input placeholder="南极熊" name="site_title" class="form-control">
                                                <p class="help-block">作为站点首页的显示标题</p>
                                            </div>
                                            <div class="form-group">
                                                <label>站点副标题</label>
                                                <input placeholder="南极熊" name="site_sub_title" class="form-control">
                                                <p class="help-block">作为站点首页的副标题</p>
                                            </div>
                                            <div class="form-group">
                                                <label>管理后台标题</label>
                                                <input placeholder="南极熊" name="site_admin_title" class="form-control">
                                                <p class="help-block">作为管理后台的标题</p>
                                            </div>
                                            <div class="form-group">
                                                <label>站点Logo</label>
                                                <input name="site_logo" type="file">
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
