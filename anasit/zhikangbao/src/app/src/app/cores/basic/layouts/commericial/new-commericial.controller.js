(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewCommericialController', BasicNewCommericialController);

    /* @ngInject */
    function BasicNewCommericialController($scope, $state) {
        var vm = this;

        $scope.returnToList = function() {
            $state.go('triangular.admin-default.basic-commericial');
        };

    }

})();
