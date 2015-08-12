        <?php

            $view=$_GET['v'];

            function displayAvtive($current,$to){
                if(!empty($current)){
                    if($current==$to){
                        return 'active-menu';
                    }
                }
            }

        ?>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="<?php echo displayAvtive($view,"home"); ?>" href="admin.php?v=home"><i class="fa fa-dashboard"></i> 控制面板</a>
                    </li>
                    <li>
                        <a class="<?php echo displayAvtive($view,"cata"); ?>" href="admin.php?v=cata"><i class="fa fa-sitemap"></i> 分类管理</a>
                    </li>
					<li>
                        <a class="<?php echo displayAvtive($view,"item"); ?>" href="admin.php?v=item"><i class="fa fa-edit"></i> 投稿管理</a>
                    </li>
                    <li>
                        <a class="<?php echo displayAvtive($view,"itemadd"); ?>" href="admin.php?v=itemadd"><i class="fa fa-plus"></i> &nbsp;添加投稿</a>
                    </li>
                    <li>
                        <a class="<?php echo displayAvtive($view,"comments"); ?>" href="admin.php?v=comments"><i class="fa fa-bar-chart-o"></i> 评论/评分管理</a>
                    </li>
                    <li>
                        <a class="<?php echo displayAvtive($view,"useradd"); ?>" href="admin.php?v=useradd"><i class="fa fa-eye"></i> 用户发布管理</a>
                    </li>
                    <li>
                        <a class="<?php echo displayAvtive($view,"ads"); ?>" href="admin.php?v=ads"><i class="fa fa-usd"></i> &nbsp;广告位管理</a>
                    </li>
                    <li>
                        <a class="<?php echo displayAvtive($view,"setting"); ?>" href="admin.php?v=setting"><i class="fa fa-qrcode"></i> &nbsp;系统设置</a>
                    </li>
                </ul>

            </div>

        </nav>