(function() {
    'use strict';

    angular
        .module('app.examples.authentication')
        .controller('ProfileController', ProfileController);

    /* @ngInject */
    function ProfileController($scope, $mdDialog, $state, UserService) {
        var vm = this;
        vm.settingsGroups = [{
            name: 'ADMIN.NOTIFICATIONS.ACCOUNT_SETTINGS',
            settings: [{
                title: 'ADMIN.NOTIFICATIONS.SHOW_LOCATION',
                icon: 'zmdi zmdi-pin',
                enabled: true
            },{
                title: 'ADMIN.NOTIFICATIONS.SHOW_AVATAR',
                icon: 'zmdi zmdi-face',
                enabled: false
            },{
                title: 'ADMIN.NOTIFICATIONS.SEND_NOTIFICATIONS',
                icon: 'zmdi zmdi-notifications-active',
                enabled: true
            }]
        },{
            name: 'ADMIN.NOTIFICATIONS.CHAT_SETTINGS',
            settings: [{
                title: 'ADMIN.NOTIFICATIONS.SHOW_USERNAME',
                icon: 'zmdi zmdi-account',
                enabled: true
            },{
                title: 'ADMIN.NOTIFICATIONS.SHOW_PROFILE',
                icon: 'zmdi zmdi-account-box',
                enabled: false
            },{
                title: 'ADMIN.NOTIFICATIONS.ALLOW_BACKUPS',
                icon: 'zmdi zmdi-cloud-upload',
                enabled: true
            }]
        }];
        vm.user = {
            name: 'Christos',
            email: 'info@oxygenna.com',
            location: 'Sitia, Crete, Greece',
            website: 'http://www.oxygenna.com',
            twitter: 'oxygenna',
            bio: 'We are a small creative web design agency \n who are passionate with our pixels.',
            current: '',
            password: '',
            confirm: ''
        };

        $scope.new_password = '';
        $scope.old_password = '';
        $scope.confirm_password = '';

        $scope.changeMyPassword = function() {

            if($scope.new_password == '' || $scope.old_password == '' || $scope.confirm_password == '') {
                alert('请完整填写信息');
                return false;
            }


            if($scope.confirm_password != $scope.new_password) {
                alert('确认密码不一致');
            }else {

                UserService.changePassword({
                    new_password: $scope.new_password,
                    old_password: $scope.old_password
                }).then(function(data) {

                    var status = data.status;
                    var realData = data.Schema;

                    if(status != '200') {
                        var alert = $mdDialog.alert({
                            title: '修改失败',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                    }else {
                        var alert = $mdDialog.alert({
                            title: '修改成功',
                            content: realData.properties.message,
                            ok: '确定'
                        });
                        $state.go('authentication.login');
                    }

                    $mdDialog.show(alert);

                });

            }

        }
    }
})();
