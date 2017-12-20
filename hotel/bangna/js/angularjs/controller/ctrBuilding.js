/**
 * Created by Admin on 6/6/16.
 */



app.controller('BuildingController', function($scope, buildingService){
    var $scope = this;
    var branch_id = $('#create').attr('data-value');
    $scope.buildingList = [];
    $scope.pagesize = 10;


    // Get List
    $scope.dataList = function(){
        buildingService.getBuildingList(branch_id).then(function(data){
            $scope.buildingList = data;
        });
    };

    // Sort
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse  = !$scope.reverse;
    };

    /**
     * Create
     * */
    $scope.btnCreate = function(){
        $scope.titleheader = "เพิ่มอาคาร";
        $scope.branch_id = branch_id;
    };

     $scope.SaveCreate = function(){
         var data = {
             'id'            :   null,
             'branch_id'     :   $scope.branch_id,
             'created'       :   $scope.created,
             'created_by'    :   $('#created_by').attr('data-value'),
             'active'        :   1,
             'published'     :   $('.published').text(),
             'name'          :   $scope.name,
             'remark'        :   $scope.remark,
             'seo_title'     :   $scope.seo_title,
             'seo_description'   :   $scope.seo_description,
             'seo_keywords'      :   $scope.seo_keywords
         };


         buildingService.getBuildingCreate(data).then(function(data){
             console.log(data);
             if(data.success == false){
                 window.location.reload(false);
             }
         });

     };



     /**
     * Update
     * */
    $scope.btnUpdate = function(id, name){
        $scope.titleheader = "แก้ไข";
        $scope.id = id;
        $scope.name = name;

        buildingService.getBuildingView(id).then(function(data){
            console.log(data);
            $scope.branch_id = data.branch_id;
            $scope.remark = data.remark;
            $scope.active = data.active;
            $scope.published    = data.published;
            $scope.seo_title    = data.seo_title;
            $scope.seo_description  = data.seo_description;
            $scope.seo_keywords = data.seo_keywords;
        });
    }

    $scope.SaveUpdate = function(id){
        var data = {
            'id'            :   id,
            'branch_id'     :   $scope.branch_id,
            'updated'       :   $scope.updated,
            'updated_by'    :   $("#updated_by").val(),
            'active'        :   1,
            'published'     :   1,
            'name'          :   $scope.name,
            'remark'        :   $scope.remark,
            'seo_title'     :   $scope.seo_title,
            'seo_description'   :   $scope.seo_description,
            'seo_keywords'      :   $scope.seo_keywords
        };

        buildingService.getBuildingUpdate(data).then(function(data){
            if(data.success == false){
                window.location.reload(false);
            }
        });
    }

    /**
     * Delete
     * */
    $scope.btnDelete = function(id,name){
        $scope.id = id;
        $scope.name = name;
    };

    $scope.confirmDelete = function(id){
        buildingService.getBuildingDelete({id:id}).then(function(data){
            if(data.status === 200){
                window.location.reload(false);
            }
        });
    };



    // Load
    $scope.dataList();
    $scope.sort();
});