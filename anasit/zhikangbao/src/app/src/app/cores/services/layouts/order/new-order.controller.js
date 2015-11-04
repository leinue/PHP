(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesNewOrderController_', BasicServicesNewOrderController_);

    /* @ngInject */
    function BasicServicesNewOrderController_($mdDialog, $state, $scope, OrderService) {
        var vm = this;

        $scope.insertOrderInfo = {};

        $scope.confirmNewOrder = function() {
        	OrderService.insert($scope.insertOrderInfo).then(function(data) {
        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
					var alert = $mdDialog.alert({
                        title: '添加失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
        			return false;
        		}

        		var alert = $mdDialog.alert({
                    title: '添加成功',
                    content: '添加成功',
                    ok: '确定'
                });
                $mdDialog.show(alert);

                $scope.returnToOrderList();

        	});
        };

        $scope.returnToOrderList = function() {
        	$state.go('triangular.admin-default.services-work');
        }
    }

})();
