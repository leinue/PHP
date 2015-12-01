(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicHealthArchivesController', BasicHealthArchivesController);

    /* @ngInject */
    function BasicHealthArchivesController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-health');
        }

    }
})();
