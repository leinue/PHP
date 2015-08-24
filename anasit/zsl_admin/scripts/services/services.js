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

		delete:function(uid){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierDelete',
				params:{
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
				method:"get",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierCreate',
				params:{
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
				method:"get",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierEdit',
				params:{
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
				method:"get",
				url:BASE_URL.url+'/Admin/TravelConstract/editConstract',
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
				url:BASE_URL.url+'/Admin/TravelConstract/addConstract',
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
				url:BASE_URL.url+'/Admin/TravelConstract/deleteConstract',
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
				method:"get",
				url:BASE_URL.url+'/Admin/TravelProductCategory/editProductCategory',
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
				url:BASE_URL.url+'/Admin/TravelProductCategory/addProductCategory',
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
				url:BASE_URL.url+'/Admin/TravelProductCategory/deleteProductCategory',
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
				method:"get",
				url:BASE_URL.url+'/Admin/TravelProductAttr/editProductAttr',
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
				url:BASE_URL.url+'/Admin/TravelProductAttr/addProductAttr',
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
				url:BASE_URL.url+'/Admin/TravelProductAttr/deleteProductAttr',
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
				method:"get",
				url:BASE_URL.url+'/Admin/TravelInsure/editTravelInsure',
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
				url:BASE_URL.url+'/Admin/TravelInsure/addTravelInsure',
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
				url:BASE_URL.url+'/Admin/TravelInsure/deleteTravelInsure',
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
				url:BASE_URL.url+'/Admin/TravelInsure/getTravelInsure'
			}).success(function(data){
				console.log(data);
				$scope.allInsures=data;
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

});
