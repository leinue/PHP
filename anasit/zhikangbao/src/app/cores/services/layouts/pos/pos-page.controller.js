(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesPosController', BasicServicesPosController);

    /* @ngInject */
    function BasicServicesPosController($mdDialog, $state, $scope, OrgInfoService) {
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
	    
	    var pushMark = function (lnglats) {
	    	for(var i= 0,marker;i<lnglats.length;i++){
		        var marker=new AMap.Marker({
		           	position:lnglats[i],
		            map:map
		        });
		        marker.content='<strong>姓名:</strong>'+nameList[i]+'<br><strong>IMEI:</strong><br><strong>定位时间:</strong><br><a href="javascript:followUp('+i+')">实时跟踪</a>&nbsp;&nbsp;<a href="javascript:followHistory()">历史记录</a>';
		        marker.on('click',markerClick);
		        // marker.emit('click',{target:marker});
		        markerStack.push(marker);
		        TotalLnglats.push(lnglats[i]);
		        markerList['18700000000'].marker = marker;
		    }
	    }

	    pushMark(lnglats);

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

        	var id = $scope.currentOrg;

        	id = id / 100;

        	var extra  = Math.random();
        	extra = extra / 100;

        	var extraTmp = Math.random();
        	extraTmp = extraTmp / 1000;

        	var lnglats=[
		        [111.488905 + id,27.23421 + extra + extraTmp],
		        [111.4821226 + id,27.222506 + extra + extraTmp],
		        [111.482714 + id,27.24605+ extra + extraTmp],
		        [111.4832512 + id,27.256172 + extra + extraTmp],
		        [111.4855082 + id,27.214837 + extra + extraTmp],
		        [111.4862762 + id,27.221274 + extra + extraTmp]
		    ];

		    pushMark(lnglats);
		    map.setCenter(lnglats[0]);

        }

    }

})();
