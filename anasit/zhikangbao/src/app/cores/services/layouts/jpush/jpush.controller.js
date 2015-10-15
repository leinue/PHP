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
        	sms: true
        }

        $scope.sendMessage = function() {

        	$('#send-message').modal('show');
			$('.modal-backdrop').css('z-index','0');

        };

        $('#send-message').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });


        $scope.sms = {
        	content: '',
        	mobile: '',
        };

        $scope.smsCtrl = {
        	sendMessage: function() {
        		
        		if($scope.sms.content == '' || $scope.sms.mobile == '') {
        			var alert = $mdDialog.alert({
        				title: '非法数据',
        				content: '手机号或发送内容不能为空',
        				ok: '确定'
        			});
        			$mdDialog.show(alert);
        			return false;
        		}

        		if($scope.checkboxes.email == false || $scope.checkboxes.app == false || $scope.checkboxes.sms == false) {
        			var alert = $mdDialog.alert({
        				title: '非法数据',
        				content: '请至少选择一个平台',
        				ok: '确定'
        			});
        			$mdDialog.show(alert);
        		}

        		SmsService.send($scope.sms).then(function(data) {
        			var status = data.status;
        			var realData = data.Schema;
        			if(status != '200') {
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

        	}
        }

    }

})();
