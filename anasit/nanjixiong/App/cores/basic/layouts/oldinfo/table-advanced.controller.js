(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('TablesAdvancedController', Controller);

    /* @ngInject */
    function Controller($scope, $timeout, $q, OldInfoService, $mdDialog, $state, $location, $sce, $stateParams, OrgService, OrgInfoService) {
        var vm = this;

        $scope.query = {
            filter: '',
            limit: '10',
            order: '-id',
            page: 1
        };

        vm.query = {
            filter: ''
        };

        $scope.users = {
            total_count: 0
        };

        vm.selected = [];

        vm.filter = {
            options: {
                debounce: 500
            }
        };

        vm.getUsers = $scope.getOldInfoBasic;
        vm.removeFilter = removeFilter;

        $scope.total_pages = [1];
        $scope.currentPageAB = 1;

        $scope.currentId = '';

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
            console.log($state);

            var name = $state.current.name;
            if(name.indexOf('org-system-org') != -1 ) {
                $location.path('/department/edit/' + id);
            }else if(name.indexOf('community') != -1) {
                $location.path('/community/edit/' + id);
            }else {
                $location.path('/basic/edit/' + id);
            }
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
                if(typeof pro != 'undefined') {
                    $scope.inserOldInfo = pro;
                    $scope.inserOldInfo.create_time = new Date(parseInt($scope.inserOldInfo.create_time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
                    if($scope.inserOldInfo.update_time != null) {
                        $scope.inserOldInfo.update_time = new Date(parseInt($scope.inserOldInfo.update_time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
                    }
                }
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
                        $mdDialog.show(alert);
                        $scope.getOldInfoBasic();
                    });
                }
            });
        };

        $scope.oldInfoItemList = {};

        $scope.getOldInfoBasic = function() {
            $scope.query.page = $scope.currentPageAB;
            OldInfoService.index($scope.query.page,$scope.query.limit).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                $scope.oldInfoItemList = realData.properties.detail;
                $scope.oldInfoCount = realData.properties.count;
                $scope.users.total_count = Math.ceil(realData.properties.count/$scope.query.limit);
                $scope.total_pages = [];
                for (var i = 1; i <= $scope.users.total_count; i++) {
                    $scope.total_pages.push(i);
                };
            });
        }

        $scope.getOldInfoBasic();

        $scope.addNewMember = function(id) {
            // $state.go('triangular.admin-default.new-family');
            $location.path('/services/new/' + id);
        }

        $scope.viewMyMember = function(user_id) {
            $location.path('/services/' + user_id);
        }

        $scope.triggerSearch = function() {
            OldInfoService.search(vm.query.filter).then(function(data) {
                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {

                    var alert = $mdDialog.alert({
                        title: '网络传输失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });

                }else {
                    $scope.oldInfoItemList = realData.properties;
                    // vm.users.total_count = realData.properties.count;
                }
            });
        }

        $scope.startSearch = function($event) {
            var keyCode = $event.keyCode;

            if($event && keyCode == 13) {
                $scope.triggerSearch();
            }

        }

        $scope.getAllOldList = function() {
            if(vm.query.filter == '') {
                $scope.getOldInfoBasic();
            }
        }

        $scope.loadNextPage = function(page) {
            $scope.currentPageAB = page;
            $scope.getOldInfoBasic();
        }

        $scope.optionsName = ['新增家庭成员', '查看家庭成员', '详情', '编辑', '删除'];

        $scope.opt_name = '';

        $scope.actionStart = function(id,i) {
            switch($scope.opt_name) {
                case '新增家庭成员':
                    $scope.addNewMember(id);
                    break;
                case '查看家庭成员':
                    $scope.viewMyMember(id);
                    break;
                case '详情':
                    $scope.viewThis(id);
                    break;
                case '编辑':
                    $scope.editThis(id);
                    break;
                case '删除':
                    $scope.deleteThis(id);
                    break;
                default:
                    break;
            }
        }

        $scope.currentOrgCate = '';
        $scope.currentOrg = '';

        $scope.getOrgList = function() {

            $scope.orgList = {};
            $scope.MonitorList = {};

            var id = $scope.currentOrgCate;
            OrgInfoService.getByOrgCate(id).then(function(data) {

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
                    // console.log($scope.MonitorList);
                }

            });
        }

        $scope.getOrgCateList = function() {
            OrgInfoService.index().then(function(data) {
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
                    $scope.orgCateList = realData.properties;
                    console.log($scope.orgCateList);
                }
            });
        }

        $scope.getOrgCateList();

        $scope.searchOldByOrgInfo = function() {
            OldInfoService.searchByOrg($scope.currentOrg).then(function(data) {
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
                    $scope.oldInfoItemList = realData.properties;
                }
            });
        }


    }
})();
