/**
 * Created by Admin on 6/15/16.
 */


app.service('EmployeeService', function($http, URL) {

    return {
        getEmployeeList: function() {
            return $http.get(URL + '/api/employee/').then(function(response) {
                if (response.status == 200) {
                    return response.data;
                }
            });
        },
        getEmployeeView: function(id) {
            return $http.get(URL + '/api/employee/' + id).then(function(response) {
                return response.data;
            });
        },
        getEmployeeViewOnPageIndex: function(id) {
            return $http.get(URL + '/api/employee/' + id).then(function(response) {
                return response.data;
            });
        },
        setEmployeeCreate: function(data) {
            return $http.post(URL + '/Employee/SetCreate/', data).then(function(response) {
                return response;
            });
        },
        getEmployeeUpdate: function(data) {
            return $http.post(URL + '/Employee/SetUpdate/', data).then(function(response) {
                return response.data;
            });
        },
        setEmployeeUpdateProfile: function(data) {
            return $http.post(URL + '/Employee/SetUpdateProfile/', data).then(function(response) {
                return response.data;
            });
        },
        setEmployeeUpdateProfileOnPageIndex: function(data) {
            return $http.post(URL + '/Employee/SetUpdateProfile/', data).then(function(response) {
                return response.data;
            });
        },

        setEmployeeChangePasswordOnPageIndex: function(data) {
            return $http.post(URL + '/Employee/SetChnagePassword/', data).then(function(response) {
                return response.data;
            });
        },
        setEmployeeChangePassword: function(data) {
            return $http.post(URL + '/Employee/SetChnagePassword/', data).then(function(response) {
                return response.data;
            });
        },
        getEmployeeTypeList: function() {
            return $http.get(URL + '/api/employee_type/').then(function(response) {
                return response.data;
            });
        },
        getBranchList: function() {
            return $http.get(URL + '/api/branch/').then(function(response) {
                return response.data;
            });
        },
        getEmployeeBranchForEdit: function(data) {
            return $http.post(URL + '/Employee/ViewEmployeeBranchEdit/', data).then(function(response) {
                return response.data;
            });
        },
        deletedEmployeeAndEmployeeBranch: function(data) {
            return $http.post(URL + '/Employee/DeletedEmployee/', data).then(function(response) {
                return response.data;
            });
        }
    };

});