(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicDeviceController', BasicDeviceController);

    /* @ngInject */
    function BasicDeviceController($scope, $state, DeviceService, $mdDialog) {
        var vm = this;

        $scope.device_currentPage = 1;
        $scope.device_total_pages = [];

        $scope.getDevice = function() {
            $scope.call_total_pages = [];
            DeviceService.index($scope.device_currentPage,10).then(function(response) {
                $scope.devices = response.Schema.properties.detail;   
                var count = Math.ceil(response.Schema.properties.count/10);
                for (var i = 1; i <= count; i++) {
                    $scope.device_total_pages.push(i);
                };
            })
        }

        //////////////////////////

        $scope.loadNextDevicePage = function(page) {
            $scope.device_currentPage = page;
            $scope.getDevice();
        }

        $scope.query = {
            keywords: ''
        };

        $scope.insertDeviceInfo = {};

        $scope.getDevice();

        $scope.addNewDevice = function() {
            $('#new-device').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.insertDeviceInfo = {};
        };

        $('#new-device,#view-device').on('hidden.bs.modal', function (e) {
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
                        $mdDialog.show(alert);
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
                $mdDialog.show(alert);
            });
        }

        $scope.getAllDevice = function() {

            if($scope.query.keywords == '') {
                $scope.getDevice();
            }

        }

        $scope.viewThisDeviceItem = function(data) {
            $('#view-device').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.insertDeviceInfo = data;
        }

        $scope.confirmEditDevice = function() {
            DeviceService.update($scope.insertDeviceInfo).then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '修改失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                }else {
                    var alert = $mdDialog.alert({
                        title: '修改成功',
                        content: '',
                        ok: '确定'
                    });
                    $scope.getDevice();
                }

                $mdDialog.show(alert);

            });
        }

        $scope.triggerDeviceSeaech = function() {
            if($scope.query.keywords == '') {
                    alert('搜索内容不能为空');
                    return false;
                }

                DeviceService.search($scope.query.keywords).then(function(data) {

                    var status = data.status;
                    var realData = data.Schema;

                    if(status != '200') {
                        alert('网络请求失败');
                    }else {
                        $scope.devices = realData.properties;
                    }

                });
        }

        $scope.startSearchDevice = function($event) {

            $scope.query.keywords = $('#device-search-input').val();

            var keyCode = $event.keyCode;

            if($event && keyCode == 13) {
                $scope.triggerDeviceSeaech();
            }
            
        }
    }
})();
