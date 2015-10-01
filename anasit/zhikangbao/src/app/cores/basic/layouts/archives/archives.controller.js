(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicArchivesController', BasicArchivesController);

    /* @ngInject */
    function BasicArchivesController($scope, $state) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-archive');
        }

        $scope.returnToArchiveList = function() {
        	$scope.addNew();
        }
    }
})();
