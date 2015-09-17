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

		console.log(orderid,oldnum,adultnum,childnum,modifyrecord,orderprice,totalcost);

		TravelOrder.update($scope,orderid,oldnum,adultnum,childnum,modifyrecord,orderprice,totalcost,function(data){
			if(data.status=='1'){
				alert(data.message);
				TravelOrder.getByOrderid($scope,orderid,function(data){});
				$scope.cancelEdit();
			}else{
				alert(data.message);
			}
			
		})
	};

	$scope.confirmOrder=function(orderid){

		TravelOrder.confirmPayment($scope,orderid,function(data){
			if(data.status=='1'){
				alert(data.message);
				TravelOrder.getAll($scope,$scope.page,function(data){});
			}else{
				alert(data.message);
			}
		});

	};

	$scope.confirmTravelStatus=function(orderid){

		TravelOrder.confrimTravelStatus($scope,orderid,function(data){
			if(data.status=='1'){
				alert(data.message);
				TravelOrder.getAll($scope,$scope.page,function(data){});
			}else{
				alert(data.message);
			}
		});
		
	};

	$scope.orderMoney='0.0';
	$scope.orderMoneyId='';

	$scope.arrangeRoute=function(orderid){
		$('.arrange-route-modal').modal('toggle');
		$scope.orderMoneyId=orderid;
	};

	$scope.confirmOrderMoney=function(){
		console.log($scope.orderMoney);
		if($scope.orderMoneyId==''){
			alert('缺少参数');
		}else{
			if($scope.orderMoney==''){
				TravelOrder.arrangeRoute($scope,$scope.orderMoneyId,$scope.orderMoney,function(data){
					alert(data.message);
					if(data.status==='1'){
						TravelOrder.getAll($scope,$scope.page,function(data){});
					}
				});
			}else{
				TravelOrder.arrangeRoute($scope,$scope.orderMoneyId,$scope.orderMoney,function(data){
					alert(data.message);
					if(data.status==='1'){
						TravelOrder.getAll($scope,$scope.page,function(data){});
					}
				});
			}
		}
		$('.arrange-route-modal').modal('toggle');
	};

});