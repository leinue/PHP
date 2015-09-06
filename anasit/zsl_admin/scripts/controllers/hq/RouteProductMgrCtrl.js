angular.module('sbAdminApp')
.controller('RouteProductMgrCtrl',function($scope,$location,User,RouteStart,RouteEnd,TravelProducts){

	window.KE = KindEditor;

	window.SEcontent=KE.create('#g_edit_feature_introduction',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.feature_introduction=$('#g_edit_feature_introduction').val();
			console.log(sessionStorage.feature_introduction);
		}
	});

	window.SEcontract=KE.create('#g_edit_constract_plus',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.constract_plus=$('#g_edit_constract_plus').val();
			console.log(sessionStorage.constract_plus);
		}
	});

	window.SEnotice=KE.create('#g_edit_notice_reserve',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.notice_reserve=$('#g_edit_notice_reserve').val();
			console.log(sessionStorage.notice_reserve);
		}
	});

	window.SEtips=KE.create('#g_edit_tips',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.tips=$('#g_edit_tips').val();
			console.log(sessionStorage.tips);
		}
	});

	window.SEfee=KE.create('#g_edit_fee_included',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.fee_included=$('#g_edit_fee_included').val();
			console.log(sessionStorage.fee_included);
		}
	});

	window.SEnoFee=KE.create('#g_edit_fee_notincluded',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.fee_notincluded=$('#g_edit_fee_notincluded').val();
			console.log(sessionStorage.fee_notincluded);
		}
	});

})

.controller('TravelProductConstract',function($scope,$location,User,TravelProductsConstract){

	$scope.alertInfo=false;
	$scope.isEdit=false;
	$scope.isAdd=false;

	$scope.inputExists={
		title:'',
		order:'',
		id:'',
		insureDesc:''
	};

	$scope.input={
		title:'',
		orderindex:'',
		insureDesc:''
	};

	TravelProductsConstract.getAll($scope,function(){});

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsConstract.add($scope,$scope.input.title,$scope.input.orderindex,$scope.input.insureDesc,function(data){
				TravelProductsConstract.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isAdd=false;
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsConstract.delete($scope,id,function(data){
				TravelProductsConstract.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
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
			TravelProductsConstract.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex,$scope.inputExists.insureDesc,function(data){
				TravelProductsConstract.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isEdit=false;
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

	TravelProductsCategory.getAll($scope,function(){});

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsCategory.add($scope,$scope.input.title,$scope.input.orderindex,function(data){
				TravelProductsCategory.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isAdd=false;
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsCategory.delete($scope,id,function(data){
				TravelProductsCategory.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
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
			TravelProductsCategory.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex,function(data){
				TravelProductsCategory.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isEdit=false;
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
		id:'',
		insureDesc:''
	};

	$scope.input={
		title:'',
		orderindex:'',
		insureDesc:''
	};

	TravelProductsInsure.getAll($scope,function(){});

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsInsure.add($scope,$scope.input.title,$scope.input.orderindex,$scope.input.insureDesc,function(data){
				TravelProductsInsure.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isAdd=false;
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsInsure.delete($scope,id,function(data){
				TravelProductsInsure.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
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
			TravelProductsInsure.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex,$scope.inputExists.insureDesc,function(data){
				TravelProductsInsure.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isEdit=false;
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

	TravelProductsAttr.getAll($scope,function(){});

	$scope.addItem=function(){
		$scope.isAdd=true;
		$scope.isEdit=false;
	};

	$scope.confirmToAddItem=function(){
		if($scope.input.title!=''){
			TravelProductsAttr.add($scope,$scope.input.title,$scope.input.orderindex,function(data){
				TravelProductsAttr.getAll($scope,function(){});
			});
			$scope.alertInfo=true;
			$scope.isAdd=false;
		}else{
			alert('请不要留空');
		}
	};

	$scope.deleteItem=function(id){
		var con=confirm("确定要删除吗?");
		if(con){
			TravelProductsAttr.delete($scope,id,function(data){
				TravelProductsAttr.getAll($scope);
			});
			$scope.alertInfo=true;
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
			TravelProductsAttr.update($scope,$scope.inputExists.id,$scope.inputExists.title,oindex,function(data){
				TravelProductsAttr.getAll($scope);
			});
			$scope.alertInfo=true;
			$scope.isEdit=false;
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

.controller('HQRouteListMgr',function($scope,$location,User,TravelProducts){

	TravelProducts.getAll($scope,'',function(){});

	$scope.deleteTravelRoute=function(pid){
		var con=confirm('确定要删除吗');
		if(con){
			TravelProducts.delete($scope,pid,function(data){
				TravelProducts.getAll($scope,'',function(){});
			});
		}
	};

	$scope.approveThis=function(pid){
		TravelProducts.approve($scope,pid,function(data){
			TravelProducts.getAll($scope,'',function(){});
		});
	};

	$scope.viewThis=function(pid){

	};

	$scope.editThis=function(pid){
		// localStorage.currentRoutePid=false;
		console.log('edit clicked '+pid);
		localStorage.currentRoutePid=pid;
		localStorage.pidToEdit=pid;
		$('.routesList').modal('toggle');
		$('.routesList').on('hidden.bs.modal', function () {
			if(localStorage.currentRoutePid!='false'){
				$('.routesListNewCls').modal('toggle');				
			}
		});
		// 
	};

	$('.routesList').on('show.bs.modal',function(){
		console.log('载入线路列表...');
		TravelProducts.getAll($scope,'',function(){
			console.log('载入线路列表结束...');
		});
	});

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

				console.log(data);

				console.log('callback enter');

				console.log('localStorage.currentRoutePid='+localStorage.pidToEdit);

				data=data[localStorage.pidToEdit];

				console.log('get data');

				console.log(data.plan.length);
				console.log(data.plan);
				var price=data.price;

				for (var i = 0; i < data.plan.length; i++) {
					var currentPlan=data.plan[i];
					if(typeof $scope.dayPlanList[i+1] != undefined){
						$scope.dayPlanList[i+1]={};
						$scope.dayPlanList[i+1].day='第'+(i+1)+'天';
						$scope.dayPlanList[i+1].description=currentPlan.description;
						$scope.dayPlanList[i+1].food=JSON.parse(currentPlan.food);
						$scope.dayPlanList[i+1].room=currentPlan.room;
						$scope.dayPlanList[i+1].title=currentPlan.title;
						$scope.dayPlanList[i+1].id=currentPlan.id;
						$scope.plan_day_datas[i+1]=i+1;
					}
				};

				console.log($scope.dayPlanList);
				// $scope.plan_day_datas.push(i+1);

				$scope.pid=data.pid;
				$scope.plan_day=1;

			  	$scope.plan_title=$scope.dayPlanList[1].title;
			  	$scope.plan_food_breakfast=$scope.dayPlanList[1]['早'];
			  	$scope.plan_food_lunch=$scope.dayPlanList[1]['中'];
			  	$scope.plan_food_dinner=$scope.dayPlanList[1]['晚'];
			  	$scope.plan_room=$scope.dayPlanList[1].room;
			  	$scope.plan_description=$scope.dayPlanList[1].description;

			  	$scope.title=data.title;
				$scope.area_start=data.area_start;
				$scope.area_end=data.area_end;

				//******************************************************

				$scope.adult_basic=Math.ceil(price[0].adult);
				$scope.child_basic=Math.ceil(price[0].child);
				$scope.old_basic=Math.ceil(price[0].old);

				$scope.adult_sell=Math.ceil(price[2].adult);
				$scope.child_sell=Math.ceil(price[2].child);
				$scope.old_sell=Math.ceil(price[2].old);

				$scope.adult_market=Math.ceil(price[1].adult);
				$scope.child_market=Math.ceil(price[1].child);
				$scope.old_market=Math.ceil(price[1].old);

				sessionStorage.adult_sell=$scope.adult_sell;
				sessionStorage.child_sell=$scope.child_sell;
				sessionStorage.old_sell=$scope.old_sell;

				sessionStorage.adult_basic=$scope.adult_basic;
				sessionStorage.child_basic=$scope.child_basic;
				sessionStorage.old_basic=$scope.old_basic;

				sessionStorage.adult_market=$scope.adult_market;
				sessionStorage.child_market=$scope.child_market;
				sessionStorage.old_market=$scope.old_market;

				//******************************************************

				$scope.category=data.category;
				$scope.img=data.img;
				$scope.isapproved=data.isapproved;
				$scope.attr=data.attr;
				$scope.num_rest=Math.ceil(data.num_rest);
				$scope.tip=data.tip;
				$scope.fee_included=data.fee_included;
				$scope.fee_noincluded=data.fee_noincluded;
				$scope.trip_days=Math.ceil(data.trip_days);
				$scope.order_index=Math.ceil(data.order_index);
				// $scope.dayPlanList='';
				$scope.num_limit=Math.ceil(data.num_limit);
				$scope.share_score=Math.ceil(data.share_score);
				$scope.content=data.content;
				$scope.contract_add=data.contract_add;
				$scope.mustknow=data.mustknow;
				$scope.constract=data.constract;
				$scope.is_insure=data.is_insure;

				$scope.categoryname=data.categoryname;
				$scope.start_name=data.start;
				$scope.end_name=data.end;
				$scope.attr_name=data.attrname;
				$scope.constract_name=data.constractname;

				sessionStorage.fee_included=$scope.fee_included;
				sessionStorage.fee_notincluded=$scope.fee_noincluded;
				sessionStorage.constract_plus=$scope.contract_add;
				sessionStorage.notice_reserve=$scope.mustknow;
				sessionStorage.tips=$scope.tip;
				sessionStorage.feature_introduction=$scope.content;

				SEcontent.html(sessionStorage.feature_introduction);
				SEfee.html(sessionStorage.fee_included);
				SEnoFee.html(sessionStorage.fee_notincluded);
				SEcontract.html(sessionStorage.constract_plus);
				SEtips.html(sessionStorage.tips);
				SEnotice.html(sessionStorage.notice_reserve);

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

		$scope.adult_sell='';
		$scope.child_sell='';
		$scope.old_sell='';
		$scope.adult_basic='';
		$scope.child_basic='';
		$scope.old_basic='';
		$scope.old_market='';
		$scope.adult_market='';
		$scope.child_market='';

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

	TravelProductsCategory.getAll($scope,function(){});
	RouteEnd.getAll($scope,function(){});
	RouteStart.getAll($scope,function(){});
	TravelProductsAttr.getAll($scope,function(){});
	TravelProductsConstract.getAll($scope,function(){});

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
		$scope.currentDay=$scope.currentDay.slice(1,$scope.currentDay.length-2);

		if(typeof $scope.dayPlanList[$scope.currentDay]=='undefined' || typeof $scope.dayPlanList[$scope.currentDay]=='object'){
			console.log($scope.currentDay);
			if(typeof $scope.dayPlanList[$scope.currentDay]=='undefined'){
				console.log('currentDay is undefined');
				$scope.dayPlanList[$scope.currentDay]={};
			}
			$scope.dayPlanList[$scope.currentDay].food={
				"早":$scope.plan_food_breakfast==undefined?'0':$scope.plan_food_breakfast,
				"中":$scope.plan_food_lunch==undefined?'0':$scope.plan_food_lunch,
				"晚":$scope.plan_food_dinner==undefined?'0':$scope.plan_food_dinner
			};
		}

		$scope.dayPlanList[$scope.currentDay].day=$scope.plan_day;

		$scope.plan_title=$scope.dayPlanList[$scope.currentDay].title;
		$scope.plan_food_breakfast=$scope.dayPlanList[$scope.currentDay]['早'];
		$scope.plan_food_lunch=$scope.dayPlanList[$scope.currentDay]['中'];
		$scope.plan_food_dinner=$scope.dayPlanList[$scope.currentDay]['晚'];
		$scope.plan_room=$scope.dayPlanList[$scope.currentDay].room;
		$scope.plan_description=$scope.dayPlanList[$scope.currentDay].description;

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

	$scope.changePlanDays=function(){
		for (var i = 1; i <= $scope.trip_days; i++) {
			console.log(i);
			$scope.plan_day_datas.push(i);
		};
	};

	//**********************************************************************************

	$scope.old_basic_change=function(){
		sessionStorage.old_basic=$scope.old_basic;
	};

	$scope.adult_basic_change=function(){
		sessionStorage.adult_basic=$scope.adult_basic;
	};

	$scope.child_basic_change=function(){
		sessionStorage.child_basic=$scope.child_basic;
	};

	$scope.old_sell_change=function(){
		sessionStorage.old_sell=$scope.old_sell;
	};

	$scope.adult_sell_change=function(){
		sessionStorage.adult_sell=$scope.adult_sell;
	};

	$scope.child_sell_change=function(){
		sessionStorage.child_sell=$scope.child_sell;
	};

	$scope.old_market_change=function(){
		sessionStorage.old_market=$scope.old_market;
	};

	$scope.adult_market_change=function(){
		sessionStorage.adult_market=$scope.adult_market;
	};

	$scope.child_market_change=function(){
		sessionStorage.child_market=$scope.child_market;
	};

	//**********************************************************************************

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

		var ppid=localStorage.currentRoutePid==undefined || localStorage.currentRoutePid=='false' ? uuid():localStorage.currentRoutePid;

		$scope.img=localStorage.currentImageUploadedURL;
		$scope.fee_included=sessionStorage.fee_included;
		$scope.fee_noincluded=sessionStorage.fee_notincluded;
		$scope.contract_add=sessionStorage.constract_plus;
		$scope.mustknow=sessionStorage.notice_reserve;
		$scope.tip=sessionStorage.tips;
		$scope.content=sessionStorage.feature_introduction;

		var scopeImg=$scope.img.indexOf('http://')!=-1?$scope.img:'http://'+$scope.img;

		var data={
			"uid":User.getUid(),
			"pid":Math.ceil(ppid),
			"title":$scope.title,
			"area_start":$scope.area_start,
			"area_end":$scope.area_end,
			"price":[
				{
					"adult":sessionStorage.adult_sell,
					"child":sessionStorage.child_sell,
					"old":sessionStorage.old_sell,
					"type":3,
					"id":77
				},{
					"adult":sessionStorage.adult_basic,
					"child":sessionStorage.child_basic,
					"old":sessionStorage.old_basic,
					"type":2,
					"id":75
				},{
					"adult":sessionStorage.adult_market,
					"child":sessionStorage.child_market,
					"old":sessionStorage.old_market,
					"type":1,
					"id":76
				}
			],
			"category":$scope.category,
			"img":"http://"+$scope.img,
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
			TravelProducts.update($scope,data,function(){
				$('.routesListNewCls').modal('toggle');
				sessionStorage.fee_included='';
				sessionStorage.fee_notincluded='';
				sessionStorage.constract_plus='';
				sessionStorage.notice_reserve='';
				sessionStorage.tips='';
				sessionStorage.feature_introduction='';
				location.reload();
			});
		}else{
			TravelProducts.add($scope,data,function(){
				$('.routesListNewCls').modal('toggle');
				location.reload();
			});
		}

	};

});
