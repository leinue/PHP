(function() {
    'use strict';

    angular
        .module('app.examples.dashboards')
        .controller('DashboardAnalyticsController', DashboardAnalyticsController);

    /* @ngInject */
    function DashboardAnalyticsController($scope, $timeout, $mdToast, $rootScope, $state, $element, dragulaService, OldInfoService, DashboardService) {
        // $timeout(function() {
        //     $rootScope.$broadcast('newMailNotification');
        //     $mdToast.show({
        //         template: '<md-toast><span flex>You have new email messages! View them <a href="" ng-click=vm.viewUnread()>here</a></span></md-toast>',
        //         controller: newMailNotificationController,
        //         controllerAs: 'vm',
        //         position: 'bottom right',
        //         hideDelay: 5000
        //     });
        // }, 10000);

        //////////////

        // function newMailNotificationController() {
        //     var vm = this;
        //     vm.viewUnread = function() {
        //         $state.go('admin-panel-email-no-scroll.email.inbox');
        //     };
        // }

        var mirrorContainer = $element.find('.mirror-container')[0];
        dragulaService.options($scope,'drag-analytics-container', {
            mirrorContainer: mirrorContainer
        });

        $scope.today_old = 0;
        $scope.old_mount = 0;
        $scope.toady_org_mount = 0;
        $scope.org_mount = 0;

        OldInfoService.todayOld().then(function(data) {
            $scope.today_old = data.Schema.properties;
        });

        OldInfoService.oldMount().then(function(data) {
            $scope.old_mount = data.Schema.properties;
        });

        DashboardService.orgMount().then(function(data) {
            $scope.org_mount = data.Schema.properties;
        });

        DashboardService.todayOrgMount().then(function(data) {
            $scope.toady_org_mount = data.Schema.properties;
        });

        $scope.helpPieChart = {
            labels: ['今日受理消息', '总消息数'],
            data: [0, 0]
        };

        DashboardService.helpMount().then(function(data) {
            $scope.helpPieChart.data[1] = data.Schema.properties;
        });

        DashboardService.helpDealMount().then(function(data) {
            $scope.helpPieChart.data[0] = data.Schema.properties;
        });

    }
})();
