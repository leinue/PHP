(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicArchivesController', BasicArchivesController);

    /* @ngInject */
    function BasicArchivesController($scope, $state, OldInfoService, $mdDialog, HealthService, $filter) {
        var vm = this;
        vm.selected = '';

        $scope.healthArichiveTitle = '新增老人健康档案';
        $scope.edit = false;
        $scope.currentId = '';
        $scope.currentUid = '';
        $scope.currentUserName = '';

        $scope.healthInfoList = {};

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-archive');
        }

        $scope.insertHealthArchiveInfo = {
            blood_pressure: '',
            blood_sugar: '',
            pulse_rate: '',
            blood_hb: '',
            temper: '',
            blood_spo: '',
            last_time: ''
        };

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

        $scope.viewThisArchive = function(uid,username) {
            $scope.isArchive = true;

            $scope.currentUid = uid;
            $scope.currentUserName = username;

            HealthService.one(uid).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                if(status != '200') {
                    alert('网络传输失败,请重试');
                }else{
                    $scope.healthInfoList = realData.properties;
                    $scope.healthInfoList.username = username;
                }
            });
        }

        $scope.returnToOldList = function() {
            $scope.isArchive = false;
        }

        $scope.showNewArchiveDialog = function() {
            $('#new-health-archive').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.edit = false;
            $scope.healthArichiveTitle = '新增老人健康档案';
            $scope.insertHealthArchiveInfo = {};
        }

        $('#new-health-archive').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.saveNewHealthArchive = function() {

            if($scope.edit) {
                //编辑老人信息档案
                // $scope.insertHealthArchiveInfo.user_id = $scope.currentUid;
                console.log($scope.insertHealthArchiveInfo);
                HealthService.update($scope.insertHealthArchiveInfo).then(function(data){
                    var status = data.status;
                    var realData = data.Schema;
                    if(status != '200') {
                        var alert = $mdDialog.alert({
                            title: '编辑失败',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                    }else {
                        var alert = $mdDialog.alert({
                            title: '编辑成功',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                        $scope.viewThisArchive($scope.currentUid,$scope.currentUserName);
                    }
                    $mdDialog.show(alert);
                });
            }else{
                //新增老人信息档案
                $scope.insertHealthArchiveInfo.user_id = $scope.currentUid;
                HealthService.insert($scope.insertHealthArchiveInfo).then(function(data){
                    var status = data.status;
                    var realData = data.Schema;
                    if(status != '200') {
                        var alert = $mdDialog.alert({
                            title: '新增失败',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                    }else {
                        var alert = $mdDialog.alert({
                            title: '新增成功',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                        $scope.viewThisArchive($scope.currentUid,$scope.currentUserName);
                    }
                    $mdDialog.show(alert);
                });
            }

        }

        $scope.editThisArchive = function(id) {
            $scope.currentId = id;
            $scope.edit = true;
            $scope.healthArichiveTitle = '编辑老人健康档案';
            $('#new-health-archive').modal('show');
            $('.modal-backdrop').css('z-index','0');
            HealthService.singleOne(id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '获取数据失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else{
                    $scope.insertHealthArchiveInfo = realData.properties;
                }
            });
        }

        $scope.removeThis = function(id) {
            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });
            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    HealthService.remove(id).then(function(data) {
                        var status = data.status;
                        var realData = data.Schema;
                        if(status === '400') {
                            var alert = $mdDialog.alert({
                                title: '删除失败',
                                content: realData.properties.message,
                                ok: '确定'
                            });
                        }else {
                            var alert = $mdDialog.alert({
                                title: '删除成功',
                                content: '',
                                ok: '确定'
                            });
                            $scope.viewThisArchive($scope.currentUid,$scope.currentUserName);
                        }
                        $mdDialog.show(alert);
                    });
                }
            });
        }
    }
})();
