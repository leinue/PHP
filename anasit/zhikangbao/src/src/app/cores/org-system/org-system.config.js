(function() {
    'use strict';

    angular
        .module('app.cores.org-system')
        .config(moduleConfig);

    /* @ngInject */
    function moduleConfig($translatePartialLoaderProvider, $stateProvider, triMenuProvider) {
        $translatePartialLoaderProvider.addPart('app/cores/org-system');

        $stateProvider
        .state('triangular.admin-default.org-system-org', {
            url: '/org/archive',
            templateUrl: 'app/cores/basic/layouts/oldinfo/basic-page.tmpl.html',
            // set the controller to load for this page
            controller: 'BasicPageController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.org-department-mgr',{
            url: '/org/department',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.org-assign-admin',{
            url: '/org/admin',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        });

        triMenuProvider.addMenu({
            name: '机构后台系统',
            icon: 'fa fa-plus-square',
            type: 'dropdown',
            state: 'triangular.admin-default.org-lvl-menu',
            priority: 2.1,
            children: [
            {
                name: '机构基础信息管理',
                state: 'triangular.admin-default.org-department-mgr',
                type: 'link'
            },
            {
                name: '老人档案管理',
                state: 'triangular.admin-default.org-system-org',
                type: 'link'
            }
        ]});
    }
})();
