/**
 * Created by Admin on 7/20/16.
 */

app.service('ReservationService', function($http){
    return{
        getBranchByFk: function(id){
            return $http.get('../../api/buildingByBranchID/'+id).then(function(response){

               return response.data;

            });
        },
        getFloorByFK: function(id){
            return $http.get('../../api/floor/'+id).then(function(response){
                return response.data;
            });
        },
        getRoomByPK: function(id){
            return $http.get('../../api/room/'+id).then(function(response){
                return response.data;
            });
        },
        getRoomByFK: function(data){
            return $http.post('../../Room/ViewOnPageReservation/', data).then(function(response){
                return response.data;
            });
        },
        getReservationDataAll: function(id){
            return $http.get('../../api/reservation/'+id).then(function(response){
                return response.data;
            });
        },
        getReservationHistoryAll: function(id){
            return $http.get('../../api/reservation_history/'+id).then(function(response){
                return response.data;
            });
        },
        setRoomUpdateStatusActive: function(data){
            return $http.post('../../Room/UpdateStatusActive/', data).then(function(response){
                return response.data;
            });
        },
        getCustomerLimitShow: function(){
            return $http.get('../../api/custometLimitShow').then(function(response){
                return response.data;
            });
        },
        getCustomerFilter: function(data){
            return $http.post('../../Customer/CustomerFilterName/', data).then(function(response){
                return response.data;
            },function(){
                return $http.get('../../api/custometLimitShow').then(function(response){
                    return response.data;
                });
            });
        },
        getReservationFindByRoomId: function(id){
            return $http.get('../../api/roomOnReservice/'+id).then(function(response){
                return response.data;
            });
        }


    };
});