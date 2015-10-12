(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicAdminController', BasicAdminController);

    /* @ngInject */
    function BasicAdminController($scope, $state, $mdDialog, UserMgrService) {
        var vm = this;

        $scope.userWithoutRightsList = {};

        $scope.getUserNoRights = function() {

            UserMgrService.index().then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status!= '200') {
                    var alert = $mdDialog.alert({
                        title: '获取无权限用户列表失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });

                    $mdDialog.show(alert);
                }else {
                    $scope.userWithoutRightsList = realData.properties;
                    console.log($scope.userWithoutRightsList);
                }

            });

        };

        $scope.getUserNoRights();

        $scope.setUserAdmin = function (id) {

            UserMgrService.setAdmin().then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {

                    var alert = $mdDialog.alert({
                        title: '设置管理员失败',
                        cotnent: realData.properties.message,
                        ok: '确定'
                    });

                }else {

                    var alert = $mdDialog.alert({
                        title: '设置管理员成功',
                        content: realData.properties.message,
                        ok: '确定'
                    });

                    $scope.getUserNoRights();

                }

                $mdDialog.show(alert);

            });

        }

    }
})();
