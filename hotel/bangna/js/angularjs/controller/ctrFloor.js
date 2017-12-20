/**
 * Created by Admin on 6/7/16.
 */

app.controller('FloorController', function($scope, FloorService, $http, $routeParams){

    var $scope = this;
    $scope.floorList = [];
    $scope.buildingForTheBuildingList = [];
    var branch_id = $("#create").attr('data-value');



    $scope.setFloorData = function(){
        FloorService.getFloorList(branch_id).then(function(data){
            $scope.floorList = data;
        });
    };


    $scope.sort = function(keyname){
        $scope.key = keyname;
        $scope.reverse  = !$scope.reverse;
    }


    /**
     * "Page Create"
     * */
    $scope.btnCreate = function(){
        $scope.titleheader = "เพิ่มชั้น";
        $scope.branch_id = branch_id;

         $scope.setBuilding = FloorService.getBuilding().then(function(data){
            $scope.buildingForTheBuildingList = data;
        });
    }

    $scope.SaveCreate = function(){

        var data = {
            'id'            : null,
            'branch_id'     : $scope.branch_id,
            'building_id'   : $scope.building_id,
            'created_by'    : $('#created_by').attr('data-value'),
            'name'          : $scope.name,
            'remark'        : $scope.remark,
            'active'        : 1,
            'published'     : 1,
            'seo_title'     : $scope.seo_title,
            'seo_seo_description'   : $scope.seo_description,
            'seo_keywords'  :   $scope.seo_keywords
        };


        $http.post('../../Floor/SetCreate/', data).then(function(response){
            if(response.status === 200){
                window.location.reload(false);
            }
            return false;
        });


    }

    /**
     * "Page Update"
     * */
    $scope.btnUpdate = function(id, name){
        $scope.titleheader = "แก้ไขข้อมูล";
        $scope.id = id;
        $scope.name = name;

        FloorService.getFloorView(id).then(function(data){
            $scope.building_id      = data['building_id'];
            $scope.remark           = data['remark'];
            $scope.active           = data['active'];
            $scope.published        = data['published'];
            $scope.seo_description  = data['seo_description'];
            $scope.seo_keywords     = data['seo_keywords'];
            $scope.seo_title        = data['seo_title'];

            $http.get('../../api/building/'+$scope.building_id).then(function(response){
                $scope.building_name = response.data.name;
            });
        });

    };

    $scope.SaveUpdate = function(){
        var data = {
            'id'            : $scope.id,
            'branch_id'     : $scope.branch_id,
            'building_id'   : $scope.building_id,
            'updated_by'    : $('#updated_by').attr('data-value'),
            'name'          : $scope.name,
            'remark'        : $scope.remark,
            'active'        : 1,
            'published'     : 1,
            'seo_title'     : $scope.seo_title,
            'seo_description'   : $scope.seo_description,
            'seo_keywords'  :   $scope.seo_keywords
        };

        FloorService.getFloorUpdate(data).then(function(data){
            if(data.success == false){
                window.location.reload(false);
            }
        });
    };


     /**
     * "Page Delete"
     * */
    $scope.btnDelete = function(id, name, building_id){
        $scope.id = id;
        $scope.name = name;

        $http.get('../../api/building/'+building_id).then(function(response){
            $scope.building_name = response.data.name;
        });

    };
    $scope.confirmDelete = function(id){
        FloorService.getFloorDelete({id:id}).then(function(response){
            if(response.status === 200){
                window.location.reload(false);
            }
        });

    };


    /**
     * Page Load and Event Load
     * */
    $scope.setFloorData();
    $scope.btnCreate();
    $scope.sort();
});