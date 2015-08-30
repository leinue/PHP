angular.module('sbAdminApp')
.controller('RouteProductMgrCtrl',function($scope,$location,User,RouteStart,RouteEnd){

})

.controller('TravelProductConstract',function($scope,$location,User,TravelProductsConstract){

	$scope.alertInfo=false;
	$scope.isEdit=false;
	$scope.isAdd=false;

	$scope.inputExists={
		title:'',
		order:'',
		id:''
	};

	$scope.input={
		title:'',
		orderindex:''
	};

	TravelProductsConstract.getAll($scope);

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsConstract.add($scope,$scope.input.title,$scope.input.orderindex);
			$scope.alertInfo=true;
			$scope.isAdd=false;
			TravelProductsConstract.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsConstract.delete($scope,id);
			$scope.alertInfo=true;
			TravelProductsConstract.getAll($scope);
		}
	};

	$scope.editItem=function(i,t,o){
		$scope.isEdit=true;
		$scope.isAdd=false;
		$scope.inputExists.id=i;
		$scope.inputExists.title=t;
		$scope.inputExists.orderindex=o;
	};

	$scope.confirmToEditItem=function(){
		if($scope.inputExists.title!=''){
			var oindex=$scope.inputExists.orderindex==''?0:$scope.inputExists.orderindex;
			TravelProductsConstract.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex);
			$scope.alertInfo=true;
			$scope.isEdit=false;
			TravelProductsConstract.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.cancelToEditItem=function(){
		$scope.isEdit=false;
	};

	$scope.cancelToAddItem=function(){
		$scope.isEdit=false;
	};

})

.controller('TravelProductCategory',function($scope,$location,User,TravelProductsCategory){

	$scope.alertInfo=false;
	$scope.isEdit=false;
	$scope.isAdd=false;

	$scope.inputExists={
		title:'',
		order:'',
		id:''
	};

	$scope.input={
		title:'',
		orderindex:''
	};

	TravelProductsCategory.getAll($scope);

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsCategory.add($scope,$scope.input.title,$scope.input.orderindex);
			$scope.alertInfo=true;
			$scope.isAdd=false;
			TravelProductsCategory.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsCategory.delete($scope,id);
			$scope.alertInfo=true;
			TravelProductsCategory.getAll($scope);
		}
	};

	$scope.editItem=function(i,t,o){
		$scope.isEdit=true;
		$scope.isAdd=false;
		$scope.inputExists.id=i;
		$scope.inputExists.title=t;
		$scope.inputExists.orderindex=o;
	};

	$scope.confirmToEditItem=function(){
		if($scope.inputExists.title!=''){
			var oindex=$scope.inputExists.orderindex==''?0:$scope.inputExists.orderindex;
			TravelProductsCategory.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex);
			$scope.alertInfo=true;
			$scope.isEdit=false;
			TravelProductsCategory.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.cancelToEditItem=function(){
		$scope.isEdit=false;
	};

	$scope.cancelToAddItem=function(){
		$scope.isEdit=false;
	};

})

.controller('TravelProductInsure',function($scope,$location,User,TravelProductsInsure){

	$scope.alertInfo=false;
	$scope.isEdit=false;
	$scope.isAdd=false;

	$scope.inputExists={
		title:'',
		order:'',
		id:''
	};

	$scope.input={
		title:'',
		orderindex:''
	};

	TravelProductsInsure.getAll($scope);

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsInsure.add($scope,$scope.input.title,$scope.input.orderindex);
			$scope.alertInfo=true;
			$scope.isAdd=false;
			TravelProductsInsure.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsInsure.delete($scope,id);
			$scope.alertInfo=true;
			TravelProductsInsure.getAll($scope);
		}
	};

	$scope.editItem=function(i,t,o){
		$scope.isEdit=true;
		$scope.isAdd=false;
		$scope.inputExists.id=i;
		$scope.inputExists.title=t;
		$scope.inputExists.orderindex=o;
	};

	$scope.confirmToEditItem=function(){
		if($scope.inputExists.title!=''){
			var oindex=$scope.inputExists.orderindex==''?0:$scope.inputExists.orderindex;
			TravelProductsInsure.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex);
			$scope.alertInfo=true;
			$scope.isEdit=false;
			TravelProductsInsure.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.cancelToEditItem=function(){
		$scope.isEdit=false;
	};

	$scope.cancelToAddItem=function(){
		$scope.isEdit=false;
	};

})

.controller('TravelProductAttr',function($scope,$location,User,TravelProductsAttr){

	$scope.alertInfo=false;
	$scope.isEdit=false;
	$scope.isAdd=false;

	$scope.inputExists={
		title:'',
		order:'',
		id:''
	};

	$scope.input={
		title:'',
		orderindex:''
	};

	TravelProductsAttr.getAll($scope);

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsAttr.add($scope,$scope.input.title,$scope.input.orderindex);
			$scope.alertInfo=true;
			$scope.isAdd=false;
			TravelProductsAttr.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsAttr.delete($scope,id);
			$scope.alertInfo=true;
			TravelProductsAttr.getAll($scope);
		}
	};

	$scope.editItem=function(i,t,o){
		$scope.isEdit=true;
		$scope.isAdd=false;
		$scope.inputExists.id=i;
		$scope.inputExists.title=t;
		$scope.inputExists.orderindex=o;
	};

	$scope.confirmToEditItem=function(){
		if($scope.inputExists.title!=''){
			var oindex=$scope.inputExists.orderindex==''?0:$scope.inputExists.orderindex;
			TravelProductsAttr.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex);
			$scope.alertInfo=true;
			$scope.isEdit=false;
			TravelProductsAttr.getAll($scope);
		}else{
			alert('请不要留空');
		}
	};

	$scope.cancelToEditItem=function(){
		$scope.isEdit=false;
	};

	$scope.cancelToAddItem=function(){
		$scope.isEdit=false;
	};

})

.controller('RouteListMgr',function($scope,$location,User,TravelProducts){

	TravelProducts.getAll($scope);

	$scope.deleteTravelRoute=function(pid){
		TravelProducts.delete($scope,pid);
		TravelProducts.getAll($scope);
	};

	$scope.approveThis=function(pid){
		TravelProducts.approve($scope,pid);
		TravelProducts.getAll($scope);
	};

	$scope.viewThis=function(pid){

	};

	$scope.editThis=function(pid){
		// localStorage.currentRoutePid=false;
		console.log('edit clicked '+pid);
		localStorage.currentRoutePid=pid;
		$('.routesList').modal('toggle');
		$('.routesList').on('hidden.bs.modal', function () {
			if(localStorage.currentRoutePid!='false'){
				$('.routesListNewCls').modal('toggle');				
			}
		});
		// 
	};

})

.controller('RouteListNew',function($scope,$location,User,TravelProducts,TravelProductsCategory,RouteStart,RouteEnd,TravelProductsAttr,TravelProductsConstract){

	$scope.modalTitle="新增线路列表";
	$scope.editStatus='add';

	$scope.dayPlanList=[];
	$scope.currentDay;
	$scope.plan_day_datas=[];

	$('.routesListNewCls').on('show.bs.modal', function () {
		if(localStorage.currentRoutePid!='false'){
			$scope.modalTitle="编辑线路列表";
			$scope.editStatus='edit';
			console.log('edit');

			TravelProducts.view($scope,localStorage.currentRoutePid,function(data){

				data=data[localStorage.currentRoutePid];

				console.log(data);

				// console.log(data.plan.length);
				// console.log(data.plan);
				var price=data.price;

				for (var i = 0; i < data.plan.length; i++) {
					var currentPlan=data.plan[i];
					console.log(data.plan);
					$scope.dayPlanList[i]={};
					$scope.dayPlanList[i].day=i+1;
					$scope.dayPlanList[i].description=currentPlan.description;
					$scope.dayPlanList[i].food=currentPlan.food;
					$scope.dayPlanList[i].room=currentPlan.room;
					$scope.dayPlanList[i].title=currentPlan.title;
					$scope.plan_day_datas[i]=i+1;
					$scope.plan_title=currentPlan.title;
				  	$scope.plan_food=currentPlan.food;
				  	$scope.plan_room=currentPlan.room;
				  	$scope.plan_description=currentPlan.description;
				};

				console.log(data.plan);

				console.log($scope.dayPlanList);
				// $scope.plan_day_datas.push(i+1);

				$scope.pid=data.pid;
				$scope.plan_day=data.plan.length;
			  	$scope.title=data.title;
				$scope.area_start=data.start;
				$scope.area_end=data.end;
				$scope.adult_pifa=Math.ceil(price[0].adult);
				$scope.child_pifa=Math.ceil(price[0].child);
				$scope.old_pifa=Math.ceil(price[0].old);
				$scope.adult_basic=Math.ceil(price[1].adult);
				$scope.child_basic=Math.ceil(price[1].child);
				$scope.old_basic=Math.ceil(price[1].old);
				$scope.category=data.categoryname;
				$scope.img=data.img;
				$scope.isapproved=data.isapproved;
				$scope.attr=data.attrname;
				$scope.num_rest=Math.ceil(data.num_rest);
				$scope.tip=data.tip;
				$scope.fee_included=data.fee_included;
				$scope.fee_noincluded=data.fee_noincluded;
				$scope.trip_days=Math.ceil(data.trip_days);
				$scope.order_index=data.order_index;
				// $scope.dayPlanList='';
				$scope.num_limit=Math.ceil(data.num_limit);
				$scope.share_score=Math.ceil(data.share_score);
				$scope.content=data.content;
				$scope.contract_add=data.contract_add;
				$scope.mustknow=data.mustknow;
				$scope.constract=data.constractname;
				$scope.is_insure=data.is_insure;
				$scope.category_id=data.category;
				console.log($scope.category_id);

			});

		}else{
			$scope.modalTitle="新增线路列表";
			$scope.editStatus='add';
			console.log('add');
		}
	});

	$('.routesListNewCls').on('hide.bs.modal', function () {
	  	localStorage.currentRoutePid=false;
	  	console.log(localStorage.currentRoutePid);
	  	$scope.modalTitle="新增线路列表";
	  	$scope.plan_day='';
	  	$scope.plan_title='';
	  	$scope.plan_food='';
	  	$scope.plan_room='';
	  	$scope.plan_description='';
	  	$scope.title='';
		$scope.area_start='';
		$scope.area_end='';
		$scope.adult_pifa='';
		$scope.child_pifa='';
		$scope.old_pifa='';
		$scope.adult_basic='';
		$scope.child_basic='';
		$scope.old_basic='';
		$scope.category='';
		$scope.img='';
		$scope.isapproved='';
		$scope.attr='';
		$scope.num_rest='';
		$scope.tip='';
		$scope.fee_included='';
		$scope.fee_noincluded='';
		$scope.trip_days='';
		$scope.dayPlanList='';
		$scope.num_limit='';
		$scope.share_score='';
		$scope.content='';
		$scope.contract_add='';
		$scope.mustknow='';
		$scope.constract='';
		$scope.is_insure='';
		$scope.order_index='';
	});

	TravelProductsCategory.getAll($scope);
	RouteEnd.getAll($scope);
	RouteStart.getAll($scope);
	TravelProductsAttr.getAll($scope);
	TravelProductsConstract.getAll($scope);

	//行程天数默认值
	$scope.plan_day=1;

	var planArr=[

		{
			"day":$scope.plan_day,
			"title":$scope.plan_title,
			"food":$scope.plan_food,
			"room":$scope.plan_room,
			"description":$scope.plan_description
		}

	];

	$scope.generatorPlan=function(){
		$scope.currentDay=$scope.plan_day;
		$scope.currentDay=$scope.currentDay.slice(1,$scope.currentDay.length-1);

		if(typeof $scope.dayPlanList[$scope.currentDay]=='undefined' || typeof $scope.dayPlanList[$scope.currentDay]=='object'){
			$scope.dayPlanList[$scope.currentDay]={};
			console.log($scope.currentDay);
			$scope.dayPlanList[$scope.currentDay].food={
				"早":$scope.plan_food_breakfast==undefined?'0':$scope.plan_food_breakfast,
				"中":$scope.plan_food_lunch==undefined?'0':$scope.plan_food_lunch,
				"晚":$scope.plan_food_dinner==undefined?'0':$scope.plan_food_dinner
			};
		}

		$scope.dayPlanList[$scope.currentDay].day=$scope.plan_day;

		$scope.plan_title='';
		$scope.plan_food_breakfast='';
		$scope.plan_food_lunch='';
		$scope.plan_food_dinner='';
		$scope.plan_room='';
		$scope.plan_description='';

	};

	$scope.changePlanTitle=function(){
		$scope.dayPlanList[$scope.currentDay].title=$scope.plan_title;
	};

	$scope.changePlanBreakfast=function(){
		$scope.dayPlanList[$scope.currentDay].food['早']=$scope.plan_food_breakfast;
	};

	$scope.changePlanLunch=function(){
		$scope.dayPlanList[$scope.currentDay].food['中']=$scope.plan_food_lunch;
	};

	$scope.changePlanDinner=function(){
		$scope.dayPlanList[$scope.currentDay].food['晚']=$scope.plan_food_dinner;
	};

	$scope.changePlanRoom=function(){
		$scope.dayPlanList[$scope.currentDay].room=$scope.plan_room;
	};

	$scope.changePlanDesc=function(){
		$scope.dayPlanList[$scope.currentDay].description=$scope.plan_description;
		console.log($scope.dayPlanList);
	};

	$scope.printBase=function(){
		var preview=document.getElementById('imghead');
		$scope.img=preview.getAttribute('src');
		alert('确认成功');
	};

	$scope.getBase64OfImg=function(){
		var preview=document.getElementById('imghead');
		$scope.img=preview.getAttribute('src');
		console.log($scope.img);
	};

	$scope.changePlanDays=function(){
		for (var i = 1; i <= $scope.trip_days; i++) {
			console.log(i);
			$scope.plan_day_datas.push(i);
		};
	};

	$scope.addProduct=function(){

		function uuid() {
		    var s = [];
		    var hexDigits = "0123456789";
		    for (var i = 0; i < 36; i++) {
		        s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
		    }
		    s[14] = "4";  // bits 12-15 of the time_hi_and_version field to 0010
		    s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);  // bits 6-7 of the clock_seq_hi_and_reserved to 01
		    s[8] = s[13] = s[18] = s[23] = "-";
		 
		    var uuid = s.join("");
		    return uuid;
		}

		var ppid=localStorage.currentRoutePid==undefined || localStorage.currentRoutePid==false ? uuid():localStorage.currentRoutePid;

		var data={
			"uid":User.getUid(),
			"pid":Math.ceil(ppid),
			"title":$scope.title,
			"area_start":$scope.area_start,
			"area_end":$scope.area_end,
			"price":[
				{
					"adult":$scope.adult_pifa,
					"child":$scope.child_pifa,
					"old":$scope.old_pifa,
					"type":1
				},{
					"adult":$scope.adult_basic,
					"child":$scope.child_basic,
					"old":$scope.old_basic,
					"type":2
				}
			],
			"category":$scope.category,
			"img":$scope.img,
			"isapproved":$scope.isapproved,
			"attr":$scope.attr,
			"num_rest":$scope.num_rest,
			"tip":$scope.tip,
			"fee_included":$scope.fee_included,
			"fee_noincluded":$scope.fee_noincluded,
			"trip_days":$scope.trip_days,
			"plan":[
				$scope.dayPlanList
			],
			"num_limit":$scope.num_limit,
			"share_score":$scope.share_score,
			"content":$scope.content,
			"contract_add":$scope.contract_add,
			"mustknow":$scope.mustknow,
			"constract":$scope.constract,
			"is_insure":$scope.is_insure,
			"order_index":$scope.order_index
		};

		console.log(data);

		if(localStorage.currentRoutePid!='false'){
			TravelProducts.update($scope,data);
		}else{
			TravelProducts.add($scope,data);
		}

	};

});
