(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicDeviceController', BasicDeviceController);

    /* @ngInject */
    function BasicDeviceController($scope, $state, DeviceService) {
        var vm = this;
        DeviceService.index().then(function(response) {
            $scope.devices = response.Schema.properties;   
        })
        $scope.addNew = function() {
        };
    }
})();
