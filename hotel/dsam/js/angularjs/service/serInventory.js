/**
 * Created by Admin on 7/11/16.
 */

app.service('InventoryService', function($http){
    return {
        getInventoryList: function(id){
            return $http.get('../../api/inventory/'+id).then(function(response){
                return response.    data;
            },
            function(response){
                return 'Error: '+response.data;
            });
        },
        getEmployeeList: function(){
            return $http.get('../../api/employee').then(function(response){
                return response.data;
            },
            function(response){
                return 'Error: '+response.data;
            });
        }
    };
});

app.service('InventoryPushService', function($http){
    return {
        getInventoryPushList: function(id){
            return $http.get('../../api/inventory_push/'+id).then(function(response){
                return response.data;
            });
        },
        getInventoryUpdate: function(data){
            return $http.post('../../InventoryPush/SetCreate/', data).then(function(response){
                return response.data;
            });
        }
    };
});
app.service('InventoryPullService', function($http){
    return {
        getInventoryPullList: function(id){
            return $http.get('../../api/inventory_pull/'+id).then(function(response){
                return response.data;
            });
        },
        getInventoryUpdate: function(data){
            return $http.post('../../InventoryPull/SetCreate/', data).then(function(response){
                return response.data;
            });
        }
    };
});