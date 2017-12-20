/**
 * Created by Admin on 6/8/16.
 */


app.service('RoomTypeService', function($http, URL) {

    return {
        getRoomTypeList: function(id) {
            return $http.post(URL + '/RoomType/ViewRoomtypeByBranchID/', id).then(function(response) {
                return response.data;
            });
        },
        getRoomTypeView: function(id) {
            return $http.get(URL + '/api/roomtype/' + id).then(function(response) {
                return response.data;
            });
        },
        getBranchViewByPk: function(id) {
            return $http.get(URL + '/api/branch/' + id).then(function(response) {
                return response.data;
            });
        },
        getRoomTypeCreate: function(data) {
            return $http.post(URL + '/RoomType/SetCreate', data).then(function(response) {
                    return response.data;
                },
                function(response) {
                    console.log(response);
                });
        },
        getName: function(data) {
            return $http.post(URL + '/RoomType/ChkName', data).then(function(response) {
                return response.data;
            });
        },
        getRoomTypeUpdate: function(id) {
            return $http.put(URL + '/api/roomtype/' + id).then(function(response) {
                return response.data;
            });
        },
        getNameEmpOfRoomType: function(id) {
            return $http.get(URL + '/api/employee/' + id, {
                datatype: 'json'
            }).then(function(response) {
                return response.data;
            });
        },
        getRoomTypeDelete: function(data) {
            return $http.post(URL + '/RoomType/DeleteRoomType', data).then(function(response) {
                return response.data;
            });
        }
    };

});