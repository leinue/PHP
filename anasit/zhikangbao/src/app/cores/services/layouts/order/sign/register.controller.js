(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesOrderRegisterController', BasicServicesOrderRegisterController);

    /* @ngInject */
    function BasicServicesOrderRegisterController($mdDialog, $state, $scope, OrderService, RefreshService, $filter) {
        var vm = this;

        $scope.order_curentPage = 1;
        $scope.order_total_pages = [];

        $scope.orderList = {};

        $scope.query = {
            orderKeywords: ''
        };

        $scope.viewUser = {};

        $scope.getAllOrder = function() {
            $scope.order_total_pages = [];
          OrderService.index($scope.order_curentPage,10).then(function(data) {

            var status = data.status;
            var realData = data.Schema;

            if(status != '200') {
              alert('网络传输失败');
            }

            $scope.orderList = realData.properties.detail;
                $scope.orderInfoCount = realData.properties.count; 
                var count = Math.ceil(realData.properties.count/10);
                for (var i = 1; i <= count; i++) {
                    $scope.order_total_pages.push(i);
                };

                $scope.order_currentPage = 1;

          });
        };

        $scope.getAllOrder();

        $scope.refreshMyWorkList = function() {
            RefreshService.refresh();
            $scope.getAllOrder();
        }

        $scope.newOrder = function() {
            $('#detail-register').modal('show');
            $('.modal-backdrop').css('z-index','0');
        };

        $scope.triggerOrderSearch = function(keywords) {
            var keywords = $('#order-search').val();
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
                        $scope.orderInfoCount = $scope.orderList.length;
                    }
                    
                }); 
            }
        };

        $scope.startSearchOrder = function($event) {
            if($event.keyCode == 13 && $event) {
                $scope.triggerOrderSearch();  
            }
        };

        $scope.backToAllOrderList = function() {
            $scope.query.orderKeywords = $('#order-search').val();
            if($scope.query.orderKeywords == '') {
                $scope.getAllOrder();
            }
        };

        $scope.loadNextOrderPage = function(page) {
            $scope.order_curentPage = page;
            $scope.getAllOrder();
        };

        $scope.confirmDealThis = function(id) {
            OrderService.confirm(id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '确认失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else {
                    var alert = $mdDialog.alert({
                        title: '确认成功',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }
            });
            $scope.getAllOrder();
        };

        $scope.viewThisOrder = function(user) {
            $('#detail-register').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.viewUser = user;
        };

        $('#detail-register').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.$watch('insertHealthArchiveInfo.lasta_time', function(newV,oldV) {
            $scope.insertHealthArchiveInfo.lasta_time = $filter('date')(newV,'yyyy-MM-dd');
        });

        $scope.$watch('insertHealthArchiveInfo.last_time', function(newV,oldV) {
            $scope.insertHealthArchiveInfo.last_time = $filter('date')(newV,'yyyy-MM-dd');
        });

    }

})();
