(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicRoleController', BasicRoleController);

    /* @ngInject */
    function BasicRoleController($scope, $state, $filter, $mdDialog, UserMgrService, RefreshService, PrivilegeService, UserRoleService, triMenu) {
        var vm = this;

        $scope.roles = {};
        $scope.roleList = {};

        $scope.rolePageTitle = '新增角色';

        $scope.viewThisRole = function(role) {
        	$scope.rolePageTitle = '查看/编辑角色';
        	$scope.roleList = role;
        	$scope.roleList.create_time = $filter('date')($scope.roleList.create_time * 1000, 'yyyy-MM-dd');
        	$scope.roleList.update_time = $filter('date')($scope.roleList.update_time * 1000, 'yyyy-MM-dd');
        	$('#new-role').modal('show');
            $('.modal-backdrop').css('z-index','0');
        }

        $scope.removeThisRole = function(id) {
        	
        	var alert = $mdDialog.confirm({
                title: '该操作不可回溯',
                content:'确定要删除该项目吗?',
                ok: '确定',
                cancel: '取消'
            });

            $mdDialog.show(alert).then(function(confirm) {
            	if(confirm) {
            		UserRoleService.remove(id).then(function(data) {
                        var status = data.status;
                        var realData = data.Schema;
                        if(status != '200') {
                            var alert = $mdDialog.alert({
                                title: '删除失败',
                                content: realData.properties.message,
                                ok: '确定'
                            });
                        }else {
                            var alert = $mdDialog.alert({
                                title: '删除成功',
                                content: '',
                                ok: '确定'
                            });
                            $scope.getAllRoles();
                        }
                        $mdDialog.show(alert);
                    });
            	}
            });
        }

        $scope.getAllRoles = function() {
        	UserRoleService.getAll().then(function(data) {
        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
        			$mdDialog.show($mdDialog.alert({
        				title: '获取角色列表失败',
        				content: realData.properties.message,
        				ok: '确定'
        			}));
        			return false;
        		}

        		$scope.roles = realData.properties;
        	});
        };

        $scope.getAllRoles();

        $scope.refreshNyRolesList = function() {
        	$scope.getAllRoles();
        }

        $scope.newRole = function() {
        	$scope.rolePageTitle = '新增角色';
        	$('#new-role').modal('show');
            $('.modal-backdrop').css('z-index','0');
            $scope.roleList = {};
        }

        $('#new-role, #menu-mgr').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.confirmNewRole = function() {
        	UserRoleService.add($scope.roleList).then(function(data) {
        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
        			$mdDialog.show($mdDialog.alert({
        				title: '添加角色信息失败',
        				content: realData.properties.message,
        				ok: '确定'
        			}));
        		}else {
        			$mdDialog.show($mdDialog.alert({
	    				title: '添加角色信息成功',
	    				content: realData.properties.message,
	    				ok: '确定'
	    			}));

	    			$('#new-role').modal('hidden');
	    			$scope.getAllRoles();
        		}
        	});
        }

        $scope.confirmEditRole = function() {
        	$scope.roleList.role_id = $scope.roleList.id;
        	UserRoleService.update($scope.roleList).then(function(data) {
        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
        			$mdDialog.show($mdDialog.alert({
        				title: '修改角色信息失败',
        				content: realData.properties.message,
        				ok: '确定'
        			}));
        		}else {
        			$mdDialog.show($mdDialog.alert({
	    				title: '修改角色信息成功',
	    				content: realData.properties.message,
	    				ok: '确定'
	    			}));

	    			$('#new-role').modal('hidden');
	    			$scope.getAllRoles();
        		}
        	});
        }

        $scope.saveMyRole = function() {
        	if($scope.rolePageTitle == '新增角色') {
        		$scope.confirmNewRole();
        	}else {
        		$scope.confirmEditRole();
        	}
        }

        //权限设置

        $scope.currentRoleId = '';

        $scope.RightsList = {};

        $scope.switches = {
        	dashboard: {
        		menu: {
        			display: true,
        			state: 'triangular.admin-default.dashboard-menu'
        		},
        		analytics: {
        			display: true,
        			state: 'triangular.admin-default.dashboard-analytics'
        		},
        		server: {
        			display: true,
        			state: 'triangular.admin-default.dashboard-server'
        		}
        	},
        	hq: {
        		menu: {
        			display: true,
        			state: 'triangular.admin-default.hq-menu'
        		},
        		archive: {
        			display: true,
        			state: 'triangular.admin-default.basic-page'
        		},
        		health: {
        			display: true,
        			state: 'triangular.admin-default.basic-archives'
        		},
        		department: {
        			display: true,
        			state: 'triangular.admin-default.department-mgr'
        		},
        		org: {
        			display: true,
        			state: 'triangular.admin-default.community-mgr'
        		},
        		service: {
        			display: true,
        			state: 'triangular.admin-default.shop-mgr'
        		},
        		video: {
        			display: true,
        			state: 'triangular.admin-default.basic-video'
        		},
        		monitor: {
        			display: true,
        			state: 'triangular.admin-default.monitor-mgr'
        		},
        		pos: {
        			display: true,
        			state: 'triangular.admin-default.services-pos'
        		},
        		device: {
        			display: true,
        			state: 'triangular.admin-default.device-mgr'
        		},
        		rights: {
        			display: true,
        			state: 'triangular.admin-default.user-role'
        		},
        		deliver: {
        			display: true,
        			state: 'triangular.admin-default.master-admin'
        		},
        		volunteer: {
        			display: true,
        			state: 'triangular.admin-default.basic-volunteer'
        		}
        	},
        	service: {
        		menu: {
        			display: true,
        			state: 'triangular.admin-default.services-menu'
        		},
        		help: {
        			display: true,
        			state: 'triangular.admin-default.services-help'
        		},
        		call: {
        			display: true,
        			state: 'triangular.admin-default.services-work'
        		},
        		sos: {
        			display: true,
        			state: 'triangular.admin-default.services-yulp'
        		},
        		msg: {
        			display: true,
        			state: 'triangular.admin-default.services-message'
        		}
        	},
        	department: {
        		menu: {
        			display: true,
        			state: 'triangular.admin-default.org-lvl-menu'
        		},
        		info: {
        			display: true,
        			state: 'triangular.admin-default.org-department-mgr'
        		},
        		old: {
        			display: true,
        			state: 'triangular.admin-default.org-system-org'
        		}
        	},
        	org: {
        		menu: {
        			display: true,
        			state: 'triangular.admin-default.community-lvl-menu'
        		},
        		info: {
        			display: true,
        			state: 'triangular.admin-default.community-info'
        		},
        		old: {
        			display: true,
        			state: 'triangular.admin-default.community-archive'
        		}
        	}
        }

        $scope.switchesJSON = JSON.stringify($scope.switches);

        $scope.viewThisRights = function(id) {
        	$scope.currentRoleId = id;
            $scope.RightsList = {};
            UserRoleService.getAuthority($scope.currentRoleId).then(function(data) {
            	var status = data.status;
            	var realData = data.Schema;

            	if(status != '200') {
            		$mdDialog.show($mdDialog.alert({
        				title: '获得权限信息失败',
        				content: realData.properties.message,
        				ok: '确定'
        			}));
            	}else {
            		if(realData.properties.states == 'null' || realData.properties.states == '' || realData.properties.states == null) {
            			$scope.switches = {
				        	dashboard: {
				        		menu: {
				        			display: true,
				        			state: 'triangular.admin-default.dashboard-menu'
				        		},
				        		analytics: {
				        			display: true,
				        			state: 'triangular.admin-default.dashboard-analytics'
				        		},
				        		server: {
				        			display: true,
				        			state: 'triangular.admin-default.dashboard-server'
				        		}
				        	},
				        	hq: {
				        		menu: {
				        			display: true,
				        			state: 'triangular.admin-default.hq-menu'
				        		},
				        		archive: {
				        			display: true,
				        			state: 'triangular.admin-default.basic-page'
				        		},
				        		health: {
				        			display: true,
				        			state: 'triangular.admin-default.basic-archives'
				        		},
				        		department: {
				        			display: true,
				        			state: 'triangular.admin-default.department-mgr'
				        		},
				        		org: {
				        			display: true,
				        			state: 'triangular.admin-default.community-mgr'
				        		},
				        		service: {
				        			display: true,
				        			state: 'triangular.admin-default.shop-mgr'
				        		},
				        		video: {
				        			display: true,
				        			state: 'triangular.admin-default.basic-video'
				        		},
				        		monitor: {
				        			display: true,
				        			state: 'triangular.admin-default.monitor-mgr'
				        		},
				        		pos: {
				        			display: true,
				        			state: 'triangular.admin-default.services-pos'
				        		},
				        		device: {
				        			display: true,
				        			state: 'triangular.admin-default.device-mgr'
				        		},
				        		rights: {
				        			display: true,
				        			state: 'triangular.admin-default.user-role'
				        		},
				        		deliver: {
				        			display: true,
				        			state: 'triangular.admin-default.master-admin'
				        		},
				        		volunteer: {
				        			display: true,
				        			state: 'triangular.admin-default.basic-volunteer'
				        		}
				        	},
				        	service: {
				        		menu: {
				        			display: true,
				        			state: 'triangular.admin-default.services-menu'
				        		},
				        		help: {
				        			display: true,
				        			state: 'triangular.admin-default.services-help'
				        		},
				        		call: {
				        			display: true,
				        			state: 'triangular.admin-default.services-work'
				        		},
				        		sos: {
				        			display: true,
				        			state: 'triangular.admin-default.services-yulp'
				        		},
				        		msg: {
				        			display: true,
				        			state: 'triangular.admin-default.services-message'
				        		}
				        	},
				        	department: {
				        		menu: {
				        			display: true,
				        			state: 'triangular.admin-default.org-lvl-menu'
				        		},
				        		info: {
				        			display: true,
				        			state: 'triangular.admin-default.org-department-mgr'
				        		},
				        		old: {
				        			display: true,
				        			state: 'triangular.admin-default.org-system-org'
				        		}
				        	},
				        	org: {
				        		menu: {
				        			display: true,
				        			state: 'triangular.admin-default.community-lvl-menu'
				        		},
				        		info: {
				        			display: true,
				        			state: 'triangular.admin-default.community-info'
				        		},
				        		old: {
				        			display: true,
				        			state: 'triangular.admin-default.community-archive'
				        		}
				        	}
				        }
            		}else {
            			$scope.switches = realData.properties.states;
            			console.log($scope.switches);
            		}
            		$('#menu-mgr').modal('show');
            		$('.modal-backdrop').css('z-index','0');
            	}

            });
        };

        $scope.confirmEditThisRights = function() {
        	UserRoleService.modifyAuthority({
        		role_id: $scope.currentRoleId,
        		states: $scope.switches
        	}).then(function(data) {
        		var status = data.status;
        		var realData = data.Schema;

        		if(status != '200') {
        			$mdDialog.show($mdDialog.alert({
        				title: '修改权限失败',
        				content: realData.properties.message,
        				ok: '确定'
        			}));
        		}else {
        			$mdDialog.show($mdDialog.alert({
	    				title: '修改权限成功',
	    				content: realData.properties.message,
	    				ok: '确定'
	    			}));

	    			$('#menu-mgr').modal('hidden');
        		}
        	});
			// triMenu.removeMenu('triangular.admin-default.menu-dynamic-dummy-page');
        }

        $scope.toggleNextLvlMenu = function(obj) {
        	for(var key in obj) {
       			obj[key].display = obj.menu.display;
        	}
        	$scope.generatorJSON();
        }

        $scope.togglePrevLvlMenu = function(obj) {

        	var flag = 0;
        	var count = 0;

        	for(var key in obj) {
        		if(key != 'menu') {
        			if(obj[key].display == !obj.menu.display) {
        				flag ++;
        			}
        			count ++;
        		}
        	}

        	if(flag == count) {
        		obj.menu.display = !obj.menu.display;
        	}

        	$scope.generatorJSON();
        }

        $scope.generatorJSON = function() {
        	// $scope.switchesJSON = JSON.stringify($scope.switches);
        }

    }

})();
