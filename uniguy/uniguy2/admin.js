
	jQuery(document).ready(function(){
		jQuery.get('adminjs/caseDataAdded.php',function(e){
			// alert(e);
		});
	});

	function setCookie(name,value){
	    var Days = 30;
	    var exp = new Date();
	    exp.setTime(exp.getTime() + Days*24*60*60*1000);
	    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	}

	//读取cookies
	function getCookie(name){
	    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	 
	    if(arr=document.cookie.match(reg))
	 
	        return unescape(arr[2]);
	    else
	        return null;
	}

	//删除cookies
	function delCookie(name){
	    var exp = new Date();
	    exp.setTime(exp.getTime() - 1);
	    var cval=getCookie(name);
	    if(cval!=null)
	        document.cookie= name + "="+cval+";expires="+exp.toGMTString();
	}

	// file_put_contents("adminjs/caseDataAdded.php","<?php echo '".json_encode($caseDataAdded)."';?>");
	// file_put_contents("adminjs/serviceDataAdded.php","<?php echo '".json_encode($serviceDataAdded)."';?>");
	// file_put_contents("adminjs/case_pa_count.php", "<?php echo '".$ashu_option['case']['case_pa_count']."';?>");
	// file_put_contents("adminjs/service_pa_count.php", "<?php echo '".$ashu_option['service']['service_pa_count']."';?>");
	// file_put_contents("adminjs/currentAServiceProTotalCount.php", "<?php echo '".($ashu_option['service']['service_pa_count']+$ashu_option['service']['service_add_pa_count'])."';?>");
	// file_put_contents("adminjs/case_add_pa_count.php", "<?php echo '".$caseDataAdded['case_add_pa_count']."';?>");

	/*******************************************************************************/

	var currentPropageteCount="<?php echo $ashu_option['case']['case_pa_count']; ?>";

	jQuery.get('adminjs/case_pa_count.php',function(e){
		currentPropageteCount=e;
		setCookie('case_pa_count',currentPropageteCount);
	});

	currentPropageteCount=getCookie('case_pa_count');

	/*******************************************************************************/
	var propagateExists='<?php echo json_encode($caseDataAdded); ?>';

	jQuery.get('adminjs/caseDataAdded.php',function(e){
		propagateExists=e;
		setCookie('propagateExists',propagateExists);
	});

	propagateExists=getCookie('propagateExists');

	/*******************************************************************************/

	var servicePropagate='<?php echo json_encode($serviceDataAdded); ?>';

	jQuery.get('adminjs/serviceDataAdded.php',function(e){
		servicePropagate=e;
		setCookie('servicePropagate',servicePropagate);
	});

	servicePropagate=getCookie('servicePropagate');

	/*******************************************************************************/

	var currentServicePropagateCount="<?php echo $ashu_option['service']['service_pa_count'];  ?>";

	jQuery.get('adminjs/service_pa_count.php',function(e){
		currentServicePropagateCount=e;
		setCookie('service_pa_count',currentServicePropagateCount);
	});

	currentServicePropagateCount=getCookie('service_pa_count');

	/*******************************************************************************/

	var currentAServiceProTotalCount="<?php echo $ashu_option['service']['service_pa_count']+$ashu_option['service']['service_add_pa_count']; ?>";
	
	jQuery.get('adminjs/currentAServiceProTotalCount.php',function(e){
		currentAServiceProTotalCount=e;
		setCookie('currentAServiceProTotalCount',currentAServiceProTotalCount);
	});

	currentAServiceProTotalCount=getCookie('currentAServiceProTotalCount');

	/*******************************************************************************/

	var container;

	var page;

	window.onload=function(){
		
		if(document.getElementById('case_add_pa')!=null){
			page='case'
			container=document.getElementById('case_add_pa').parentNode.parentNode.parentNode;

			/*******************************************************************************/

			var case_add_pa_count="";
			
			jQuery.get('adminjs/case_add_pa_count.php',function(e){
				case_add_pa_count=e;
				setCookie('case_add_pa_count',case_add_pa_count);
			});

			case_add_pa_count=getCookie('case_add_pa_count');
			
			/*******************************************************************************/

			document.getElementById('case_add_pa_count').setAttribute('value',case_add_pa_count);			
		}

		if(document.getElementById('service_add_pa')!=null){
			page='service';
			container=document.getElementById('service_add_pa').parentNode.parentNode.parentNode;			
		}

		hidePaCount();

		function getLength(obj){
			var index=0;
			for(var elem in obj){
				index++;
			}
			return index;
		}

		if(propagateExists!='' && page=='case'){
			var json=JSON.parse(propagateExists);
			console.log(getLength(json));
			if(getLength(json)>3){
				var propagateCount=json['case_add_pa_count'];
				var propagateAddedStack={};
				var singleAdded={};
				var index=0;
				var count=0;
				for(var elem in json){
					if(elem=='Submit' || elem=='save_my_options' || elem=='case_add_pa_count' || elem=='case_add_pa'){
						continue;
					}
					if(count==4){
						count=0;
						index+=1;
						singleAdded={};
						singleAdded[elem]=json[elem];
						// continue;
					}else{
						propagateAddedStack[index]=singleAdded;
					}
					singleAdded[elem]=json[elem];
					count+=1;
				}

				console.log(propagateAddedStack);

				for(elem in propagateAddedStack){
					var propagate=propagateAddedStack[elem];
					currentPropageteCount++;
					var visible=propagate['checkbox_case_pa'+currentPropageteCount+'_visibile'];
					console.log(visible);
					addPropagatePanel(container,propagate['case_pa_desc'+currentPropageteCount],propagate['case_pa_img'+currentPropageteCount],propagate['case_pa_img'+currentPropageteCount+'_pos'],visible);
				}
			}
			
		}

		if(servicePropagate!='' && page=='service'){
			var json=JSON.parse(servicePropagate);
			if(getLength(json)>3){
				var propagateCount=json['service_add_pa_count'];
				var propagateAddedStack={};
				var singleAdded={};
				var index=0;
				var count=0;
				for(var elem in json){
					if(elem=='Submit' || elem=='save_my_options' || elem=='service_add_pa_count' || elem=='service_add_pa'){
						continue;
					}
					if(count==7){
						count=0;
						index+=1;
						singleAdded={};
						singleAdded[elem]=json[elem];
						// continue;
					}else{
						propagateAddedStack[index]=singleAdded;
					}
					singleAdded[elem]=json[elem];
					count+=1;
				}

				var serviceIndex=currentAServiceProTotalCount;

				for(elem in propagateAddedStack){
					var propagate=propagateAddedStack[elem];
					serviceIndex++;
					var visible=propagate['checkbox_service_pa'+serviceIndex+'_visibile'];
					//visible,title,subtitle,desc,ahrefTitle,ahref,img,split
					addServicePropagatePanel(visible,propagate['propaganda'+serviceIndex+'_big_title'],propagate['propaganda'+serviceIndex+'_medium_title'],propagate['propaganda'+serviceIndex+'_small_desc'],propagate['propaganda'+serviceIndex+'_small_href'],propagate['propaganda'+serviceIndex+'_small_href_title'],propagate['propaganda'+serviceIndex+'_small_img'],true);
				}
			}
			
		}

	}

	function hidePaCount(){
		if(page=='case'){
			var paCount=document.getElementById('case_add_pa_count').parentNode.parentNode;
			paCount.style.display='none';
		}
		if(page=="service"){
			document.getElementById('service_add_pa_count').parentNode.parentNode.style.display='none';			
		}
	}

	function pageScroll() {
		window.scrollBy(0,document.body.clientHeight);
		scrolldelay = setTimeout('pageScroll()',100);
		if(document.documentElement.scrollTop==0) clearTimeout(scrolldelay); 
	}

	var addPropagate=function(elem){
		var _this=elem;
		container=_this.parentNode.parentNode.parentNode;
		currentPropageteCount++;

		addPropagatePanel(container,'','','','true');
		document.getElementById('case_add_pa_count').setAttribute('value',parseInt(document.getElementById('case_add_pa_count').getAttribute('value'))+1);
	
		pageScroll();
	};

	var addServicePropagate=function(elem){
		var _this=elem;
		container=_this.parentNode.parentNode.parentNode;

		addServicePropagatePanel('','','','','','','',true);

		document.getElementById('service_add_pa_count').setAttribute('value',parseInt(document.getElementById('service_add_pa_count').getAttribute('value'))+1);

		pageScroll();
	}

	var addServicePropagatePanel=function(visible,title,subtitle,desc,ahrefTitle,ahref,img,split){

		split=split||false;
		var splitcol;
		if(split){splitcol=' class="split" ';}

		currentAServiceProTotalCount++;

		var vis='<select class="postform" id="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile" name="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile"> <option value="">请选择</option>  <option value="1">可视</option><option value="0">不可视</option></select>';
		
		switch(visible){
			case '1':
				vis='<select class="postform" id="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile" name="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile"> <option value="">请选择</option>  <option selected="selected" value="1">可视</option><option value="0">不可视</option></select>';
				break;
			case '0':
				vis='<select class="postform" id="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile" name="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile"> <option value="">请选择</option>  <option value="1">可视</option><option selected="selected" value="0">不可视</option></select>';
				break;
			default:
				var vis='<select class="postform" id="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile" name="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile"> <option value="">请选择</option>  <option value="1">可视</option><option value="0">不可视</option></select>';
				break;
		}

		
		var _checkbox='<tr valign="top"><th scope="row" width="200px">宣传板是否可视</th><td>请选择<br>'+vis+'<br><br></td></tr>';
		var title='<tr valign="top"><th scope="row" width="200px">当前宣传版面-大标题</th><td>显示在当前宣传版面的大标题<br><input size="60" value="'+title+'" id="propaganda'+currentAServiceProTotalCount+'_big_title" name="propaganda'+currentAServiceProTotalCount+'_big_title" type="text"><br><br></td></tr>';
		var midTitle='<tr valign="top"><th scope="row" width="200px">当前宣传版面-中标题</th><td>显示在当前宣传版面的中标题<br><input size="60" value="'+subtitle+'" id="propaganda'+currentAServiceProTotalCount+'_medium_title" name="propaganda'+currentAServiceProTotalCount+'_medium_title" type="text"><br><br></td></tr>';
		var desc='<tr valign="top"><th scope="row" width="200px">当前宣传版面-详细描述</th><td>显示在当前宣传版面的详细描述<br><textarea name="propaganda'+currentAServiceProTotalCount+'_small_desc" cols="60" rows="7" id="propaganda'+currentAServiceProTotalCount+'_small_desc" style="width: 80%; font-size: 12px;" class="code">'+desc+'</textarea><br><br></td></tr>';
		var ahrefTitle='<tr valign="top"><th scope="row" width="200px">当前宣传版面-链接标题</th><td>显示在当前宣传版面的链接标题<br><input size="60" value="'+ahrefTitle+'" id="propaganda'+currentAServiceProTotalCount+'_small_href_title" name="propaganda'+currentAServiceProTotalCount+'_small_href_title" type="text"><br><br></td></tr>';
		var aherf='<tr valign="top"><th scope="row" width="200px">当前宣传版面-链接</th><td>显示在当前宣传版面的链接<br><input size="60" value="'+ahref+'" id="propaganda'+currentAServiceProTotalCount+'_small_href" name="propaganda'+currentAServiceProTotalCount+'_small_href" type="text"><br><br></td></tr>';
		var img='<tr '+splitcol+' valign="top"><th scope="row" width="200px">当前宣传版面-图片</th><td><div class="preview_pic_optionspage" id="propaganda'+currentAServiceProTotalCount+'_small_img_div"><img src="'+img+'" alt=""></div>请上传一个图片或填写一个图片地址,建议大小:980*568<br><input size="60" value="'+img+'" name="propaganda'+currentAServiceProTotalCount+'_small_img" class="upload_pic_input" type="text">&nbsp;<a onclick="return false;" title="" class="k_hijack button thickbox" id="propaganda'+currentAServiceProTotalCount+'_small_img" href="media-upload.php?type=image&amp;hijack_target=propaganda'+currentAServiceProTotalCount+'_small_img&amp;TB_iframe=true">插入图片</a><br><br></td></tr>';

		var result=_checkbox+title+midTitle+desc+ahrefTitle+aherf+img;

		container.innerHTML=container.innerHTML+result;

	}

	var addPropagatePanel=function(container,desc,imgsrc,pos,visible){

		var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';

		switch(pos){
			case 'left':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option selected="true" value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';
				break;
			case 'right':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option selected="true" value="right">居右</option><option value="bottom">居下</option></select>';			
				break;
			case 'top':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option selected="true" value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';
				break;
			case 'bottom':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option selected="true" value="bottom">居下</option></select>';
				break;
			default:
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';
				break;
		}

		var vis='<select class="postform" id="checkbox_case_pa'+currentPropageteCount+'_visibile" name="checkbox_case_pa'+currentPropageteCount+'_visibile"> <option value="">请选择</option>  <option value="1">可视</option><option value="0">不可视</option></select>';
		
		switch(visible){
			case '1':
				vis='<select class="postform" id="checkbox_case_pa'+currentPropageteCount+'_visibile" name="checkbox_case_pa'+currentPropageteCount+'_visibile"> <option value="">请选择</option>  <option selected="selected" value="1">可视</option><option value="0">不可视</option></select>';
				break;
			case '0':
				vis='<select class="postform" id="checkbox_case_pa'+currentPropageteCount+'_visibile" name="checkbox_case_pa'+currentPropageteCount+'_visibile"> <option value="">请选择</option>  <option value="1">可视</option><option selected="selected" value="0">不可视</option></select>';
				break;
			default:
				var vis='<select class="postform" id="checkbox_case_pa'+currentPropageteCount+'_visibile" name="checkbox_case_pa'+currentPropageteCount+'_visibile"> <option value="">请选择</option>  <option value="1">可视</option><option value="0">不可视</option></select>';
				break;
		}

		addElment(container,'新建宣传面板'+currentPropageteCount+'介绍','案例页面中宣传板'+currentPropageteCount+'的介绍','<input size="60" value="'+desc+'" id="case_pa_desc'+currentPropageteCount+'" name="case_pa_desc'+currentPropageteCount+'" type="text">');
		addElment(container,'新建宣传面板'+currentPropageteCount+'图片位置','请选择图片位置'+currentPropageteCount+'的介绍',str);
		addElment(container,'新建宣传面板'+currentPropageteCount+'图片','请上传一个图片或填写一个图片地址,建议大小:146*428'+currentPropageteCount+'的介绍','<div class="preview_pic_optionspage" id="case_pa_img'+currentPropageteCount+'_div"><img src="'+imgsrc+'"></div>请上传一个图片或填写一个图片地址,建议大小:146*428<br><input size="60" value="'+imgsrc+'" name="case_pa_img'+currentPropageteCount+'" class="upload_pic_input" type="text">&nbsp;<a onclick="return false;" title="" class="k_hijack button thickbox" id="case_pa_img'+currentPropageteCount+'" href="media-upload.php?type=image&amp;hijack_target=case_pa_img'+currentPropageteCount+'&amp;TB_iframe=true">插入图片</a>');
		addElment(container,'新建宣传面板'+currentPropageteCount+'是否可视','设置此宣传板是否可视',vis,true);
	}

	function addElment(container,title,subtitle,element,isSplited){
		isSplited=isSplited||false;

		var newPropagatePanel=document.createElement('tr');
		newPropagatePanel.setAttribute('valign','top');

		var th=document.createElement('th');
		th.style.width='200px';
		th.setAttribute('scope','row');
		th.innerHTML=title;

		var td=document.createElement('td');

		td.innerHTML=subtitle+'<br><br>'+element+'<br><br>';

		container.appendChild(newPropagatePanel);
		newPropagatePanel.appendChild(th);
		newPropagatePanel.appendChild(td);
		if(isSplited){
			newPropagatePanel.setAttribute('class','split');
		}

	}
	// window.onload=hidePaCount;
	