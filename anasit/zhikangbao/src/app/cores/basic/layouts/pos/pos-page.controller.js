(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicPosController', BasicPosController);

    /* @ngInject */
    function BasicPosController($scope) {
        var vm = this;
        vm.testData = ['triangular', 'is', 'great'];

        $scope.lng = 116.397428;
	    $scope.lat = 39.90923;

	    $scope.getPath = function() {
		 	var lngX = $scope.lng;
	        var latY = $scope.lat;
	        var lineArr = [];
	        lineArr.push([lngX, latY]);
	        for (var i = 1; i < 100; i++) {
	          lngX = lngX + Math.random() * 0.05;
	          if (i % 2) {
	            latY = latY + Math.random() * 0.0001;
	          } else {
	            latY = latY + Math.random() * 0.06;
	          }
	          lineArr.push([lngX, latY]);
	        }
	    };
    }
})();
