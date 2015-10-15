(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesNewMemberController', BasicServicesNewMemberController);

    /* @ngInject */
    function BasicServicesNewMemberController($scope, $state, $mdDialog, FamilyMemberService, $stateParams) {
        var vm = this;

        $scope.returnToList = function() {
        	$state.go('triangular.admin-default.basic-page');
        }

        $scope.newMemberList = {};

        $scope.newMemberList.user_id = $stateParams.user_id;

        $scope.saveNewFamilyMember = function() {
            FamilyMemberService.insert($scope.newMemberList).then(function(data) {

                console.log(data);

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
                        content: '新增成员成功',
                        ok: '确定'
                    });
                    // $scope.getAll();
                }
                $mdDialog.show(alert);
            });
        }
    }
})();
