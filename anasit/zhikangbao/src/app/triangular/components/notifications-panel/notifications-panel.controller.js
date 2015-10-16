(function() {
    'use strict';

    angular
        .module('triangular.components')
        .controller('NotificationsPanelController', NotificationsPanelController);

    /* @ngInject */
    function NotificationsPanelController($scope, $http, $mdSidenav, $state, API_CONFIG, YulpService, $mdToast, $mdDialog, $filter) {
        var vm = this;
        // sets the current active tab
        vm.close = close;
        vm.currentTab = 0;
        vm.notificationGroups = {};

        if(typeof localStorage.SosCount == 'undefined') {
            YulpService.count().then(function(data) {
              console.log(data);
              localStorage.SosCount = data.Schema.properties;
            });
        }

        setInterval(function() {
            YulpService.count().then(function(data) {
              var currentCount = data.Schema.properties;
              localStorage.currentSosCount = currentCount;
              if(parseInt(currentCount) > parseInt(localStorage.SosCount)) {
                var diff = parseInt(currentCount) - parseInt(localStorage.SosCount);
                YulpService.latest(diff).then(function(data) {
                  var status = data.status;
                  var realData = data.Schema.properties;
                  if(status != '200') {
                    return false;
                  }

                  localStorage.SosCount = currentCount;

                  vm.notificationGroups = realData;

                  for (var i = 0; i < realData.length; i++) {
                        var curr = realData[i];

                        $mdToast.show(
                            $mdToast.simple()
                                .content(curr.sos_address + '的 ' + curr.sos_name + ' 发来一份求救信息: ' + curr.sos_title + ', 手机号为: ' + curr.sos_mobile)
                                .position('bottom right')
                                .action($filter('translate')('下一个'))
                                .highlightAction(true)
                                .hideDelay(0)
                        ).then(function() {
                            
                        });
                  };

                });
              }
            })
        },2000);


        ////////////////

        // add an event to switch tabs (used when user clicks a menu item before sidebar opens)
        $scope.$on('triSwitchNotificationTab', function($event, tab) {
            vm.currentTab = tab;
        });

        function openMail() {
            $state.go('private.admin.toolbar.inbox');
            vm.close();
        }

        function close() {
            $mdSidenav('notifications').close();
        }
    }
})();
