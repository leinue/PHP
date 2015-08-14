<?php

$page=1;
if(!empty($_GET['page'])){
    $page=$_GET['page'];
}

$usersModel=new Cores\Models\UsersModel();
$pageCount=count($usersModel->selectAll());
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

function printUserItems($usersModel,$page,$uid){
    $allItemObj=$usersModel->getUserItem($uid);
    $str='';
    $header='<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            用户投稿管理
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>主题</th>
                                                <th>所属分类</th>
                                                <th>发布时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
    $footer='</tbody> </table> </div> </div> </div> </div>';
    if(is_array($allItemObj)){
        $j=$page>1?($page*5+1):0;
        foreach ($allItemObj as $key => $value) {
            $j++;
            $cataObj=new Cores\Models\CataModel();
            $cataName=$cataObj->selectOne($value['caid'],true);
            $cataName=$cataName[0]['name'];
            $str.='<tr>
                    <td>'.$j.'</td>
                    <td>'.$value['title'].'</td>
                    <td>'.$cataName.'</td>
                    <!--<td>'.$value['uid'].'</td>-->
                    <td>'.$value['createTime'].'</td>
                </tr>';
        }
        return $header.$str.$footer;
    }else{
        return '<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            暂无数据
                        </div></div></div>';
    }
}


if(!empty($_GET['action']) && !empty($_GET['uid'])){
    $uid=$_GET['uid'];
    switch ($_GET['action']) {
        case 'block_user':
            $usersModel->block($uid);
            $prompt=success('封禁成功');
            break;
        case 'deblock_user':
            $usersModel->deblock($uid);
            $prompt=success('解封成功');
            break;
        case 'view_user_item':
            $prompt=printUserItems($usersModel,$page,$uid);
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
                            用户管理 <small>在这里管理来自discuz的用户,更详细的管理请到discuz中管理:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">

                <?php echo $prompt; ?>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                用户管理
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>昵称</th>
                                                <th>用户组</th>
                                                <th>创建时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                $usersList=$usersModel->selectAll($page);
                                                if(is_array($usersList)){
                                                    $j=$page>1?($page*5)+1:0;
                                                    foreach ($usersList as $key => $value) {
                                                        $j++;
                                                        //9是被封禁的
                                                        $userGroup=$value['privilege']==='0'?'管理员':($value['privilege']==='9'?'封禁者':'投稿者');
                                                        $btnName=$value['privilege']==='9'?'解封':'封禁';
                                                        $block=$value['privilege']==='9'?'deblock_user':'block_user';
                                                        $blockBtn='';
                                                        if($value['privilege']!='0'){
                                                            $blockBtn='<a href="admin.php?v='.$_GET['v'].'&action='.$block.'&uid='.$value['uid'].'&page='.$page.'" class="btn btn-sm btn-danger">'.$btnName.'</a>';
                                                        }else{
                                                            $blockBtn='';
                                                        }
                                                        echo '<tr>
                                                                <td>'.$j.'</td>
                                                                <td>'.$value['name'].'</td>
                                                                <td>'.$userGroup.'</td>
                                                                <td>'.$value['createTime'].'</td>
                                                                <td>
                                                                    <a href="admin.php?v='.$_GET['v'].'&action=view_user_item&uid='.$value['uid'].'&page='.$page.'" class="btn btn-sm btn-primary">查看投稿</a>
                                                                    '.$blockBtn.'
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
                        </div>
                    </div>
                </div>
