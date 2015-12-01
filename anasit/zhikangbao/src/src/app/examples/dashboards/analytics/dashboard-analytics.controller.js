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

        localStorage.today_old = typeof localStorage.today_old == 'undefined' ? 0 : localStorage.today_old;
        localStorage.old_mount = typeof localStorage.old_mount == 'undefined' ? 0 : localStorage.old_mount;
        localStorage.org_mount = typeof localStorage.org_mount == 'undefined' ? 0 : localStorage.org_mount;
        localStorage.toady_org_mount = typeof localStorage.toady_org_mount == 'undefined' ? 0 : localStorage.toady_org_mount;

        $scope.today_old = localStorage.today_old;
        $scope.old_mount = localStorage.old_mount;
        $scope.toady_org_mount = localStorage.toady_org_mount;
        $scope.org_mount = localStorage.org_mount;

        $scope.getRectData = function() {
            OldInfoService.todayOld().then(function(data) {
                $scope.today_old = data.Schema.properties;
                localStorage.today_old = $scope.today_old;
            });

            OldInfoService.oldMount().then(function(data) {
                $scope.old_mount = data.Schema.properties;
                localStorage.old_mount = $scope.old_mount;
            });

            DashboardService.orgMount().then(function(data) {
                $scope.org_mount = data.Schema.properties;
                localStorage.org_mount = $scope.org_mount;
            });

            DashboardService.todayOrgMount().then(function(data) {
                $scope.toady_org_mount = data.Schema.properties;
                localStorage.toady_org_mount = $scope.toady_org_mount;
            });
        }

        var onDashBorardFreshInterval = 0;

        $scope.getRectData();

        // if(window.onDashBorardFresh !== -1) {
        //     onDashBorardFreshInterval = setInterval(function() {
        //         console.log('decting');
        //         if(window.onDashBorardFresh == true) {
        //             console.log('dected');
        //             setTimeout(function() {
        //                 $scope.getRectData();
        //             },2500);
        //             clearInterval(onDashBorardFreshInterval);
        //             window.onDashBorardFresh = -1;
        //         }
        //     },1000);
        // }

        $scope.helpPieChart = {
            labels: ['已处理消息数', '总消息数'],
            data: [0, 0]
        };

        DashboardService.helpMount().then(function(data) {
            $scope.helpPieChart.data[1] = data.Schema.properties;
        });

        DashboardService.helpDealMount().then(function(data) {
            $scope.helpPieChart.data[0] = data.Schema.properties;
        });

        $scope.oldMonthLineChart = {
            labels: [],
            series: ['老人数据'],
            options: {
                datasetFill: false,
                responsive: true
            },
            data: []
        };

        DashboardService.oldMonthMount().then(function(data){
            var tmp = data.Schema.properties;
            var tmpList = [];
            for (var key in tmp) {
                var curr = tmp[key];
                tmpList.push(curr);

                var tmpKey = key;
                if(tmpKey > 30) {
                    tmpKey -= 30;
                }
                $scope.oldMonthLineChart.labels.push(tmpKey);
            };
            $scope.oldMonthLineChart.data.push(tmpList);
            console.log($scope.oldMonthLineChart.data);
        });

        $scope.onlinePieChart = {
            labels: ['历史在线用户', '当前在线用户'],
            data: [0, 0]
        };

        DashboardService.loginMount().then(function(data) {
            $scope.onlinePieChart.data[0] = data.Schema.properties;
        });

        DashboardService.todayLoginMount().then(function(data) {
            $scope.onlinePieChart.data[1] = data.Schema.properties;
        });

    }
})();
