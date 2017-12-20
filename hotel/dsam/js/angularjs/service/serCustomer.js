/**
 * Created by Admin on 7/4/16.
 */

app.service('CustomerService', function($http){

    return{
        getCustomerAllList: function(){
            return $http.get('../api/customer').then(function(response){
                return response.data;
            });
        },
        getCustomerView: function(id){
            return $http.get('../api/customer/'+id).then(function(response){
                return response.data;
            });
        },
        getCustomerCreate: function(data){
            return $http.post('../Customer/SetCreate', data).then(function(response){
                return response.data;
            });
        },
        getCustomerUpdate: function(data){
            return $http.post('../Customer/SetUpdate', data).then(function(response){
                return response.data;
            });
        },
        getCustomerDelete: function(id){
            return $http.delete('../api/customer/'+id).then(function(response){
                return response.data;
            });
        }
    };

});