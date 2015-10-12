(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicVideoController', BasicVideoController);

    /* @ngInject */
    function BasicVideoController($scope, OrgService, $mdDialog, MonitorService) {
        var vm = this;
        vm.testData = ['triangular', 'is', 'great'];

        $scope.orgList = {};
        $scope.MonitorList = {};

        $scope.currentOrg = '';
        $scope.currentMonitor = '';

        OrgService.index().then(function(data) {
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
        		console.log($scope.orgList);
        	}

        	
        });

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

    }
})();
