/**
 * Created by Admin on 7/7/16.
 */

app.service('EmployeeTypeService', function($http, URL) {
    return {
        getEmployeeTypeAll: function(data) {
            return $http.post(URL + '/EmployeeType/ViewEmployeeTypeAll', data).then(function(response) {
                return response.data;
            });
        },
        getEmployeeType: function(id) {
            return $http.get(URL + '/api/employee_type/' + id).then(function(response) {
                return response.data;
            });
        },
        getEmployeeTypeCreate: function(data) {
            return $http.post(URL + '/EmployeeType/SetCreate', data).then(function(response) {
                return response.data;
            });
        },
        getEmployeeTypeUpdate: function(data) {
            return $http.post(URL + '/EmployeeType/SetUpdate', data).then(function(response) {
                return response.data;
            });
        },
        getEmployeeTypeDelete: function(data) {
            return $http.post(URL + '/EmployeeType/DeleteEmployeeType', data).then(function(response) {
                return response.data;
            });
        }
    };
});