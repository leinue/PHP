angular.module('sbAdminApp')
.controller('SupplyRouteMgrCtrl',function($scope,$location,User,RouteStart,RouteEnd,RouteSell){

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
		$scope.statusMessage='修改成功';
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
		$scope.statusMessage="添加成功";
	};

	$scope.cancelToAddRoute=function(){
		$scope.isAdd=false;
	};

	$scope.cancelToEditRoute=function(){
		$scope.isEdit=false;
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
		if(con){
			$scope.result=RouteStart.delete(id);
			RouteStart.getAll($scope);
		}
	};

	$scope.addRouteStart=function(){
		$scope.addBefore();
	};

	$scope.confirmToAddRouteStart=function(){
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
		if(con){
			$scope.result=RouteEnd.delete(id);
			$scope.getAll($scope);
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

	/*****************************发售地******************************/

	RouteSell.getAll($scope);

	$scope.editRouteSell=function(id,t,o){
		$scope.editBefore(id,t,o);
	};

	$scope.deleteRouteSell=function(id){
		var con=confirm('确定要删除吗?');
		if(con){
			$scope.result=RouteSell.delete(id);
			RouteSell.getAll($scope);
		}
	};

	$scope.addRouteSell=function(){
		$scope.addBefore();
	};

	$scope.confirmToAddRouteSell=function(){
		RouteSell.add($scope,$scope.addRoute.title,0);
		$scope.addAfter();
		RouteSell.getAll($scope);
	};

	$scope.confirmToEditRouteSell=function(){
		RouteSell.update($scope,$scope.editRoute.id,$scope.editRoute.title,$scope.editRoute.orderindex);
		$scope.editAfter();
		RouteSell.getAll($scope);
	};

});