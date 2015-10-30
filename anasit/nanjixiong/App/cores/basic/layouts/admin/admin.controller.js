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

        $scope.currentUserId = '';
        $scope.role_id_selected = '';
        $scope.roleIdList = {};

        $scope.changeRoleId = function(val) {
            console.log(val);
            $scope.role_id_selected = val;
        }

        $scope.openOperatingForm = function(user_id,role_id) {
            $('#right-mgr').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.currentUserId = user_id;
            $scope.role_id_selected = role_id;
            UserMgrService.getRoles().then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    alert('获取权限列表失败');
                    return false;
                }

                console.log(realData.properties);
                $scope.roleIdList = realData.properties;

            });
        };

        $('#right-mgr').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
            $scope.currentUserId == '';
            $scope.role_id_selected == '';
        });

        $scope.confirmRights = function() {

            if($scope.currentUserId == '' || $scope.role_id_selected == '') {
                return false;
            }

            $scope.setUserAdmin($scope.currentUserId,$scope.role_id_selected);

        };

        $scope.setUserAdmin = function (id,role_id) {

            UserMgrService.setAdmin(id,role_id).then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {

                    var alert = $mdDialog.alert({
                        title: '设置权限失败',
                        cotnent: realData.properties.message,
                        ok: '确定'
                    });

                }else {

                    var alert = $mdDialog.alert({
                        title: '设置权限成功',
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
