<?php
    
    $fieldOptions=new Cores\Models\FieldsOptionsModel();
    $field=new Cores\Models\FieldsModel();
    $fieldList=$fieldOptions->selectAll();

    if(!empty($_GET['action'])){
        switch ($_GET['action']) {
            case 'add_new_item':
                $itemObj=new Cores\Models\ItemsModel();
                $uid='11';
                $caid=$_POST['item_cata_add'];
                $title=$_POST['item_theme_add'];
                $count=$_POST['count'];

                if($title==null || $caid==null || $count==null){
                    alert('项目类别或项目主题不能为空');
                }

                $itemAdded=$itemObj->add($uid,$caid,$title);
                $itemId=$itemAdded[0]->getIid();
                
                if($itemId==null){
                    alert('添加投稿失败,请重试!');
                }else{
                    if(is_array($fieldList)){
                        foreach ($fieldList as $key => $value) {
                            $foid=$value->getFoid();
                            $v=$_POST['item_'.$value->getName().'_add'];
                            if($v==null){
                                alert('有空值');
                                die();
                            }
                            $field->add($foid,$v,$itemId);
                        }
                    }else{
                        alert('字段值为空');
                    }
                }

                break;
            default:
                break;
        }
    }

    function tips($tips){
        return $tips==null?'':'<p class="help-block">'.$tips.'</p>';
    }

    function input($name,$name_control,$id,$tips=null,$value=null){
        $tips=tips($tips);
        return '<div class="form-group">
                    <label>'.$name.'</label>
                    <input placeholder="'.$name.'" value="'.$value.'" name="'.$name_control.'" class="form-control">
                    '.$tips.'
                </div>';
    }

    function img_($name,$name_control,$id,$tips=null,$value=null){
        $tips=tips($tips);
        return '<div class="form-group">
                    <label>'.$name.'</label>
                    <input id="'.$id.'" name="'.$name.'" value="'.$value.'" type="file">
                    '.$tips.'
                </div>';
    }

    function textarea($name,$name_control,$id,$tips,$value=null){
        $tips=tips($tips);
        return '<div class="form-group">
                    <label>'.$name.'</label>
                    <textarea class="form-control" placeholder='.$name.' id="'.$id.'" name="'.$name.'" value="'.$value.'"></textarea>
                    '.$tips.'
                </div>';
    }

    function selector($name,$name_control,$id,$tips,$selectorCount,$value=""){
        $tips=tips($tips);
        return '<div class="form-group">
                    <label>'.$name.'</label>
                    <select class="form-control" placeholder='.$name.' id="'.$id.'" name="'.$name.'"">'.$selectorCount.'</select>
                    '.$tips.'
                </div>';
    }

    function range_($name,$name_control,$id,$tips,$from,$to,$rangeUnit,$value=""){
        $tips=tips($tips);
        return '<div class="form-group">
                    <label>'.$name.' ( '.$rangeUnit.' )</label>
                    <input class="form-control" type="number" placeholder="from" id="'.$id.'" name="'.$name.'"">
                    <label></label>
                    <input class="form-control" type="number" placeholder="to" id="'.$id.'" name="'.$name.'"">
                    '.$tips.'
                </div>';
    }

    function generatorItemAddingForm($fieldList,$suffix='_add',$action=null){
        if(is_array($fieldList)){
            echo '<form role="form" method="post" action="'.$action.'&count='.count($fieldList).'">';
            $cataOption='';
            $cataObj=new Cores\Models\CataModel();
            $cataList=$cataObj->selectAll();
            if(is_array($cataList)){
                foreach ($cataList as $key => $value) {
                    if($value->getParent()!='0' && $value->getChild()!='second'){
                        $cataOption.='<option value="'.$value->getCaid().'">'.$value->getName().'</option>';
                    }
                }
            }
            echo '<div class="form-group">
                    <label>项目类别</label>
                    <select name="item_cata'.$suffix.'" class="form-control">
                        '.$cataOption.'
                    </select>
                </div>';
            echo '<div class="form-group">
                    <label>项目主题</label>
                    <input placeholder="项目主题" value="" name="item_theme'.$suffix.'" class="form-control">
                </div>';
            foreach ($fieldList as $key => $value) {
                $type=$value->getType();
                $id='item_'.$value->getName().$suffix;
                $name=$id;
                switch ($type) {
                    case 'input':
                         echo input($value->getName(),$name,$id,$value->getTips());
                        break;
                    case 'img':
                        echo img_($value->getName(),$name,$id,$value->getTips());
                    case 'selector':
                        if($type=='selector'){
                            echo selector($value->getName(),$name,$id,$value->getTips(),$value->getSelectorCount());
                        }
                    case 'range_':
                        if($type=='range_'){
                            echo range_($value->getName(),$name,$id,$value->getTips(),$value->getRangeFrom(),$value->getRangeTo(),$value->getRangeUnit());
                        }
                    case 'textarea':
                        if($type=='textarea'){
                            echo textarea($value->getName(),$name,$id,$value->getTips());
                        }
                    default:
                        break;
                }
            }
            echo '<button type="submit" class="btn btn-default">提交</button></form>';
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
