angular.module('sbAdminApp')
.controller('SupplyMgrCtrl',function($scope,$location,User,SupplierMgr){

	if(!User.isLoggedIn){
		$location.path('/login');
	}

	$scope.alertInfo=false;

	SupplierMgr.getAll($scope);

	$scope.deleteSupplier=function(uid){

		var con=confirm("确定要删除吗?");
		if(con){
			SupplierMgr.delete(uid);
			SupplierMgr.getAll($scope);
		}

	};

	$scope.editSupplier=function(uid,username,password,tel,groupid,salt,status,name,image1,image2,image3,isapproved,type){
		SupplierMgr.update(uid,username,password,tel,groupid,salt,status,name,image1,image2,image3,isapproved,type);
		$scope.alertInfo=true;
		SupplierMgr.getAll();
	};

	$scope.addSupplier=function(username,password,tel,groupid,salt,status,name,joindate,joinip,lastvisit,lastip,create_time,update_time,image1,image2,image3,isapproved,type){
		SupplierMgr.add(username,password,tel,groupid,salt,status,name,joindate,joinip,lastvisit,lastip,create_time,update_time,image1,image2,image3,isapproved,type);
		$scope.alertInfo=true;
		SupplierMgr.getAll();
	};
	
});