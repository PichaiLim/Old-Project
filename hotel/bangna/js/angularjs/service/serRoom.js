/**
 * Created by Admin on 6/7/16.
 */


app.service('RoomService', function($http, URL) {

    return {
        getRoomList: function() {
            return $http.get(URL + '/Room/ViewRoomAll').then(function(response) {
                return response.data;
            });
        },
        getRoomView: function(id) {
            return $http.get(URL + '/api/room/' + id).then(function(response) {
                return response.data;
            });
        },
        setRoomCreate: function(data) {
            return $http.post(URL + '/Room/SetCreate/', data).then(function(response) {
                return response;
            });
        },
        setRoomUpdate: function(data) {
            return $http.post(URL + '/Room/SetUpdate/', data).then(function(response) {
                return response;
            });
        },
        getRoomDelete: function(data) {
            return $http.post(URL + '/Room/DeleteRoom', data).then(function(response) {
                return response;
            });
        },

        /**
         * Get data "Select"
         * */
        getRoomForTheBuilding: function() {
            return $http.get('../../api/building/').then(function(response) {
                return response.data;
            });
        },
        getRoomForTheFloor: function() {
            return $http.get('../../api/floor/').then(function(response) {
                return response.data;
            });
        },
        getRoomForTypeRoom: function() {
            return $http.get('../../api/roomtype/').then(function(response) {
                return response.data;
            });
        }
    };

});