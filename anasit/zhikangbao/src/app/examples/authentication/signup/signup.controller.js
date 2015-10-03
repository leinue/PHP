(function() {
    'use strict';

    angular
        .module('app.examples.authentication')
        .controller('SignupController', SignupController);

    /* @ngInject */
    function SignupController($scope, $state, $mdToast, $http, $filter, triSettings, API_CONFIG, SignupService) {
        var vm = this;
        vm.triSettings = triSettings;
        vm.signupClick = signupClick;
        vm.user = {
            username: '',
            mobile: '',
            password: '',
            idcard: ''
        };

        ////////////////

        function signupClick() {

            console.log(vm.user);

            var result = SignupService.signup(vm.user);

            console.log(result);

            $mdToast.show(
                    $mdToast.simple()
                    .action($filter('translate')('SIGNUP.MESSAGES.LOGIN_NOW'))
                    .position('bottom right')
                    .highlightAction(true)
                    .hideDelay(0)
                ).then(function() {
                    $state.go('authentication.login');
            });
            // $http({
            //     method: 'POST',
            //     url: API_CONFIG.url + 'signup',
            //     data: $scope.user
            // }).
            // success(function(data) {
            //     $mdToast.show(
            //         $mdToast.simple()
            //         .content($filter('translate')('SIGNUP.MESSAGES.CONFIRM_SENT') + ' ' + data.email)
            //         .position('bottom right')
            //         .action($filter('translate')('SIGNUP.MESSAGES.LOGIN_NOW'))
            //         .highlightAction(true)
            //         .hideDelay(0)
            //     ).then(function() {
            //         $state.go('public.auth.login');
            //     });
            // }).
            // error(function() {
            //     $mdToast.show(
            //         $mdToast.simple()
            //         .content($filter('translate')('SIGNUP.MESSAGES.NO_SIGNUP'))
            //         .position('bottom right')
            //         .hideDelay(5000)
            //     );
            // });
        }
    }
})();