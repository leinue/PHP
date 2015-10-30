(function() {
    'use strict';

    angular
        .module('app.examples.authentication')
        .controller('SignupController', SignupController);

    /* @ngInject */
    function SignupController($scope, $state, $mdToast, $http, $filter, triSettings, API_CONFIG, SignupService, OrgService, CheckStatus) {
        var vm = this;
        vm.triSettings = triSettings;
        vm.signupClick = signupClick;
        vm.user = {
            username: '',
            mobile: '',
            password: '',
            idcard: '',
            orgid: ''
        };

        vm.userconfirm = {
            confirm: ''
        };

        vm.orgList = {};

        //读取机构列表

        OrgService.index().then(function(data){
            vm.orgList = data.Schema.properties;
        });

        function signupClick() {

            SignupService.signup(vm.user)
                .then(function(data){

                    var status = data.status;
                    var realData = data.Schema;
                    
                    $mdToast.show(
                            $mdToast.simple()
                            .action($filter('translate')(realData.properties.message))
                            .position('bottom right')
                            .highlightAction(true)
                            .hideDelay(0)
                        ).then(function() {
                            if(CheckStatus.check(status)) {
                                $state.go('authentication.login');
                            }
                    });

                });

        }
    }
})();