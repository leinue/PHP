'use strict';

/**
 * @ngdoc directive
 * @name izzyposWebApp.directive:adminPosHeader
 * @description
 * # adminPosHeader
 */

angular.module('sbAdminApp')
  .directive('sidebar',['$location',function() {
    return {
      templateUrl:'scripts/directives/sidebar/sidebar.html',
      restrict: 'E',
      replace: true,
      scope: {
      },
      controller:function($scope,User){
        $scope.selectedMenu = 'dashboard';
        $scope.collapseVar = 0;
        $scope.multiCollapseVar = 0;
        
        $scope.check = function(x){
          
          if(x==$scope.collapseVar)
            $scope.collapseVar = 0;
          else
            $scope.collapseVar = x;
        };
        
        $scope.multiCheck = function(y){
          
          if(y==$scope.multiCollapseVar)
            $scope.multiCollapseVar = 0;
          else
            $scope.multiCollapseVar = y;
        };

        var groups=User.getGroup();

        $scope.sb_isAdmin=false;
        $scope.sb_isRoot=false;
        $scope.sb_isSupply=false;
        $scope.sb_isFinace=false;
        $scope.sb_isShop=false;

        if(groups.indexOf('root')!=-1){
          $scope.sb_isRoot=true;
        }

        if(groups.indexOf('admin')!=-1){
          $scope.sb_isAdmin=true;
        }

        if(groups.indexOf('supply')!=-1){
          $scope.sb_isSupply=true;
        }

        if(groups.indexOf('shop')!=-1){
          $scope.sb_isShop=true;
        }

      }
    }
  }]);
