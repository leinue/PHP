(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewOldManController', BasicNewOldManController);

    /* @ngInject */
    function BasicNewOldManController($scope, $state) {
        var vm = this;

        $scope.returnToOldmanList = function() {
            $state.go('triangular.admin-default.basic-page');
        };
    }

})();
