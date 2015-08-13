$(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
    	$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
	};
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	};
    initToolbarBootstrapBindings(); 
	$('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
});


var cata_selector_id='';
var cata_selector_name='';

$('.modal-view-cata').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('whatever');
  var tmp=recipient.split('==');
  cata_selector_id=tmp[0];
  cata_selector_name=tmp[1];
  var modal = $(this);
  $('#second_name_area').val('');
  // $('#cata_field_list')
  $.get("App/Admin/Execute/Exe.php?cata_field_to_view="+cata_selector_id,function(data,status){
    	$('#cata_field_list tbody').html('');
    	$('#cata_edit_field_list tbody').html('');
    	if(data==='-1'){
    		alert('暂无数据,请添加');
    		// $('.modal-view-cata').modal('hide');
    	}else{
    		var childList=JSON.parse(data);
    		var j=1;
    		for (var i = 0; i < childList.length; i++) {
    			if(childList[i]['child']!='second'){
    				$('#cata_field_list tbody').append('<tr><td>'+j+'</td><td>'+childList[i]['name']+'</td><td>'+cata_selector_name+'</td><td><a class="btn btn-danger del_rd_lvl" id="cata_rd_lve_del_'+childList[i]['caid']+'" caid="'+childList[i]['caid']+'" onclick="confirmToDel3rdLvlField(this)" href="#">删除</a></td></tr>');
    				$('#cata_edit_field_list tbody').append('<tr><td>'+j+'</td> <td>'+childList[i]['name']+'</td> <td><input placeholder="这里填写要修改的值" name="cata_field_edit_name" id="cata_field_edit_name_'+childList[i]['caid']+'" class="form-control"></td> <td><a caid="'+childList[i]['caid']+'" onclick="confirmToEdit3rdLvlField(this)" class="btn btn-primary btn-sm edit_third_lvl_field">确认</a></td></tr>');
    				j++;
    			}
    		};
    	}
  	});

  $.get("App/Admin/Execute/Exe.php?cata_second_to_view="+cata_selector_id,function(data){
  	if(data==='-1'){
  		$('#edit_second_level_name').html('保存');
  	}else{
  		$('#edit_second_level_name').html('修改');
  		var secondField=JSON.parse(data);
  		$('#second_name_area').val(secondField[0]['name']);
  		$('#second_name_area').attr('caid',secondField[0]['caid']);
  	}
  });
});

$('#cata_selector_add').on('click',function(){
	var name=$('#cata_selector_name').val();
	$.get("App/Admin/Execute/Exe.php?name="+name+"&cata_field_to_add="+cata_selector_id,function(data,status){
    	if(data==='-1'){
    		alert('添加失败,请检查名称是否重复!');	
    	}else{
    		alert('添加成功!');
    		$('#cata_field_list tbody').append('<tr><td>'+(i+1)+'</td><td>'+childList[i]['name']+'</td><td>'+cata_selector_name+'</td></tr>');
    	}
  	});
});

$('#edit_second_level_name').on('click',function(){
	var name=$('#second_name_area').val();
	var btnName=$(this).html();
	if(name!=''){
		if(btnName=='保存'){
			$.get('App/Admin/Execute/Exe.php?name='+name+'&cata_field_second='+cata_selector_id,function(data){
				if(data==='-1'){
					alert('添加失败,请重试');
				}else{
					alert('添加成功');
				}
			});
		}else{
			if(btnName=='修改'){
				$.get('App/Admin/Execute/Exe.php?name='+name+'&cata_second_to_edit='+$('#second_name_area').attr('caid'),function(data){
					if(data==='-1'){
						alert('修改失败,请重试');
					}else{
						alert('修改成功');
					}
				});
			}
		}
		
	}else{
		alert('字段名不能为空');
	}
});

function confirmToEdit3rdLvlField(obj){
	var caid=$(obj).attr('caid');
	var name=$('#cata_field_edit_name_'+caid).val();
	
	if(name==''){
		alert('要修改的字段名不能为空!');
	}else{
		$.get('App/Admin/Execute/Exe.php?name='+name+'&edit_third_lvl_field='+caid,function(data){
			if(data!='-1'){
				alert('修改成功');
			}else{
				alert('修改失败');
			}
		});
	}
}

function confirmToDel3rdLvlField(obj){
	var caid=$(obj).attr('caid');
	var r=confirm("该操作不可恢复,确定要继续吗?");
	if(!r){
	}else{
		$.get('App/Admin/Execute/Exe.php?cata_rd_lve_del='+caid,function(data){
			if(data!='-1'){
				alert('删除成功');
			}else{
				alert('删除失败');
			}
		});
	}
}

function editCommentsContent(obj){
	var requestUrl=$(obj).attr('ref');
	var content=$(obj).parent().prev().val();
	if(content!=''){
		$.get('App/Admin/Execute/Exe.php?'+requestUrl+'&content='+content,function(data){
			if(data!='-1'){
				alert('修改成功');
				window.location.href="admin.php?v=comments";
			}else{
				alert('修改失败');
			}
		});
	}else{
		alert('修改内容不能为空!');
	}
}
