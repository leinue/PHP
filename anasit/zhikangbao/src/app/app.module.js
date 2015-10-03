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
            'url':  'http://api.zkkj168.com/'
        })

        .config(function ($httpProvider) {

            //允许跨源
            $httpProvider.defaults.withCredentials = true;

        })
        //配置restangular
        .config(function(RestangularProvider) {
            RestangularProvider.setBaseUrl('http://api.zkkj168.com/');
                RestangularProvider.setDefaultHeaders({
                'Content-Type': 'application/json'
            });
            RestangularProvider.setDefaultHttpFields({cache: true});
            RestangularProvider.setMethodOverriders(["put", "patch"]);
        })
        // create services that will use
        .factory('SignupService',['Restangular', function(Restangular){

            return {
                signup: function(registerData) {
                    return Restangular.all('auth/register').post(registerData);
                }
            };

        }])
        .factory('LoginService',['Restangular', function(Restangular){

            return {
                login: function(m,p) {
                    return Restangular.one('/auth/login/'+m+'/'+p).get();
                }
            };

        }]);
})();