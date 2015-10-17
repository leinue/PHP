(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesHelpController', BasicServicesHelpController);

    /* @ngInject */
    function BasicServicesHelpController($mdDialog, $state, $scope, HelpService) {
        var vm = this;

        $scope.helpList = {};

        $scope.query = {
            keywords: ''
        };

        $scope.getHelpList = function() {

        	HelpService.index().then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {

        			var alert=$mdDialog.alert({
        				title: '获取求助列表失败',
        				content: realData.properties.message,
        				ok: '确定'
        			});

        			$mdDialog.show(alert);

        		}else {
        			console.log(realData.properties);
        			$scope.helpList = realData.properties;
        		}

        	});

        };

        $scope.getHelpList();

        $scope.confirmDeal = function(id) {

        	if(id == null || typeof id == 'undefined') {
        		return false;
        	}

        	var data = {
        		id: id
        	}

        	HelpService.setDeal(data).then(function(data) {

        		var status = data.status;
        		var realData  = data.Schema;

        		if(status != '200') {

        			var alert = $mdDialog.alert({
        				title: '受理失败',
        				content: realData.properties.message,
        				ok: '确定'
        			});

        		}else {

        			var alert = $mdDialog.alert({
        				title: '受理成功',
        				content: realData.properties.message,
        				ok: '确定'
        			});

        		}


        		$mdDialog.show(alert);
        		$scope.getHelpList();

        	});

        }

        $scope.startSearchHelp = function($event) {
            var keywords = $scope.query.keywords;
            if($event.keyCode == 13) {
                $scope.oldArchiveInfoItemList = {};
                if(keywords == '') {
                    $scope.getHelpList();
                }else {
                    HelpService.search(keywords).then(function(data) {

                        console.log(data);

                        var status = data.status;
                        var realData = data.Schema;

                        if(status != '200') {
                            var alert = $mdDialog.alert({
                                title: '搜索失败',
                                content: realData.properties.message,
                                ok: '确定'
                            });
                            $mdDialog.show(alert);
                        }else {
                            $scope.helpList = realData.properties;
                        }
                        
                    }); 
                }
            }
        }

        $scope.backToAllHelpList = function() {
            if($scope.query.keywords == '') {
                $scope.getHelpList();
            }
        }

    }

})();
