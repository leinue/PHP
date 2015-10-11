(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewVolunteerController', BasicNewVolunteerController);

    /* @ngInject */
    function BasicNewVolunteerController($scope, $state) {
        var vm = this;

        $scope.returnToList = function() {
            $state.go('triangular.admin-default.basic-volunteer');
        }
    }
})();
