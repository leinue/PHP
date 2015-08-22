angular.module('sbAdminApp')

.factory('User',function(ACCESS_LEVELS){

	var service={};

	// var _user=$cookieStore.get('user');

	service.setUser=function(user){
		_user=user;
		// $cookieStore.put('user',_user);
	}

	service.isLoggedIn=function(){
		return _user ? true : false;
	}

	service.getUser=function(){
		return _user;
	}

	service.setLogin=function(){
		isLoggedIn=true;
	}

	service.logout=function(){
		// $cookieStore.remove('user');
		_user=null;
	}

	return service;

})

.factory('RouteStart',function($q,$http){

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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/editStart?data="+request+"&callback=JSON_CALLBACK")
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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/deleteStart?data="+request+"&callback=JSON_CALLBACK")
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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/createStart?data="+request+"&callback=JSON_CALLBACK")
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

			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/listStart?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.allRoutes=data;
			})
			.error(function(data){
				console.log(data);
			});
		}
	};

})

.factory('RouteEnd',function($q,$http){

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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/editEnd?data="+request+"&callback=JSON_CALLBACK")
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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/deleteEnd?data="+request+"&callback=JSON_CALLBACK")
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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/createEnd?data="+request+"&callback=JSON_CALLBACK")
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

			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/listEnd?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.allRoutesEnd=data;
			})
			.error(function(data){
				console.log(data);
			});

		}

	};

})

.factory('RouteSell',function($q,$http){

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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/editSell?data="+request+"&callback=JSON_CALLBACK")
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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/createSell?data="+request+"&callback=JSON_CALLBACK")
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
			
			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/deleteSell?data="+request+"&callback=JSON_CALLBACK")
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

			$http.jsonp("http://service.zhangshanglv.cn/index.php/Admin/TravelArea/listSell?callback=JSON_CALLBACK")
			.success(function(data){
				$scope.allRoutesSell=data;
			})
			.error(function(data){
				console.log(data);
			});

		}

	};

});