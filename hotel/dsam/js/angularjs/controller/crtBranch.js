/**
 * Created by Admin on 6/27/16.
 */

app.controller('BranchController', function($scope, BranchSerivce, $http, $location){
    var $scope = this;
    var user_id = ($('#create').attr('data-value') != '')? $('#create').attr('data-value'):'';

    $scope.listDataActive = [
        {
            'text'  :   'Yes',
            'value' :   1
        },
        {
            'text'  :   'No',
            'value' :   ''
        }
    ];

    $scope.listDataPublished = [
        {
            'text'  :   'Yes',
            'value' :   1
        },
        {
            'text'  :   'No',
            'value' :   ''
        }
    ];

    $scope.listDataProvince = {};
    $scope.listDataDistrict = {};

    /**
     * Crate
     * */
    $scope.btnCreate = function(){
        $scope.titleheader = "เพิ่มสาขา";
        $scope.active = 1;
        $scope.published = 1;


        $http.get('index/api/province').then(function(response){
            $scope.listDataProvince = response.data;
        });

    };

    $scope.btnConfirmCreate = function(){

        var map_data = '';

        if($scope.latitude.length != 0 && $scope.longitude.length != 0){
            map_data = $scope.latitude + ',' + $scope.longitude;
        }

        var data = {
            'created_by'    :   $('#created_by').val(),
            'active'        :   $scope.active,
            'published'     :   $scope.published,
            'name'          :   $scope.name,
            'remark'        :   $scope.remark,
            'address'       :   $scope.address,
            'province_id'   :   $scope.province_id['id'],
            'district_id'   :   $scope.district_id['id'],
            'area_id'       :   $scope.area_id['id'],
            'postal_code'   :   $scope.postal_code,
            'map_data'      :   (map_data.length != 0)? map_data:'',
            'phone'         :   $scope.phone,
            'fax'           :   $scope.fax,
            'seo_title'         :   $scope.seo_title,
            'seo_description'   :   $scope.seo_description,
            'seo_keywords'      :   $scope.seo_keywords,
            'building_count'    :   0,
            'floor_count'       :   0,
            'room_count'        :   0,
            'room_type_count'   :   0
        };

        BranchSerivce.getBranchCreate(data).then(function(data){
            console.log(data);
            if(data.success == false) {
                $location.path('/');
                window.location.reload(false);
            }
            else{
                $scope.name = "";
                $('#name').focus();
            }

        });

    };



    /**
     * Data List
     * */
    $scope.setDataListDistrict = function(province_id){

        var province = {'id': province_id.id, 'name':province_id.province, 'hashKey':province_id.$$hashKey};

        if(province != undefined){

            $http.get('index.php/api/district/'+province.id).then(function(response){
                $scope.listDataDistrict = response.data;
            });
        }

    };

    $scope.setDataListArea = function(district_id){

        var district = {
            'id': district_id.id,
            'province_id': district_id.province_id,
            'name': district_id.district,
            'hashKey': district_id.$$hashKey
        };

        if(district != undefined){

            $http.get('index.php/api/area/'+district.id).then(function(response){
                $scope.listDataArea = response.data;
            });

        }

    };

    $scope.setDataListPostalCode = function(area_id){
        var area = {
            'id': area_id.id,
            'district_id': area_id.district_id,
            'area': area_id.area,
            '$$hashKey': area_id.$$hashKey
        };

        if(area != undefined){
            $http.get('index.php/api/postal_code/'+area.id).then(function(response){
                $scope.listDataPostalCode = response.data;

                if (response.data.length == 1){
                    angular.forEach(response.data, function(i){
                        $scope.postal_code = i.postal_code;
                    });
                }
            });
        }
    };


    /**
     * Page Load
     * */
    $scope.btnCreate();

})
    .controller('BranchListController', function($scope, BranchSerivce, $http, $location){
        var $scope = this;

        $scope.getDataListAll = function(){
            $http.get('../api/branch').then(function(response){
                $scope.listBranch = response.data;
            });
        };

        // Sort data
        $scope.sort = function(keyname){
            $scope.sortKey = keyname;
            $scope.reverse  = !$scope.reverse;
        };


        $scope.btnDelete = function(id){
            $scope.id = id;
            BranchSerivce.getBranchView(id).then(function(data){
                $scope.name = data['name'];
            });
        }

        $scope.confirmDelete = function(id){
            BranchSerivce.getBranchDelete(id).then(function(){
                $location.path('/');
                window.location.reload(false);
            });
        };

        /**
         * Page Load
         * */
        $scope.getDataListAll();
     })
    .controller('BranchUpdateController', function($scope, $http, $routeParams, BranchSerivce){
        var $scope = this;
        $scope.titleheader = "แก้ไข";
        $scope.longitude = '';
        $scope.latitude = '';


        $scope.listDataActive = [
            {
                'text'  :   'Yes',
                'value' :   1
            },
            {
                'text'  :   'No',
                'value' :   ''
            }
        ];

        $scope.listDataPublished = [
            {
                'text'  :   'Yes',
                'value' :   1
            },
            {
                'text'  :   'No',
                'value' :   ''
            }
        ];


        $scope.id = $routeParams.id;


        $scope.btnUpdate = function(){
            $http.get('../api/branch/'+$scope.id).then(function(response){
                var data = response.data;
                $scope.id           =   data['id'];
                $scope.active       =   data['active'];
                $scope.published    =   data['published'];
                $scope.name         =   data['name'];
                $scope.remark       =   data['remark'];
                $scope.address      =   data['address'];
                $scope.province_id  =   data['province_id'];
                $scope.district_id  =   data['district_id'];
                $scope.area_id      =   data['area_id'];
                $scope.postal_code  =   data['postal_code'];
                $scope.map_data     =   data['map_data'];
                $scope.phone        =   data['phone'];
                $scope.fax          =   data['fax'];
                $scope.seo_title    =   data['seo_title'];
                $scope.seo_description  =   data['seo_description'];
                $scope.seo_keywords     =   data['seo_keywords'];


                if($scope.map_data.length != 0){
                    var mapDataSplit    = $scope.map_data.split(',');

                    $scope.latitude     = parseFloat(mapDataSplit[0]);
                    $scope.longitude    = parseFloat(mapDataSplit[1]);
                }

                if($scope.province_id.length != 0){

                    $http.get('../api/district/'+$scope.province_id).then(function(response){
                        $scope.listDistrict = response.data;
                    });

                    $http.get('../api/area/'+$scope.district_id).then(function(response){
                        $scope.listArea = response.data;
                    });

                    $http.get('../api/postal_code/'+$scope.area_id).then(function(response){
                        $scope.listPostalCode = response.data;

                    });
                }

            });
        };



        $http.get('../api/province').then(function(response){
            $scope.listProvince = response.data;
        });

        $scope.change_district = function(){
            $http.get('../api/district/'+$scope.province_id).then(function(response){
                $scope.listDistrict = response.data;
            });
            $scope.district_id = '';
        }


        // Confirm Update
        $scope.btnConfirmUpdate = function()
        {
            var map_data = '';

            if($scope.latitude.length != 0 && $scope.longitude.length != 0){
                map_data = $scope.latitude + ',' + $scope.longitude;
            }

            var data = {
                'id'                :   $scope.id,
                'active'            :   $scope.active,
                'published'         :   $scope.published,
                'name'              :   $scope.name,
                'remark'            :   $scope.remark,
                'address'           :   $scope.address,
                'province_id'       :   $scope.province_id,
                'district_id'       :   $scope.district_id,
                'area_id'           :   $scope.area_id,
                'postal_code'       :   $scope.postal_code,
                'map_data'          :   (map_data.length != 0)? map_data:'',
                'phone'             :   $scope.phone,
                'fax'               :   $scope.fax,
                'updated_by'        :   $('#updated_by').val(),
                'seo_title'         :   $scope.seo_title,
                'seo_description'   :   $scope.seo_description,
                'seo_keywords'      :   $scope.seo_keywords
            };

            BranchSerivce.getBranchUpdate(data).then(function(data){
                console.log(data);
                if(data.success == false)
                {
                    $location.path('/');
                    window.location.reload(false);
                }
            });
        }

        /**
         * Page Load
         * */
        $scope.btnUpdate();
     });