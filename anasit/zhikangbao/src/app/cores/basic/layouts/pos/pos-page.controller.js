(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicPosController', BasicPosController)

    /* @ngInject */
    function BasicPosController($scope, OrgService, OrgInfoService) {
        var vm = this;

        $scope.lng = 116.397428;
	    $scope.lat = 39.90923;

	    $scope.getPath = function() {
		 	var lngX = $scope.lng;
	        var latY = $scope.lat;
	        var lineArr = [];
	        lineArr.push([lngX, latY]);
	        for (var i = 1; i < 100; i++) {
	          lngX = lngX + Math.random() * 0.05;
	          if (i % 2) {
	            latY = latY + Math.random() * 0.0001;
	          } else {
	            latY = latY + Math.random() * 0.06;
	          }
	          lineArr.push([lngX, latY]);
	        }
	    };

	    $scope.AMapId = 'amap-container'; //高德地图的存放容器
	    $scope.mapObj; //获得的初始化高德地图对象

	    $scope.markerClickListener; //点击界面添加标记监听器

	    if(typeof $scope.timeout == 'undefined') {
	        $scope.timeout = 500;
	    }

	    $scope.initAMap = function() {

	        if(typeof $scope.lng == 'undefined') {
	          $scope.lng = 116.397428;
	        }

	        if(typeof $scope.lat == 'undefined') {
	          $scope.lat = 39.90923;
	        }

	        var position = new AMap.LngLat($scope.lng,$scope.lat); //初始化默认坐标
	        $scope.mapObj = new AMap.Map($scope.AMapId,{
	          	view:new AMap.View2D({
	            	center:position,
	            	zoom:14,
	            	rotation:0
	          	}),
	          	lang:'zh_cn'
	        });

	        $scope.mapObj.plugin(['AMap.ToolBar','AMap.Scale','AMap.OverView'],
		        function(){
		            map.addControl(new AMap.ToolBar());

		            map.addControl(new AMap.Scale());

		            map.addControl(new AMap.OverView({isOpen:true}));
		   	 	});
	    };

	    // $scope.ListenClick = function() {
	    //     $scope.markerClickListener=AMap.event.addListener($scope.mapObj,'click',function(e){
	    //       	var lnglat=e.lnglat;
	    //       	$scope.markerPlace(e.lnglat,'ddd');
	    //     });
	    // };

	   	var infoWindow = new AMap.InfoWindow();

	    $scope.markerPlace = function(lnglat,title) {
	    	var marker=new AMap.Marker({
	            map:$scope.mapObj,
	           	position:lnglat,
	           	icon:"http://webapi.amap.com/images/0.png",
	           	offset:new AMap.Pixel(-10,-34),
	           	title:title,
	        });
	        var textMarker=new AMap.Marker({
	            map:$scope.mapObj,
	           	position:lnglat,
	           	offset:new AMap.Pixel(-10,-34),
	           	title:title,
	           	content:"<div class=\"marker-style\">"+title+"</div>"
	        });
	        marker.content = title;
	        return marker;
	    };

	    function markerClick(e) {
	    	console.log('ddd');
	    	infoWindow.setContent(e.target.content);
	    	infoWindow.open($scope.mapObj,e.target.getPosition());
	    }

	    $scope.removeMarkerListener = function() {
	    	AMap.event.removeListener($scope.markerClickListener); //移除事件
	    };

	    $scope.initAMap();
	    // $scope.ListenClick();

	    var lineArr = $scope.getPath();

	    //给lineArr设置默认值
	    if(typeof lineArr == 'undefined') {
	        var lngX = $scope.lng;
	        var latY = $scope.lat;
	        var lineArr = [];
	        lineArr.push([lngX, latY]);
	        for (var i = 1; i < 3; i++) {
	          	lngX = lngX + Math.random() * 0.05;
	          	if (i % 2) {
	            	latY = latY + Math.random() * 0.0001;
	          	} else {
	            	latY = latY + Math.random() * 0.06;
	          	}
	          	lineArr.push([lngX, latY]);
	        }
	    }

	    //绘制轨迹
	    var polyline = new AMap.Polyline({
	        map: $scope.mapObj,
	        path: lineArr,
	        strokeColor: "#00A",  //线颜色
	        strokeOpacity: 1,     //线透明度
	        strokeWeight: 3,      //线宽
	        strokeStyle: "solid"  //线样式
	    });

	    $scope.mapObj.setFitView();

	    var markerPerson = new AMap.Marker({
	        map: $scope.mapObj,
	        position: [$scope.lng, $scope.lat],
	        icon: "http://code.mapabc.com/images/car_03.png",
	        offset: new AMap.Pixel(-26, -13),
	        autoRotation: true
	    });

	    $scope.startAnimation = function() {
	        markerPerson.moveAlong(lineArr, $scope.timeout);//开始动画
	    };

	    $scope.stopAnimation = function() {
	        markerPerson.stopMove();//结束动画
	    };

	    var marker = new AMap.Marker({
        	position: [116.480983, 39.989628]
	    });
	    marker.setMap($scope.mapObj);
	    $scope.mapObj.setFitView();
	    var info = new AMap.InfoWindow({
	        content:"信息窗体<br>这里是方恒科技大厦",
	        offset:new AMap.Pixel(0,-28)
	    });
	    info.open($scope.mapObj,marker.getPosition());

	    ////////////////////////////////////////////////////////////////////

	    $scope.getOrgList = function() {

        	$scope.orgList = {};
        	$scope.MonitorList = {};

        	var id = $scope.currentOrgCate;
        	OrgInfoService.getByOrgCate(id).then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
	        		var alert = $mdDialog.alert({
	                    title: '网络传输失败',
	                    content: realData.properties.message,
	                    ok: '确定'
	                });
	                $mdDialog.show(alert);
	        	}else {
	        		$scope.orgList = realData.properties;
	        		// console.log($scope.MonitorList);
	        	}

        	});
        }

        $scope.getOrgCateList = function() {
        	OrgInfoService.index().then(function(data) {
	        	var status = data.status;
	        	var realData = data.Schema;

	        	if(status != '200') {
	        		var alert = $mdDialog.alert({
	                    title: '网络传输失败',
	                    content: realData.properties.message,
	                    ok: '确定'
	                });
	                $mdDialog.show(alert);
	        	}else {
	        		$scope.orgCateList = realData.properties;
	        		console.log($scope.orgCateList);
	        	}
	        });
        }

        $scope.getOrgCateList();

    }
})();
