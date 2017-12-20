/**
 * Created by Admin on 6/7/16.
 */

app.service('FloorService', function($http, URL){

    return {
        getFloorList: function(id){
            return $http.get(URL + '/api/floor/'+id).then(function(response){
                return response.data;
            });
        },
        getFloorView: function(id){
            return $http.get(URL + '/api/floorByPK/'+id).then(function(response){
                return response.data;
            });
        },
        getFloorForTheBuilding : function(){
            return $http.get(URL + '/api/floor').then(function(response){
                return response.data;
            });
        },
        getFloorUpdate : function(data){
            return $http.post(URL + '/Floor/SetUpdate/', data).then(function(response){
                return response.data;
            });
        },
        getFloorDelete: function(data){
            return $http.post(URL + '/Floor/DeleteFloor', data).then(function(response){
                return response;
            });
        },
        getBuilding: function() {
            return $http.get(URL + '/api/building/').then(function(response) {
                return response.data;
            });
        },
    };

});