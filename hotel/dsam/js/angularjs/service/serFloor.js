/**
 * Created by Admin on 6/7/16.
 */

app.service('FloorService', function($http){

    return {
        getFloorList: function(id){
            return $http.get('../../api/floor/'+id).then(function(response){
                return response.data;
            });
        },
        getFloorView: function(id){
            return $http.get('../../api/floorByPK/'+id).then(function(response){
                return response.data;
            });
        },
        getFloorForTheBuilding : function(){
            return $http.get('../../api/floor').then(function(response){
                return response.data;
            });
        },
        getFloorUpdate : function(data){
            return $http.post('../../Floor/SetUpdate/', data).then(function(response){
                return response.data;
            });
        },
        getFloorDelete: function(id){
            return $http.delete('../../api/floor/'+id).then(function(response){
                return response;
            });
        }
    };

});