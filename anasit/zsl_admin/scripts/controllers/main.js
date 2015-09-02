'use strict';
/**
 * @ngdoc function
 * @name sbAdminApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the sbAdminApp
 */
angular.module('sbAdminApp')

  .controller('MainCtrl', function($scope,$position,$location,User) {

  	$scope.homeDashBoardTitle="欢迎使用掌尙旅后台系统";
  });
