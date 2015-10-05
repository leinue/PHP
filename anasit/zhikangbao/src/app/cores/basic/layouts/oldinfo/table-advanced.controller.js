(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('TablesAdvancedController', Controller);

    /* @ngInject */
    function Controller($scope, $timeout, $q, OldInfoService, $mdDialog, $state, $location, $sce) {
        var vm = this;
        vm.query = {
            filter: '',
            limit: '10',
            order: '-id',
            page: 1
        };
        vm.selected = [];
        vm.filter = {
            options: {
                debounce: 500
            }
        };
        vm.getUsers = $scope.getOldInfo;
        vm.removeFilter = removeFilter;

        activate();

        $scope.currentId = '';

        ////////////////

        function activate() {
        }

        function removeFilter() {
            vm.filter.show = false;
            vm.query.filter = '';

            if(vm.filter.form.$dirty) {
                vm.filter.form.$setPristine();
            }
        }

        $scope.editThis = function(id) {
            // OldInfoService.update(id);
            $scope.currentId = id;
            // $location.path('triangular.admin-default.edit-oldman');
            $location.path('/basic/edit/' + id);
        };

        $scope.inserOldInfo = {
            user_id: localStorage.id,
            realname: '',
            blood_type: '',
            org_id: '',
            device_id: '',
            address: '',
            finance: '',
            feature: '',
            description: '',
            realation_name: '',
            realation_phone: '',
            realationship: '',
            mobile: '',
            idcard: '',
            sex: '',
            nation: ''
        };

        $scope.viewThis = function(id) {
            $scope.currentId = id;

            OldInfoService.one(id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                var pro = realData.properties;
                if(pro.length != 0) {
                    pro = pro[0];
                }
                $scope.inserOldInfo.realname = pro.realname;
                $scope.inserOldInfo.blood_type = pro.blood_type;
                $scope.inserOldInfo.org_id = pro.org_id;
                $scope.inserOldInfo.device_id = pro.device_id;
                $scope.inserOldInfo.address = pro.address;
                $scope.inserOldInfo.finance = pro.finance;
                $scope.inserOldInfo.feature = pro.feature;
                $scope.inserOldInfo.description = pro.description;
                $scope.inserOldInfo.realation_name = pro.realation_name;
                $scope.inserOldInfo.realation_phone = pro.realation_phone;
                $scope.inserOldInfo.realationship = pro.realationship;
                $scope.inserOldInfo.mobile = pro.mobile;
                $scope.inserOldInfo.idcard = pro.idcard;
                $scope.inserOldInfo.sex = pro.sex;
                $scope.inserOldInfo.nation = pro.nation;
            });

            var tmpl = JSON.stringify($scope.inserOldInfo);

            tmpl = $sce.trustAsHtml(tmpl);

            $('#viewDetail').modal('show');
            $('.modal-backdrop').css('z-index','0');

        };

        $('#viewDetail').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });
        
        $scope.deleteThis = function(id) {
            // OldInfoService.remove(id);
            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });
            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    OldInfoService.remove(id).then(function(data) {
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
                        }
                    });
                }
            });
        };

        $scope.oldInfoItemList = {};

        $scope.getOldInfo = function() {
            OldInfoService.index().then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                $scope.oldInfoItemList = realData.properties;                
            });
        }

        $scope.getOldInfo();

    }
})();