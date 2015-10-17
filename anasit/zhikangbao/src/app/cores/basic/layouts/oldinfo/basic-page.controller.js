(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicPageController', BasicPageController);

    /* @ngInject */
    function BasicPageController($scope, $state, $mdDialog, OldInfoService, $location) {
        var vm = this;

        $scope.addNew = function() {

            var name = $state.current.name;

            console.log(name);

            if(name.indexOf('org-system-org') != -1) {
                $state.go('triangular.admin-default.department-new-oldman');
            }else if(name.indexOf('community') != -1) {
                $state.go('triangular.admin-default.community-new-oldman');
            }else {
               $state.go('triangular.admin-default.new-oldman');
            }
            
        }

    }

})();
