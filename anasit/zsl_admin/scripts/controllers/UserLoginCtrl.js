angular.module('sbAdminApp')
.controller('UserLoginCtrl',function($scope,$location,User){

	$scope.login=function(){

		console.log($scope.telnumber);
		console.log($scope.password);

		if($scope.telnumber==null || $scope.password==null){
			alert('用户名或密码不能为空');
		}else{
			User.setUser($scope.telnumber,$scope.password);
		}

	};

});