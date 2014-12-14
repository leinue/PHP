<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="style.css" />
	<script>document.write(unescape('%3Cscript%20type%3D%22text/javascript%22%20src%3D%22http%3A//api.map.baidu.com/api%3Fv%3D2.0%26ak%3D52E434d922f90a508da65f332d406553%22%3E%3C/script%3E'));</script>
	<title>酒驾监控系统Web控制端</title>
</head>
<body>
	<div class="content-head">
		<div class="main-title"><a href="">酒驾监控系统Web控制端</a></div>
	</div>

	<div class="content-body">
		<div class="console">
			<div class="console-head">控制台消息监视：<span id="console-status">暂无消息</span></div>
			<div class="console-body">
				<div id="r-result">
				经度: <input id="longitude" value="" type="text" style="width:100px; margin-right:10px;" />
				纬度: <input id="latitude" value="" type="text" style="width:100px; margin-right:10px;" />
				<input type="button" class="btn" id="submitLongAndLat" value="查询经纬度"/>
				</div>
				<div class="tools">
					<input type="button" class="btn" id="ajaxlocate" value="天眼定位"/>
				</div>
			</div>
		</div>
		<div id="allmap" class="map-zone"></div>
	</div>

	<div class="content-footer">
		<div class="content-footer-flag">酒驾监控系统Web控制端·挑战杯·2014</div>
	</div>

</body>
<script type="text/javascript">

	//绘制百度地图
	var map=new BMap.Map("allmap");

	var longitude=document.getElementById('longitude').value;
	var latitude=document.getElementById('latitude').value;

	map.centerAndZoom(new BMap.Point(longitude,latitude),11);
	map.enableScrollWheelZoom(true);

	//使用XHR获得最新的坐标信息
	//使用XHR轮询
	var xhr=new XMLHttpRequest();

	//天眼定位XHR
	var locate=new XMLHttpRequest();

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

	//locateXHR请求状态
	locate.onreadystatechange=function(){
		if(locate.readyState==4 && locate.status==200){
			var res=locate.responseText;
			var resJSON=JSON.parse(res);

			displayRequestResult(resJSON.message);
		}else{
			displayRequestResult(xhr.statusText);
		}
	};

	//XHR请求状态
	xhr.onreadystatechange=function(){
		if(xhr.readyState==4 && xhr.status==200){
			//成功
			var coordinate=xhr.responseText;
			var jsondata=JSON.parse(coordinate);

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
</script>
</html>
