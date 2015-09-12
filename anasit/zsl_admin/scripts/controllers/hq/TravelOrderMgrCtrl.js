angular.module('sbAdminApp')
.controller('TravelOrderMgrCtrl',function($scope,$location,User,TravelOrder){
	$scope.page=1;

	$scope.new_oldnum='';
	$scope.new_adultnum='';
	$scope.new_childnum='';
	$scope.new_totalcost='';
	$scope.new_orderprice='';
	$scope.orderid='';

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
		$scope.editBtnIsShow=true;
		$scope.inputIsShow=false;
	};

	$scope.startEdit=function(o,a,c,t,op,remark,orderid){
		$scope.editBtnIsShow=false;
		$scope.inputIsShow=true;
		$scope.new_oldnum=o;
		$scope.new_adultnum=a;
		$scope.new_childnum=c;
		$scope.new_totalcost=t;
		$scope.new_orderprice=op;
		$scope.remark=remark;
		$scope.orderid=orderid;
	};

	$scope.cancelEdit=function(){
		$scope.editBtnIsShow=true;
		$scope.inputIsShow=false;
	};

	$scope.confirmEdit=function(){

		var orderid=$scope.orderid;
		var oldnum=$scope.new_oldnum;
		var adultnum=$scope.new_adultnum;
		var childnum=$scope.new_childnum;
		var modifyrecord=$scope.remark;
		var orderprice=$scope.new_orderprice;
		var totalcost=$scope.new_totalcost;

		TravelOrder.update($scope,orderid,oldnum,adultnum,childnum,modifyrecord,orderprice,totalcost,function(data){
			TravelOrder.getByOrderid($scope,orderid,function(data){});
			$scope.cancelEdit();
		})
	};

});