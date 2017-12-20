/**
 * Created by Admin on 7/20/16.
 */

app.service('ReservationService', function($http, URL) {
    return {
        getBranchByFk: function(id) {
            return $http.get('../../api/buildingByBranchID/' + id).then(function(response) {
                return response.data;
            });
        },
        getFloorByFK: function(id) {
            return $http.get('../../api/floor/' + id).then(function(response) {
                return response.data;
            });
        },
        getRoomNameByPK: function(id) {
            return $http.get(URL + '/api/roomName/' + id).then(function(response) {
                return response.data;
            });
        },
        getRoomByRoomIdAndBranchId: function(data) {
            return $http.post('../../Room/ViewRoomByRoomIdAndBranchId/', data);
        },
        getRoomByFK: function(data) {
            return $http.post(URL + '/Room/ViewOnPageReservation/', data).then(function(response) {
                return response.data;
            });
        },
        getReservationDataAll: function(data) {
            return $http.post(URL + '/Reservation/RoomCheckout/', data).then(function(response) {
                return response.data;
            });
        },
        getReportDaily: function(data) {
            return $http.post(URL + '/Report/reportDaily/', data).then(function(response) {
                return response.data;
            });
        },
        getReportSummaryDaily: function(data) {
            return $http.post(URL + '/Report/reportSummaryDaily/', data).then(function(response) {
                return response.data;
            });
        },
        getPaymentAll: function(id) {
            return $http.get(URL + '/api/paymentList/' + id).then(function(response) {
                return response.data;
            });
        },
        getReservationByStartDate: function(data) {
            return $http.post(URL + '/Reservation/ViewReservationByStartDate/', data);
        },
        getRoomNotReservation: function(data) {
            return $http.post(URL + '/Room/ViewRoomNotReservation/', data);
        },
        getReservationByPk: function(id) {
            return $http.get(URL + '/api/reservationByPk/' + id);
        },
        countStatusRoom: function(data) {
            return $http.post(URL + '/Reservation/CountStatusRoom/', data);
        },
        getReservationHistoryAll: function(id) {
            return $http.get(URL + '/api/reservation_history/' + id).then(function(response) {
                return response.data;
            });
        },
        getReservationHistoryMore: function(id) {
            return $http.get(URL + '/api/reservation_history_more/' + id).then(function(response) {
                return response.data;
            });
        },
        setRoomUpdateStatusActive: function(data) {
            return $http.post('../../Room/UpdateStatusActive/', data).then(function(response) {
                return response.data;
            });
        },
        getCustomerAll: function() {
            return $http.get(URL + '/api/customer').then(function(response) {
                return response.data;
            });
        },
        getCustomerFilter: function(data) {
            return $http.post('../../Customer/CustomerFilterName/', data).then(function(response) {
                return response.data;
            }, function() {
                return $http.get('../../api/custometLimitShow').then(function(response) {
                    return response.data;
                });
            });
        },
        getReservationFindByRoomId: function(id) {
            return $http.get('../../api/roomOnReservice/' + id).then(function(response) {
                return response.data;
            });
        },
        saveReservation: function(data) {
            return $http.post(URL + '/Reservation/SetBooking/', data);
        },
        saveReservationHistory: function(data) {
            return $http.post(URL + '/ReservationHistory/SetReservationHistory/', data);
        },
        updateReservation: function(data) {
            return $http.post(URL + '/Reservation/UpdateReservation/', data);
        },
        updateDeposit: function(data) {
            return $http.post(URL + '/Customer/UpdateDeposit/', data);
        },
        getDepositInCustomerByPK: function(id) {
            return $http.get(URL + '/api/depositInCustomerByPK/' + id).then(function(response) {
                return response.data.deposit;
            });
        },
        validateDateRoomReservedOrCheckin: function(data) {
            return $http.post(URL + '/Reservation/ValidateDateRoomReservedOrCheckin/', data).then(function(response) {
                return response.data;
            });
        },
    };
});