angular.module('sbAdminApp')
.controller('SupplyMgrCtrl',function($scope,$location,User,Supplier,BASE_URL){

	if(!User.isLoggedIn){
		$location.path('/login');
	}

	$scope.currentPage=1;

	$scope.alertInfo=false;

	Supplier.getAll($scope,$scope.currentPage);

	$scope.currentUid='';

	$scope.searchCondition='';
	
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

	var searchCallback=function(data){
		console.log(data);
	};

	$scope.searchConditionChange=function(data){
		if($scope.searchCondition==''){
			Supplier.getAll($scope,$scope.currentPage);
		}
	};

	$scope.searchForSpecificUser=function(){
		if($scope.searchCondition==''){
			alert('搜索内容不能为空');
		}else{
			if(!isNaN($scope.searchCondition)){
				if($scope.searchCondition<11){
					User.getInfo($scope,$scope.searchCondition,'','','',function(data){
						searchCallback(data);
					});
				}else{
					User.getInfo($scope,'',$scope.searchCondition,'','',function(data){
						searchCallback(data);
					});
				}
			}else{
				User.getInfo($scope,null,null,$scope.searchCondition,null,function(data){
					searchCallback(data);
				});
			}
			
		}
	};
	
});