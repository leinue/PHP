<?php

    $fieldOptions=new Cores\Models\FieldsOptionsModel();
    $field=new Cores\Models\FieldsModel();
    $fieldList=$fieldOptions->selectAll();

    if(!empty($_GET['action'])){
        switch ($_GET['action']) {
            case 'publish_item':
                $itemObj=new Cores\Models\ItemsModel();
                $cataObj=new Cores\Models\CataModel();
                $uid='3CEC7A3B-58BD-82B7-E4BA-8849286079BE';
                $caid=$_POST['item_cata_publish'];
                $caidList=array();
                $title=$_POST['item_theme_publish'];
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
                        array_push($caidList, $value['caid']);
                        $rdList=$cataObj->getCataChild($value['caid']);
                        if(is_array($rdList)){
                            foreach ($rdList as $childKey => $childValue) {
                                if($childValue['child']!='second' && $childValue['name']==$_POST['item_'.$childValue['name'].'_cata_publish']){
                                    array_push($caidList, $childValue['caid']);
                                }
                            }
                        }
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
                            $v=$_POST['item_'.$value->getName().'_publish'];
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
	<div class="row">

	  	<div class="col-md-10 col-md-offset-1">
	  		<?php echo $prompt; ?>
		  	<div class="panel panel-default">
		  		<div class="panel-heading">
			    	<h3 class="panel-title">发布项目</h3>
			  	</div>
				<div class="panel-body">
					
					<?php
						generatorItemAddingForm($fieldList,'_publish','index.php?v='.$_GET['v'].'&action=publish_item');
					?>

				</div>
			</div>
		</div>
	</div>