angular.module('sbAdminApp')
.controller('SupplyMgrCtrl',function($scope,$location,User,SupplierMgr){

	SupplierMgr.getAll($scope);
	
});