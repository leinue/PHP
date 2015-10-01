(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicPageController', BasicPageController);

    /* @ngInject */
    function BasicPageController($scope, $state, $mdDialog) {
        var vm = this;

        $scope.addNew = function() {
        	$state.go('triangular.admin-default.new-oldman');
        }

        $scope.deleteThisItem = function() {
			var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });
            $mdDialog.show(alert);
        }

    }

})();
