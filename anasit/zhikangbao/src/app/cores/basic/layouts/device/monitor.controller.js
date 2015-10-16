(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicMonitorController', BasicMonitorController);

    /* @ngInject */
    function BasicMonitorController($scope, $state, MonitorService, $mdDialog, OrgService) {
        var vm = this;

        $scope.isEdit = false;

        $scope.query = {
            keywords: ''
        }

        $scope.getDevice = function() {
            MonitorService.index().then(function(response) {
                $scope.devices = response.Schema.properties;
                console.log($scope.devices);
            })
        }

        $scope.insertDeviceInfo = {};
        $scope.insertDeviceInfo.monitor_port = 1554;

        $scope.orgList = {};

        $scope.getDevice();

        $scope.addNewDevice = function() {
            $('#new-device').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.insertDeviceInfo = {};
            $scope.insertDeviceInfo.monitor_port = 1554;
            $scope.isEdit = false;
        };

        $('#new-device').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.deleteThisItem = function(id) {
            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });

            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    MonitorService.remove(id).then(function(data) {
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
                            $scope.getDevice();
                        }
                        $mdDialog.show(alert);
                    });
                }
            });
        }

        $scope.saveNewDevice = function() {
            if(!$scope.isEdit) {
                MonitorService.insert($scope.insertDeviceInfo).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    if(status != '200') {
                        var alert = $mdDialog.alert({
                            title: '添加失败',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                    }else {
                        var alert = $mdDialog.alert({
                            title: '添加成功',
                            content: '',
                            ok: '确定'
                        });
                        $scope.getDevice();
                    }
                    $mdDialog.show(alert);
                });
            }else {
                MonitorService.update($scope.insertDeviceInfo).then(function(data) {
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
                            content: '',
                            ok: '确定'
                        });
                        $scope.getDevice();
                    }
                    $mdDialog.show(alert);
                });
            }
            
        }

        OrgService.index().then(function(data) {

            var status = data.status;
            var realData = data.Schema;

            if(status != '200') {
                var alert = $mdDialog.alert({
                    title: '网络传输失败',
                    content: realData.properties.message,
                    ok: '确定'
                });
                $mdDialog.show(alert);
            }else {
                $scope.orgList = realData.properties;
            }

        });

        $scope.viewThisItem = function(id) {

            $scope.addNewDevice();

            $scope.isEdit = true;

            MonitorService.one(id).then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '网络传输失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else {
                    $scope.insertDeviceInfo = realData.properties;
                }

            });

        }

        $scope.getAllMonitor = function() {

            if($scope.query.keywords == '') {
                $scope.getDevice();
            }

        }

        $scope.startSearchMonitor = function($event) {

            var keyCode = $event.keyCode;

            if($event && keyCode == 13) {
                if($scope.query.keywords == '') {
                    alert('搜索内容不能为空');
                    return false;
                }

                MonitorService.search($scope.query.keywords).then(function(data) {

                    var status = data.status;
                    var realData = data.Schema;

                    if(status != '200') {
                        alert('网络请求失败');
                    }else {
                        $scope.devices = realData.properties;
                    }

                });
            }
            
        }

    }
})();
