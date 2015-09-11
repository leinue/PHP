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

	$scope.editorder=function(orderid){
		$('.edit-orders').modal('toggle');
		TravelOrder.getByOrderid($scope,orderid,function(data){
			//singleOrderList
		});
		$scope.isShow1=true;
		$scope.isShow2=false;
	};

	$scope.startEdit=function(){
		$scope.isShow1=false;
		$scope.isShow2=true;
	};

	$scope.cancelEdit=function(){
		$scope.isShow1=true;
		$scope.isShow2=false;
	};

	$scope.comfirmEdit=function(){
		$scope.singleOrderList.oldnum=$scope.newoldnum;
		$scope.singleOrderList.adultnum=$scope.newadultnum;
		$scope.singleOrderList.childnum=$scope.newchildnum;
		$scope.singleOrderList.remark=$scope.remark;

		TravelOrder.update();
	};

});