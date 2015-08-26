angular.module('sbAdminApp')

.factory('User',function($q,$http,$location,ACCESS_LEVELS,BASE_URL){

	var service={};

	var d=$q.defer();
	var promise=d.promise;

	localStorage.isLogedIn=false;


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
				console.log(data);
				localStorage.userMobile=tel;
				localStorage.userPwd=password;
				localStorage.isLogedIn=true;
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
		return localStorage.isLogedIn=='true';
	}

	service.getUser=function(){
		return localStorage.userMobile;
	}

	service.logout=function(){

		$http({
			method:"POST",
			url:BASE_URL.url+'/User/Auth/logout'
		}).success(function(data){
			if(data.status=='success'){
				localStorage.isLogedIn="false";
				$location.path('/login');
			}else{
				alert('注销失败');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
	}

	service.getUid=function(){
		return 173;
	}

	service.getThisInfo=function(){
		$http({
			method:"post",
			url:BASE_URL.url+'/User/Info/getthisinfo'
		}).success(function(data){

			console.log(data);

		}).catch(function(reason){
			$q.reject(reason);
		});
	}

	return service;

})

.factory('RouteStart',function($q,$http,BASE_URL){

	return {
		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/editStart',
				data:{
					"id":id,
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/deleteStart',
				data:{
					"id":id
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/createStart',
				data:{
					"title":title,
					"orderindex":orderindex
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
				method:"post",
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/editEnd',
				data:{
					"id":id,
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/deleteEnd',
				data:{
					"id":id
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/createEnd',
				data:{
					"title":title,
					"orderindex":orderindex
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
				method:"post",
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

.factory('SupplierMgr',function($q,$http,BASE_URL){

	///Admin/CompanySupplier/supplierList

	return {

		getAll:function($scope){
			
			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierList'
			}).success(function(data){
				$scope.supplierListResult=data.supplier.list.data;
				console.log($scope.supplierListResult);
			}).catch(function(reason){
				$scope.supplierListResult=false;
				$q.reject(reason);
			});

		},

		delete:function(uid){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierDelete',
				data:{
					"supplier":{
						"delete":{
							"data":{
								"uid":uid
							}
						}
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data.supplier;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function(username,password,tel,groupid,salt,status,name,joindate,joinip,lastvisit,lastip,create_time,update_time,image1,image2,image3,isapproved,type){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierCreate',
				data:{
					"supplier":{
						"create":{
							"data":{
								"username":username,
				                "password":password,
				                "tel":tel,
				                "groupid":groupid,
				                "salt":salt,
				                "status":status,
				                "name":name,
				                "joindate":joindate,
				                "joinip":joinip,
				                "lastvisit":lastvisit,
				                "lastip":lastip,
				                "create_time":create_time,
				                "update_time":update_time,
				                "image1":image1,
				                "image2":image2,
				                "image3":image3,
				                "isapproved":isapproved,
				                "type":type
							}
						}
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data.supplier.create;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		update:function(uid,username,password,tel,groupid,salt,status,name,image1,image2,image3,isapproved,type){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierEdit',
				data:{
					"supplier":{
						"create":{
							"data":{
								"uid":uid,
								"username":username,
				                "password":password,
				                "tel":tel,
				                "groupid":groupid,
				                "salt":salt,
				                "status":status,
				                "name":name,
				                "image1":image1,
				                "image2":image2,
				                "image3":image3,
				                "isapproved":isapproved,
				                "type":type
							}
						}
					}
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data.supplier.create;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsConstract',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelConstract/editConstract',
				data:{
					"id":id,
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelConstract/addConstract',
				data:{
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelConstract/deleteConstract',
				data:{
					"id":id
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelConstract/getAllConstract'
			}).success(function(data){
				console.log(data);
				$scope.allConstract=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsCategory',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductCategory/editProductCategory',
				data:{
					"id":id,
					"name":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductCategory/addProductCategory',
				data:{
					"name":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductCategory/deleteProductCategory',
				data:{
					"id":id
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductCategory/getProductCategory'
			}).success(function(data){
				console.log(data);
				$scope.allCategories=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsAttr',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductAttr/editProductAttr',
				data:{
					"id":id,
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductAttr/addProductAttr',
				data:{
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductAttr/deleteProductAttr',
				data:{
					"id":id
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductAttr/getProductAttr'
			}).success(function(data){
				console.log(data);
				$scope.allAttrs=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsInsure',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/editTravelInsure',
				data:{
					"id":id,
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/createTravelInsure',
				data:{
					"title":title,
					"orderindex":orderindex
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/deleteTravelInsure',
				data:{
					"id":id
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
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/getTravelInsure'
			}).success(function(data){
				console.log(data);
				$scope.allInsures=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProducts',function($q,$http,BASE_URL){

	return {

		update:function($scope,data){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/editTravelProduct',
				data:data
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				alert(data.message);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,data){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/addTravelProduct',
				data:data
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				alert(data.message);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,pid){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/deleteTravelProduct',
				data:{
					"pid":pid
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				alert(data.message);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,id=null){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/getTravelRoute',
				data:{
					"uid":id
				}
			}).success(function(data){
				console.log(data);
				$scope.allTravelRoutes=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		approve:function($scope,pid){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/isProductApproved',
				data:{pid}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				alert(data.message);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		view:function($scope,pid,callback){

			var d=$q.defer();
			var promise=d.promise;
			
			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/getProductById',
				data:{"pid":pid}
			}).success(function(data){
				// console.log(data);
				$scope.status=data;
				$scope.product=data;
				// localStorage.singleProduct=JSON.stringify(data);
				callback(data);
				// alert(data.message);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

});
