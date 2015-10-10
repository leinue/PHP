(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesController', BasicServicesController);

    /* @ngInject */
    function BasicServicesController($scope, $state, FamilyMemberService, $mdDialog, $stateParams) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-family');
        };

        $scope.currentUserId = $stateParams.oldman_id;

        $scope.memberList = {};

        $scope.insertMemberList = {};

        $scope.editMemberList = {};

        $scope.backToOldManList = function() {
            $state.go('triangular.admin-default.basic-page');
        };

        $scope.getAllMembers = function() {
            FamilyMemberService.index($scope.currentUserId).then(function(data) {
                var status = data.status;
                var realData = data.data.Schema;
                $scope.memberList = realData.properties;           
                console.log($scope.memberList);
            });
        }

        $scope.getAllMembers();

        $scope.editData = {
            user_relation_id: '',
            relation_id: ''
        };

        $scope.editThisMember = function(id,user_id) {
            $('#edit-family-member').modal('show');
            $('.modal-backdrop').css('z-index','0');

            $scope.editData.user_relation_id = id;
            $scope.editData.relation_id = user_id;

            FamilyMemberService.one(id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var alert = $mdDialog.alert({
                        title: '该操作不可回溯',
                        content: realData.properties.message,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                }else {
                    $scope.editMemberList = realData.properties;
                }
            });
        };

        $('#edit-family-member').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.deleteThisMember = function(id) {

            var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });

            $mdDialog.show(alert).then(function(confirm) {
                if(confirm) {
                    FamilyMemberService.remove(id).then(function(data) {
                        var status = data.status;
                        var realData = data.Schema;

                        if(status != '200') {
                            var msg = realData.properties.message;
                            var alert = $mdDialog.alert({
                                    title: msg,
                                    content:msg,
                                    ok: '确定'
                                });
                        }else {
                            var alert = $mdDialog.alert({
                                title: '操作成功',
                                content: '删除成员成功',
                                ok: '确定'
                            });
                            $scope.getAllMembers();
                        }
                        $mdDialog.show(alert);
                    });
                }
            });
        }

        $scope.saveEditMember = function() {
            $scope.editMemberList.user_relation_id = $scope.editData.user_relation_id; 
            $scope.editMemberList.relation_id = $scope.editData.relation_id;
            console.log($scope.editMemberList);
            FamilyMemberService.update($scope.editMemberList).then(function(data) {
                var status = data.status;
                var realData = data.Schema;

                if(status != '200') {
                    var msg = realData.properties.message;
                    var alert = $mdDialog.alert({
                            title: msg,
                            content: msg,
                            ok: '确定'
                        });
                }else {
                    var alert = $mdDialog.alert({
                        title: '操作成功',
                        content: '编辑成员成功',
                        ok: '确定'
                    });
                    $scope.getAllMembers();
                }
                $mdDialog.show(alert);
            });
        };

    }
})();
