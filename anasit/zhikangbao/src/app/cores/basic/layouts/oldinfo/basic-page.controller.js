(function() {
    'use strict';

    angular
        .module('app.cores.basic')
        .controller('BasicPageController', BasicPageController);

    /* @ngInject */
    function BasicPageController($scope, $state, $mdDialog, OldInfoService, $location, CsvImporterService) {
        var vm = this;

        $scope.addNew = function() {

            var name = $state.current.name;

            console.log(name);

            if(name.indexOf('org-system-org') != -1) {
                $state.go('triangular.admin-default.department-new-oldman');
            }else if(name.indexOf('community') != -1) {
                $state.go('triangular.admin-default.community-new-oldman');
            }else {
               $state.go('triangular.admin-default.new-oldman');
            }
            
        } 

        $scope.donwloadCsvTemplate = function() {
            window.open('http://api.zkkj168.com/oldInfo.csv');
        }

        $scope.openUploadDialog = function($event) {
            window.open('http://api.zkkj168.com/a/','_blank','height=500px,width=750px,menubar=no,titlebar=no,scrollbar=no,toolbar=no,status=no,location=no,resizable=no');
            // $('#upload-modal').modal('show');
            // $('.modal-backdrop').css('z-index','0');
        }

        $('#upload-modal').on('hidden.bs.modal', function (e) {
            $('.modal-backdrop').css('z-index','1040');
        });

        $scope.downloadCsvFile = function() {
            CsvImporterService.download().then(function(data){
                window.open('http://api.zkkj168.com/a/download/' + data);
            });
        };

    }

})();
