(function() {
    'use strict';

    angular
        .module('app.examples.dashboards')
        .controller('DashboardDraggableController', DashboardDraggableController);

    /* @ngInject */
    function DashboardDraggableController($scope, $timeout, $mdToast, $rootScope, $state, dragulaService, $document,$element) {

        var mirrorContainer = $element.find('.mirror-container')[0];
        dragulaService.options($scope,'drag-container', {
            mirrorContainer: mirrorContainer
        });
    }
})();
