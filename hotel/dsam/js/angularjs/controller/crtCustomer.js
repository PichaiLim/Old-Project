/**
 * Created by Admin on 7/4/16.
 */

app.controller('CustomerController', function($scope, $location, $http, $routeParams, CustomerService){
    var $scope = this;
    $scope.listAll = [];
    $scope.titleheader = "เพิ่มข้อมูลลูกค้า";

    $scope.listDataActive = [{'text':'Yes', 'value':'1'},{'text':'No', 'value':''}];
    $scope.listDataGender = [{'text': 'ชาย', 'value': 'male'}, {'text': 'หญิง', 'value': 'female'}];
    $scope.listDataMaritalStatus = [{'text': 'โสด', 'value': 'single'}, {'text': 'แต่งงาน', 'value': 'married'}];

    $scope.listProvince = {};
    $scope.listDistrict = {};
    $scope.listArea = {};
    $scope.listPostalCode = {};


    /**
     * Index
     * */
    CustomerService.getCustomerAllList().then(function(data){
        $scope.listAll = data;
    });

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };


    $scope.activeOnLoad = function(active)
    {
        var txtActive = "";
        if(active == "1"){
            txtActive = "เข้าพัก";
        }else{
            txtActive = "-";
        }
        $scope.TxtActive = txtActive;
    };

    $scope.setEmployeeName = function(emp_id){
        if(emp_id != null){
            $http.get('../api/employee/'+emp_id).then(function(response){
                if(emp_id == response.data.id){
                    $scope.TxtEmpName = response.data.username;
                }
            });
        }
    };



    /**
     * Event Click Button Create
     * */

    $scope.btnCreate = function(){
        $scope.active = 1;
        $scope.gender = 'male';
        $scope.marital_status = "single";

        $http.get('../api/province').then(function(response){
            $scope.listProvince = response.data;
        });
    }

    $scope.btnSave = function(){

        if($scope.area_id != ""){
            $http.get('../api/postal_code/'+$scope.area_id).then(function(response){
                $scope.listPostalCode = response.data;
                angular.forEach(response.data, function(i){
                    $scope.postal_code = i['postal_code'];
                });
            });
        }


        var data = {
            'id'            :   null,
            'email'         :   $scope.email,
            'created'       :   null,
            'created_by'    :   $("#created_by").val(),
            'updated'       :   null,
            'updated_by'    :   null,
            'active'        :   $scope.active,
            'initial'       :   $scope.initial,
            'first_name'    :   $scope.first_name,
            'last_name'     :   $scope.last_name,
            'gender'        :   $scope.gender,
            'birthdate'     :   $scope.birthdate,
            'nationality'   :   $scope.nationality,
            'personal_no'   :   $scope.personal_no,
            'passport_no'   :   $scope.passport_no,
            'marital_status':   $scope.marital_status,
            'address'       :   $scope.address,
            'province_id'   :   $scope.province_id,
            'district_id'   :   $scope.district_id,
            'area_id'       :   $scope.area_id,
            'postal_code'   :   $scope.postal_code,
            'home_phone'    :   $scope.home_phone,
            'work_phone'    :   $scope.work_phone,
            'mobile_phone'  :   $scope.mobile_phone,
            'remark'        :   $scope.remark
        };

        CustomerService.getCustomerCreate(data).then(function(data){
            if(data.success == false){
                window.location.reload(false);
            }
        });
    };



    /**
     * Event Change
     * */
    $scope.changeProvince = function(provinceID){
        $http.get('../api/district/'+provinceID).then(function(response){
            $scope.listDistrict = response.data;
        });
        $scope.district_id = '';
        $scope.area_id = '';
        $scope.listArea = {};
        $scope.postal_code = '';
        $scope.listPostalCode = {};
    };

    $scope.changeDistrict = function(districtID){
        $http.get('../api/area/'+districtID).then(function(response){
            $scope.listArea = response.data;
        });

        $scope.area_id = '';
        $scope.postal_code = '';
        $scope.listPostalCode = {};
    };

    $scope.changeArea = function(areaID)
    {
        $http.get('../api/postal_code/'+areaID).then(function(response){
            $scope.listPostalCode = response.data;
            angular.forEach(response.data, function(i){
                $scope.postal_code = i['area_id'];
            });
        });
    };




    /**
     * Get list data of update
     * */
    $scope.btnUpdate = function(id){
        $scope.titleheader = "แก้ไขข้อมูลลูกค้า";
        $scope.id = id;

        CustomerService.getCustomerView(id).then(function(data){
            $scope.email            =   data['email'];
            $scope.created          =   data['created'];
            $scope.created_by       =   data['created_by'];
            $scope.active           =   data['active'];
            $scope.initial          =   data['initial'];
            $scope.first_name       =   data['first_name'];
            $scope.last_name        =   data['last_name'];
            $scope.gender           =   data['gender'];
            $scope.birthdate        =   data['birthdate'];
            $scope.nationality      =   data['nationality'];
            $scope.personal_no      =   data['personal_no'];
            $scope.passport_no      =   data['passport_no'];
            $scope.marital_status   =   (data['marital_status'] == '')?'single':data['marital_status'];
            $scope.address          =   data['address'];
            $scope.province_id      =   data['province_id'];
            $scope.district_id      =   data['district_id'];
            $scope.area_id          =   data['area_id'];
            $scope.postal_code      =   data['postal_code'];
            $scope.home_phone       =   data['home_phone'];
            $scope.work_phone       =   data['work_phone'];
            $scope.mobile_phone     =   data['mobile_phone'];
            $scope.remark           =   data['remark'];

            if($scope.province_id != ""){
                $http.get('../api/district/'+$scope.province_id).then(function(response){
                    $scope.listDistrict = response.data;
                });
                $http.get('../api/area/'+$scope.district_id).then(function(response){
                    $scope.listArea = response.data;
                });
                $http.get('../api/postal_code/'+$scope.area_id).then(function(response){
                    $scope.listPostalCode = response.data;
                    angular.forEach(response.data, function(i){
                        $scope.postal_code = i['area_id'];
                    });
                });
            }

        });

        $http.get('../api/province').then(function(response){
            $scope.listProvince = response.data;
        });

    };

    /**
     * Save update
     * */
    $scope.btnSaveUpdate = function(){
        if($scope.area_id != ""){
            $http.get('../api/postal_code/'+$scope.area_id).then(function(response){
                $scope.listPostalCode = response.data;
                angular.forEach(response.data, function(i){
                    $scope.postal_code = i['postal_code'];
                });
            });
        }

        var data = {
            'id'            :   $scope.id,
            'email'         :   $scope.email,
            'created'       :   $scope.created,
            'created_by'    :   $scope.created_by,
            'updated'       :   $scope.updated,
            'updated_by'    :   $("#updated_by").val(),
            'active'        :   $scope.active,
            'initial'       :   $scope.initial,
            'first_name'    :   $scope.first_name,
            'last_name'     :   $scope.last_name,
            'gender'        :   $scope.gender,
            'birthdate'     :   $scope.birthdate,
            'nationality'   :   $scope.nationality,
            'personal_no'   :   $scope.personal_no,
            'passport_no'   :   $scope.passport_no,
            'marital_status':   $scope.marital_status,
            'address'       :   $scope.address,
            'province_id'   :   $scope.province_id,
            'district_id'   :   $scope.district_id,
            'area_id'       :   $scope.area_id,
            'postal_code'   :   $scope.postal_code,
            'home_phone'    :   $scope.home_phone,
            'work_phone'    :   $scope.work_phone,
            'mobile_phone'  :   $scope.mobile_phone,
            'remark'        :   $scope.remark
        };

        console.log(data);

        CustomerService.getCustomerUpdate(data).then(function(data){
            console.log(data);
            if(data.success == false){
                window.location.reload(false);
            }
        });
    };



    /**
     * Delete
     * */
    $scope.btnDelete = function(id){
        $scope.id = id;
        CustomerService.getCustomerView(id).then(function(data) {
            $scope.FullName = data['initial']+data['first_name']+ ' '+data['last_name'];
        });
    };

    $scope.btnConfirm = function(){
        CustomerService.getCustomerDelete($scope.id).then(function(){
            $location.path('/');
            window.location.reload(false);
        });
    }




    /**
     * Page Load
     * */
});