angular.module('sbAdminApp')
.controller('TravelOrderMgrCtrl',function($scope,$location,User,TravelOrder){
	$scope.page=1;

	TravelOrder.getAll($scope,$scope.page,function(data){});

	$scope.loadPrevPage=function(){
		$scope.page=$scope.page-1;
		if($scope.page<=0){
			$scope.page=1;
		}
		TravelOrder.getAll($scope,$scope.page,function(data){});
	};

	$scope.loadNextPage=function(){
		$scope.page=$scope.page+1;
		TravelOrder.getAll($scope,$scope.page,function(data){});
	};

	$scope.editorder=function(){

	};

	$scope.delorder=function(){

	};
});