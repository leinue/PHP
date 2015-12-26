(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicDeviceController', BasicDeviceController);

    /* @ngInject */
    function BasicDeviceController($scope, $state, DeviceService, $mdDialog, RefreshService, $filter, OrgService) {
        var vm = this;

        $scope.device_currentPage = 1;
        $scope.device_total_pages = [];

        $scope.getDevice = function() {
            $scope.device_total_pages = [];
            DeviceService.index($scope.device_currentPage,10).then(function(response) {
                $scope.devices = response.Schema.properties.detail; 
                $scope.deviceInfoCount = response.Schema.properties.count;   
                var count = Math.ceil(response.Schema.properties.count/10);
                for (var i = 1; i <= count; i++) {
                    $scope.device_total_pages.push(i);
                };
            });
        }

        $scope.refreshMyDeviceList = function() {
            RefreshService.refresh();
            // $scope.getDevice();
            $scope.loadDifferentDevice($scope.isDeviceBinded);
        }

        //////////////////////////

        $scope.loadNextDevicePage = function(page) {
            $scope.device_currentPage = page;
            if($scope.device_currentPage > $scope.device_total_pages.length) {
                $scope.device_currentPage = 1;
            }
            $scope.loadDifferentDevice($scope.isDeviceBinded);
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

        $('#new-device,#view-device,#bind-device-to-old').on('hidden.bs.modal', function (e) {
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
                            $scope.loadDifferentDevice($scope.isDeviceBinded);
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
            $scope.insertDeviceInfo.active_time = $filter('date')($scope.insertDeviceInfo.active_time * 1000, 'yyyy-MM-dd');
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
                    $scope.loadDifferentDevice($scope.isDeviceBinded);
                }

                $mdDialog.show(alert);

            },function(error) {
                var alert = $mdDialog.alert({
                    title: '编辑设备信息失败,请联系管理员,错误代码:' + error.status,
                    content: error.statusText,
                    ok: '确定'
                });
                $mdDialog.show(alert);
            });
        }

        $scope.triggerDeviceSeaech = function() {
            if($scope.query.keywords == '') {
                    $scope.loadDifferentDevice($scope.isDeviceBinded);
                    return false;
                }

                DeviceService.search($scope.query.keywords).then(function(data) {

                    var status = data.status;
                    var realData = data.Schema;

                    if(status != '200') {
                        alert('网络请求失败');
                    }else {
                        $scope.devices = realData.properties;
                        $scope.deviceInfoCount = $scope.devices.length;
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

        $scope.orgList = {};
        OrgService.index().then(function(data){
            $scope.orgList = data.Schema.properties;
        },function(error) {
            var alert = $mdDialog.alert({
                title: '获取组织结构列表失败,请联系管理员,错误代码:' + error.status,
                content: error.statusText,
                ok: '确定'
            });
            $mdDialog.show(alert);
        });

        $scope.importNewDevice = function() {
            window.open('http://api.zkkj168.com/a/index.php?method=device','_blank','height=500px,width=750px,menubar=no,titlebar=no,scrollbar=no,toolbar=no,status=no,location=no,resizable=no');
        }

        $scope.downloadDeviceCsv = function() {
            window.open('http://api.zkkj168.com/deviceInfo.csv');
        }

        $scope.isDeviceBinded = true;

        $scope.getDeviceUnbinded = function() {
            $scope.device_total_pages = [];
            DeviceService.indexUnbundled($scope.device_currentPage,10).then(function(response) {
                $scope.devices = response.Schema.properties.detail; 
                $scope.deviceInfoCount = response.Schema.properties.count;   
                var count = Math.ceil(response.Schema.properties.count/10);
                for (var i = 1; i <= count; i++) {
                    $scope.device_total_pages.push(i);
                };
            });
        };

        $scope.loadDifferentDevice = function(isBinded) {

            if(isBinded) {
                 $scope.getDevice();
                 $scope.isDeviceBinded = true;
                 if($scope.device_currentPage > $scope.device_total_pages.length) {
                    $scope.device_currentPage = 1;
                    $scope.loadNextDevicePage();
                 }
            }else {
                $scope.getDeviceUnbinded();
                $scope.isDeviceBinded = false;
            }

        };

        $scope.deviceToBindId = 0;
        $scope.oldToBindId = 0;

        $scope.bindThisDeviceToOld = function(device_id) {
            $scope.deviceToBindId = device_id;
            $('#bind-device-to-old').modal('show');
            $('.modal-backdrop').css('z-index','0');
        };

        $scope.unbindThisDeviceToOld = function(did, idcard) {
            DeviceService.unbindDevice(did, idcard).then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '解绑失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else {
                    var alert = $mdDialog.alert({
                        title: '解绑成功',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                    $scope.loadDifferentDevice($scope.isDeviceBinded);
                }

            }, function(error) {
                var alert = $mdDialog.alert({
                    title: '出错了,请联系管理员,错误代码:' + error.status,
                    content: error.statusText,
                    ok: '确定'
                });
                $mdDialog.show(alert);
            });
        };

        $scope.confirmToBindThisToDevice = function(idcard) {
            $scope.oldToBindId = idcard;
            if($scope.deviceToBindId === 0 || $scope.oldToBindId === 0) {
                var alert = $mdDialog.alert({
                    title: '出错了',
                    content: '您尚未选择任何设备',
                    ok: '确定'
                });
                $mdDialog.show(alert);
                return false;
            }

            DeviceService.bindDevice($scope.deviceToBindId, $scope.oldToBindId).then(function(data) {

                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '绑定失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else {
                    var alert = $mdDialog.alert({
                        title: '绑定成功',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                    $scope.loadDifferentDevice($scope.isDeviceBinded);
                }

            }, function(error) {
                var alert = $mdDialog.alert({
                    title: '出错了,请联系管理员,错误代码:' + error.status,
                    content: error.statusText,
                    ok: '确定'
                });
                $mdDialog.show(alert);
            });

            $scope.deviceToBindId = 0;
            $scope.oldToBindId = 0;
        }
    }
})();
