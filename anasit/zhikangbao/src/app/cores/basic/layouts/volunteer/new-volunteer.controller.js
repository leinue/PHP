(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewVolunteerController', BasicNewVolunteerController);

    /* @ngInject */
    function BasicNewVolunteerController($scope, $state, VolunteerService, $mdDialog) {
        var vm = this;

        $scope.returnToList = function() {
            $state.go('triangular.admin-default.basic-volunteer');
        }

        $scope.volunteerInsertInfo = {};

        $scope.confirmVolunteerInfo = function() {
            VolunteerService.insert($scope.volunteerInsertInfo).then(function(data) {

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
        }
    }
})();
