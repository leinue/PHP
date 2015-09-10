angular.module('sbAdminApp')

.controller('SupplyRouteMgrNewCtrl',function($scope,$location,User,RouteStart,RouteEnd){

	$('.routesListNewCls').modal('toggle');

	window.KE = KindEditor;

	KE.create('#feature_introduction',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.feature_introduction=$('#feature_introduction').val();
			console.log(sessionStorage.feature_introduction);
		}
	});

	KE.create('#constract_plus',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.constract_plus=$('#constract_plus').val();
			console.log(sessionStorage.constract_plus);
		}
	});

	KE.create('#notice_reserve',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.notice_reserve=$('#notice_reserve').val();
			console.log(sessionStorage.notice_reserve);
		}
	});

	KE.create('#tips',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.tips=$('#tips').val();
			console.log(sessionStorage.tips);
		}
	});

	KE.create('#fee_included',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.fee_included=$('#fee_included').val();
			console.log(sessionStorage.fee_included);
		}
	});

	KE.create('#fee_notincluded',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.fee_notincluded=$('#fee_notincluded').val();
			console.log(sessionStorage.fee_notincluded);
		}
	});

	// $('.routesListNewCls').modal({backdrop: 'static', keyboard: false});

})

.controller('RouteListNew',function($scope,$location,User,TravelProducts,TravelProductsCategory,RouteStart,RouteEnd,TravelProductsAttr,TravelProductsConstract){

	$scope.modalTitle="新增线路列表";
	$scope.editStatus='add';

	$scope.dayPlanList=[];
	$scope.currentDay;
	$scope.plan_day_datas=[];

	$scope.prevPlanDays=0;

	$('.routesListNewCls').on('show.bs.modal', function () {
		if(localStorage.currentRoutePid!='false'){
			$scope.modalTitle="编辑线路列表";
			$scope.editStatus='edit';
			console.log('edit');

			TravelProducts.view($scope,localStorage.currentRoutePid,function(data){

				console.log(data);

				data=data[localStorage.currentRoutePid];

				console.log(data.plan.length);
				console.log(data.plan);
				var price=data.price;

				for (var i = 0; i < data.plan.length; i++) {
					var currentPlan=data.plan[i];
					$scope.dayPlanList[i]={};
					$scope.dayPlanList[i].day=i+1;
					$scope.dayPlanList[i].description=currentPlan.description;
					$scope.dayPlanList[i].food=currentPlan.food;
					$scope.dayPlanList[i].room=currentPlan.room;
					$scope.dayPlanList[i].title=currentPlan.title;
					$scope.plan_day_datas[i]=i+1;
				};

				console.log($scope.dayPlanList);
				// $scope.plan_day_datas.push(i+1);

				$scope.pid=data.pid;
				$scope.plan_day=data.plan.length;
			  	$scope.plan_title='';
			  	$scope.plan_food='';
			  	$scope.plan_room='';
			  	$scope.plan_description='';
			  	$scope.title=data.title;
				$scope.area_start=data.start;
				$scope.area_end=data.end;
				$scope.adult_basic=Math.ceil(price[0].adult);
				$scope.child_basic=Math.ceil(price[0].child);
				$scope.old_basic=Math.ceil(price[0].old);
				$scope.adult_sell=Math.ceil(price[1].adult);
				$scope.child_sell=Math.ceil(price[1].child);
				$scope.old_sell=Math.ceil(price[1].old);
				$scope.adult_market=Math.ceil(price[2].adult);
				$scope.child_market=Math.ceil(price[2].child);
				$scope.old_market=Math.ceil(price[2].old);
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

			console.log($scope.dayPlanList[$scope.currentDay]);
			console.log($scope.plan_food_breakfast);

			if(typeof $scope.dayPlanList[$scope.currentDay].food=='undefined'){
				$scope.dayPlanList[$scope.currentDay].food={
					"早":$scope.plan_food_breakfast==undefined?'0':$scope.plan_food_breakfast,
					"中":$scope.plan_food_lunch==undefined?'0':$scope.plan_food_lunch,
					"晚":$scope.plan_food_dinner==undefined?'0':$scope.plan_food_dinner
				};
			}
			
		}

		$scope.dayPlanList[$scope.currentDay].day=$scope.plan_day;

		console.log($scope.dayPlanList[$scope.currentDay]);

		$scope.plan_title=$scope.dayPlanList[$scope.currentDay].title;
		$scope.plan_food_breakfast=$scope.dayPlanList[$scope.currentDay].food['早'];
		$scope.plan_food_lunch=$scope.dayPlanList[$scope.currentDay].food['中'];
		$scope.plan_food_dinner=$scope.dayPlanList[$scope.currentDay].food['晚'];
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
		var currentPlanDays=$scope.plan_day_datas.length;

		var inputPlanDays=$scope.trip_days;

		console.log('input plan days='+inputPlanDays);
		console.log('current plan days='+currentPlanDays);

		if($scope.plan_day_datas.length==0){
			console.log('scope.plan_day_datas=0');
			for (var i = 1; i <= $scope.trip_days; i++) {
				console.log(i);
				$scope.plan_day_datas.push(i);
			};
		}else{
			console.log('scope.plan_day_datas!=0');
			if(inputPlanDays!=''){
				if(currentPlanDays<inputPlanDays){
					//继续push(当前数量-当前输入数量)个元素
					console.log('<');
					console.log('currentPlanDays-inputPlanDays='+(inputPlanDays-currentPlanDays));
					for(var i=currentPlanDays+1;i<=inputPlanDays;i++){
						console.log('push i='+i);
						$scope.plan_day_datas.push(i);
					}
				}else{
					if(currentPlanDays>inputPlanDays){
						//删除(当前数量-当前输入数量)个元素
						console.log('>');
						for(var i=0;i<(currentPlanDays-inputPlanDays);i++){
							$scope.plan_day_datas.pop();
							$scope.dayPlanList.pop();
							$scope.plan_title='';
						  	$scope.plan_food='';
						  	$scope.plan_room='';
						  	$scope.plan_description='';
						  	$scope.plan_food_breakfast='';
						  	$scope.plan_food_dinner='';
						  	$scope.plan_food_lunch='';
							console.log($scope.dayPlanList);
						}
					}
				}
			}
		}

	};

	$scope.addProduct=function(){

		// KE.sync();

		$scope.$apply();

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

		$scope.img=localStorage.currentImageUploadedURL;
		$scope.fee_included=sessionStorage.fee_included;
		$scope.fee_noincluded=sessionStorage.fee_notincluded;
		$scope.contract_add=sessionStorage.constract_plus;
		$scope.mustknow=sessionStorage.notice_reserve;
		$scope.tip=sessionStorage.tips;
		$scope.content=sessionStorage.feature_introduction;

		if(sessionStorage.cityStartList!=''){
			$scope.area_start=JSON.parse(sessionStorage.cityStartList);
			console.log($scope.area_start);
		}

		if(sessionStorage.cityEndList!=''){
			$scope.area_end=JSON.parse(sessionStorage.cityEndList);
			console.log($scope.area_end);
		}

		if(sessionStorage.tripDateList!=''){
			var tripDateJSON=JSON.parse(sessionStorage.tripDateList);
		}else{
			var tripDateJSON='';
		}

		console.log('final trip date json:');
		console.log(tripDateJSON);

		console.log('scope.title=');
		console.log($scope.title);

		var data={
			"uid":User.getUid(),
			"pid":Math.ceil(ppid),
			"title":$scope.title,
			"area_start":$scope.area_start,
			"area_end":$scope.area_end,
			"price":[
				{
					"old":$scope.old_basic,
					"adult":$scope.adult_basic,
					"child":$scope.child_basic,
					"type":1
				},{
					"old":$scope.old_sell,
					"adult":$scope.adult_sell,
					"child":$scope.child_sell,
					"type":2
				},{
					"old":$scope.old_market,
					"adult":$scope.adult_market,
					"child":$scope.child_market,
					"type":3
				}
			],
			"category":$scope.category,
			"img":'http://'+$scope.img,
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
			"order_index":$scope.order_index,
			"trip_date":tripDateJSON
		};

		console.log(data);

		if(localStorage.currentRoutePid!='false'){
			TravelProducts.update($scope,data,function(){
				$('.routesListNewCls').modal('toggle');
			});
		}else{
			console.log('ssssdsd');
			TravelProducts.add($scope,data,function(data){
				console.log('add done');
				if(data.status==='1'){
					$('.routesListNewCls').modal('toggle');
					sessionStorage.fee_included='';
					sessionStorage.fee_notincluded='';
					sessionStorage.constract_plus='';
					sessionStorage.notice_reserve='';
					sessionStorage.tips='';
					sessionStorage.feature_introduction='';
					sessionStorage.tripDateList='';
				}

				if(data.message.indexOf('成功')!=-1){
					$('.routesListNewCls').modal('toggle');
				}
				
			});
		}

	};

});
