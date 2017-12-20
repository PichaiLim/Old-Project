/**
 * Created by Admin on 6/13/16.
 */


app.service('BranchSerivce', function($http){

    return {
        getBranchList : function(){
            return $http.get('../../api/branch').then(function(response){
                return response.data;
            });
        },
        getBranchView : function(id){
            return $http.get('../../index.php/api/branch/'+id).then(function(response){
                return response.data;
            });
        },
        getBranchCreate: function(data){
            return $http.post('index.php/Branch/SetCreate', data).then(function(response){
                return response.data;
            });
        },
        getBranchUpdate: function(data){
            return $http.put('../../index.php/Branch/SetUpdate/', data).then(function(response){
                return response.data;
            });
        },
        getBranchDelete: function(id){
            return $http.delete('../../index.php/api/branch/'+id).then(function(response){
                return response.data;
            });
        }
    };

});