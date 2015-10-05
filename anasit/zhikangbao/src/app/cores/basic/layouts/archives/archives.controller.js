(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicArchivesController', BasicArchivesController);

    /* @ngInject */
    function BasicArchivesController($scope, $state, OldInfoService, $mdDialog) {
        var vm = this;
        vm.selected = '';

        $scope.healthArichiveTitle = '新增老人健康档案';
        $scope.edit = false;
        $scope.currentId = '';

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-archive');
        }

        $scope.insertHealthArchiveInfo = function() {

        }

        $scope.isArchive = false;

        $scope.returnToArchiveList = function() {
        	$scope.addNew();
        }

        $scope.oldInfoItemList = {};

        $scope.getOldInfo = function() {
            OldInfoService.index().then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                $scope.oldInfoItemList = realData.properties;                
            });
        }

        $scope.getOldInfo();

        $scope.viewThisArchive = function(uid) {
            $scope.isArchive = true;
        }

        $scope.returnToOldList = function() {
            $scope.isArchive = false;
        }

        $scope.showNewArchiveDialog = function() {
            $('#new-health-archive').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.edit = false;
            $scope.healthArichiveTitle = '新增老人健康档案';
        }

        $('#new-health-archive').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.saveNewHealthArchive = function() {

            if($scope.edit) {
                //编辑老人信息档案
            }else{
                //新增老人信息档案
            }

        }

        $scope.editThisArchive = function(id) {
            $scope.currentId = id;
            $scope.edit = true;
            $scope.healthArichiveTitle = '编辑老人健康档案';
            $('#new-health-archive').modal('show');
            $('.modal-backdrop').css('z-index','0');
        }

        $scope.removeThis = function() {
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
