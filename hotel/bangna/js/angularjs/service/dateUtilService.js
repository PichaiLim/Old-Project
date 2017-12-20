(function() {
    angular.module("dsam")
        .service("DateUtilService", DateUtilService);

    function DateUtilService(moment) {
        this.dateDiff = function(date1, date2) {
            if (date1 && date2) {
                var start = moment(date1, 'YYYY/MM/DD');
                var end = moment(date2, 'YYYY/MM/DD');
                return end.diff(start, 'days');
            }
        };

        this.dateNow = function(){
            var date = new Date();
            return (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear().toString().substr(2,2);
        };

        this.yearNow = function(){
            var dateNow = new Date();
            return (dateNow.getFullYear() + 543).toString().substr(2, 2);
        };
    }

})();
