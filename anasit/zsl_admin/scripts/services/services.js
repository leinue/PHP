angular.module('sbAdminApp')

.factory('User',function($q,$http,$location,ACCESS_LEVELS,BASE_URL){

	var service={};

	var d=$q.defer();
	var promise=d.promise;


	// var _user=$cookieStore.get('user');

	service.setUser=function(tel,password){

		$http({
			method:"POST",
			url:BASE_URL.url+'/User/Auth/Login',
			data:{
				"mobile":tel,
				"password":password
			}
		}).success(function(data){
			if(data.status=='success'){
				localStorage.userMobile=tel;
				localStorage.userPwd=password;
				$location.path('/');
			}else{
				alert('登录失败,请检查用户名或密码');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
			
		// $cookieStore.put('user',_user);
	}

	service.isLoggedIn=function(){
		return localStorage.userMobile ? true : false;
	}

	service.getUser=function(){
		return localStorage.userMobile;
	}

	service.logout=function(){
		localStorage.userMobile=null;
		localStorage.userPwd=null;
	}

	return service;

})

.factory('RouteStart',function($q,$http,BASE_URL){

	return {
		update:function($scope,id,title,orderIndex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/editStart',
				params:{
					"data":{
						"id":id,
						"title":title,
						"orderindex":orderIndex
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id){
			
			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/deleteStart',
				params:{
					"data":{
						"id":id
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex){
			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/createStart',
				params:{
					"data":{
						"title":title,
						"orderindex":orderindex
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope){
			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/listStart'
			}).success(function(data){
				console.log(data);
				$scope.allRoutes=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}
	};

})

.factory('RouteEnd',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/editEnd',
				params:{
					"data":{
						"id":id,
						"title":title,
						"orderindex":orderIndex
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/deleteEnd',
				params:{
					"data":{
						"id":id
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/createEnd',
				params:{
					"data":{
						"title":title,
						"orderindex":orderindex
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/listEnd'
			}).success(function(data){
				console.log(data);
				$scope.allRoutesEnd=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('RouteSell',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/editSell',
				params:{
					"data":{
						"id":id,
						"title":title,
						"orderindex":orderIndex
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/createSell',
				params:{
					"data":{
						"title":title,
						"orderindex":orderIndex
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/deleteSell',
				params:{
					"data":{
						"id":id
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/TravelArea/listSell'
			}).success(function(data){
				console.log(data);
				$scope.allRoutesSell=data;
			}).catch(function(reason){
				$q.reject(reason);
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

			$http({
				method:"get",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierList'
			}).success(function(data){
				$scope.supplierListResult=data.supplier.list.data;
				console.log($scope.supplierListResult);
			}).catch(function(reason){
				$scope.supplierListResult=false;
				$q.reject(reason);
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