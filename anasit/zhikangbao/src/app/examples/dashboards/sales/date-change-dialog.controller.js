(function() {
    'use strict';

    angular
        .module('app.examples.dashboards')
        .controller('DateChangeDialogController', DateChangeDialogController);

    /* @ngInject */
    function DateChangeDialogController($mdDialog, range) {
        var vm = this;
        vm.cancelClick = cancelClick;
        vm.okClick = okClick;

        ////////////////

        function okClick() {
            saveBitsToMoment(vm.start, range.start);
            saveBitsToMoment(vm.end, range.end);
            $mdDialog.hide();
        }

        function cancelClick() {
            $mdDialog.cancel();
        }

        function createDateSelectOptions() {
            // create options for date select boxes (this will be removed in favor of mdDatetime picker when it becomes available)
            vm.dateSelectOptions = {
                years: [],
                months: ['CALENDAR.MONTHNAMES.JANUARY','CALENDAR.MONTHNAMES.FEBRUARY','CALENDAR.MONTHNAMES.MARCH','CALENDAR.MONTHNAMES.APRIL','CALENDAR.MONTHNAMES.MAY','CALENDAR.MONTHNAMES.JUNE','CALENDAR.MONTHNAMES.JULY','CALENDAR.MONTHNAMES.AUGUST','CALENDAR.MONTHNAMES.SEPTEMBER','CALENDAR.MONTHNAMES.OCTOBER','CALENDAR.MONTHNAMES.NOVEMBER', 'CALENDAR.MONTHNAMES.DECEMBER'],
                dates: [],
                hours: [],
                minutes: []
            };
            // years
            var now = new Date();
            for(var year = now.getFullYear() - 5; year <= now.getFullYear() + 5; year++) {
                vm.dateSelectOptions.years.push(year);
            }
            // days
            for(var date = 1; date <= 31; date++) {
                vm.dateSelectOptions.dates.push(date);
            }
            // hours
            for(var hour = 0; hour <= 23; hour++) {
                vm.dateSelectOptions.hours.push(hour);
            }
            // minutes
            for(var minute = 0; minute <= 59; minute++) {
                vm.dateSelectOptions.minutes.push(minute);
            }
        }

        function convertMomentToBits(moment) {
            return {
                year: moment.year(),
                month: moment.month(),
                date: moment.date(),
                hour: moment.hour(),
                minute: moment.minute()
            };
        }

        function saveBitsToMoment(bits, moment) {
            moment.year(bits.year);
            moment.month(bits.month);
            moment.date(bits.date);
            moment.hour(bits.hour);
            moment.minute(bits.minute);
        }

        // init

        createDateSelectOptions();

        vm.start = convertMomentToBits(range.start);
        vm.end = convertMomentToBits(range.end);
    }
})();