(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicOrgController', BasicOrgController);

    /* @ngInject */
    function BasicOrgController($scope, $state, $mdDialog, OrgInfoService, OrgService) {
        var vm = this;

        $scope.orgTitle = '新增组织信息';
        $scope.edit = false;

        $scope.orgList = {};
        $scope.insertOrgList = {};

        $scope.orgCateList = {};

        $scope.orgEnabled = {
            0: {
                id: '1',
                name: '是'
            },
            1: {
                id: '0',
                name: '否'
            }
        };

        OrgInfoService.index().then(function(data) {
            var status = data.status;
            var realData = data.Schema;

            if(status != '200') {
                var alert = $mdDialog.alert({
                    title: '读取组织结构信息失败,请重试',
                    content: realData.properties.message,
                    ok: '确定'
                });
               $mdDialog.show(alert);
            }else{
                $scope.orgCateList = realData.properties;
            }
        });

        $scope.getAllOrgInfo = function() {
            OrgService.index().then(function(data) {
                console.log(data);
                var realData = data.Schema;
                $scope.orgList = realData.properties;
            });
        }

        $scope.getAllOrgInfo();

        $scope.addNewOrg = function() {
            $scope.edit = false;
            $scope.orgTitle = '新增组织信息';
            $('#new-org').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.insertOrgList = {};
        };

        $('#new-device').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.editThisItem = function(id) {
            $scope.orgTitle = '编辑组织信息';
            $scope.edit = true;
            $('#new-org').modal('show');
            $('.modal-backdrop').css('z-index','0');

            OrgService.one(id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                $scope.insertOrgList = realData.properties[0];
            });
        }

        $scope.saveNewOrg = function() {
            if($scope.edit) {
                //编辑组织信息
                OrgService.update($scope.insertOrgList).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    if(status != '200') {
                        var alert = $mdDialog.alert({
                            title: '编辑失败',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                    }else{
                        var alert = $mdDialog.alert({
                            title: '编辑成功',
                            content: '',
                            ok: '确定'
                        });
                        $scope.getAllOrgInfo();
                        $('#new-org').modal('hide');
                    }
                    $mdDialog.show(alert);
                });
            }else{
                //新增组织信息
                OrgService.insert($scope.insertOrgList).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    if(status != '200') {
                        var alert = $mdDialog.alert({
                            title: '新增失败',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                    }else{
                        var alert = $mdDialog.alert({
                            title: '新增成功',
                            content: '',
                            ok: '确定'
                        });
                        $scope.getAllOrgInfo();
                        $('#new-org').modal('hide');
                    }
                    $mdDialog.show(alert);
                });
            }
        }

        $scope.deleteThisItem = function(id) {
            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });

            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    OrgService.remove(id).then(function(data) {
                        var status = data.status;
                        var realData = data.Schema;
                        if(status != '200') {
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
                            $scope.getAllOrgInfo();
                        }
                        $mdDialog.show(alert);
                    });
                }
            });
        };

        $scope.viewThisOrg = function(id) {
            $scope.editThisItem(id);
        };

    }
})();
