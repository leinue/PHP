(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicCommericialController', BasicCommericialController);

    /* @ngInject */
    function BasicCommericialController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-commericial');
        };
    }
})();
