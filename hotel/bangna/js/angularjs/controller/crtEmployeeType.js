/**
 * Created by Admin on 7/7/16.
 */

app.controller('EmployeeTypeController', function($scope, $http, $routeParams, $location, EmployeeTypeService) {
    var $scope = this;
    $scope.titleheader = "เพิ่มประเภท";

    /**
     * List on Index
     * */
    EmployeeTypeService.getEmployeeTypeAll().then(function(data) {
        $scope.listEmployeeType = data;
    });

    /**
     * Create
     * */
    $scope.btnSave = function() {
        var data = {
            'id': $scope.id,
            'name': $scope.name,
            'remark': $scope.remark,
            'created': $scope.created,
            'created_by': $('#created_by').val(),
            'updated': null,
            'updated_by': null
        };

        EmployeeTypeService.getEmployeeTypeCreate(data).then(function(data) {
            if (data.success == false) {
                $location.path('/');
                window.location.reload(false);
            }
        });
    };

    /**
     * Update
     * */
    $scope.btnUpdate = function(id) {
        $scope.titleheader = "แก้ไขประเภท";
        ViewList(id);
    }

    $scope.btnSaveUpdate = function() {
        var data = {
            'id': $scope.id,
            'name': $scope.name,
            'remark': $scope.remark,
            'created': $scope.created,
            'created_by': $scope.created_by,
            'updated': $scope.updated,
            'updated_by': $('#updated_by').val()
        };

        EmployeeTypeService.getEmployeeTypeUpdate(data).then(function(data) {
            if (data.success == false) {
                $location.path('/');
                window.location.reload(false);
            }
        });
    };


    $scope.btnDelete = function(id) {
        ViewList(id);
    };

    $scope.confirmDelete = function(id) {
        EmployeeTypeService.getEmployeeTypeDelete({
            id: id
        }).then(function() {
            $location.path('/');
            window.location.reload(false);
        });
    };


    /**
     * function
     * */
    var ViewList = function(id) {
        EmployeeTypeService.getEmployeeType(id).then(function(data) {
            $scope.id = data['id'];
            $scope.name = data['name'];
            $scope.remark = data['remark'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.updated = data['updated'];
            $scope.updated_by = data['updated_by'];
        });
    }

});