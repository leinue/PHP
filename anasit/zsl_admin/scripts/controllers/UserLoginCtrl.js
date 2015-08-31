angular.module('sbAdminApp')
.controller('UserLoginCtrl',function($scope,$location,User){

	$scope.disable=false;

	$scope.mode='login';
	$scope.modeTitle="登录";

	var tmpUserMobile=$scope.telnumber;
	var tmpUserPwd=$scope.password;

	$scope.setModeLogin=function(){
		$scope.mode="login";
		$scope.modeTitle="登录";
		$scope.telnumber=tmpUserMobile;
		$scope.password=tmpUserPwd;
	};

	$scope.setModeRegister=function(){
		$scope.mode="register";
		$scope.modeTitle="返回";
		$scope.telnumber='';
		$scope.password='';
	};

	if(User.isLoggedIn()){
		$location.path('/');
	}

	if(localStorage.userMobile!=undefined){
		$scope.telnumber=localStorage.userMobile;
		$scope.password=localStorage.userPwd;
		$scope.rememberMe=localStorage.rememberMe;
	}

	$scope.checkNull=function(){
		if($scope.telnumber==null || $scope.password==null){
			return false;
		}
		return true;
	};

	$scope.login=function(){

		if($scope.mode=="login"){
			if(!$scope.checkNull()){
				alert('用户名或密码不能为空');
			}else{
				$scope.disable=true;
				localStorage.rememberMe=$scope.rememberMe;
				User.setUser($scope.telnumber,$scope.password,function(){
					User.getThisInfo();
					$scope.disable=false;
				});
			}
		}else{
			if($scope.mode=="register"){
				$scope.setModeLogin();
			}
		}		

	};

	$scope.register=function(){
		if($scope.mode=='register'){
			if(!$scope.checkNull()){
				alert('用户名或密码不能为空');
			}else{
				User.register($scope.telnumber,$scope.password,function(){
					alert('注册成功,请登录');
					$scope.setModeLogin();
				});
			}
		}else{
			$scope.setModeRegister();
		}
	}

});