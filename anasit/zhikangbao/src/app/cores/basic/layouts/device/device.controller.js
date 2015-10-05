(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicDeviceController', BasicDeviceController);

    /* @ngInject */
    function BasicDeviceController($scope, $state, DeviceService, $mdDialog) {
        var vm = this;

        $scope.getDevice = function() {
            DeviceService.index().then(function(response) {
                $scope.devices = response.Schema.properties;   
            })
        }

        $scope.insertDeviceInfo = {};

        $scope.getDevice();

        $scope.addNewDevice = function() {
            $('#new-device').modal('show');
            $('.modal-backdrop').css('z-index','0');
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
                    DeviceService.remove(id).then(function(data) {
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
                    });
                }
            });
        }

        $scope.saveNewDevice = function() {
            DeviceService.insert($scope.insertDeviceInfo).then(function(data) {
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
            });
        }
    }
})();
