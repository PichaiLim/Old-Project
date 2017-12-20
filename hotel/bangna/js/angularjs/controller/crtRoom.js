/**
 * Created by Admin on 6/7/16.
 */

app.controller('RoomController', function($scope, RoomService, $routeParams, $http, $location) {

    var $scope = this;
    var branchId = $('.create').attr('data-value');

    $scope.roomList = [];
    $scope.roomForTheBuildingList = [];
    $scope.roomForTheFloorList = [];
    $scope.roomForTheTypeRoomList = [];

    $scope.branch_name = "";
    $scope.building_name = "";
    $scope.floor_name = "";



    /**
     * Index.php
     * Get list data in table
     * */
    $scope.roomDataList = function() {
        RoomService.getRoomList().then(function(data) {
            $scope.roomList = data;
        });
    };

    // Sort data
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };


    /**
     * "Page Create"
     * Get & Set date to modal "Create"
     */
    $scope.btnCreate = function() {
        $scope.titleheader = "เพิ่มห้อง";

        $scope.branch_id = branchId;
        $scope.active = 1;
        $scope.published = 1;

        $scope.setRoomForTheBuilding = RoomService.getRoomForTheBuilding().then(function(data) {
            $scope.roomForTheBuildingList = data;
        });

        $scope.setRoomForTheFloorList = RoomService.getRoomForTheFloor().then(function(data) {
            $scope.roomForTheFloorList = data;
        });

        $scope.setRoomForTheTypeRoomList = RoomService.getRoomForTypeRoom().then(function(data) {
            $scope.roomForTheTypeRoomList = data;
        });

    };
    // Save date at page "Create" on modal
    $scope.SaveCreate = function() {
        var data = {
            'id': null,
            'branch_id': $scope.branch_id,
            'building_id': $scope.building_id,
            'floor_id': $scope.floor_id,
            'room_type_id': $scope.room_type_id,
            'created': $scope.created,
            'created_by': $('#created_by').attr('data-value'),
            'active': $scope.active,
            'published': $scope.published,
            'name': $scope.name,
            'remark': $scope.remark,
            'seo_title': $scope.seo_title,
            'seo_description': $scope.seo_description,
            'seo_keywords': $scope.seo_keywords,
            'reservation_count': 0
        };
        //console.log(data);

        RoomService.setRoomCreate(data).then(function(data) {
            if (data.status == 200) {
                window.location.reload(false);
            }
        });

        ClearValueInput();
    };

    /**
     * "Page Update"
     * */
    $scope.btnUpdate = function(id) {
        $scope.titleheader = "แก้ไขข้อมูล";

        $scope.id = id;

        RoomService.getRoomView(id).then(function(data) {
            $scope.name = data['name'];

            var branch_id = ($scope.branch_id = data['branch_id']);
            var building_id = ($scope.building_id = data['building_id']);
            var floor_id = ($scope.floor_id = data['floor_id']);

            $scope.room_type_id = data['room_type_id'];
            $scope.remark = data['remark'];
            $scope.active = data['active'];
            $scope.published = data['published'];
            $scope.room_type_id = data['room_type_id'];
            $scope.seo_description = data['seo_description'];
            $scope.seo_keywords = data['seo_keywords'];
            $scope.seo_title = data['seo_title'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.updated = data['updated'];
            $scope.updated_by = data['updated_by'];

            $http.get('../../api/branch/' + branch_id).then(function(response) {
                $scope.branch_name = response.data.name;
            });

            $http.get('../../api/building/' + building_id).then(function(response) {
                $scope.building_name = response.data.name;
            });

            $http.get('../../api/floorByPK/' + floor_id).then(function(response) {
                $scope.floor_name = response.data.name;
            });

            $scope.setRoomForTheTypeRoomList = RoomService.getRoomForTypeRoom().then(function(data) {
                $scope.roomForTheTypeRoomList = data;
            });
        });

    };

    $scope.SaveUpdate = function() {

        var data = {
            'id': $scope.id,
            'branch_id': $scope.branch_id,
            'building_id': $scope.building_id,
            'floor_id': $scope.floor_id,
            'room_type_id': $scope.room_type_id,
            'updated': $("#updated").val(),
            'updated_by': $("#updated_by").val(),
            'active': $scope.active,
            'published': $scope.published,
            'name': $scope.name,
            'remark': $scope.remark,
            'seo_title': $scope.seo_title,
            'seo_description': $scope.seo_description,
            'seo_keywords': $scope.seo_keywords
        };
        RoomService.setRoomUpdate(data)
            .then(function() {
                $location.path('/');
                window.location.reload(false);
            });

    };


    /**
     * Delete
     * */
    $scope.btnDelete = function(id, branch_id, building_id, floor_id, roomname) {
        $scope.id = id;
        $scope.roomname = roomname;

        $http.get('../../api/branch/' + branch_id).then(function(response) {
            $scope.branch_name = response.data.name;
        });

        $http.get('../../api/building/' + building_id).then(function(response) {
            $scope.building_name = response.data.name;
        });

        $http.get('../../api/floor/' + floor_id).then(function(response) {
            $scope.floor_name = response.data.name;
        });
    };

    $scope.confirmDelete = function(id) {
        RoomService.getRoomDelete({
            id: id
        }).then(function(data) {
            if (data.status === 200) {
                window.location.reload(false);
            }
            return false;
        });
    }


    /**
     * Clear value input
     * */
    function ClearValueInput() {
        $scope.name = "";
        $scope.remark = "";
    }

    /**
     * Page Load Function
     * */
    $scope.roomDataList();
    $scope.sort();
});