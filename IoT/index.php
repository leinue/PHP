<?php
$title="首页 - 酒驾监控系统";
require('header.php');
?>

	<div class="content-body">
		<div class="console">
			<div class="console-head">控制台消息监视：<span id="console-status">暂无消息</span></div>
			<div class="console-body">
				<div id="r-result">
				经度: <input id="longitude" class="textbox" value="" type="text" style="width:100px; margin-right:10px;" />
				纬度: <input id="latitude" class="textbox" value="" type="text" style="width:100px; margin-right:10px;" />
					<input type="button" class="btn" id="submitLongAndLat" value="查询经纬度"/>
				</div>
				<!--<div class="tools">
				</div>-->
			</div>
		</div>
		<div id="allmap" class="map-zone"></div>
	</div>

<?php
require('footer.php');
?>
