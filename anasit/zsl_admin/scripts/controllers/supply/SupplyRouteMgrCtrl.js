angular.module('sbAdminApp')
.controller('SupplyRouteMgrCtrl',function($scope,$location,User,TravelProducts,RouteStart,RouteEnd){

	window.KE = KindEditor;

	window.SEcontent=KE.create('#s_edit_feature_introduction',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.feature_introduction=$('#s_edit_feature_introduction').val();
			console.log(sessionStorage.feature_introduction);
		}
	});

	window.SEcontract=KE.create('#s_edit_constract_plus',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.constract_plus=$('#s_edit_constract_plus').val();
			console.log(sessionStorage.constract_plus);
		}
	});

	window.SEnotice=KE.create('#s_edit_notice_reserve',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.notice_reserve=$('#s_edit_notice_reserve').val();
			console.log(sessionStorage.notice_reserve);
		}
	});

	window.SEtips=KE.create('#s_edit_tips',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.tips=$('#s_edit_tips').val();
			console.log(sessionStorage.tips);
		}
	});

	window.SEfee=KE.create('#s_edit_fee_included',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.fee_included=$('#s_edit_fee_included').val();
			console.log(sessionStorage.fee_included);
		}
	});

	window.SEnoFee=KE.create('#s_edit_fee_notincluded',{
		width : '100%',
		afterBlur: function(){
			this.sync();
			sessionStorage.fee_notincluded=$('#s_edit_fee_notincluded').val();
			console.log(sessionStorage.fee_notincluded);
		}
	});

})

.controller('RouteListMgr',function($scope,$location,User,TravelProducts){

	User.getThisInfo(function(){});

	var uid=User.getUid(function(){});	

	// TravelProducts.getAll($scope,uid);

	$scope.deleteTravelRoute=function(pid){
		var con=confirm('确认删除吗');
		if(con){
			TravelProducts.delete($scope,pid,function(data){
				TravelProducts.getAll($scope,uid,function(){});
			});
		}
	};

	$scope.approveThis=function(pid){
		TravelProducts.approve($scope,pid,function(data){
			TravelProducts.getAll($scope,uid,function(){});
		});
	};

	$scope.viewThis=function(pid){

	};

	$scope.editThis=function(pid){
		localStorage.currentRoutePid=false;
		localStorage.pidToEdit=pid;
		$('.routesList').modal('toggle');
		localStorage.currentRoutePid=pid;
		$('.routesList').on('hidden.bs.modal', function () {
			if(localStorage.currentRoutePid!='false'){
				$('.routesListNewCls').modal('toggle');
			}
		});
	};

	$('.routesList').on('show.bs.modal', function () {
		var uid=User.getUid();
		console.log('uid='+uid);
		TravelProducts.getAll($scope,uid,function(){});
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

				// $scope.dayPlanList[0]={};

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

				sessionStorage.tripDateList=data.trip_date;

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

				//******************************************************************************

				//生成日期选择区域

				if(sessionStorage.tripDateList!='null'){
					var editTripDateJSON=JSON.parse(sessionStorage.tripDateList);
					console.log(editTripDateJSON);
					for(dateKey in editTripDateJSON){
          				if(editTripDateJSON.hasOwnProperty(dateKey)){
          					var money=Math.ceil(editTripDateJSON[dateKey]);
          					var date=dateKey;
							var html='<div>';
							html+='<div style="margin-top:15px" class="col-md-12">';
							html+='<div class="form-group">';
							html+='<input type="date" style="display:none" value="'+date+'" class="form-control" placeholder="请选择时间">';
							html+='<div class="input-append date" id="datetimepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy">';
							html+='<input class="form_datetime form-control" value="'+date+'" onchange="updateRealDateCtrl(this)" size="16" type="text" placeholder="请选择时间">';
							html+='<span class="add-on"><i class="icon-th"></i></span>';
							html+='</div>';
							html+='</div>';
							html+='</div>';
							html+='<div class="col-md-12">';
							html+='<div class="form-group">';
							html+='<input type="number" class="form-control" value="'+money+'" placeholder="请输入价格">';
							html+='</div>';
							html+='</div>';
							html+='<div style="border-bottom:1px solid rgb(204,204,204);padding-bottom:15px;margin-bottom:15px;" class="col-md-12">';
							html+='<div class="form-group">';
							html+='<a class="btn btn-sm btn-default" date="'+date+'" money="'+money+'" flag="1" onclick="confirmTripDate(this)">确认</a>';
							html+='<a onclick="deleteThisDate(this)" class="btn btn-sm btn-default btn_remove_date">删除此时间</a>';
							html+='</div>';
							html+='</div>';
							html+='</div>';
							$('#trip_date_edit_area').append(html);
							$(".form_datetime").datetimepicker({format:"yyyy-mm-dd",weekStart: 1,todayBtn:  1,autoclose: 1,todayHighlight: 1,startView: 2,forceParse: 0,showMeridian: 1,language:"zh-CN"});
          				}
					}
				}

				//******************************************************************************

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
		$scope.dayPlanList={};
		$scope.num_limit='';
		$scope.share_score='';
		$scope.content='';
		$scope.contract_add='';
		$scope.mustknow='';
		$scope.constract='';
		$scope.is_insure='';
		$scope.order_index='';
		$scope.plan_day_datas='';

		location.reload();
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
			console.log('enter dayPlanList');
			console.log($scope.dayPlanList);
			if(typeof $scope.dayPlanList[$scope.currentDay]=='undefined'){
				console.log('currentDay is undefined');
				$scope.dayPlanList[$scope.currentDay]={};
			}
			console.log('currentDay is defined');
			console.log('after {}');
			console.log($scope.dayPlanList);
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

		console.log('==============================');

		console.log(sessionStorage.adult_sell);
		console.log(sessionStorage.child_sell);
		console.log(sessionStorage.old_sell);

		console.log("==============================");

		if(sessionStorage.tripDateList!=''){
			var tripDateJSON=JSON.parse(sessionStorage.tripDateList);
		}else{
			var tripDateJSON='';
		}

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
			"order_index":$scope.order_index,
			"trip_date":tripDateJSON
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

		$scope.dayPlanList=[];
		$scope.currentDay;
		$scope.plan_day_datas=[];

	};

});
