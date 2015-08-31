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

	$scope.afterOperateGroup=function(){
		User.getInfoByUid($scope,$scope.currentUid,function(data){
			var currentGroup=data.group;
			$scope.UserGroups=currentGroup.split(',');
			console.log($scope.UserGroups);
		},true);
	}

	$scope.addGroup=function(group){
		Supplier.addGroup($scope,$scope.currentUid,group,function(){
			$scope.afterOperateGroup();
		});
	}

	$scope.removeGroup=function(group){
		Supplier.removeGroup($scope,$scope.currentUid,group,function(){
			$scope.afterOperateGroup();
		});
	}

	$scope.editSupplier=function(uid){
		$('.edit-supplier').modal('toggle');
		$scope.currentUid=uid;
		$scope.afterOperateGroup();
	};

	$scope.setRoot=function(){
		$scope.addGroup('root');
	};

	$scope.unsetRoot=function(){
		$scope.removeGroup('root');
	};

	$scope.setAdmin=function(){
		$scope.addGroup('admin');
	};

	$scope.unsetAdmin=function(){
		$scope.removeGroup('admin');
	};

	$scope.setSupply=function(){
		$scope.addGroup('supply');
	};

	$scope.unsetSupply=function(){
		$scope.removeGroup('supply');
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
