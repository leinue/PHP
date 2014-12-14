<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="css/style.css" />
	<script>document.write(unescape('%3Cscript%20type%3D%22text/javascript%22%20src%3D%22http%3A//api.map.baidu.com/api%3Fv%3D2.0%26ak%3D52E434d922f90a508da65f332d406553%22%3E%3C/script%3E'));</script>
	<title>酒驾监控系统Web控制端 V1.1</title>
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

	<script type="text/javascript" src="js/ajax.js"></script>
</body>
</html>
