(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesOrderController', BasicServicesOrderController);

    /* @ngInject */
    function BasicServicesOrderController($mdDialog, $state, $scope, OrderService) {
        var vm = this;

        $scope.order_curentPage = 1;
        $scope.order_total_pages = [];

        $scope.orderList = {};

        $scope.query = {
            orderKeywords: ''
        };

        $scope.getAllOrder = function() {
            $scope.order_total_pages = [];
        	OrderService.index($scope.order_curentPage,10).then(function(data) {

        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
        			alert('网络传输失败');
        		}

        		$scope.orderList = realData.properties.detail;
                var count = Math.ceil(realData.properties.count/10);
                for (var i = 1; i <= count; i++) {
                    $scope.order_total_pages.push(i);
                };

                $scope.order_currentPage = 1;

        	});
        };

        $scope.getAllOrder();

        $scope.newOrder = function() {
            $state.go('triangular.admin-default.service-new-work-order');
        };

        $scope.startSearchOrder = function($event) {
            var keywords = $('#order-search').val();
            if($event.keyCode == 13 && $event) {
                console.log($event.keyCode);
                console.log(keywords);
                if(keywords == '') {
                    $scope.getAllOrder();
                }else {
                    OrderService.search(keywords).then(function(data) {

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
                            $scope.orderList = realData.properties;
                        }
                        
                    }); 
                }
            }
        };

        $scope.backToAllOrderList = function() {
            $scope.query.orderKeywords = $('#order-search').val();
            if($scope.query.orderKeywords == '') {
                $scope.getAllOrder();
            }
        };

       	$scope.loadNextOrderPage = function() {
            $scope.getAllOrder();
       	};

    }

})();
