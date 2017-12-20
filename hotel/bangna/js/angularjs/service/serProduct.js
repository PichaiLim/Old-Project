/**
 * Created by Admin on 7/5/16.
 */

app.service('ProductService', function($http, URL){
    return {
        getProductAllList: function(){
            return $http.get(URL + '/api/product').then(function(response){
                return response.data;
            })
        },
        getProductView: function(id){
            return $http.get(URL + '/api/product/'+id).then(function(response){
                return response.data;
            })
        },
        getProductCreate: function(data){
            return $http.post(URL + '/Product/SetCreate/', data).then(function(response){
                return response.data;
            })
        },
        getProductUpdate: function(data){
            return $http.post(URL + '/Product/SetUpdate/', data).then(function(response){
                return response.data;
            })
        },
        getProductDelete: function(data){
            return $http.post(URL + '/Product/DeleteProduct/', data).then(function(response){
                return response.status;
            })
        }
    };
});