angular.module('sbAdminApp')
.controller('RouteAreaMgrCtrl',function($scope,$location,User,RouteStart,RouteEnd){

	$scope.isEdit=false;
	$scope.isAdd=false;
	$scope.alertInfo=false;

	$scope.statusMessage='';

	$scope.editRoute={
		title:'',
		order:'',
		id:''
	};

	$scope.addRoute={
		title:'',
		orderindex:''
	};

	$scope.editBefore=function(id,t,o){
		if(!$scope.isEdit){
			$scope.isEdit=true;
		}
		$scope.alertInfo=false;
		$scope.isAdd=false;
		$scope.editRoute.id=id;
		$scope.editRoute.title=t;
		$scope.editRoute.order=o;
	};

	$scope.editAfter=function(){
		$scope.alertInfo=!$scope.alertInfo;
		$scope.isEdit=!$scope.isEdit;
	};

	$scope.addBefore=function(){
		$scope.isAdd=true;
		$scope.alertInfo=false;
		$scope.isEdit=false;
	};

	$scope.addAfter=function(){
		$scope.alertInfo=true;
		$scope.isAdd=false;
	};

	$scope.cancelToAddRoute=function(){
		$scope.isAdd=false;
	};

	$scope.cancelToEditRoute=function(){
		$scope.isEdit=false;
	};

	$scope.deleteAfter=function(){

	};

	/*****************************出发地******************************/

	RouteStart.getAll($scope);

	$scope.editRouteStart=function(id,t,o){
		$scope.editBefore(id,t,o);
	};

	$scope.confirmToEditRouteStart=function(){
		RouteStart.update($scope,$scope.editRoute.id,$scope.editRoute.title,$scope.editRoute.orderindex);
		$scope.editAfter();
		RouteStart.getAll($scope);
	};

	$scope.deleteRouteStart=function(id){
		var con=confirm('确定要删除吗?');
		$scope.alertInfo=true;
		if(con){
			$scope.result=RouteStart.delete($scope,id);
			$scope.deleteAfter();
			RouteStart.getAll($scope);
		}
	};

	$scope.addRouteStart=function(){
		$scope.addBefore();
	};

	$scope.confirmToAddRouteStart=function(){
		console.log($scope.addRoute.title);
		RouteStart.add($scope,$scope.addRoute.title,0);
		$scope.addAfter();
		RouteStart.getAll($scope);
	};

	/*****************************目的地******************************/

	RouteEnd.getAll($scope);
	

	$scope.editRouteEnd=function(id,t,o){
		$scope.editBefore(id,t,o);
	};

	$scope.deleteRouteEnd=function(id){
		var con=confirm('确定要删除吗');
		$scope.alertInfo=true;
		if(con){
			$scope.result=RouteEnd.delete($scope,id);
			RouteEnd.getAll($scope);
		}
	};

	$scope.addRouteEnd=function(){
		$scope.addBefore();
	};

	$scope.confirmToAddRouteEnd=function(){
		RouteEnd.add($scope,$scope.addRoute.title,0);
		$scope.addAfter();
		RouteEnd.getAll($scope);
	};

	$scope.confirmToEditRouteEnd=function(){
		RouteEnd.update($scope,$scope.editRoute.id,$scope.editRoute.title,$scope.editRoute.orderindex);
		$scope.editAfter();
		RouteEnd.getAll($scope);
	};

});