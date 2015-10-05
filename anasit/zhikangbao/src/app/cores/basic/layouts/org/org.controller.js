(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicOrgController', BasicOrgController);

    /* @ngInject */
    function BasicOrgController($scope, $state, $mdDialog) {
        var vm = this;

        $scope.orgTitle = '新增组织信息';
        $scope.edit = false;

        $scope.addNewOrg = function() {
            $scope.edit = false;
            $scope.orgTitle = '新增组织信息';
            $('#new-org').modal('show');
            $('.modal-backdrop').css('z-index','0');
        };

        $('#new-device').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.editThisItem = function() {
            $scope.orgTitle = '编辑组织信息';
            $scope.edit = true;
            $('#new-org').modal('show');
            $('.modal-backdrop').css('z-index','0');
        }

        $scope.saveNewOrg = function() {
            if($scope.edit) {
                //编辑组织信息
            }else{
                //新增组织信息
            }
        }

        $scope.deleteThisItem = function() {
            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });

            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    // OldInfoService.remove(id).then(function(data) {
                    //     var status = data.status;
                    //     var realData = data.Schema;
                    //     if(status === '400') {
                    //         var alert = $mdDialog.alert({
                    //             title: '删除失败',
                    //             content: realData.properties.message,
                    //             ok: '确定'
                    //         });
                    //     }else {
                    //         var alert = $mdDialog.alert({
                    //             title: '删除成功',
                    //             content: '',
                    //             ok: '确定'
                    //         });
                    //     }
                    // });
                }
            });
        }

    }
})();
