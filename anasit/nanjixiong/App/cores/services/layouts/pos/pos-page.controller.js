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

        window.runtimePosInterval = '';

        //定义位置的查看状态0表示全体1表示追踪
        //默认为0
        vm.posStatus = {
        	status: 0,
        	backToWhole: function() {
        		vm.posStatus.status = 0;
        		$state.go('triangular.admin-default.services-pos');
        		$('#returnRoWholeBtn').hide();
        		$('#history-pos-console ul').html('');
        		$scope.getOldManTrip();
        		this.title = "位置信息监控";
        		window.clearInterval(window.singleRuntimePosInterval);
        		window.singleRuntimePosInterval = '';
        		$('#history-pos-console').slideUp();
        	},
        	title: '位置信息监控',
        	openConsole: function() {
        		console.log($('#history-pos-console'));
        		$('#history-pos-console').slideToggle();
        	}
        };

        vm.startSearch = function(e) {
        	var keyCode = window.event ? e.keyCode : e.which;
        	if(keyCode == 13) {

        		if(markerStack.length == 0) {
        			var alert = $mdDialog.confirm({
		                title: '请先选择社区',
		                content:'请先选择社区',
		                ok: '确定'
		            });
		            $mdDialog.show(alert);
        			return false;
        		}
        		
        		if(vm.search.content == '') {
        			var alert = $mdDialog.confirm({
		                title: '搜索内容不能为空',
		                content:'请填写搜索内容',
		                ok: '确定'
		            });
		            $mdDialog.show(alert);
		            return false;
        		}

        		var keywords = vm.search.content;

        		var currentMarker;

        		for (var i = 0; i < markerStack.length; i++) {
        			var curr = markerStack[i];
        			if(curr.imei == keywords || curr.idcard == keywords || curr.mobile == keywords) {
        				var currentMarker = curr;
        				break;
        			}else {
        				var alert = $mdDialog.confirm({
			                title: '搜索失败',
			                content:'无此信息',
			                ok: '确定'
			            });
			            $mdDialog.show(alert);
        			}
        		};

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

	    window.infoWindow = new AMap.InfoWindow({offset:new AMap.Pixel(0,-30)});
	    
	    var pushMark = function (lnglats,manInfo) {
	    	for(var i= 0,marker;i<lnglats.length;i++){
		        var marker=new AMap.Marker({
		           	position:lnglats[i],
		            map:map
		        });

		        var currentMan = manInfo[i];

		        var name = currentMan.realname;
		        var imei = currentMan.device_imei;
		        var time = $filter('date')(currentMan.last_time*1000,'yyyy-MM-dd hh:mm:ss');
		        var mobile = currentMan.mobile;

		        marker.content='<strong>姓名:</strong>'+name+'<br><strong>IMEI:</strong>'+imei+'<br><strong>定位时间:</strong>'+time+'<br><a href="javascript:followUp('+i+')">实时跟踪</a>&nbsp;&nbsp;<a href="javascript:followHistory('+currentMan.user_id+')">历史记录</a>';
		        marker.on('click',markerClick);

		        marker.mobile = mobile;
		        marker.name = name;
		        marker.idcard = currentMan.idcard;
		        marker.imei = imei;
		        marker.uid = currentMan.user_id;

		        // marker.emit('click',{target:marker});

		        markerStack.push(marker);
		        TotalLnglats.push(lnglats[i]);
		    }
	    }

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

        		var lnglats = [];
        		var oldMan = [];

        		for (var i = 0; i < realData.length; i++) {
        			var curr = realData[i];

        			var tmp = [];
        			tmp[0] = curr.lng;
        			tmp[1] = curr.lat;
        			lnglats.push(tmp);

        			var oldTmp = {};
        			oldTmp = curr;
        			oldMan.push(oldTmp);
        		};

        		pushMark(lnglats,oldMan);
		    	map.setCenter(lnglats[0]);

		    	var allRuntime = 10;
		    	if(window.runtimePosInterval == '') {
		    		window.runtimePosInterval = setInterval(function() {
		    			$('#pos-time').slideDown();
		    			$('#pos-time').html(allRuntime + ' 秒后刷新位置');
                        allRuntime --;
			    		$scope.getOldManTrip();
			    	},10000);
		    	}

        	});

        }

    }

})();
