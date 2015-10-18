(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesPosController', BasicServicesPosController);

    /* @ngInject */
    function BasicServicesPosController($mdDialog, $state, $scope, OrgInfoService, DeviceService, $filter) {
        var vm = this;

        vm.search = {
        	content: ''
        };

        window.ServicesPosVM = vm;

        window.TotalLnglats = [];

        $scope.currentOrg = '';

        //定义位置的查看状态0表示全体1表示追踪
        //默认为0
        vm.posStatus = {
        	status: 0,
        	backToWhole: function() {
        		vm.posStatus.status = 0;
        		$state.go('triangular.admin-default.services-pos');
        		$('#returnRoWholeBtn').hide();
        		console.log(TotalLnglats);
        		for(var i= 0,marker;i<TotalLnglats.length;i++){
			        var marker=new AMap.Marker({
			           	position:TotalLnglats[i],
			            map:map
			        });
			        marker.content='<strong>姓名:</strong><br><strong>IMEI:</strong><br><strong>定位时间:</strong><br><strong>状态:</strong><br><a href="javascript:followUp('+i+')">实时跟踪</a>&nbsp;&nbsp;<a href="">历史记录</a>';
			        marker.on('click',markerClick);
			        // marker.emit('click',{target:marker});
			        markerStack.push(marker);
			    }
        	},
        	title: '位置信息监控'
        };

        window.markerList = {
        	'18000179176': {
        		marker: ''
        	},

        	'18115992267': {
        		marker: ''
        	},

        	'18700000000': {
        		marker: ''
        	}
        };

        vm.startSearch = function(e) {
        	var keyCode = window.event ? e.keyCode : e.which;
        	if(keyCode == 13) {

        		if(vm.search.content == '') {
        			var alert = $mdDialog.confirm({
		                title: '搜索内容不能为空',
		                content:'请填写搜索内容',
		                ok: '确定'
		            });
		            $mdDialog.show(alert);
		            return false;
        		}

        		if (typeof markerList[vm.search.content] == 'undefined') {
        			return false;
        			alert('无此信息');
        		}

        		var currentMarker = markerList[vm.search.content].marker;

        		console.log(currentMarker);

        		currentMarker.emit('click',{target:currentMarker});

        		for (var i = markerStack.length - 1; i >= 0; i--) {
		            if(markerStack[i].Rd.position === currentMarker.Rd.position){
		                continue;
		            }
		            markerStack[i].setMap();
		        };

		        map.setCenter(currentMarker.Rd.position);

        	}
        };

        window.map = new AMap.Map("amap-container", {
	        resizeEnable: true,
	        zoom: 10
	    });
	    map.setCenter([111.47, 27.25]);
	    window.markerStack = [];
	    window.currentMarker = '';

	    var lnglats=[
	        [111.478904,27.253423],
	        [111.472122,27.251176],
	        [111.47271,27.252501],
	        [111.478258,27.254600]
	    ];

	    var nameList = ['方滨兴', '李华', '佟霏', '吕少勇', '熊焰', '朱银', '李善学', '李淑婷'];

	    window.infoWindow = new AMap.InfoWindow({offset:new AMap.Pixel(0,-30)});
	    
	    var pushMark = function (lnglats,manInfo) {
	    	for(var i= 0,marker;i<lnglats.length;i++){
		        var marker=new AMap.Marker({
		           	position:lnglats[i],
		            map:map
		        });

		        var currentMan = manInfo[i];

		        var name = currentMan.name;
		        var imei = currentMan.imei;
		        var time = $filter('date')(currentMan.last_time*1000,'yyyy-MM-dd hh:mm:ss');

		        marker.content='<strong>姓名:</strong>'+name+'<br><strong>IMEI:</strong>'+imei+'<br><strong>定位时间:</strong>'+time+'<br><a href="javascript:followUp('+i+')">实时跟踪</a>&nbsp;&nbsp;<a href="javascript:followHistory()">历史记录</a>';
		        marker.on('click',markerClick);
		        // marker.emit('click',{target:marker});
		        markerStack.push(marker);
		        TotalLnglats.push(lnglats[i]);
		        markerList['18700000000'].marker = marker;
		    }
	    }

	    pushMark(lnglats,nameList);

	    function markerClick(e){
	        infoWindow.setContent(e.target.content);
	        infoWindow.open(map, e.target.getPosition());
	        map.setCenter(e.target.getPosition());
	        currentMarker = e;
	    }

	    map.setFitView();

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
	        	}
	        });
        }

        $scope.getOrgCateList();

        $scope.getOldManTrip = function() {

        	clearMap();

        	TotalLnglats = [];

        	DeviceService.getDeviceAndOldByOrgId($scope.currentOrg).then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
        			var alert = $mdDialog.alert({
	                    title: '网络传输失败',
	                    content: realData.properties.message,
	                    ok: '确定'
	                });
	                $mdDialog.show(alert);
	                return false;
        		}

        		realData = realData.properties;

        		console.log(realData);

        		var lnglats = [];
        		var oldMan = [];

        		for (var i = 0; i < realData.length; i++) {
        			var curr = realData[i];

        			var tmp = [];
        			tmp[0] = curr.lng;
        			tmp[1] = curr.lat;
        			lnglats.push(tmp);

        			var oldTmp = {};
        			oldTmp.name = curr.realname;
        			oldTmp.imei = curr.device_imei;
        			oldTmp.last_time = curr.last_time;
        			oldMan.push(oldTmp);
        		};

        		pushMark(lnglats,oldMan);
		    	map.setCenter(lnglats[0]);

        	});

        }

    }

})();
