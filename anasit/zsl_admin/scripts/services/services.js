angular.module('sbAdminApp')

.factory('User',function($q,$http,ACCESS_LEVELS,BASE_URL){

	var service={};

	var d=$q.defer();
	var promise=d.promise;


	// var _user=$cookieStore.get('user');

	service.setUser=function(tel,password){

		var request={
		    "admin": {
		        "login": {
		            "data": {
		                "tel": tel,
		                "password": password
		            }
		        }
		    }
		};

		request=JSON.stringify(request);
			
		$http.jsonp(BASE_URL.url+"/Admin/CompanyAdmin/login?data="+request+"&callback=JSON_CALLBACK")
		.success(function(data){
			var status=data.admin.login.status;
			if(status==='1'){
				_user=data.admin.login.data;
				$location.path('/home');				
			}else{
				switch(status){
					case 0:
						alert("数据库系统查询登录失败或密码错误");
						break;
					case -1:
						alert("数据库表中没有该管理员");
						break;
					default:
						break;
				}
			}
		})
		.error(function(data){
			alert('网络传输错误');
		});
		// $cookieStore.put('user',_user);
	}

	service.isLoggedIn=function(){
		return _user ? true : false;
	}

	service.getUser=function(){
		return _user;
	}

	service.logout=function(){
		_user=null;
	}

	return service;

})

.factory('RouteStart',function($q,$http,BASE_URL){

	return {
		update:function($scope,id,title,orderIndex){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"id":id,
				"title":title,
				"orderindex":orderIndex
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/editStart?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.updateSuccess=data;
			})
			.error(function(data){
				$scope.updateSuccess=false;
			});

		},

		delete:function($scope,id){
			
			var d=$q.defer();
			var promise=d.promise;

			var request={
				"id":id
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/deleteStart?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.deleteSuccess=data;
			})
			.error(function(data){
				$scope.deleteSuccess=false;
			});
		},

		add:function($scope,title,orderindex){
			var d=$q.defer();
			var promise=d.promise;

			var request={
				"title":title,
				"orderindex":orderindex
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/createStart?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.addSuccess=data;
			})
			.error(function(data){
				$scope.addSuccess=false;
			});
		},

		getAll:function($scope){
			var d=$q.defer();
			var promise=d.promise;

			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/listStart?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.allRoutes=data;
			})
			.error(function(data){
				console.log(data);
			});
		}
	};

})

.factory('RouteEnd',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"id":id,
				"title":title,
				"orderindex":orderindex
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/editEnd?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.updateSuccess=data;
			})
			.error(function(data){
				$scope.updateSuccess=false;
			});

		},

		delete:function($scope,id){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"id":id
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/deleteEnd?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.deleteSuccess=data;
			})
			.error(function(data){
				$scope.deleteSuccess=false;
			});

		},

		add:function($scope,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"title":title,
				"orderindex":orderindex
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/createEnd?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.addSuccess=data;
			})
			.error(function(data){
				$scope.addSuccess=false;
			});

		},

		getAll:function($scope){

			var d=$q.defer();
			var promise=d.promise;

			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/listEnd?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.allRoutesEnd=data;
			})
			.error(function(data){
				console.log(data);
			});

		}

	};

})

.factory('RouteSell',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"id":id,
				"title":title,
				"orderindex":orderIndex
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/editSell?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.updateSuccess=data;
			})
			.error(function(data){
				$scope.updateSuccess=false;
			});

		},

		add:function($scope,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"title":title,
				"orderindex":orderindex
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/createSell?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.addSuccess=data;
			})
			.error(function(data){
				$scope.addSuccess=false;
			});

		},

		delete:function($scope,id){

			var d=$q.defer();
			var promise=d.promise;

			var request={
				"id":id
			};

			request=JSON.stringify(request);
			
			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/deleteSell?data="+request+"&callback=JSON_CALLBACK")
			.success(function(data){
				$scope.deleteSuccess=data;
			})
			.error(function(data){
				$scope.deleteSuccess=false;
			});

		},

		getAll:function($scope){

			var d=$q.defer();
			var promise=d.promise;

			$http.jsonp(BASE_URL.url+"/Admin/TravelArea/listSell?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.allRoutesSell=data;
			})
			.error(function(data){
				console.log(data);
			});

		}

	};

})

.factory('SupplierMgr',function($q,$http,BASE_URL){

	///Admin/CompanySupplier/supplierList

	return {

		getAll:function($scope){
			
			var d=$q.defer();
			var promise=d.promise;

			$http.jsonp(BASE_URL.url+"/Admin/CompanySupplier/supplierList?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.supplierListResult=data.supplier.list;
				console.log($scope.supplierListResult);
			})
			.error(function(data){
				$scope.supplierListResult=false;
			});

		},

		delete:function($scope,uid){

			var d=$q.defer();
			var promise=d.promise;

		},

		add:function($scope){

			var d=$q.defer();
			var promise=d.promise;

		},

		update:function($scope){

			var d=$q.defer();
			var promise=d.promise;

		}

	};

});