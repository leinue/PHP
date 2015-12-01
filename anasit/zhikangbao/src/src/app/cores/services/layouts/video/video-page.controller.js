(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesVideoController', BasicServicesVideoController);

    /* @ngInject */
    function BasicServicesVideoController() {
        var vm = this;
        vm.testData = ['triangular', 'is', 'great'];
    }
})();
