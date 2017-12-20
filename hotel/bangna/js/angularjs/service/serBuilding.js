/**
 * Created by Admin on 6/6/16.
 */
app.service('buildingService', function($http, URL){

    return {
        getBuildingList : function(id){
            return $http.get(URL + '/api/buildingByBranchID/'+id).then(function(response){
                return response.data;
            });
        },
        getBuildingView : function (id) {
            return $http.get(URL + '/api/building/'+id).then(function(response){
                return response.data;
            });
        },
        getBuildingCreate : function(data){
            return $http.post(URL + '/Building/SetCreate', data).then(function(response){
                return response.data;
            });
        },
        getBuildingUpdate : function(data){
            return $http.post(URL + '/Building/SetUpdate/', data).then(function(response){
                return response.data;
            });
        },
        getBuildingDelete: function(data){
            return $http.post(URL + '/Building/DeleteBuilding', data).then(function(response){
                return response;
            });
        }
    };

});