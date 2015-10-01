(function() {
    'use strict';
    
    angular
        .module('app.cores.services')
        .controller('BasicServicesPosController', BasicServicesPosController);

    /* @ngInject */
    function BasicServicesPosController() {
        var vm = this;
        vm.testData = ['triangular', 'is', 'great'];
    }
})();
