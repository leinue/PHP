angular.module('sbAdminApp')
.controller('SupplyVerifyCtrl',function($scope,$location,User,TravelSupply){

	console.log('进入查看个人资料');

	console.log('supply verify uid='+User.getUid());

	User.getInfo($scope,User.getUid(),'','','',function(data){

	},true);

	TravelSupply.getAll($scope,'',function(data){
		console.log('supply verify travel supply end');
	});

});