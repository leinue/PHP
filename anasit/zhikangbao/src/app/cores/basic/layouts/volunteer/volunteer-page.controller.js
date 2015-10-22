(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicVolunteerController', BasicVolunteerController);

    /* @ngInject */
    function BasicVolunteerController($scope, $state, VolunteerService, $mdDialog) {
        var vm = this;

        $scope.AllVolunteerInfo = {};
        $scope.volunteerUpdateInfo = {};

        $scope.currentVolunteerPage = 1;
        $scope.v_total_pages = [];

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-volunteer');
        };

        $scope.getVolunteerInfo = function() {
            $scope.v_total_pages = [];
            VolunteerService.index($scope.currentVolunteerPage, 10).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '获取志愿者信息失败',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else {
                    $scope.AllVolunteerInfo = realData.properties.detail;
                    var totalPages = Math.ceil(realData.properties.count/10);
                    for (var i = 1; i <= totalPages; i++) {
                        $scope.v_total_pages.push(i);
                    };
                }
            });
        };

        $scope.getVolunteerInfo();

        $scope.deleteThisVolunteer = function(vid) {
            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });
            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    VolunteerService.remove(vid).then(function(data) {
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
                        }
                        $mdDialog.show(alert);
                        $scope.getVolunteerInfo();
                    });
                }
            });
        };

        $scope.viewThisVolunteer = function(user) {
            $('#volunteer-info').modal('show');
            $scope.volunteerUpdateInfo = user;
            $('.modal-backdrop').css('z-index','0');
        };

        $('#volunteer-info').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.confirmUpdateVolunteerInfo = function() {
            VolunteerService.update($scope.volunteerUpdateInfo).then(function(data) {

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
                        content: realData.properties.message,
                        ok: '确定'
                    });
                }

                $mdDialog.show(alert);

            });
        };

        $scope.loadNextVolunteerPage = function(page) {
            $scope.currentVolunteerPage = page;
            $scope.getVolunteerInfo();
        };
    }
})();
