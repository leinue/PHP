(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicNewOldManController', BasicNewOldManController);

    /* @ngInject */
    function BasicNewOldManController($scope, $state, OldInfoService, $mdDialog, OrgInfoService, $stateParams, OrgService, $location) {
        var vm = this;

        $scope.edit = false;

        $scope.inserOldInfo = {};

        $scope.thisTitle = '新增老人信息';

        if(typeof $stateParams.id !='undefined') {
            $scope.edit = true;
            $scope.thisTitle = '编辑老人信息';
        }

        if($scope.edit) {
            OldInfoService.one($stateParams.id).then(function(data) {
                var status = data.status;
                var realData = data.Schema;
                var pro = realData.properties;
                $scope.inserOldInfo = pro;
            },function(error) {
                var alert = $mdDialog.alert({
                    title: '出错了,请联系管理员,错误代码:' + error.status,
                    content: error.statusText,
                    ok: '确定'
                });
                $mdDialog.show(alert);
            });
        }

        $scope.ordList = {};

        OrgService.index().then(function(data) {
            var status = data.status;
            var realData = data.Schema.properties;
            $scope.ordList = realData;
        },function(error) {
            var alert = $mdDialog.alert({
                title: '出错了,请联系管理员,错误代码:' + error.status,
                content: error.statusText,
                ok: '确定'
            });
            $mdDialog.show(alert);
        });

        $scope.returnToOldmanList = function() {
            var name = $state.current.name;
            if(name.indexOf('departemnt-edit-oldman') != -1) {
                $location.path('/org/archive');
            }else if(name.indexOf('community') != -1) {
                $location.path('/community/archive');
            }else if (name.indexOf('department-new-oldman') != -1) {
                $location.path('/org/archive');
            }else {
                $location.path('/basic');
            }
        };

        $scope.submitInfo = function() {
            var isError = false;
            if(!$scope.edit){
                OldInfoService.insert($scope.inserOldInfo).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    var msg = realData.properties.message;
                    var alert = $mdDialog.alert({
                            title: msg,
                            content:msg,
                            ok: '确定'
                        });
                    $mdDialog.show(alert);
                },function(error) {
                    var alert = $mdDialog.alert({
                        title: '出错了,请联系管理员,错误代码:' + error.status,
                        content: error.statusText,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                    isError = true;
                });
                // if(status == '200' || status == '201') {
                //     $scope.returnToOldmanList();
                // }
                if(!isError) {
                    $scope.inserOldInfo = {};                    
                }
            }else {
                console.log($scope.inserOldInfo);
                OldInfoService.update($scope.inserOldInfo).then(function(data) {
                    var status = data.status;
                    var realData = data.Schema;
                    var msg = realData.properties.message;
                    var alert = $mdDialog.alert({
                            title: msg,
                            content:msg,
                            ok: '确定'
                        });
                    $mdDialog.show(alert);
                    if(status == '200' || status == '201') {
                        $scope.returnToOldmanList();
                    }
                },function(error) {
                    var alert = $mdDialog.alert({
                        title: '出错了,请联系管理员,错误代码:' + error.status,
                        content: error.statusText,
                        ok: '确定'
                    });
                    $mdDialog.show(alert);
                });
            }
            
        };

        $scope.currentFeature = '';
        $scope.currentFeatureContent = '';
        $scope.featureContentList = {};

        $scope.changeFeatureContent = function() {
            var list = {
                '精神残疾': [
                    '一级智障',
                    '二级智障',
                    '三级智障',
                    '四级智障'
                ],
                '肢体残疾': [
                    '一级残疾',
                    '二级残疾',
                    '三级残疾',
                    '四级残疾'
                ]
            };

            $scope.featureContentList = list[$scope.currentFeature];
        }

        $scope.changeFeatureFileds = function(v) {

            if(typeof $scope.inserOldInfo.feature != 'undefined') {
                $scope.inserOldInfo.feature += ' ' + $scope.currentFeatureContent;
            }else {
                $scope.inserOldInfo.feature = $scope.currentFeatureContent;
            }
            
        }

    }

})();
