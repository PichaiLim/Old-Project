/**
 * Created by Admin on 7/7/16.
 */

app.service('EmployeeTypeService', function($http){
    return {
        getEmployeeTypeAll : function(){
            return $http.get('../api/employee_type/').then(function(response){
                return response.data;
            });
        },
        getEmployeeType : function(id){
            return $http.get('../api/employee_type/'+id).then(function(response){
                return response.data;
            });
        },
        getEmployeeTypeCreate: function(data){
            return $http.post('../EmployeeType/SetCreate', data).then(function(response){
                return response.data;
            });
        },
        getEmployeeTypeUpdate: function(data){
            return $http.post('../EmployeeType/SetUpdate', data).then(function(response){
                return response.data;
            });
        },
        getEmployeeTypeDelete: function(id){
            return $http.delete('../api/employee_type/'+id).then(function(response){
                return response.data;
            });
        }
    };
});