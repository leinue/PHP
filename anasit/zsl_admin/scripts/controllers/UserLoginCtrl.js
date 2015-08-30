angular.module('sbAdminApp')
.controller('UserLoginCtrl',function($scope,$location,User){

	if(User.isLoggedIn()){
		console.log('sasa');
		$location.path('/');
	}

	if(localStorage.userMobile!=undefined){
		$scope.telnumber=localStorage.userMobile;
		$scope.password=localStorage.userPwd;
		$scope.rememberMe=localStorage.rememberMe;
	}

	$scope.login=function(){

		if($scope.telnumber==null || $scope.password==null){
			alert('用户名或密码不能为空');
		}else{
			localStorage.rememberMe=$scope.rememberMe;
			User.setUser($scope.telnumber,$scope.password);
		}

	};

});