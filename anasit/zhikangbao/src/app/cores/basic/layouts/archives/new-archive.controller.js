(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewArchiveController', BasicNewArchiveController);

    /* @ngInject */
    function BasicNewArchiveController($scope, $state) {
        var vm = this;

        $scope.returnToArchiveList = function() {
            $state.go('triangular.admin-default.basic-archive');
        };
    }

})();
