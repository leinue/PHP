(function() {
    'use strict';

    angular
        .module('app.examples.authentication')
        .controller('LoginController', LoginController);

    /* @ngInject */
    function LoginController($state, triSettings, LoginService, CheckStatus, $mdToast, $filter) {
        var vm = this;
        vm.loginClick = loginClick;
        vm.socialLogins = [{
            icon: 'fa fa-twitter',
            color: '#5bc0de',
            url: '#'
        },{
            icon: 'fa fa-facebook',
            color: '#337ab7',
            url: '#'
        },{
            icon: 'fa fa-google-plus',
            color: '#e05d6f',
            url: '#'
        },{
            icon: 'fa fa-linkedin',
            color: '#337ab7',
            url: '#'
        }];
        vm.triSettings = triSettings;
        // create blank user variable for login form
        vm.user = {
            login_user: '',
            password: '',
            rememberMe: false
        };

        ///////////////////////////////////////////////////////

        if(typeof localStorage.username_ != 'undefined') {
            vm.user.login_user = localStorage.username_;
            vm.user.password = localStorage.userpw;
            vm.user.rememberMe = Boolean(localStorage.rememberMe);
        }

        function loginClick() {
            LoginService.login(vm.user)
            .then(function(data){

                console.log(data);

                var status  = data.status;
                var realData = data.Schema;

                $mdToast.show(
                        $mdToast.simple()
                        .action($filter('translate')(realData.properties.message))
                        .position('bottom right')
                        .highlightAction(true)
                        .hideDelay(0)
                );

                if(CheckStatus.check(status)) {

                    var info = realData.properties;

                    localStorage.id = info.id;
                    localStorage.username_ = vm.user.login_user;
                    localStorage.mobile = info.mobile;
                    localStorage.userpw = vm.user.password;
                    localStorage.rememberMe = vm.user.rememberMe;

                    var roleList = [];

                    for (var i = 0; i < info.roles.length; i++) {
                        var role = info.roles[i];
                        roleList.push(role.code);
                    };

                    localStorage.roles = JSON.stringify(roleList);

                    $state.go('triangular.admin-default.basic-page');
                }

            });
            
        }
    }
})();
