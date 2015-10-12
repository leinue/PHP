(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .config(moduleConfig);

    /* @ngInject */
    function moduleConfig($translatePartialLoaderProvider, $stateProvider, triMenuProvider) {
        $translatePartialLoaderProvider.addPart('app/cores/basic');

        $stateProvider
        .state('triangular.admin-default.basic-page', {
            url: '/basic',
            templateUrl: 'app/cores/basic/layouts/oldinfo/basic-page.tmpl.html',
            // set the controller to load for this page
            controller: 'BasicPageController',
            controllerAs: 'vm'
        }).state('triangular.admin-default.basic-archives', {
            url: '/archives',
            templateUrl: 'app/cores/basic/layouts/archives/archives.tmpl.html',
            controller: 'BasicArchivesController',
            controllerAs: 'vm'
        }).state('triangular.admin-default.basic-volunteer', {
            url: '/volunteer',
            templateUrl: 'app/cores/basic/layouts/volunteer/volunteer-page.tmpl.html',
            controller: 'BasicVolunteerController',
            controllerAs: 'vm'
        }).state('triangular.admin-default.basic-commericial', {
            url: '/commericial',
            templateUrl: 'app/cores/basic/layouts/commericial/commericial-page.tmpl.html',
            controller: 'BasicCommericialController',
            controllerAs: 'vm'
        }).state('triangular.admin-default.basic-pos', {
            url: '/pos',
            templateUrl: 'app/cores/basic/layouts/pos/pos-page.tmpl.html',
            controller: 'BasicPosController',
            controllerAs: 'vm'
        }).state('triangular.admin-default.basic-video', {
            url: '/video',
            templateUrl: 'app/cores/basic/layouts/video/video-page.tmpl.html',
            controller: 'BasicVideoController',
            controllerAs: 'vm'
        }).state('triangular.admin-default.new-oldman', {
            url: '/basic/new',
            templateUrl: 'app/cores/basic/layouts/oldinfo/new-old.tmpl.html',
            controller: 'BasicNewOldManController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.edit-oldman', {
            url: '/basic/edit/{id}',
            templateUrl: 'app/cores/basic/layouts/oldinfo/new-old.tmpl.html',
            controller: 'BasicNewOldManController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.new-archive', {
            url: '/archives/new',
            templateUrl: 'app/cores/basic/layouts/archives/new-archive.tmpl.html',
            controller: 'BasicNewArchiveController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.new-volunteer', {
            url: '/volunteer/new',
            templateUrl: 'app/cores/basic/layouts/volunteer/new-volunteer.tmpl.html',
            controller: 'BasicNewVolunteerController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.new-commericial', {
            url: '/commericial/new',
            templateUrl: 'app/cores/basic/layouts/commericial/new-commericial.tmpl.html',
            controller: 'BasicNewCommericialController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.device-mgr',{
            url: '/device-mgr',
            templateUrl: 'app/cores/basic/layouts/device/device.tmpl.html',
            controller: 'BasicDeviceController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.monitor-mgr',{
            url: '/monitor-mgr',
            templateUrl: 'app/cores/basic/layouts/device/monitor.tmpl.html',
            controller: 'BasicMonitorController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.org-mgr',{
            url: '/org-mgr',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.department-mgr',{
            url: '/org-mgr',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.community-mgr',{
            url: '/org-mgr',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.shop-mgr',{
            url: '/org-mgr',
            templateUrl: 'app/cores/basic/layouts/org/org.tmpl.html',
            controller: 'BasicOrgController',
            controllerAs: 'vm'
        })
        .state('triangular.admin-default.master-admin',{
            url: '/master/admin',
            templateUrl: 'app/cores/basic/layouts/admin/admin.tmpl.html',
            controller: 'BasicAdminController',
            controllerAs: 'vm'
        });

        triMenuProvider.addMenu({
            name: '总部后台系统',
            icon: 'fa fa-heartbeat',
            type: 'dropdown',
            priority: 2.1,
            children: [
            {
                name: '档案管理系统',
                state: 'triangular.admin-default.basic-page',
                type: 'dropdown',
                children: [{
                    name: '老人档案管理',
                    state: 'triangular.admin-default.basic-page',
                    type: 'link'
                },{
                    name: '健康档案管理',
                    state: 'triangular.admin-default.basic-archives',
                    type: 'link'
                }]
            },
            // {
            //     name: '档案管理',
            //     state: 'triangular.admin-default.basic-archives',
            //     type: 'link'
            // },
            // {
            //     name: '设备管理',
            //     state: 'triangular.admin-default.device-mgr',
            //     type: 'link'
            // },
            {
                name: '机构管理',
                state: 'triangular.admin-default.department-mgr',
                type: 'link'
            },
            {
                name: '社区管理',
                state: 'triangular.admin-default.community-mgr',
                type: 'link'
            },
            {
                name: '服务商家管理',
                state: 'triangular.admin-default.shop-mgr',
                type: 'link'
            },
            {
                name: '视频关爱系统',
                state: 'triangular.admin-default.basic-video',
                type: 'dropdown',
                children: [{
                    name: '视频关爱',
                    state: 'triangular.admin-default.basic-video',
                    type: 'link'
                },{
                    name: '监控器设备管理',
                    state: 'triangular.admin-default.monitor-mgr',
                    type: 'link'
                }]
            },
            {
                name: '实时定位系统',
                state: 'triangular.admin-default.basic-pos',
                type: 'dropdown',
                children: [{
                    name: '实时定位',
                    state: 'triangular.admin-default.services-pos',
                    type: 'link'
                },{
                    name: '老人机设备管理',
                    state: 'triangular.admin-default.device-mgr',
                    type: 'link'
                }]
            },
            {
                name: '志愿者管理',
                state: 'triangular.admin-default.basic-volunteer',
                type: 'link'
            },
            {
                name: '系统管理员设置',
                state: 'triangular.admin-default.master-admin',
                type: 'link'
            }]
        });

        // triMenuProvider.addMenu({
        //     name: 'ffffff',
        //     icon: 'zmdi zmdi-check',
        //     type: 'dropdown',
        //     priority: 5.1,
        //     children: [{
        //         name: 'ffffffff',
        //         state: 'triangular.admin-default.basic-page',
        //         type: 'link'
        //     }]
        // )};
    }
})();
