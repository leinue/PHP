angular.module('sbAdminApp')
.controller('UserLoginCtrl',function($scope,$location,User){

	$scope.login=function(){
		User.setUser(1);
		$location.path('/home');
	};

});