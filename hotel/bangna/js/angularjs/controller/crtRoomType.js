/**
 * Created by Admin on 6/8/16.
 */

var branch_id = 0;

app.controller('RoomTypeController', function($scope, RoomTypeService, $location, $http, $routeParams) {

    var $scope = this;
    var branch_id = $('#create').attr('data-value');

    $scope.roomTypeList = [];

    // get params
    $scope.roomTypeId = 0;
    $scope.roomTypeName = '';

    // Get list data
    $scope.RoomTypeDataList = function() {
        RoomTypeService.getRoomTypeList({
            id: branch_id
        }).then(function(data) {
            $scope.roomTypeList = data;
        });
    };

    // Sort Data
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };

    /**
     * Create
     * */
    // Get data on model 'Create'
    $scope.btnAdd = function() {
        $scope.titleheader = "เพิ่มประเภทห้อง";
        $scope.created = new Date();
        $scope.active = 1;
        $scope.published = 1;
        $scope.created_by = $('#created_by').val();

        RoomTypeService.getBranchViewByPk(branch_id).then(function(data) {
            $scope.branch_id = data.id;
            $scope.branch_name = data.name;
        });

    };

    $scope.btnCreate = function() {

        var data = {
            'id': null,
            'branch_id': $scope.branch_id,
            'created': $scope.created,
            'created_by': $scope.created_by,
            'updated': null,
            'updated_by': null,
            'active': $scope.active,
            'published': $scope.published,
            'price': $scope.price,
            'deposit': $scope.deposit,
            'name': $scope.name,
            'remark': $scope.remark,
            'seo_title': $scope.seo_title,
            'seo_description': $scope.seo_description,
            'seo_keywords': $scope.seo_keywords
        };

        RoomTypeService.getRoomTypeCreate(data).then(function(data) {
            window.location.reload(false);
        });
    };


    /**
     * Update
     * */
    $scope.btnUpdate = function(id) {
        $scope.titleheader = "แก้ไข";
        RoomTypeService.getRoomTypeView(id).then(function(data) {
            $scope.id = id;
            $scope.created = data.created;
            $scope.created_by = data.created_by;
            $scope.updated = new Date();
            $scope.updated_by = $("#updated_by").val();
            $scope.active = data.active;
            $scope.published = data.published;
            $scope.price = parseFloat(data.price);
            $scope.deposit = parseFloat(data.deposit);
            $scope.name = data.name;
            $scope.remark = data.remark;
            $scope.seo_title = data.seo_title;
            $scope.seo_description = data.seo_description;
            $scope.seo_keywords = data.seo_keywords;

            // Get name Branch
            RoomTypeService.getBranchViewByPk(data.branch_id).then(function(data) {
                $scope.branch_id = data.id;
                $scope.branch_name = data.name;
            });


        });
    };

    $scope.Update = function() {

        var dataUpdate = {
            "id": $scope.id,
            "branch_id": $scope.branch_id,
            "created": $scope.created,
            "created_by": $scope.created_by,
            "updated": new Date(),
            "updated_by": $scope.updated_by,
            "active": $scope.active,
            "published": $scope.published,
            "price": $scope.price,
            "deposit": $scope.deposit,
            "name": $scope.name,
            "remark": $scope.remark,
            "seo_title": $scope.seo_title,
            "seo_description": $scope.seo_description,
            "seo_keywords": $scope.seo_keywords
        };

        $http.post('../../RoomType/SetUpdate/', dataUpdate).then(function(response) {
            if (response.status == 200) {
                window.location.reload(false);
            }
        });

    };

    /**
     * Delete
     * */
    // event click for show modal
    $scope.btnDelete = function(id, name) {
        $scope.roomTypeId = id;
        $scope.roomTypeName = name;
    };
    // event click Confirm Delete on "Modal"
    $scope.confirmDelete = function(id) {
        RoomTypeService.getRoomTypeDelete({
            id: id
        });
        window.location.reload(false);
    };




    /**
     * function
     * */
    $scope.chk_name = function() {
        var res = false;
        angular.forEach($scope.roomTypeList, function(i, k) {
            if ($scope.name == i['name']) {
                return res = true;
            }
        });
        return res;
    }

    $scope.validateForm = function(form) {
        return form.$invalid || $scope.chk_name();
    }

    // load
    $scope.RoomTypeDataList();
    $scope.sort();
});