(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicOrgController', BasicOrgController);

    /* @ngInject */
    function BasicOrgController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        };
    }
})();
