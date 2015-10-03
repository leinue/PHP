(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicDeviceController', BasicDeviceController);

    /* @ngInject */
    function BasicDeviceController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        };
    }
})();
