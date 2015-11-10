(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicVideoController', BasicVideoController);

    /* @ngInject */
    function BasicVideoController($scope, OrgService, OrgInfoService, $mdDialog, MonitorService) {
        var vm = this;
        vm.testData = ['triangular', 'is', 'great'];

        $scope.orgList = {};
        $scope.MonitorList = {};
        $scope.orgCateList = {};

        $scope.currentOrg = '';
        $scope.currentMonitor = '';
        $scope.currentOrgCate = '';

        $scope.currentCodec = 'h264';
        $scope.currentSubtype = 'sub';

        $scope.videoValue = 'rtsp://admin:zkmoni777@192.168.1.55:1554/h264/ch1/main/av_stream';

        // OrgService.index().then(function(data) {
        // 	var status = data.status;
        // 	var realData = data.Schema;

        // 	if(status != '200') {
        // 		var alert = $mdDialog.alert({
        //             title: '网络传输失败',
        //             content: realData.properties.message,
        //             ok: '确定'
        //         });
        //         $mdDialog.show(alert);
        // 	}else {
        // 		$scope.orgList = realData.properties;
        // 	}
        // });

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

        $scope.getMonitorList = function() {
        	var id = $scope.currentOrg;
        	MonitorService.getByOrg(id).then(function(data) {

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
	        		$scope.MonitorList = realData.properties;
	        		console.log($scope.MonitorList);
	        	}

        	});
        }

        $scope.getVideo = function() {
        	var monitor = $scope.currentMonitor;
        	var name = monitor.username, pw = monitor.password, ip = monitor.ip, domain = monitor.domain;
        	var port = monitor.monitor_port;
        	if(port == '') {
        		port = '1554';
        	}
        	$scope.videoValue = 'rtsp://'+name+':'+pw+'@'+ip+':'+port+'/'+$scope.currentCodec+'/ch1/'+$scope.currentSubtype+'/av_stream';
        	console.log($scope.videoValue);
        	var videoHTML = "<!--[if IE]>"+
"   <object type=\'application/x-vlc-plugin\' id=\'basicVideo\' events=\'True\'"+
"       classid=\'clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921\' codebase=\"http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab\" width=\"100%\" height=\"410\">"+
"          <param name=\'mrl\' value=\""+$scope.videoValue+"\" />"+
"          <param name=\'volume\' value=\'50\' />"+
"          <param name=\'autoplay\' value=\'true\' />"+
"          <param name=\'loop\' value=\'false\' />"+
"          <param name=\'fullscreen\' value=\'false\' />"+
"          <param name=\'controls\' value=\'false\' />"+
"    </object>"+
"<![endif]-->"+
"<!--[if !IE]><!-->"+
"    <object type=\'application/x-vlc-plugin\' id=\'basicVideo\' events=\'True\' width=\"100%\" height=\"410\" pluginspage=\"http://www.videolan.org\" codebase=\"http://downloads.videolan.org/pub/videolan/vlc-webplugins/2.0.6/npapi-vlc-2.0.6.tar.xz\">"+
"        <param name=\'mrl\' value=\""+$scope.videoValue+"\" />"+
"        <param name=\'volume\' value=\'50\' />"+
"        <param name=\'autoplay\' value=\'true\' />"+
"        <param name=\'loop\' value=\'false\' />"+
"        <param name=\'fullscreen\' value=\'false\' />"+
"        <param name=\'controls\' value=\'false\' />"+
"    </object>"+
"<!--<![endif]-->";

/*

<!--[if IE]>
          <object type='application/x-vlc-plugin' id='basicVideo' events='True'
         classid='clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921' codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab" width="100%" height="410">
          <param name='mrl' value='rtsp://admin:zkmoni777@192.168.1.55:1554/h264/ch1/main/av_stream' />
           <param name='volume' value='50' />
           <param name='autoplay' value='true' />
          <param name='loop' value='false' />
          <param name='fullscreen' value='false' />
          <param name='controls' value='false' />
    </object>
    <![endif]-->
    <!--[if !IE]><!-->
        <object type='application/x-vlc-plugin' id='basicVideo' events='True' width="100%" height="410" pluginspage="http://www.videolan.org" codebase="http://downloads.videolan.org/pub/videolan/vlc-webplugins/2.0.6/npapi-vlc-2.0.6.tar.xz">
            <param name='mrl' value='rtsp://admin:zkmoni777@192.168.1.55:1554/h264/ch1/main/av_stream' />
                <param name='volume' value='50' />
                <param name='autoplay' value='true' />
            <param name='loop' value='false' />
            <param name='fullscreen' value='false' />
        <param name='controls' value='false' />
    </object>
    <!--<![endif]-->    

    
*/

	
	$('#monitor-area').html(videoHTML);
            $scope.selectVideoArea();
        };

        $scope.selectArea = false;
        $scope.selectTitle = '选择视频监控区域'

        $scope.selectVideoArea = function() {
            if($scope.selectArea) {
                $scope.selectArea = false;
                $('#basicVideo').show();
                $scope.selectTitle = '选择视频监控区域';
            }else {
                $scope.selectArea = true;
                $('#basicVideo').hide();
                $scope.selectTitle = '完成选择';
            }

        };

    }
})();
