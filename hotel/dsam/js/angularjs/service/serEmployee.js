/**
 * Created by Admin on 6/15/16.
 */


app.service('EmployeeService', function($http){

    return {
        getEmployeeList: function(){
            return $http.get('../../api/employee/').then(function(response){
                if(response.status == 200)
                {
                    return response.data;
                }
            });
        },
        getEmployeeView: function(id){
            return $http.get('../../api/employee/'+id).then(function(response){
                return response.data;
            });
        },
        getEmployeeViewOnPageIndex: function(id){
            return $http.get('index.php/api/employee/'+id).then(function(response){
                return response.data;
            });
        },
        setEmployeeCreate: function(data){
            return $http.post('../../Employee/SetCreate/', data).then(function(response){
                return response;
            });
        },
        getEmployeeUpdate: function(data){
            return $http.post('../../Employee/SetUpdate/', data).then(function(response){
                return response.data;
            });
        },
        setEmployeeUpdateProfile: function(data){
            return $http.post('../../Employee/SetUpdateProfile/', data).then(function(response){
                return response.data;
            });
        },
        setEmployeeUpdateProfileOnPageIndex: function(data){
            return $http.post('index.php/Employee/SetUpdateProfile/', data).then(function(response){
                return response.data;
            });
        },

        setEmployeeChangePasswordOnPageIndex: function(data){
            return $http.post('index.php/Employee/SetChnagePassword/', data).then(function(response){
                return response.data;
            });
        },
        setEmployeeChangePassword: function(data){
            return $http.post('../../Employee/SetChnagePassword/', data).then(function(response){
                return response.data;
            });
        }
    };

});