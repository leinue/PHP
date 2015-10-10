(function() {
    'use strict';

    angular
        .module('app', [
            'triangular',
            'ngAnimate', 'ngCookies', 'ngTouch', 'ngSanitize', 'ngMessages', 'ngMaterial',
            'ui.router', 'pascalprecht.translate', 'LocalStorageModule', 'googlechart', 'chart.js', 'linkify', 'ui.calendar', 'angularMoment', 'textAngular', 'uiGmapgoogle-maps', 'hljs', 'md.data.table', angularDragula(angular),
            'restangular' , 
            //'seed-module',
            // uncomment above to activate the example seed module
            'app.examples',
            'app.cores'
        ])
        // create a constant for languages so they can be added to both triangular & translate
        .constant('APP_LANGUAGES', [{
            name: 'LANGUAGES.CHINESE',
            key: 'zh'
        },{
            name: 'LANGUAGES.ENGLISH',
            key: 'en'
        },{
            name: 'LANGUAGES.FRENCH',
            key: 'fr'
        },{
            name: 'LANGUAGES.PORTUGUESE',
            key: 'pt'
        }])
        // set a constant for the API we are connecting to
        .constant('API_CONFIG', {
            'url':  'http://api.zkkj168.com:81/'
        })
        .directive('dateformat', ['$filter',function($filter) {  
            var dateFilter = $filter('date');  
            return {  
                require: 'ngModel',  
                link: function(scope, elm, attrs, ctrl) {  
          
                    function formatter(value) {  
                        return dateFilter(value, 'yyyy-MM-dd'); //format  
                    }  
          
                    function parser() {  
                        return ctrl.$modelValue;  
                    }  
          
                    ctrl.$formatters.push(formatter);  
                    ctrl.$parsers.unshift(parser);  
          
                }  
            };  
        }])
        .filter('nullToVisual', function(){
            return function(i){
              if(typeof i != 'undefined') {
                if(i=='' || i==null){
                  return '无';
                }else{
                  return i;
                }
              }
            }
        })
        .filter('orgIsEnabled', function() {
          return function(i) {
            return i==='1' ? '已开启' : '已关闭';
          };
        })
        .run(function($rootScope, $location, $http, $state, LoginService, CheckStatus, $mdDialog){

            // User.getThisInfo();

            $rootScope.$on('$locationChangeStart',function(evt,next,curr){
              
              console.log('route change start');

              var userIsLoginIn = localStorage.id;

              if(next.indexOf('login')==-1 || next.indexOf('signup')==-1){
                //进入登录页面,登录页面不需要判断是否登录
                CheckStatus.checkAuth().then(function(data) {
                    var userIsLoggedIn = data;
                    if(userIsLoggedIn === 'false' || userIsLoggedIn === false) {
                      var alert = $mdDialog.alert({
                          title: '登录超时或未登录',
                          content:'请重新登录',
                          ok: '确定'
                      });
                      $mdDialog.show(alert);
                      $state.go('authentication.login');
                    }
                 });
              }

              

              // if(!User.isLoggedIn() ||){
              //   $location.path('/login');
              // }

              // var currentGroup=localStorage.group;

              // console.log("currentGroup="+currentGroup);

              // if(next.indexOf('hq')!=-1){
              //   //总部后台
              //   console.log('进入总部后台...即将验证权限');
              //   if(currentGroup.indexOf('root')!=-1 || currentGroup.indexOf('admin')!=-1){
              //     console.log('access approved');
              //   }else{
              //     alert('无权访问');
              //     $location.path(curr);
              //   }
              // }

              // if(next.indexOf('finance')!=-1){
              //   //财务后台
              //   console.log('进入财务后台...即将验证权限');
              //   if(currentGroup.indexOf('root')!=-1 || currentGroup.indexOf('admin')!=-1 || currentGroup.indexOf('finance')!=-1){
              //     console.log('access approved');
              //   }else{
              //     alert('无权访问');
              //     $location.path(curr);
              //   }

              // }

              // if(next.indexOf('supply')!=-1){
              //   //供应商后台
              //   console.log('进入供应商后台...即将验证权限');
              //   if(currentGroup.indexOf('supply')!=-1 || currentGroup.indexOf('root')!=-1 || currentGroup.indexOf('admin')!=-1){
              //     console.log('access approved');
              //   }else{
              //     alert('无权访问');
              //     $location.path(curr);
              //   }
              // }

            });

          })

        .config(function ($httpProvider) {

            //允许跨源
            $httpProvider.defaults.withCredentials = true;

            $httpProvider.defaults.useXDomain=true;
            delete $httpProvider.defaults.headers.common['X-Requested-With'];

        })
        //配置restangular
        .config(function(RestangularProvider) {
            RestangularProvider.setBaseUrl('http://api.zkkj168.com:81/');
                RestangularProvider.setDefaultHeaders({
                'Content-Type': 'application/json',
            });
            RestangularProvider.setDefaultHttpFields({
                'cache': false,
                'withCredentials': true
            });
            RestangularProvider.setMethodOverriders(["put", "patch"]);
        })
        .factory('CheckStatus',['Restangular', '$http', 'API_CONFIG', function(Restangular, $http, API_CONFIG){

            return {
                check: function(status) {
                    return status === '201' || status === '200';
                },
                checkAuth: function(http) {
                    http = http == null ? false : true;
                    if(http) {
                        return $http.get(API_CONFIG.url + 'auth/check');
                    }else{
                      console.log('restangular');
                       return Restangular.one('auth/check').get();
                    }
                }
            };

        }])
        // create services that will use
        .factory('SignupService',['Restangular', function(Restangular){

            return {
                signup: function(registerData) {
                    return Restangular.all('auth/register').post(registerData);
                }
            };

        }])
        .factory('LoginService',['Restangular', '$http', 'API_CONFIG', function(Restangular, $http, API_CONFIG){

            return {
                login: function(login_user,http) {
                    http = http == null ? false : true;
                   if(http) {
                      return $http.post(API_CONFIG.url + 'auth/login',login_user);
                   }else{
                      return Restangular.all('/auth/login/').post(login_user);
                   }
                   
                },
                
                logout: function() {
                    return Restangular.one('/auth/logout').get().then(function(data) {
                        localStorage.id = '';
                        localStorage.username = '';
                        localStorage.roles = '';
                        localStorage.mobile = '';
                        $state.go('authentication.login');
                    });
                }
            };

        }])
        .factory('UserService',['Restangular', function(Restangular) {

            return {

                getUserInfo: function () {
                    return {
                        id: localStorage.id,
                        username: localStorage.username,
                        mobile: localStorage.mobile,
                        roles: localStorage.roles
                    };
                },

                isUserOffline: function() {
                    return localStorage.id === '' || typeof localStorage.id === 'undefined';
                }

            };

        }])
        .factory('OrgService', ['Restangular', function(Restangular){

            return {

                index: function() {
                    return Restangular.one('/profile/org/index').get();
                },

                update: function(data) {
                    return Restangular.all('/profile/org/update').post(data);
                },

                insert: function(data) {
                    return Restangular.all('/profile/org/insert').post(data);
                },

                remove: function(org_id) {
                    return Restangular.one('/profile/org/delete/' + org_id).get(); 
                },

                one: function(id) {
                  return Restangular.one('/profile/org/one/' + id).get();
                }

            };

        }])
        .factory('OldInfoService',['Restangular', function(Restangular) {

          return {

            index: function() {
              return Restangular.one('/profile/old/index').get();
            },

            update:function(data) {
              return Restangular.all('/profile/old/update').post(data);
            },

            insert: function(data) {
              return Restangular.all('/profile/old/insert').post(data);
            },

            remove: function(uid) {
              return Restangular.one('/profile/old/delete/' + uid).get();
            },

            one: function(uid) {
              return Restangular.one('/profile/old/one/' + uid).get();
            }

          };

        }])
        .factory('OrgInfoService',['Restangular', function(Restangular) {

          return {

            index: function() {
              return Restangular.one('/profile/org_cate/index').get();
            },

            update:function(data) {
              return Restangular.all('/profile/org_cate/update').post(data);
            },

            insert: function(data) {
              return Restangular.all('/profile/org_cate/insert').post(data);
            },

            remove: function(uid) {
              return Restangular.one('/profile/org_cate/delete' + uid).get();
            },

            one: function(uid) {
              return Restangular.one('/profile/org_cate/one' + uid).get();
            }

          };

        }])
        .factory('DeviceService',['Restangular', function(Restangular) {

          return {

            index: function() {
              return Restangular.one('/profile/device/index').get();
            },

            update:function(data) {
              return Restangular.all('/profile/device/update').post(data);
            },

            insert: function(data) {
              return Restangular.all('/profile/device/insert').post(data);
            },

            remove: function(uid) {
              return Restangular.one('/profile/device/delete/' + uid).get();
            }

          };

        }])
        .factory('HealthService', ['Restangular', function(Restangular){

          return  {

            index: function() {
              return Restangular.all('/healths/old').get();
            },

            update: function(data) {
              return Restangular.all('/healths/old/edit').post(data);
            },

            insert: function(data) {
              return Restangular.all('/healths/old/add').post(data);
            },

            remove: function(id) {
              return Restangular.one('/healths/old/remove/' + id).get();
            },

            one: function(id) {
              return Restangular.one('/healths/old/' + id).get();
            },

            singleOne: function(id) {
              return Restangular.one('/healths/old/singleOne/' + id).get();
            }

          };

        }])
        .factory('FamilyMemberService', ['Restangular', '$http', 'API_CONFIG', function(Restangular, $http, API_CONFIG) {

          return {

            index: function(id) {
              // return Restangular.all('/relation/all').get();
              return $http.get(API_CONFIG.url + 'relation/one/' + id);
            },

            update: function(data) { 
              return Restangular.all('/relation/edit').post(data);
            },

            insert: function(data) {
              return Restangular.all('/relation/add').post(data);
            },

            remove: function(id) {
              return Restangular.one('/relation/delete/' + id).get();
            },

            one: function(id) {
              return Restangular.one('/relation/single/' + id).get();
            }

          };

        }]);

        // .factory('DeviceHistoryService',['Restangular', function(Restangular) {

        //   return {

        //     index: function() {
        //       return Restangular.one('/profile/device_history/index').get();
        //     },

        //     update:function(data) {
        //       return Restangular.all('/profile/device_history/update').post(data);
        //     },

        //     insert: function(data) {
        //       return Restangular.all('/profile/device_history/insert').post(data);
        //     },

        //     remove: function(uid) {
        //       return Restangular.one('/profile/device_history/delete' + uid).get();
        //     }

        //   };

        // }]);
})();
