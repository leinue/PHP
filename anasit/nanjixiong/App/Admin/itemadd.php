<?php
    
    $fieldOptions=new Cores\Models\FieldsOptionsModel();
    $field=new Cores\Models\FieldsModel();
    $fieldList=$fieldOptions->selectAll();

    if(!empty($_GET['action'])){
        switch ($_GET['action']) {
            case 'add_new_item':
                $itemObj=new Cores\Models\ItemsModel();
                $cataObj=new Cores\Models\CataModel();
                $uid=$_SESSION['uid'];
                $caid=$_POST['item_cata_add'];
                $caidList=array();
                $rdValueList=array();
                $title=$_POST['item_theme_add'];
                $count=null;
                if(!empty($_GET['count'])){
                    $count=$_GET['count'];
                }else{
                    alert('count未定义');
                    redirectTo('admin.php?v='.$_GET['v']);
                }

                if($title==null || $caid==null){
                    alert('项目类别或项目主题不能为空');
                    redirectTo('admin.php?v='.$_GET['v']);
                }

                array_push($caidList,$caid);

                $secondList=$cataObj->getSecond();

                if(is_array($secondList)){
                    foreach ($secondList as $key => $value) {
                        $list='';
                        array_push($rdValueList, $value['caid']);
                        $rdList=$cataObj->getCataChild($value['caid']);
                        if(is_array($rdList)){
                            foreach ($rdList as $childKey => $childValue) {
                                
                                if($childValue['child']!='second' && $childValue['name']==$_POST['item_'.$value['name'].'_cata_add']){
                                    array_push($rdValueList, $childValue['caid']);
                                    array_push($rdValueList, $childValue['name']);
                                }
                                
                                if(is_array($_POST['item_'.$value['name'].'_cata_add'])){
                                    array_push($rdValueList,$_POST['item_'.$value['name'].'_cata_add']);
                                }
                            }
                        }
                        array_push($caidList, $rdValueList);
                        $rdValueList=array();
                    }
                }

                $caidJSON='';

                $caidJSON=json_encode($caidList);

                $itemAdded=$itemObj->add($uid,$caidJSON,$title);
                $itemId=$itemAdded[0]->getIid();
                
                if($itemId==null){
                    alert('添加投稿失败,请重试!');
                }else{
                    if(is_array($fieldList)){
                        foreach ($fieldList as $key => $value) {
                            $foid=$value->getFoid();
                            $v=$_POST['item_'.$value->getName().'_add'];
                            $field->add($foid,$v,$itemId);
                        }
                        $prompt=success('添加成功');
                    }else{
                        alert('字段值为空');
                    }
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
                            添加投稿 <small>在这里可以直接添加投稿:)</small>
                        </h1>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <?php echo $prompt; ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                发布投稿
                            </div>
                            <div class="panel-body">

                            <?php 

                                generatorItemAddingForm($fieldList,'_add','admin.php?v='.$_GET['v'].'&action=add_new_item');

                            ?>
                                
                                <!-- <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                                  <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                      </ul>
                                    </div>
                                  <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                      <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                                      <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                                      <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                                      </ul>
                                  </div>
                                  <div class="btn-group">
                                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
                                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
                                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
                                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
                                  </div>
                                  <div class="btn-group">
                                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
                                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
                                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
                                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
                                  </div>
                                  <div class="btn-group">
                                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
                                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
                                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
                                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
                                  </div>
                                  <div class="btn-group">
                                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
                                        <div class="dropdown-menu input-append">
                                            <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                                            <button class="btn" type="button">Add</button>
                                    </div>
                                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>
                                  </div>
                                  
                                  <div class="btn-group">
                                    <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
                                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                  </div>
                                  <div class="btn-group">
                                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
                                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
                                  </div>
                                  <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">
                                </div>

                                <style type="text/css">
                                    #editor {overflow:scroll; max-height:300px}
                                </style>

                                <div id="editor">
                                  输入内容&hellip;
                                </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
