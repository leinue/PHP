var cata_selector_id='';
var cata_selector_name='';

$('.modal-view-cata').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('whatever');
  var tmp=recipient.split('==');
  cata_selector_id=tmp[0];
  cata_selector_name=tmp[1];
  var modal = $(this);
  // $('#cata_field_list')
  $.get("App/Admin/Execute/Exe.php?cata_field_to_view="+cata_selector_id,function(data,status){
    	$('#cata_field_list tbody').html('');
    	if(data==='-1'){
    		alert('暂无数据,请添加');
    		// $('.modal-view-cata').modal('hide');
    	}else{
    		var childList=JSON.parse(data);
    		for (var i = 0; i < childList.length; i++) {
    			$('#cata_field_list tbody').append('<tr><td>'+(i+1)+'</td><td>'+childList[i]['name']+'</td><td>'+cata_selector_name+'</td></tr>');
    		};
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