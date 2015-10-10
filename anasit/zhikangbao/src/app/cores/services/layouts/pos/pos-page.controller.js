(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesPosController', BasicServicesPosController);

    /* @ngInject */
    function BasicServicesPosController($mdDialog, $state) {
        var vm = this;

        vm.search = {
        	content: ''
        };

        window.ServicesPosVM = vm;

        //定义位置的查看状态0表示全体1表示追踪
        //默认为0
        vm.posStatus = {
        	status: 0,
        	backToWhole: function() {
        		vm.posStatus.status = 0;
        		$state.go('triangular.admin-default.services-pos');
        		$('#returnRoWholeBtn').hide();
        		for(var i= 0,marker;i<lnglats.length;i++){
			        var marker=new AMap.Marker({
			           	position:lnglats[i],
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
        		'marker': ''
        	},
        	'18115992267': {
        		'marker': ''
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



        	}
        };

        window.map = new AMap.Map("amap-container", {
	        resizeEnable: true,
	        zoom: 13
	    });
	    window.markerStack = [];
	    window.currentMarker = '';

	    var lnglats=[
	        [116.368904,39.923423],
	        [116.382122,39.921176],
	        [116.387271,39.922501],
	        [116.398258,39.914600]
	    ];
	    
	    window.infoWindow = new AMap.InfoWindow({offset:new AMap.Pixel(0,-30)});
	    
	    for(var i= 0,marker;i<lnglats.length;i++){
	        var marker=new AMap.Marker({
	           	position:lnglats[i],
	            map:map
	        });
	        marker.content='<strong>姓名:</strong><br><strong>IMEI:</strong><br><strong>定位时间:</strong><br><strong>状态:</strong><br><a href="javascript:followUp('+i+')">实时跟踪</a>&nbsp;&nbsp;<a href="">历史记录</a>';
	        marker.on('click',markerClick);
	        // marker.emit('click',{target:marker});
	        markerStack.push(marker);
	    }

	    function markerClick(e){
	        infoWindow.setContent(e.target.content);
	        infoWindow.open(map, e.target.getPosition());
	        map.setCenter(e.target.getPosition());
	        currentMarker = e;
	    }

	    map.setFitView();

    }

})();
