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
            templateUrl: 'app/cores/services/layouts/video/video-page.tmpl.html',
            controller: 'BasicServicesVideoController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-yulp', {
            url: '/services/yulp',
            templateUrl: 'app/cores/services/layouts/video/video-page.tmpl.html',
            controller: 'BasicServicesVideoController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.services-message', {
            url: '/services/message',
            templateUrl: 'app/cores/services/layouts/video/video-page.tmpl.html',
            controller: 'BasicServicesVideoController',
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
        });

        triMenuProvider.addMenu({
            name: '客服后台系统',
            icon: 'fa fa-user-md',
            type: 'dropdown',
            priority: 2.1,
            children: [
            // {
            //     name: '家庭成员',
            //     state: 'triangular.admin-default.services-page',
            //     type: 'link'
            // },
            // {
            //     name: '健康档案',
            //     state: 'triangular.admin-default.health-archives',
            //     type: 'link'
            // },
            // {
            //     name: '位置监控',
            //     state: 'triangular.admin-default.services-pos',
            //     type: 'link'
            // },
            {
                name: '求助服务受理',
                state: 'triangular.admin-default.services-help',
                type: 'link'
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
