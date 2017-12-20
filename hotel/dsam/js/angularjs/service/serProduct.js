/**
 * Created by Admin on 7/5/16.
 */

app.service('ProductService', function($http){
    return {
        getProductAllList: function(){
            return $http.get('../api/product').then(function(response){
                return response.data;
            })
        },
        getProductView: function(id){
            return $http.get('../api/product/'+id).then(function(response){
                return response.data;
            })
        },
        getProductCreate: function(data){
            return $http.post('../Product/SetCreate/', data).then(function(response){
                return response.data;
            })
        },
        getProductUpdate: function(data){
            return $http.post('../Product/SetUpdate/', data).then(function(response){
                return response.data;
            })
        },
        getProductDelete: function(id){
            return $http.delete('../api/product/'+id).then(function(response){
                return response.status;
            })
        }
    };
});