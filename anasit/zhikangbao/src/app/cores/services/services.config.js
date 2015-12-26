(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .config(moduleConfig);

    /* @ngInject */
    function moduleConfig($translatePartialLoaderProvider, $stateProvider, triMenuProvider) {
        $translatePartialLoaderProvider.addPart('app/cores/services');

        $stateProvider
        .state('triangular.admin-default.services-page', {
            url: '/services/{oldman_id}',
            templateUrl: 'app/cores/services/layouts/family-member/services-page.tmpl.html',
            // set the controller to load for this page
            controller: 'BasicServicesController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.health-archives', {
            url: '/health-archives',
            templateUrl: 'app/cores/services/layouts/health-archives/health-page.tmpl.html',
            controller: 'BasicHealthArchivesController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-pos', {
            url: '/services-pos',
            templateUrl: 'app/cores/services/layouts/pos/pos-page.tmpl.html',
            controller: 'BasicServicesPosController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-help', {
            url: '/services/help',
            templateUrl: 'app/cores/services/layouts/help/help.tmpl.html',
            controller: 'BasicServicesHelpController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-yulp', {
            url: '/services/yulp',
            templateUrl: 'app/cores/services/layouts/call/call.tmpl.html',
            controller: 'BasicServicesCallController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-message', {
            url: '/services/message',
            templateUrl: 'app/cores/services/layouts/jpush/jpush.tmpl.html',
            controller: 'BasicServicesJpushController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.new-family', {
            url: '/services/new/{user_id}',
            templateUrl: 'app/cores/services/layouts/family-member/new-member.tmpl.html',
            controller: 'BasicServicesNewMemberController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.new-health', {
            url: '/services-archives/new',
            templateUrl: 'app/cores/services/layouts/health-archives/new-health.tmpl.html',
            controller: 'BasicServicesNewHealthController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-work', {
            url: '/services/work',
            templateUrl: 'app/cores/services/layouts/order/order.tmpl.html',
            controller: 'BasicServicesOrderController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.service-new-work-order', {
            url: '/services/order/new',
            templateUrl: 'app/cores/services/layouts/order/new-order.tmpl.html',
            controller: 'BasicServicesNewOrderController_',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-distribute', {
            url: '/services/order/distribute',
            templateUrl: 'app/cores/services/layouts/order/distribute/distribute.tmpl.html',
            controller: 'BasicServicesOrderDistributeController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-register', {
            url: '/services/order/register',
            templateUrl: 'app/cores/services/layouts/order/sign/register.tmpl.html',
            controller: 'BasicServicesOrderRegisterController',
            controllerAs: 'vm'
        });

        // {
        //     name: '工单管理',
        //     state: 'triangular.admin-default.services-work',
        //     type: 'link'
        // },

        // ,{
        //     name: '签到管理',
        //     state: 'triangular.admin-default.services-register',
        //     type: 'link'
        // }

        triMenuProvider.addMenu({
            name: '客服后台系统',
            icon: 'fa fa-user-md',
            type: 'dropdown',
            state: 'triangular.admin-default.services-menu',
            priority: 2.1,
            children: [{
                name: '咨询服务受理',
                state: 'triangular.admin-default.services-help',
                type: 'link'
            },
            {
                name: '求助服务受理',
                state: 'triangular.admin-default.services-work',
                type: 'dropdown',
                children: [{
                    name: '工单管理',
                    state: 'triangular.admin-default.services-work',
                    type: 'link'
                },{
                    name: '派单管理',
                    state: 'triangular.admin-default.services-distribute',
                    type: 'link'
                }]
            },
            {
                name: '求救呼叫处理',
                state: 'triangular.admin-default.services-yulp',
                type: 'link'
            },
            {
                name: '消息群发系统',
                state: 'triangular.admin-default.services-message',
                type: 'link'
            }]
        });
    }
})();
