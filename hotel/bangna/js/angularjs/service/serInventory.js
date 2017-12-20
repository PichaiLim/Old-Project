/**
 * Created by Admin on 7/11/16.
 */

app.service('InventoryService', function($http, URL) {
    return {
        getInventoryList: function(id) {
            return $http.get(URL + '/api/inventory/' + id).then(function(response) {
                return response.data;
            });
        },
        getInventoryNotProductByBranchIDList: function(id) {
            return $http.get(URL + '/api/addInventoryNotProductByBranchID/' + id);
        },
        getProductHaveInventoryByBranchIDList: function() {
            return $http.post(URL + '/Inventory/ViewProductHaveInventoryByBranchIDList/').then(function(response) {
                return response.data;
            });
        },
        saveInventory: function(data) {
            return $http.post(URL + '/Inventory/SaveInventory/', data).then(function(response) {
                return response.data;
            });
        }
    };
});

app.service('InventoryPushService', function($http, URL) {
    return {
        getInventoryPushList: function(id) {
            return $http.get(URL + '/api/inventory_push/' + id).then(function(response) {
                return response.data;
            });
        },
        getInventoryUpdate: function(data) {
            return $http.post(URL + '/InventoryPush/SetCreate/', data).then(function(response) {
                return response.data;
            });
        },
        getInventoryPushDetailList: function(id) {
            return $http.get(URL + '/api/inventory_push_detail_list/' + id).then(function(response) {
                return response.data;
            });
        },
        getLastInventoryPushRecieptNo: function() {
            return $http.post(URL + '/InventoryPush/ViewLastInventoryPushRecieptNo/').then(function(response) {
                return response.data;
            });
        },
        verifyRecieptNo: function(id) {
            return $http.get(URL + '/api/verifyRecieptNo/' + id).then(function(response) {
                return response.data;
            });
        }
    };
});
app.service('InventoryPullService', function($http, URL) {
    return {
        getInventoryPullList: function(id) {
            return $http.get(URL + '/api/inventory_pull/' + id).then(function(response) {
                return response.data;
            });
        },
        getInventoryUpdate: function(data) {
            return $http.post(URL + '/InventoryPull/SetCreate/', data).then(function(response) {
                return response.data;
            });
        },
        getInventoryPullDetailList: function(id) {
            return $http.get(URL + '/api/inventory_pull_detail_list/' + id).then(function(response) {
                return response.data;
            });
        },
        getLastInventoryPullRecieptNo: function() {
            return $http.post(URL + '/InventoryPull/ViewLastInventoryPullRecieptNo/').then(function(response) {
                return response.data;
            });
        }
    };
});