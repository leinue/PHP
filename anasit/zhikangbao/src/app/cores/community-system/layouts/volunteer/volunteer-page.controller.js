(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicVolunteerController', BasicVolunteerController);

    /* @ngInject */
    function BasicVolunteerController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-volunteer');
        };
    }
})();
