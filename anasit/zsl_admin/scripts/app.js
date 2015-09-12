'use strict';
/**
 * @ngdoc overview
 * @name sbAdminApp
 * @description
 * # sbAdminApp
 *
 * Main module of the application.
 */
angular
  .module('sbAdminApp', [
    'oc.lazyLoad',
    'ui.router',
    'ui.bootstrap',
    'angular-loading-bar',
  ])
  .constant('ACCESS_LEVELS',{
    pub:1,
    user:2,
    hq:3,
    finance:4,
    supply:5
  })
  .constant('BASE_URL',{
    url:'http://service.zhangshanglv.cn'
  })
  .config(function ($httpProvider) {

    $httpProvider.defaults.withCredentials = true;

  })
  .filter('nullToVisual',function(){
      return function(i){
          if(i=='' || i==null){
            return '无';
          }else{
            return i;
          }
      }
  })
  .filter('payType',function(){
    return function(i){

      switch(i){
        case '1':
          return '微信支付';
        case '0':
          return '未支付';
        case '2':
          return '手动支付';
      }

    };
  })
  .filter('payStatus',function(){
    return function(i){
      if(i==='0'){
        return '未支付';
      }

      if(i==='1'){
        return '已支付';
      }
    };
  })
  .filter('StaffMgrStatusToChar',function(){
      return function(i){
          if(i==='0'){
            return '审核中';
          }else{
            if(i==='1'){
              return '已通过';
            }else{
              return '已拒绝';
            }
          }
      }
  })
  .filter('groupToVisual',function(){
      return function(groups){
          var groupName;
          groupName=groups.replace('root','超级管理员');
          groupName=groupName.replace('admin','管理员');
          groupName=groupName.replace('supply','供货商');
          groupName=groupName.replace('shop','shop');
          return groupName;
      }
  })
  .run(function($rootScope,$location,User){

    // User.getThisInfo();

    $rootScope.$on('$locationChangeStart',function(evt,next,curr){
      
      console.log('route change start');

      if(!User.isLoggedIn()){
        $location.path('/login');
      }

      var currentGroup=localStorage.group;

      console.log("currentGroup="+currentGroup);

      if(next.indexOf('hq')!=-1){
        //总部后台
        console.log('进入总部后台...即将验证权限');
        if(currentGroup.indexOf('root')!=-1 || currentGroup.indexOf('admin')!=-1){
          console.log('access approved');
        }else{
          alert('无权访问');
          $location.path(curr);
        }
      }

      if(next.indexOf('finance')!=-1){
        //财务后台
        console.log('进入财务后台...即将验证权限');
        if(currentGroup.indexOf('root')!=-1 || currentGroup.indexOf('admin')!=-1 || currentGroup.indexOf('finance')!=-1){
          console.log('access approved');
        }else{
          alert('无权访问');
          $location.path(curr);
        }

      }

      if(next.indexOf('supply')!=-1){
        //供应商后台
        console.log('进入供应商后台...即将验证权限');
        if(currentGroup.indexOf('supply')!=-1 || currentGroup.indexOf('root')!=-1 || currentGroup.indexOf('admin')!=-1){
          console.log('access approved');
        }else{
          alert('无权访问');
          $location.path(curr);
        }
      }


    });

  })
  // .config(function($httpProvider){
  //   var interceptor=function($scope,$rootScope,Auth){
      
  //     return {
        
  //       'response':function(resp){
  //         if(resp.config.url=='/api/login'){
  //           Auth.setToken();
  //         }
  //         return resp;
  //       },

  //       'responseError':function(rejection){

  //       }

  //     };

  //   };
  // })
  .config(['$stateProvider','$urlRouterProvider','$ocLazyLoadProvider','$httpProvider',function ($stateProvider,$urlRouterProvider,$ocLazyLoadProvider,$httpProvider) {
    
    $ocLazyLoadProvider.config({
      debug:false,
      events:true,
    });

    $urlRouterProvider.otherwise('/dashboard/home');

    $httpProvider.defaults.useXDomain=true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
    //13044903255

    $stateProvider
      .state('dashboard', {
        url:'/dashboard',
        templateUrl: 'views/dashboard/main.html',
        resolve: {
            loadMyDirectives:function($ocLazyLoad){
                return $ocLazyLoad.load(
                {
                    name:'sbAdminApp',
                    files:[
                    'scripts/directives/header/header.js',
                    'scripts/directives/header/header-notification/header-notification.js',
                    'scripts/directives/sidebar/sidebar.js',
                    'scripts/directives/sidebar/sidebar-search/sidebar-search.js',
                    // 'scripts/services/services.js'
                    ]
                }),
                $ocLazyLoad.load(
                {
                   name:'toggle-switch',
                   files:["bower_components/angular-toggle-switch/angular-toggle-switch.min.js",
                          "bower_components/angular-toggle-switch/angular-toggle-switch.css"
                      ]
                }),
                $ocLazyLoad.load(
                {
                  name:'ngAnimate',
                  files:['bower_components/angular-animate/angular-animate.js']
                })
                $ocLazyLoad.load(
                {
                  name:'ngCookies',
                  files:['bower_components/angular-cookies/angular-cookies.js']
                })
                $ocLazyLoad.load(
                {
                  name:'ngResource',
                  files:['bower_components/angular-resource/angular-resource.js']
                })
                $ocLazyLoad.load(
                {
                  name:'ngSanitize',
                  files:['bower_components/angular-sanitize/angular-sanitize.js']
                })
                $ocLazyLoad.load(
                {
                  name:'ngTouch',
                  files:['bower_components/angular-touch/angular-touch.js']
                })
            }
        }
    })
      .state('dashboard.home',{
        url:'/home',
        controller: 'MainCtrl',
        templateUrl:'views/dashboard/home.html',
        resolve: {
          loadMyFiles:function($ocLazyLoad) {
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
              'scripts/controllers/main.js',
              'scripts/directives/timeline/timeline.js',
              'scripts/directives/notifications/notifications.js',
              'scripts/directives/chat/chat.js',
              'scripts/directives/dashboard/stats/stats.js'
              ]
            })
          }
        }
      })
      .state('dashboard.form',{
        templateUrl:'views/form.html',
        url:'/form'
    })
      .state('dashboard.blank',{
        templateUrl:'views/pages/blank.html',
        url:'/blank'
    })
      .state('login',{
        templateUrl:'views/pages/login.html',
        url:'/login',
        controller:'UserLoginCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/UserLoginCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.chart',{
        templateUrl:'views/chart.html',
        url:'/chart',
        controller:'ChartCtrl',
        resolve: {
          loadMyFile:function($ocLazyLoad) {
            return $ocLazyLoad.load({
              name:'chart.js',
              files:[
                'bower_components/angular-chart.js/dist/angular-chart.min.js',
                'bower_components/angular-chart.js/dist/angular-chart.css'
              ]
            }),
            $ocLazyLoad.load({
                name:'sbAdminApp',
                files:['scripts/controllers/chartContoller.js']
            })
          }
        }
    })
      .state('dashboard.table',{
        templateUrl:'views/table.html',
        url:'/table'
    })
      .state('dashboard.panels-wells',{
          templateUrl:'views/ui-elements/panels-wells.html',
          url:'/panels-wells'
      })
      .state('dashboard.buttons',{
        templateUrl:'views/ui-elements/buttons.html',
        url:'/buttons'
    })
      .state('dashboard.notifications',{
        templateUrl:'views/ui-elements/notifications.html',
        url:'/notifications'
    })
      .state('dashboard.typography',{
       templateUrl:'views/ui-elements/typography.html',
       url:'/typography'
   })
      .state('dashboard.icons',{
       templateUrl:'views/ui-elements/icons.html',
       url:'/icons'
   })
      .state('dashboard.grid',{
       templateUrl:'views/ui-elements/grid.html',
       url:'/grid'
   })
    //   .state('dashboard',{
    //     url:'/hq',
    //     templateUrl:'views/hq/supply-mgr.html'
    // })
      .state('dashboard.staff-mgr',{
        templateUrl:'views/hq/staff-mgr.html',
        url:'/hq/staff-mgr',
        controller:'StaffMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/StaffMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-mgr',{
        templateUrl:'views/hq/supply-mgr.html',
        url:'/hq/supply-mgr',
        controller:'SupplyMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/SupplyMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.branch-office-mgr',{
        templateurl:'views/hq/branch-office-mgr.html',
        url:'/hq/branch-office-mgr',
        controller:'BranchOfficeMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/BranchOfficeMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.agent-mgr',{
        templateUrl:'views/hq/agent-mgr.html',
        url:'/hq/agent-mgr',
        controller:'AgentMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/AgentMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.route-area-mgr',{
        templateUrl:'views/hq/route-area-mgr.html',
        url:'/hq/route-area-mgr',
        controller:'RouteAreaMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/RouteAreaMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.route-product-mgr',{
        templateUrl:'views/hq/route-product-mgr.html',
        url:'/hq/route-product-mgr',
        controller:'RouteProductMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/RouteProductMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.travel-order-mgr',{
        templateUrl:'views/hq/travel-order-mgr.html',
        url:'/hq/travel-order-mgr',
        controller:'TravelOrderMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/TravelOrderMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.goods-assortment',{
        templateUrl:'views/hq/goods-assortment.html',
        url:'/hq/goods-assortment',
        controller:'GoodsAssortmentCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/GoodsAssortmentCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.points-mall',{
        templateUrl:'views/hq/points-mall.html',
        url:'/hq/points-mall',
        controller:'PointsMall',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/PointsMall.js'
              ]
            })
          }
        }
    })
      .state('dashboard.vip-prefeature',{
        templateUrl:'views/hq/vip-prefeature.html',
        url:'/hq/vip-prefeature',
        controller:'VIPPrefeatureCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/VIPPrefeatureCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.perimeter-mall',{
        templateUrl:'views/hq/perimeter-mall.html',
        url:'/hq/perimeter-mall',
        controller:'PerimeterMallCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/PerimeterMallCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.points-sign-in',{
        templateUrl:'views/hq/points-sign-in.html',
        url:'/hq/points-sign-in',
        controller:'PointsSignInCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/PointsSignInCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.dial-raffle',{
        templateUrl:'views/hq/dial-raffle.html',
        url:'/hq/dial-raffle',
        controller:'DialRaffleCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/DialRaffleCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.vote',{
        templateUrl:'views/hq/vote.html',
        url:'/hq/vote',
        controller:'VoteCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/VoteCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.card-mgr',{
        templateUrl:'views/hq/card-mgr.html',
        url:'/hq/card-mgr',
        controller:'CardMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/CardMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.profile-mgr',{
        templateUrl:'views/hq/profile-mgr.html',
        url:'/hq/profile-mgr',
        controller:'ProfileMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/ProfileMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.vip-points-mgr',{
        templateUrl:'views/hq/vip-points-mgr.html',
        url:'/hq/vip-points-mgr',
        controller:'VIPPointsMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/VIPPointsMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.agent-statistics',{
        templateUrl:'views/hq/agent-statistics.html',
        url:'/hq/agent-statistics',
        controller:'AgentStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/AgentStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-statistics',{
        templateUrl:'views/hq/supply-statistics.html',
        url:'/hq/supply-statistics',
        controller:'SupplyStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/SupplyStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.shopkeeper-statistics',{
        templateUrl:'views/hq/shopkeeper-statistics.html',
        url:'/hq/shopkeeper-statistics',
        controller:'ShopkeeperStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/ShopkeeperStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.department-statistics',{
        templateUrl:'views/hq/department-statistics.html',
        url:'/hq/department-statistics',
        controller:'DepartmentStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/hq/DepartmentStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.finance-verify',{
        templateUrl:'views/finance/finance-verify.html',
        url:'/finance/finance-verify',
        controller:'FinanceVerifyCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/finance/FinanceVerifyCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.finance-record',{
        templateUrl:'views/finance/finance-record.html',
        url:'/finance/finance-record',
        controller:'FinanceRecordCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/finance/FinanceRecordCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.finance-route-statistics',{
        templateUrl:'views/finance/finance-route-statistics.html',
        url:'/finance/finance-route-statistics',
        controller:'FinanceRouteStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/finance/FinanceRouteStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.finance-route-credit-statistics',{
        templateUrl:'views/finance/finance-route-credit-statistics.html',
        url:'/finance/finance-route-credit-statistics',
        controller:'FinanceRouteCreditStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/finance/FinanceRouteCreditStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-verify',{
        templateUrl:'views/supply/supply-verify.html',
        url:'/supply/supply-verify',
        controller:'SupplyVerifyCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyVerifyCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-profile',{
        templateUrl:'views/supply/supply-profile.html',
        url:'/supply/supply-profile',
        controller:'SupplyProfileCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyProfileCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-route-mgr',{
        templateUrl:'views/supply/supply-route-mgr.html',
        url:'/supply/supply-route-mgr',
        controller:'SupplyRouteMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyRouteMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-route-mgr-new',{
        templateUrl:'views/supply/supply-route-mgr-new.html',
        url:'/supply/supply-route-mgr-new',
        controller:'SupplyRouteMgrNewCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyRouteMgrNewCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-travel-order-mgr',{
        templateUrl:'views/supply/supply-travel-order-mgr.html',
        url:'/supply/supply-travel-order-mgr',
        controller:'SupplyTravelOrderMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyTravelOrderMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-goods-mgr',{
        templateUrl:'views/supply/supply-goods-mgr.html',
        url:'/supply/supply-goods-mgr',
        controller:'SupplyGoodsMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyGoodsMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-goods-order-mgr',{
        templateUrl:'views/supply/supply-goods-order-mgr.html',
        url:'/supply/supply-goods-order-mgr',
        controller:'SupplyGoodsOrderMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyGoodsOrderMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-comments-mgr',{
        templateUrl:'views/supply/supply-comments-mgr.html',
        url:'/supply/supply-comments-mgr',
        controller:'SupplyCommentsMgrCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyCommentsMgrCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-travel-verify',{
        templateUrl:'views/supply/supply-travel-verify.html',
        url:'/supply/supply-travel-verify',
        controller:'SupplyTravelVerifyCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyTravelVerifyCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-travel-statistics',{
        templateUrl:'views/supply/supply-travel-statistics.html',
        url:'/supply/supply-travel-statistics',
        controller:'SupplyTravelStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyTravelStatisticsCtrl.js'
              ]
            })
          }
        }
    })
      .state('dashboard.supply-travel-credit-statistics',{
        templateUrl:'views/supply/supply-travel-credit-statistics.html',
        url:'/supply/supply-travel-credit-statistics',
        controller:'SupplyTravelCreditStatisticsCtrl',
        resolve:{
          loadMyFiles:function($ocLazyLoad){
            return $ocLazyLoad.load({
              name:'sbAdminApp',
              files:[
                'scripts/controllers/supply/SupplyTravelCreditStatisticsCtrl.js'
              ]
            })
          }
        }
    })

  }]);

    
