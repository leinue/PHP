(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewOldManController', BasicNewOldManController);

    /* @ngInject */
    function BasicNewOldManController($scope, $state, OldInfoService, $mdDialog, OrgInfoService, $stateParams, OrgService) {
        var vm = this;

        $scope.edit = false;

        $scope.inserOldInfo = {};

        /*
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
        */

        $scope.thisTitle = '新增老人信息';

        if(typeof $stateParams.id !='undefined') {
            $scope.edit = true;
            $scope.thisTitle = '编辑老人信息';
        }

        if($scope.edit) {
            OldInfoService.one($stateParams.id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                var pro = realData.properties;
                $scope.inserOldInfo = pro;
            });
        }

        $scope.ordList = {};

        OrgService.index().then(function(data) {
            var status = data.status;
            var realData = data.Schema.properties;
            $scope.ordList = realData;
            console.log($scope.ordList);
        });

        $scope.returnToOldmanList = function() {
            $state.go('triangular.admin-default.basic-page');
        };

        $scope.submitInfo = function() {
            if(!$scope.edit){
                OldInfoService.insert($scope.inserOldInfo).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    var msg = realData.properties.message;
                    var alert = $mdDialog.alert({
                            title: msg,
                            content:msg,
                            ok: '确定'
                        });
                    $mdDialog.show(alert);
                });
            }else {
                console.log($scope.inserOldInfo);
                OldInfoService.update($scope.inserOldInfo).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    var msg = realData.properties.message;
                    var alert = $mdDialog.alert({
                            title: msg,
                            content:msg,
                            ok: '确定'
                        });
                    $mdDialog.show(alert);
                });
            }
            
        };
    }

})();
