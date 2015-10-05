(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewOldManController', BasicNewOldManController);

    /* @ngInject */
    function BasicNewOldManController($scope, $state, OldInfoService, $mdDialog, OrgInfoService, $stateParams) {
        var vm = this;

        $scope.edit = false;

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
        }

        $scope.ordList = {};

        OrgInfoService.index().then(function(data) {
            var status = data.status;
            var realData = data.Schema.properties;
            $scope.ordList = realData;
        });

        $scope.returnToOldmanList = function() {
            $state.go('triangular.admin-default.basic-page');
        };

        $scope.submitInfo = function() {
            console.log($scope.inserOldInfo);
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
        };
    }

})();
