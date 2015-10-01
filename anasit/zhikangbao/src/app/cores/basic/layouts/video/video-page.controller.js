(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicVideoController', BasicVideoController);

    /* @ngInject */
    function BasicVideoController() {
        var vm = this;
        vm.testData = ['triangular', 'is', 'great'];
    }
})();
