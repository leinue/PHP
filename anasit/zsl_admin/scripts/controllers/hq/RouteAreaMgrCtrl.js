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

	RouteStart.getAll($scope,function(){});

	$scope.editRouteStart=function(id,t,o){
		$scope.editBefore(id,t,o);
	};

	$scope.confirmToEditRouteStart=function(){
		RouteStart.update($scope,$scope.editRoute.id,$scope.editRoute.title,$scope.editRoute.orderindex,function(data){
			RouteStart.getAll($scope,function(){});
		});
		$scope.editAfter();
	};

	$scope.deleteRouteStart=function(id){
		var con=confirm('确定要删除吗?');
		$scope.alertInfo=true;
		if(con){
			$scope.result=RouteStart.delete($scope,id,function(){
				RouteStart.getAll($scope,function(){});
			});
			$scope.deleteAfter();
		}
	};

	$scope.addRouteStart=function(){
		$scope.addBefore();
	};

	$scope.confirmToAddRouteStart=function(){
		console.log($scope.addRoute.title);
		RouteStart.add($scope,$scope.addRoute.title,0,function(){
			RouteStart.getAll($scope,function(){});
		});
		$scope.addAfter();
	};

	/*****************************目的地******************************/

	RouteEnd.getAll($scope,function(){});
	

	$scope.editRouteEnd=function(id,t,o){
		$scope.editBefore(id,t,o);
	};

	$scope.deleteRouteEnd=function(id){
		var con=confirm('确定要删除吗');
		$scope.alertInfo=true;
		if(con){
			$scope.result=RouteEnd.delete($scope,id,function(data){
				RouteEnd.getAll($scope,function(){});
			});
		}
	};

	$scope.addRouteEnd=function(){
		$scope.addBefore();
	};

	$scope.confirmToAddRouteEnd=function(){
		RouteEnd.add($scope,$scope.addRoute.title,0,function(data){
			RouteEnd.getAll($scope,function(){});
		});
		$scope.addAfter();
	};

	$scope.confirmToEditRouteEnd=function(){
		RouteEnd.update($scope,$scope.editRoute.id,$scope.editRoute.title,$scope.editRoute.orderindex,function(data){
			RouteEnd.getAll($scope,function(){});
		});
		$scope.editAfter();
	};

});
