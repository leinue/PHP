(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesNewMemberController', BasicServicesNewMemberController);

    /* @ngInject */
    function BasicServicesNewMemberController($scope, $state) {
        var vm = this;

        $scope.returnToList = function() {
        	$state.go('triangular.admin-default.services-page');
        }
    }
})();
