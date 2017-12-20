/**
 * Created by Admin on 6/7/16.
 */


app.service('RoomService', function($http){

    return {
        getRoomList: function(){
            return $http.get('../../api/room').then(function(response){
                return response.data;
            });
        },
        getRoomView: function(id){
            return $http.get('../../api/room/'+id).then(function(response){
                return response.data;
            });
        },
        setRoomCreate : function(data){
            return $http.post('../../Room/SetCreate/', data).then(function(response){
                return response;
            });
        },
        setRoomUpdate: function(data){
            return $http.post('../../Room/SetUpdate/', data).then(function(response){
                return response;
            });
        },
        getRoomDelete : function(id){
            return $http.delete('../../api/room/'+id).then(function(response){
                return response;
            });
        },

        /**
         * Get data "Select"
         * */
        getRoomForTheBuilding : function(){
            return $http.get('../../api/building/').then(function(response){
                return response.data;
            });
        },
        getRoomForTheFloor : function(){
            return $http.get('../../api/floor/').then(function(response){
                return response.data;
            });
        },
        getRoomForTypeRoom : function () {
            return $http.get('../../api/roomtype/').then(function(response){
                return response.data;
            });
        }
    };

});