(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicPageController', BasicPageController);

    /* @ngInject */
    function BasicPageController($scope, $state, $mdDialog, OldInfoService) {
        var vm = this;

        $scope.addNew = function() {
            $state.go('triangular.admin-default.new-oldman');
        }

    }

})();
