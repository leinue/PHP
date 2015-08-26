'use strict';

/**
 * @ngdoc directive
 * @name izzyposWebApp.directive:adminPosHeader
 * @description
 * # adminPosHeader
 */
angular.module('sbAdminApp')
	.directive('header',function(){
		return {
        templateUrl:'scripts/directives/header/header.html',
        restrict: 'E',
        replace: true,
    	}
	})
	.controller('headerNoficationCtrl',function($scope,$location,User){

		$scope.unsetUser=function(){
			User.logout();
		};

	});


