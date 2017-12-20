/**
 * Created by Admin on 6/6/16.
 */
app.service('buildingService', function($http){

    return {
        getBuildingList : function(id){
            return $http.get('../../api/buildingByBranchID/'+id).then(function(response){
                return response.data;
            });
        },
        getBuildingView : function (id) {
            return $http.get('../../api/building/'+id).then(function(response){
                return response.data;
            });
        },
        getBuildingCreate : function(data){
            return $http.post('../../Building/SetCreate', data).then(function(response){
                return response.data;
            });
        },
        getBuildingUpdate : function(data){
            return $http.post('../../Building/SetUpdate/', data).then(function(response){
                return response.data;
            });
        },
        getBuildingDelete: function(id){
            return $http.delete('../../api/building/'+id).then(function(response){
                return response;
            });
        }
    };

});