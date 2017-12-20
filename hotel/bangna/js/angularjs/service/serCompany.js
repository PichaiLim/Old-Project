app.service('CompanyService', function($http, URL) {
    return {
        getCompanyView: function() {
            return $http.get(URL + '/Company/ViewCompany').then(function(response) {
                return response.data;
            });
        },
        companyUpdate: function(data) {
            return $http.post(URL + '/Company/UpdateCompany', data).then(function(response) {
                return response.data;
            });
        }
    };

});