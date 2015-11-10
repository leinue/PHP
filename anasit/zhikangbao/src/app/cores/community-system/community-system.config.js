(function() {
    'use strict';

    angular
        .module('app.cores.community-system')
        .config(moduleConfig);

    /* @ngInject */
    function moduleConfig($translatePartialLoaderProvider, $stateProvider, triMenuProvider) {
        $translatePartialLoaderProvider.addPart('app/cores/community-system');

        $stateProvider
        .state('triangular.admin-default.community-archive', {
            url: '/community/archive',
            templateUrl: 'app/cores/basic/layouts/oldinfo/basic-page.tmpl.html',
            // set the controller to load for this page
            controller: 'BasicPageController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.community-info', {
            url: '/community/info',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            // set the controller to load for this page
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.community-assign', {
            url: '/community/assign',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            // set the controller to load for this page
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        });

        triMenuProvider.addMenu({
            name: '社区后台系统',
            icon: 'fa fa-hospital-o',
            type: 'dropdown',
            state: 'triangular.admin-default.community-lvl-menu',
            priority: 2.1,
            children: [
            {
                name: '社区基础信息查看',
                state: 'triangular.admin-default.community-info',
                type: 'link'
            },
            // {
            //     name: '社区管理员指派',
            //     state: 'triangular.admin-default.community-assign',
            //     type: 'link'
            // },
            {
                name: '老人档案管理',
                state: 'triangular.admin-default.community-archive',
                type: 'link'
            }]
        });

    }
})();
