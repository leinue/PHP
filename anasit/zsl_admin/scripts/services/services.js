angular.module('sbAdminApp')

.factory('User',function($q,$http,$location,ACCESS_LEVELS,BASE_URL){

	var service={};

	var d=$q.defer();
	var promise=d.promise;

	localStorage.isLogedIn=localStorage.isLogedIn==undefined?false:localStorage.isLogedIn;

	// var _user=$cookieStore.get('user');
	var userInfo;

	service.setUser=function(tel,password,callback){

		$http({
			method:"POST",
			url:BASE_URL.url+'/User/Auth/Login',
			data:{
				"mobile":tel,
				"password":password
			}
		}).success(function(data){
			if(data.status===1){
				console.log(data);
				localStorage.userMobile=tel;
				localStorage.userPwd=password;
				localStorage.isLogedIn='true';
				$location.path('/');
				callback();
			}else{
				alert('登录失败,请检查用户名或密码');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
			
		// $cookieStore.put('user',_user);
	}

	service.isLoggedIn=function(){
		console.log(localStorage.isLogedIn);
		return localStorage.isLogedIn=='true';
	};

	service.getUser=function(){
		return localStorage.userMobile;
	};

	service.logout=function(){

		$http({
			method:"POST",
			url:BASE_URL.url+'/User/Auth/logout'
		}).success(function(data){
			if(data.status===1){
				localStorage.isLogedIn="false";
				localStorage.uid=null;
				localStorage.group=null;
				$location.path('/login');
			}else{
				alert('注销失败');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
	};

	service.getUid=function(){
		return localStorage.uid;
	};

	service.getGroup=function(){
		return localStorage.group;
	};

	service.getThisInfo=function(callback){
		$http({
			method:"post",
			url:BASE_URL.url+'/User/Info/getthisinfo'
		}).success(function(data){
			userInfo=data;
			if(userInfo.status===1){
				console.log(userInfo.data);
				localStorage.uid=userInfo.data.uid;
				localStorage.group=userInfo.data.group;
				callback(data);
			}else{
				var errorMsg=userInfo.message;
				if(errorMsg.indexOf('用户未登陆')!=-1){
					localStorage.isLogedIn="false";
					localStorage.uid=null;
					localStorage.group=null;
					$location.path('/login');
				}
				alert(userInfo.message);
			}
			// console.log(data);
		}).catch(function(reason){
			$q.reject(reason);
		});
	};

	// service.checkAuth(current,to){

	// }

	service.isRoot=function(){
		// return 
	};

	service.register=function(mobile,password,callback){
		$http({
			method:"POST",
			url:BASE_URL.url+'/User/Auth/register',
			data:{
				"mobile":mobile,
				"password":password
			}
		}).success(function(data){
			console.log(data);
			if(data.status===1){
				callback();
			}else{
				alert('注册失败,请重试');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
	};

	service.getInfo=function($scope,uid=null,mobile=null,nickname=null,group=null,callback,single=false){
		$http({
			method:'GET',
			url:BASE_URL.url+'/User/Info/getinfosbyinfo?uid='+uid+'&mobile='+mobile+'&nickname='+nickname+'&group='+group
		}).success(function(data){
			if(data.status===1){
				if(!single){
					$scope.allSuppliersList=data;
				}else{
					$scope.singleUser=data;
				}
				callback(data.data);
			}else{
				alert('查询失败');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
	}

	service.getInfoByUid=function($scope,uid,callback){
		$http({
			method:'GET',
			url:BASE_URL.url+'/User/Info/getinfobyuid?uid='+uid
		}).success(function(data){
			if(data.status===1){
				console.log(data);
				callback(data.data);
			}else{
				alert('获取用户信息失败');
			}
		}).catch(function(reason){
			$q.reject(reason);
		});
	};

	return service;


})

.factory('Supplier',function($q,$http,BASE_URL){

	return {

		getAll:function($scope,page=1,callback){
			//http://service.zhangshanglv.cn/User/Info/getinfobypage
			$http({
				method:"get",
				url:BASE_URL.url+'/User/Info/getinfobypage?page='+page+'&size=10'
			}).success(function(data){
				console.log(data);
				$scope.allSuppliersList=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});
		},

		addGroup:function($scope,uid,group,callback){
			$http({
				method:"POST",
				url:BASE_URL.url+'/Admin/Auth/addgrouptouid',
				data:{
					"uid":uid,
					"group":group
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				callback(data);
				if(data.status!==1){
					alert('添加组失败');
				}
			}).catch(function(reason){
				$q.reject(reason);
			});
		},

		removeGroup:function($scope,uid,group,callback){
			$http({
				method:"POST",
				url:BASE_URL.url+'/Admin/Auth/delgroupfromuid',
				data:{
					"uid":uid,
					"group":group
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				callback(data);
				if(data.status!==1){
					alert('移除组失败');
				}
			}).catch(function(reason){
				$q.reject(reason);
			});
		}

	};

})

.factory('RouteStart',function($q,$http,BASE_URL){

	return {
		update:function($scope,id,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id,callback){
			
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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex,callback){
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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,callback){
			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/listStart'
			}).success(function(data){
				console.log(data);
				$scope.allRoutes=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}
	};

})

.factory('RouteEnd',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelArea/listEnd'
			}).success(function(data){
				console.log(data);
				$scope.allRoutesEnd=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('SupplierMgr',function($q,$http,BASE_URL){

	///Admin/CompanySupplier/supplierList

	return {

		getAll:function($scope,callback){
			
			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/CompanySupplier/supplierList'
			}).success(function(data){
				$scope.supplierListResult=data.supplier.list.data;
				console.log($scope.supplierListResult);
				callback(data.supplier.list.data);
			}).catch(function(reason){
				$scope.supplierListResult=false;
				$q.reject(reason);
			});

		},

		delete:function(uid,callback){

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
				callback(data);
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

		update:function($scope,id,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelConstract/getAllConstract'
			}).success(function(data){
				console.log(data);
				$scope.allConstract=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsCategory',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductCategory/getProductCategory'
			}).success(function(data){
				console.log(data);
				$scope.allCategories=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsAttr',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProductAttr/getProductAttr'
			}).success(function(data){
				console.log(data);
				$scope.allAttrs=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProductsInsure',function($q,$http,BASE_URL){

	return {

		update:function($scope,id,title,orderindex,desc,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/editTravelInsure',
				data:{
					"id":id,
					"title":title,
					"orderindex":orderindex,
					'description':desc
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,title,orderindex,desc,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/createTravelInsure',
				data:{
					"title":title,
					"orderindex":orderindex,
					"description":desc
				}
			}).success(function(data){
				console.log(data);
				$scope.status=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,id,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,callback){

			var d=$q.defer();
			var promise=d.promise;

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelInsure/getTravelInsure'
			}).success(function(data){
				console.log(data);
				$scope.allInsures=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelProducts',function($q,$http,BASE_URL){

	return {

		update:function($scope,data,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		add:function($scope,data,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		delete:function($scope,pid,callback){

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
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		getAll:function($scope,id=null,callback){

			var d=$q.defer();
			var promise=d.promise;

			console.log('service uid='+id);

			var request={
				"uid":id
			};

			if(id=='' || id==null){
				request={};
			}

			$http({
				method:"post",
				url:BASE_URL.url+'/Admin/TravelProduct/getTravelRoute',
				data:request
			}).success(function(data){
				console.log(data);
				$scope.allTravelRoutes=data;
				if(status==="0"){
					alert(data.message);
				}
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		},

		approve:function($scope,pid,callback){

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
				callback(data);
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
				console.log(data);
				$scope.status=data;
				$scope.product=data;
				// localStorage.singleProduct=JSON.stringify(data);
				console.log('callback start');
				callback(data);
				// alert(data.message);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

})

.factory('TravelSupply',function($q,$http,BASE_URL){

	return {

		getAll:function($scope,page,callback){

			var d=$q.defer();
			var promise=d.promise;
			
			$http({
				method:"get",
				url:BASE_URL.url+'/Travel/Supply/getsuppliersbypage?page='+page
			}).success(function(data){
				console.log(data);
				$scope.allTravelSupply=data;
				callback(data);
			}).catch(function(reason){
				$q.reject(reason);
			});

		}

	};

});
