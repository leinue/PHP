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
            'app.cores',
            'angularFileUpload',
            'ui.bootstrap', 'ui.bootstrap.datetimepicker'
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
        .filter('isDeal', function() {
          return function(i) {
            return i==='1' ? '已受理' : '未受理';
          };
        })
        .filter('orderStatus', function() {
          return function(i) {
            return i==='1' ? '已受理' : '未受理';
          };
        })
        .filter('userGroupFilter', function() {
          return function(i) {
            if (i == '2') {
              return '管理员';
            }else if (i == '5') {
              return '客服';
            }
          }
        })
        .run(function($rootScope, $location, $http, $state, LoginService, CheckStatus, $mdDialog, DashboardService){

            // User.getThisInfo();

            window.clearInterval(window.runtimePosInterval);
            window.clearInterval(window.singleRuntimePosInterval);

            window.runtimePosInterval = '';
            window.singleRuntimePosInterval = '';

            console.log(localStorage.roles);

            $rootScope.$on('$locationChangeStart',function(evt,next,curr){
              
              var userIsLoginIn = localStorage.id;

              if(next.indexOf('login') === -1 && next.indexOf('signup') === -1){
                
                //进入登录页面,登录页面不需要判断是否登录
                if(typeof localStorage.username_ == 'undefined' || localStorage.username_ == '') {
                  //本地未存储用户数据时不用判断是否登录,直接认定为未登录
                  $state.go('authentication.login');
                }

                CheckStatus.checkAuth().then(function(data) {
                    var userIsLoggedIn = data;
                    if(userIsLoggedIn === 'false' || userIsLoggedIn === false) {
                      var alert = $mdDialog.alert({
                          title: '登录超时或未登录',
                          content:'请重新登录',
                          ok: '确定'
                      });
                      $mdDialog.show(alert);
                      DashboardService.reduceOnline();
                      $state.go('authentication.login');
                    }

                    if(localStorage.fromLoginPage == 'true') {
                        localStorage.fromLoginPage = 'false';
                        window.location.reload();
                        
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

            // $mdToast.show(
            //   $mdToast.simple()
            //   .action($filter('translate')('message'))
            //   .position('bottom right')
            //   .highlightAction(true)
            //   .hideDelay(0)
            // );

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
        .factory('LoginService',['Restangular', '$http', 'API_CONFIG', '$state', function(Restangular, $http, API_CONFIG, $state){

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
                },

                changePassword: function(data) {
                  return Restangular.all('/auth/user/change').post(data);
                }

            };

        }])
        .factory('OrgService', ['Restangular', function(Restangular){

            return {
                //select *,a.name from organization inner join organization_cate as a on a.id in (3,4,5);
                index: function(code) {
                    if(code != null ) {
                      return Restangular.one('/profile/org/index/' + code).get();
                    }else {
                      return Restangular.one('/profile/org/index').get();
                    }
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
                },

                search: function(keywords) {
                  return Restangular.one('/organization/search/' + keywords).get();
                }

            };

        }])
        .factory('OldInfoService',['Restangular', function(Restangular) {

          return {

            index: function(page,count) {
              page = page == null ? 1 : page;
              count = count == null ? 10 : count;
              return Restangular.one('/profile/old/index/' + page + '/' + count).get();
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
            },

            search: function(keywords) {
              return Restangular.one('/healths/search/' + keywords).get();
            },

            searchByOrg: function(org, features) {
              if (features == null) {
                return Restangular.one('/profile/old/org_get/' + org).get();
              }else {
                return Restangular.one('/profile/old/org_get/' + org + '/' + features).get();
              }
            },

            todayOld: function() {
              return Restangular.one('/old/today_add').get();
            },

            oldMount: function() {
              return Restangular.one('/old/oldMount').get();
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
            },

            getByOrgCate: function(id) {
              return Restangular.one('/video/getorg/' + id).get();
            }

          };

        }])
        .factory('DeviceService',['Restangular', function(Restangular) {

          return {

            index: function(page,limit) {
              var page = page == null ? 1 : page;
              var limit = limit == null ? 10 :limit;
              return Restangular.one('/profile/device/index/' + page + '/' + limit).get();
            },

            update: function(data) {
              return Restangular.all('/profile/device/update').post(data);
            },

            insert: function(data) {
              return Restangular.all('/profile/device/insert').post(data);
            },

            remove: function(uid) {
              return Restangular.one('/profile/device/delete/' + uid).get();
            },

            search: function(keywords) {
              return Restangular.one('/device/search/' + keywords).get();
            },

            getDeviceAndOldByOrgId: function(id) {
              return Restangular.one('/device/org/' + id).get();
            },

            getOldHistoryByUid: function(uid) {
              return Restangular.one('/device/device_history/' + uid).get();
            },

            getRuntimePositionByUid: function(uid) {
              return Restangular.one('/device/device_info/' + uid).get();
            },

            getSingleOldByKeyWords: function(key) {
              return Restangular.one('/device/search_pos/' + key).get();
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
              return Restangular.one('/healths/old/singleOne/A/' + id).get();
            },

            search: function(keywords) {
              return Restangular.one('/healths/search/' + keywords).get();
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

        }])
        .factory('UserMgrService', ['Restangular', '$http', 'API_CONFIG', function(Restangular, $http, API_CONFIG) {
          
            return {
          
                index: function() {
                  return Restangular.one('/user/unactive').get();
                },

                setAdmin: function(id,role_id) {
                  return Restangular.one('/user/active/' + id + '/' + role_id).get();
                },

                getRoles: function() {
                  return Restangular.one('user/get_roles').get();
                }

            };
        }])
        .factory('MonitorService', ['Restangular', '$http', 'API_CONFIG', function(Restangular, $http, API_CONFIG) {
            return {
          
              index: function(page,limit) {
                var page = page == null ? 1 : page;
                var limit = limit == null ? 10 : limit;
                return Restangular.one('/monitor/all/' + page + '/' + limit).get();
              },

              update: function(data) {
                return Restangular.all('/monitor/edit').post(data);
              },

              remove: function(id) {
                return Restangular.one('/monitor/delete/' + id).get();
              },

              insert: function(data) {
                return Restangular.all('/monitor/add').post(data);
              },

              one: function(id) {
                return Restangular.one('/monitor/one/' + id).get();
              },

              getByOrg: function(id) {
                return Restangular.one('/video/getmonitor/' + id).get();
              },

              search: function(keywords) {
                return Restangular.one('/monitor/search/' + keywords).get();
              }

            };
        }])
        .factory('HelpService', ['Restangular', '$http', 'API_CONFIG', function(Restangular, $http, API_CONFIG) {
          
          return {

            index: function(page,limit) {
              page = page == null ? 1 : page;
              limit = limit == null ? 10 : limit;
              return Restangular.one('/help/get/' + page + '/' + limit).get();
            },

            setDeal: function(id) {
              return Restangular.all('/help/update').post(id);
            },

            search: function(keywords) {
              return Restangular.one('/help/search/' + keywords).get();
            }

          };

        }])
        .factory('YulpService', ['Restangular', '$http', 'API_CONFIG', function (Restangular, $http, API_CONFIG) {

          return {
            
            index: function(page,limit) {
              page = page == null ? 1 : page;
              limit = limit == null ? 10 : limit;
              return Restangular.one('/sos/all/' + page + '/' + limit).get();
            },

            detail: function(id) {
              return Restangular.one('/sos/detail/' + id).get();
            },

            family: function(id) {
              return Restangular.one('/sos/family/' + id).get();
            },

            count: function() {
              return Restangular.one('/sos/count').get();
            },

            latest: function(count) {
              return Restangular.one('/sos/new/' + count).get();
            },

            search: function(keywords) {
              return Restangular.one('/sos/searcha/' + keywords).get();
            }

          };

        }])
        .factory('SmsService', ['Restangular', '$http', 'API_CONFIG', function (Restangular, $http, API_CONFIG) {

          return {
            
            send: function(data) {
              return Restangular.all('/message/jpush/send').post(data);
            },

            sendBySms: function(data) {
              return Restangular.all('/message/sms/send').post(data);
            },

            sendByEmail: function(data) {
              return Restangular.one('/PHPMailer/examples/smtp.php?title=' + data.title + '&content=' + data.content + '&to=' + data.to).get();
            }

          };

        }])
        .factory('OrderService', ['Restangular', '$http', 'API_CONFIG', function (Restangular, $http, API_CONFIG) {

          return {
            
            index: function(page,limit) {
              page = page == null ? 1 : page;
              limit = limit == null ? 10 : limit;
              return Restangular.one('/work/get/' + page + '/' + limit).get();
            },

            insert: function(data) {
              return Restangular.all('/work/add').post(data);
            },

            search: function(data) {
              return Restangular.one('/work/search/' + data).get();
            },

            confirm: function(id) {
              return Restangular.one('work/deal/' + id).get();
            }

          };

        }])
        .factory('VolunteerService', ['Restangular', '$http', 'API_CONFIG', function (Restangular, $http, API_CONFIG) {

          return  {

            index: function(page, limit) {
              page = page == null ? 1 : page;
              limit = limit == null ? 10 : limit;
              return Restangular.one('/volunteer/all/' + page + '/' + limit).get();
            },

            insert: function(data) {
              return Restangular.all('/volunteer/add').post(data);
            },

            update: function(data) {
              return Restangular.all('/volunteer/edit/').post(data);
            },

            remove: function(id) {
              return Restangular.one('/volunteer/delete/' + id).get();
            },

            search: function(keywords) {
              return Restangular.one('/volunteer/search/' + keywords).get();
            }

          };

        }])
        .factory('CsvImporterService', ['Restangular', '$http', 'API_CONFIG', function (Restangular, $http, API_CONFIG) {

          return {
        
            import: function(name) {
              return Restangular.one('/csv/import/' + name).get();
            },

            download: function() {
              return Restangular.one('/csv/download').get();
            }

          };

        }])
        .factory('DashboardService', ['Restangular', '$http', 'API_CONFIG', function (Restangular, $http, API_CONFIG) {

          return {
            
            orgMount: function() {
              return Restangular.one('/org/mount').get();
            },

            todayOrgMount: function() {
              return Restangular.one('/org/today_mount').get();
            },

            helpMount: function() {
              return Restangular.one('/help/mount').get();
            },

            helpDealMount: function() {
              return Restangular.one('/help/deal_mount').get();
            },

            oldMonthMount: function() {
              return Restangular.one('/old/month_mount').get();
            },

            loginMount: function() {
              return Restangular.one('/auth/login_mount').get();
            },

            todayLoginMount: function() {
              return Restangular.one('/auth/online_mount').get();
            },

            reduceOnline: function() {
              return Restangular.one('auth/reduce_online').get();
            }

          };

        }])
        .factory('RefreshService', ['$mdToast', function ($mdToast) {
          
          return  {

            refresh: function() {
              // $mdToast.show(
              //   $mdToast.simple()
              //       .content('刷新数据...')
              //       .position('bottom right')
              //       .highlightAction(true)
              //       .hideDelay(2000)
              // );
            }

          }

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
