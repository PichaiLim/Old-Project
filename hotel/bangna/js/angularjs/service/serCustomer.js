/**
 * Created by Admin on 7/4/16.
 */

app.service('CustomerService', function($http, URL) {

    return {
        getCustomerAllList: function() {
            return $http.get(URL + '/Customer/ViewCustomerList').then(function(response) {
                return response.data;
            });
        },
        getCustomerView: function(id) {
            return $http.get(URL + '/api/customer/' + id).then(function(response) {
                return response.data;
            });
        },
        getCustomerCreate: function(data) {
            return $http.post(URL + '/Customer/SetCreate', data).then(function(response) {
                return response.data;
            });
        },
        validateNameAndLastName: function(data) {
            return $http.post(URL + '/Customer/ValidateName', data).then(function(response) {
                return response.data;
            });
        },
        getCustomerUpdate: function(data) {
            return $http.post(URL + '/Customer/SetUpdate', data).then(function(response) {
                return response.data;
            });
        },
        getCustomerDelete: function(id) {
            return $http.post(URL + '/Customer/DeleteCustomer', id).then(function(response) {
                return response.data;
            });
        },
        getProvince: function() {
            return $http.get(URL + '/api/province/');
        },
        getDistrict: function(id) {
            return $http.get(URL + '/api/district/' + id);
        },
        getArea: function(id) {
            return $http.get(URL + '/api/area/' + id);
        },
        getPostalCode: function(id) {
            return $http.get(URL + '/api/postal_code/' + id);
        }
    };

});