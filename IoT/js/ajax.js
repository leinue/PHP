
	//绘制百度地图
	var map=new BMap.Map("allmap");

	var longitude=document.getElementById('longitude').value;
	var latitude=document.getElementById('latitude').value;

	var stCtrl = new BMap.PanoramaControl(); //构造全景控件
	stCtrl.setOffset(new BMap.Size(20, 20));
	map.addControl(stCtrl);//添加全景控件

	map.addControl(new BMap.MapTypeControl());
	map.centerAndZoom(new BMap.Point(longitude,latitude),11);
	map.enableScrollWheelZoom(true);

	//使用XHR获得最新的坐标信息
	//使用XHR轮询
	var xhr=new XMLHttpRequest();

	//天眼定位XHR
	var locate=new XMLHttpRequest();

	//获得当前定位XHR
	var gcp=new XMLHttpRequest();

	if(window.sessionStorage){
	}else{
		alert("您的浏览器不支持sessionStorage,有些功能无法使用");
	}

	getCoordinate();
	var isfirst=1;

	//window.addEventListener("load",getCoordinate,true);
	window.setInterval(getCoordinate,2000);

	//得到最新的坐标信息
	function getCoordinate(){
		if(typeof xhr.withCredentials===undefined){
		
		}else{
			xhr.open("get","req.php?method=read",true);
			xhr.send();
		}
	}

	document.getElementById('submitLongAndLat').onclick=function(){
		var longitude=document.getElementById('longitude').value;
		var latitude=document.getElementById('latitude').value;
		if(longitude!="" && latitude!=""){
			toTheLocation(longitude,latitude);
		}
	};

	document.getElementById('ajaxlocate').onclick=function(){
		if(typeof locate.withCredentials===undefined){
		
		}else{
			locate.open("get","locate.php?message=hhhhhhh",true);
			locate.send();
		}
	};

	document.getElementById('getCurrentPos').onclick=function(){
		if(typeof gcp.withCredentials===undefined){
		
		}else{
			gcp.open("get","getCurrentPos.php",true);
			gcp.send();
		}		
	}
	
	// 用经纬度设置地图中心点
	function toTheLocation(long,lat){
		if(long!="" && lat!=""){
			map.clearOverlays();
			var new_point = new BMap.Point(long,lat);
			var marker = new BMap.Marker(new_point);  // 创建标注
			map.addOverlay(marker);              // 将标注添加到地图中
			map.panTo(new_point);
		}
	}

	//gcpXHR请求状态
	gcp.onreadystatechange=function(){
		if(gcp.readyState==4 && gcp.status==200){
			var pos=gcp.responseText;
			var pos=JSON.parse(pos);
			console.log(pos);
			toTheLocation(pos.x,pos.y);
		}else{
			displayRequestResult(gcp.statusText);
		}
	};

	//locateXHR请求状态
	locate.onreadystatechange=function(){
		if(locate.readyState==4 && locate.status==200){
			var res=locate.responseText;
			var resJSON=JSON.parse(res);

			displayRequestResult(resJSON.message);
		}else{
			displayRequestResult(locate.statusText);
		}
	};

	//XHR请求状态
	xhr.onreadystatechange=function(){
		if(xhr.readyState==4 && xhr.status==200){
			//成功
			var coordinate=xhr.responseText;
			var jsondata=JSON.parse(coordinate);

			console.log(coordinate);

			var nextCount=jsondata.count;

			if(isfirst==1){
				sessionStorage['count']=sessionStorage['count']-1;
				isfirst=0;
			}
			//alert("sessionStorage['count']="+sessionStorage['count']+";next="+nextCount);
			if(nextCount!=sessionStorage['count']){
				sessionStorage['count']=jsondata.count;
				displayCoordinate(jsondata.longitude,jsondata.latitude);
				toTheLocation(jsondata.longitude,jsondata.latitude);
			}
		}else{
			//失败
			displayRequestResult(xhr.statusText);
		}
	};

	//展示最新的经纬度
	function displayCoordinate(long,lat){
		document.getElementById('longitude').value=long;
		document.getElementById('latitude').value=lat;
	}

	//展示XHR状态
	function displayRequestResult(status){
		document.getElementById('console-status').innerHTML=status;
	}