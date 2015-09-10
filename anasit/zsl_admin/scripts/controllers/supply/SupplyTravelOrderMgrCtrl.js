angular.module('sbAdminApp')
.controller('SupplyTravelOrderMgrCtrl',function($scope,$location,User,TravelOrder){
	$scope.page=1;

	TravelOrder.getOne($scope,User.getUid(),function(data){});

	$scope.loadPrevPage=function(){
		$scope.page=$scope.page-1;
		if($scope.page<=0){
			$scope.page=1;
		}
		TravelOrder.getOne($scope,User.getUid(),function(data){});
	};

	$scope.loadNextPage=function(){
		$scope.page=$scope.page+1;
		TravelOrder.getOne($scope,User.getUid(),function(data){});
	};
});