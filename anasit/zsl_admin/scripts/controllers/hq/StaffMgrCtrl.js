angular.module('sbAdminApp')
.controller('StaffMgrCtrl',function($scope,$location,User,TravelSupply){

	$scope.page=1;

	TravelSupply.getAll($scope,$scope.page,function(data){});

	$scope.loadPrevPage=function(){
		$scope.page=$scope.page-1;
		if($scope.page<=0){
			$scope.page=1;
		}
		TravelSupply.getAll($scope,$scope.page,function(data){});
	};

	$scope.loadNextPage=function(){
		$scope.page=$scope.page+1;
		TravelSupply.getAll($scope,$scope.page,function(data){});
	};

	$scope.approve=function(uid){
		TravelSupply.approve($scope,uid,function(data){
			TravelSupply.getAll($scope,$scope.page,function(data){});
		});
	};

	$scope.reject=function(uid){
		TravelSupply.reject($scope,uid,function(data){
			TravelSupply.getAll($scope,$scope.page,function(data){});
		});
	}

});
