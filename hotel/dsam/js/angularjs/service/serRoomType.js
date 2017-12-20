/**
 * Created by Admin on 6/8/16.
 */


app.service('RoomTypeService', function($http){

    return{
        getRoomTypeList: function(id){
            return $http.get('../../api/roomtypeByBranchID/'+id).then(function(response){
                return response.data;
            });
        },
        getRoomTypeView: function(id){
            return $http.get('../../api/roomtype/'+id).then(function(response){
                return response.data;
            });
        },
        getBranchViewByPk: function(id){
            return $http.get('../../api/branch/'+id).then(function(response){
                return response.data;
            });
        },
        getRoomTypeCreate: function(data){
            return $http.post('../../RoomType/SetCreate',data).then(function(response){
                return response.data;
            },
            function(response){
                console.log(response);
            });
        },
        getName : function(data){
            return $http.post('../../RoomType/ChkName', data).then(function(response){
                return response.data;
            });
        },
        getRoomTypeUpdate: function(id){
            return $http.put('../../api/roomtype/'+id).then(function(response){
                return response.data;
            });
        },
        getNameEmpOfRoomType: function(id){
            return $http.get('../../api/employee/'+id, {datatype: 'json'}).then(function(response){
                return response.data;
            });
        },
        getRoomTypeDelete: function(id){
            return $http.delete('../../api/roomtype/'+id, {dataType: 'json'}).then(function(response){
                return response.data;
            });
        }
    };

});