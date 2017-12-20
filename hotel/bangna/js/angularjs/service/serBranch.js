/**
 * Created by Admin on 6/13/16.
 */


app.service('BranchSerivce', function($http, URL) {

    return {
        getBranchList: function() {
            return $http.get(URL + '/Branch/BranchListAll').then(function(response) {
                return response.data;
            });
        },
        getBranchView: function(id) {
            return $http.get(URL + '/api/branch/' + id).then(function(response) {
                return response.data;
            });
        },
        getBranchCreate: function(data) {
            return $http.post(URL + '/Branch/SetCreate', data).then(function(response) {
                return response.data;
            });
        },
        getBranchUpdate: function(data) {
            return $http.post(URL + '/Branch/SetUpdate/', data).then(function(response) {
                return response.data;
            });
        },
        getBranchDelete: function(data) {
            return $http.post(URL + '/Branch/DeleteBranch/', data).then(function(response) {
                return response.data;
            });
        }
    };

});