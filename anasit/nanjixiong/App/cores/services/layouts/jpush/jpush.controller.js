(function() {
    'use strict';

    angular
        .module('app.cores.services')
        .controller('BasicServicesJpushController', BasicServicesJpushController);

    /* @ngInject */
    function BasicServicesJpushController($mdDialog, $state, $scope, OrgInfoService, SmsService) {
        var vm = this;

        $scope.checkboxes = {
        	email: true,
        	app: true,
        	sms: true,
        	_default: 'app'
        }

        $scope.sendType = "标题";
        $scope.sendTypeTitle = '标题';

        $scope.sendMessage = function() {

        	$('#send-message').modal('show');
			$('.modal-backdrop').css('z-index','0');

        };

        $('#send-message').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });


        $scope.sms = {
        	title: '',
        	message: '',
        };

        $scope.realSms = {
        	mobile: '',
        	text: ''
        };

        $scope.emailSend = {
        	to: '',
        	title: '',
        	content: ''
        };

        $scope.changeType = function() {
        	switch($scope.checkboxes._default) {
        		case 'app':
        			$scope.sendType = '标题';
        			$scope.sendTypeTitle = '标题';
        			break;
        		case 'sms':
        			$scope.sendType = '手机号(多个请用逗号分割)';
        			$scope.sendTypeTitle = '手机号(多个请用逗号分割)';
        			break;
        		case 'email':
        			$scope.sendType = '邮箱帐号';
        			$scope.sendTypeTitle = '标题';
        			break
        		default:
        			break;
        	}
        }

        $scope.smsCtrl = {
        	sendMessage: function() {
        		
        		if($scope.sms.title == '' || $scope.sms.message == '') {
        			var alert = $mdDialog.alert({
        				title: '非法数据',
        				content: '数据缺少,请完整填写',
        				ok: '确定'
        			});
        			$mdDialog.show(alert);
        			return false;
        		}

        		// if($scope.checkboxes.email == false || $scope.checkboxes.app == false || $scope.checkboxes.sms == false) {
        		// 	var alert = $mdDialog.alert({
        		// 		title: '非法数据',
        		// 		content: '请至少选择一个平台',
        		// 		ok: '确定'
        		// 	});
        		// 	$mdDialog.show(alert);
        		// }

        		var method = {

        			app: function() {
        				SmsService.send($scope.sms).then(function(data) {
		        			var status = data.msg_id;
		        			if(status.length === 0) {
		        				var alert = $mdDialog.alert({
		        					title: '发送失败',
		        					content: '发送数据失败,请重试',
		        					ok: '确定'
		        				});
		        			}else {
		        				var alert = $mdDialog.alert({
		        					title: '发送成功',
		        					content: '发送成功',
		        					ok: '确定'
		        				});
		        			}

		        			$mdDialog.show(alert);
		        		});
        			},

        			sms: function() {
        				$scope.realSms.mobile = $scope.sms.title;
        				$scope.realSms.text = $scope.sms.message;
        				SmsService.sendBySms($scope.realSms).then(function(data) {
        					var status = data.msg;
		        			if(status != 'OK') {
		        				var alert = $mdDialog.alert({
		        					title: '发送失败',
		        					content: status,
		        					ok: '确定'
		        				});
		        			}else {
		        				var alert = $mdDialog.alert({
		        					title: '发送成功',
		        					content: '发送成功',
		        					ok: '确定'
		        				});
		        			}

		        			$mdDialog.show(alert);
        				});
        			},

        			email: function() {
        				$scope.emailSend.title = $scope.sms.title;
        				$scope.emailSend.content = $scope.sms.message;
        				SmsService.sendByEmail($scope.emailSend).then(function(data) {
        					// var status = data.msg;
		        			// if(status != 'OK') {
		        			// 	var alert = $mdDialog.alert({
		        			// 		title: '发送失败',
		        			// 		content: status,
		        			// 		ok: '确定'
		        			// 	});
		        			// }else {
		        				
		        			// }
		        			var alert = $mdDialog.alert({
	        					title: '发送成功',
	        					content: '发送成功',
	        					ok: '确定'
	        				});

		        			$mdDialog.show(alert);

        				});

        			}

        		};

        		method[$scope.checkboxes._default]();

        	}
        }

    }

})();
