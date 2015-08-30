angular.module('sbAdminApp')
.controller('SupplyMgrCtrl',function($scope,$location,User,Supplier,BASE_URL){

	if(!User.isLoggedIn){
		$location.path('/login');
	}

	$scope.currentPage=1;

	$scope.alertInfo=false;

	Supplier.getAll($scope,$scope.currentPage);

	$scope.currentUid='';

	
	$scope.deleteSupplier=function(uid){

		// var con=confirm("确定要删除吗?");
		// if(con){
		// 	Supplier.delete(uid);
		// 	Supplier.getAll($scope);
		// }

	};

	$scope.loadPage=function(){
		Supplier.getAll($scope,$scope.currentPage);
	};

	$scope.loadPrevPage=function(){
		$scope.currentPage--;
		if($scope.currentPage<0){
			$scope.currentPage=1;
		}
		Supplier.getAll($scope,$scope.currentPage);
	};

	$scope.loadNextPage=function(){
		$scope.currentPage++;
		Supplier.getAll($scope,$scope.currentPage);
	};

	$scope.editSupplier=function(uid){
		$('.edit-supplier').modal('toggle');
		$scope.currentUid=uid;

	};

	$scope.setRoot=function(){
		Supplier.addGroup($scope,$scope.currentUid,'root');
	};

	$scope.unsetRoot=function(){
		Supplier.removeGroup($scope,$scope.currentUid,'root');
	};

	$scope.setAdmin=function(){
		Supplier.addGroup($scope,$scope.currentUid,'admin');
	};

	$scope.unsetAdmin=function(){
		Supplier.removeGroup($scope,$scope.currentUid,'admin');
	};

	$scope.setSupply=function(){
		Supplier.addGroup($scope,$scope.currentUid,'supply');
	};

	$scope.unsetSupply=function(){
		Supplier.removeGroup($scope,$scope.currentUid,'supply');
	};
	
});