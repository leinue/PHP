(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesCallController', BasicServicesCallController);

    /* @ngInject */
    function BasicServicesCallController($mdDialog, $state, $scope, YulpService, RefreshService) {
        var vm = this;

		$scope.helpList = {};
		$scope.detailList = {};
		$scope.familyList = {};

        $scope.query = {
            keywords: ''
        };

        $scope.call_total_pages = [];
        $scope.call_currentPage = 1;

        $scope.getHelpList = function() {

            $scope.call_total_pages = [];

        	YulpService.index($scope.call_currentPage,10).then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		console.log(realData);

        		if(status != '200') {

        			var alert=$mdDialog.alert({
        				title: '获取求救呼叫列表失败',
        				content: realData.properties.message,
        				ok: '确定'
        			});

        			$mdDialog.show(alert);

        		}else {
        			$scope.helpList = realData.properties.detail;
                    $scope.yulpInfoCount = realData.properties.count;
                    var count = Math.ceil(realData.properties.count/10);
                    for (var i = 1; i <= count; i++) {
                        $scope.call_total_pages.push(i);
                    };
        		}

        	});

        };

        $scope.loadNextCallPage = function(page) {
            // console.log();
            $scope.call_currentPage = page;
            $scope.getHelpList();
        }

        $scope.getHelpList();

        $scope.refreshMyCallList = function() {
            RefreshService.refresh();
            $scope.getHelpList();
        }

        $scope.viewThisYulp = function(id) {

        	YulpService.detail(id).then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {

        			var alert = $mdDialog.alert({
        				title: '获取详细信息失败',
        				content: realData.properties.message,
        				ok: '确定'
        			});

        			$mdDialog.show(alert);

        		}else {
        			$scope.detailList = realData.properties;
        			$('#old-info').modal('show');
        			$('.modal-backdrop').css('z-index','0');
        		}
        	});

        }

        $scope.viewThisFamily = function(id) {

        	YulpService.family(id).then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {

        			var alert = $mdDialog.alert({
        				title: '获取详细信息失败',
        				content: realData.properties.message,
        				ok: '确定'
        			});

        			$mdDialog.show(alert);

        		}else {
        			$scope.familyList = realData.properties;
        			if($scope.familyList.length > 0) {
        				$scope.member_name_id = $scope.familyList[0].id;
        				$scope.member_mobile_id = $scope.familyList[0].id;
        				$scope.member_relation_id = $scope.familyList[0].id;
        			}else {
        				$scope.familyList = [];
        				$scope.familyList[0] = {};
        				$scope.familyList[0].realname = '暂无';
        				$scope.familyList[0].mobile = '暂无';
        				$scope.familyList[0].relation = '暂无';
        			}

        			console.log($scope.familyList);
        			$('#old-family-member').modal('show');
        			$('.modal-backdrop').css('z-index','0');
        		}

        	});

        }

        $('#old-info,#old-family-member').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.changeCurrentMember = function() {
        	$scope.member_mobile_id = $scope.member_name_id;
        	$scope.member_relation_id = $scope.member_name_id;
        }

        $scope.triggerCallSearch = function() {
            $scope.call_total_pages = [];
            $scope.query.keywords = $('#sos-search-input').val();
            var keywords = $scope.query.keywords;
            if(keywords == '') {
                $scope.getHelpList();
            }else {
                YulpService.search(keywords).then(function(data) {

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
                        $scope.yulpInfoCount = $scope.helpList.length;
                    }
                    
                }); 
            }
        }

        $scope.startSearchSos = function($event) {
            if($event.keyCode == 13 && $event) {
                $scope.triggerCallSearch();
            }
        }

        $scope.backToAllSosList = function() {
            if($scope.query.keywords == '') {
                $scope.getHelpList();
            }
        }

    }

})();
