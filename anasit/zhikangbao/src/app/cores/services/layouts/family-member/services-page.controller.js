(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesController', BasicServicesController);

    /* @ngInject */
    function BasicServicesController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-family');
        }
    }
})();
