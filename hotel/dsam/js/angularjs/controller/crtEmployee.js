/**
 * Created by Admin on 6/15/16.
 */

app.controller('EmployeeController', function($scope, EmployeeService, $routeParams, $http, $location){

    var $scope = this;
    $scope.titleheader = "เพิ่มข้อมูลผู้ใช้งาน";

    $scope.id = 0;
    $scope.listDataAdmin = [{'text':'No', 'value':''}, {'text':'Yes', 'value':'1'}];
    $scope.listDataActive = [{'text':'Yes', 'value':'1'},{'text':'No', 'value':''}];
    $scope.listDataGender = [{'text': 'ชาย', 'value': 'male'}, {'text': 'หญิง', 'value': 'female'}];
    $scope.listDataMaritalStatus = [{'text': 'โสด', 'value': 'single'}, {'text': 'แต่งงาน', 'value': 'married'}];
    $scope.branch_id = {};



    // attributes
    $scope.attributeLabelName = {
        'id' : '#',
        'employee_type_id' : 'ประเภทผู้ใช้งาน',
        'admin' : 'สถานะ Admin',
        'code' : 'Code',
        'username' : 'ชื่อผู้เช้าใช้งาน',
        'email' : 'Email',
        'password' : 'รหัสผ่าน',
        'login_timeout' : 'ระยะเวลาในการใช้งาน',
        'avatar' : 'Avatar',
        'created' : 'วันที่สร้าง',
        'created_by' : 'สร้างโดยใคร',
        'updated' : 'วันที่แก้ไข',
        'updated_by' : 'แก้ไขโดยใคร',
        'active' : 'Active',
        'initial' : 'Initial',
        'first_name' : 'ชื่อ',
        'last_name' : 'นามสกุล',
        'gender' : 'เพศ',
        'birthdate' : 'วันเกิด',
        'marital_status' : 'สถานะภาพ',
        'address' : 'ที่อยู่',
        'province_id' : 'จังหวัด',
        'district_id' : 'เขต/อำเภอ',
        'area_id' : 'แขวง/ตำบล',
        'postal_code' : 'รหัสไปรษณีย์',
        'home_phone' : 'โทรศัพท์บ้าน',
        'work_phone' : 'โทรศัพท์ที่ทำงาน',
        'mobile_phone' : 'เบอร์มือถือ',
        'remark' : 'หมายเหตุ',
        'fullname':'ชื่อ - นามสกุล',
        'tel':'เบอร์โทรศัพท์',
        'tool':'เครื่องมือ',
        'confirm_password':'ยืนยันรหัสผ่าน',
        'branch_id': 'สาขา'
    };

    // Table data list.
    EmployeeService.getEmployeeList().then(function(data){
        $scope.dataList = data;

        //console.log($scope.a);
    });

    // Sort data
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse  = !$scope.reverse;
    };


    $scope.click_branch_id = function(branch){
        console.log(branch);
    }

    /**
     * Create
     * */
    $scope.btnCreate = function(){
        $scope.admin = '';
        $scope.active = '1';
        $scope.gender = 'male';
        $scope.marital_status = 'single';
        $scope.province_id = '1';
        $scope.employee_type_id = 1;
    };

    $scope.btnSave = function(){

        var data = {
            'id'                :   $scope.id,
            'employee_type_id'  :   $scope.employee_type_id,
            'admin'             :   $scope.admin,
            'code'              :   $scope.code,
            'username'          :   $scope.username,
            'email'             :   $scope.email,
            'password'          :   $scope.password,
            'login_timeout'     :   15,
            'avatar'            :   null,
            'created'           :   $scope.created,
            'created_by'        :   $('#created_by').val(),
            'updated'           :   null,
            'updated_by'        :   null,
            'active'            :   $scope.active,
            'initial'           :   $scope.initial,
            'first_name'        :   $scope.first_name,
            'last_name'         :   $scope.last_name,
            'gender'            :   $scope.gender,
            'birthdate'         :   $scope.birthdate,
            'marital_status'    :   $scope.marital_status,
            'address'           :   $scope.address,
            'province_id'       :   $scope.province_id,
            'district_id'       :   $scope.district_id,
            'area_id'           :   $scope.area_id,
            'postal_code'       :   $scope.postal_code,
            'home_phone'        :   $scope.home_phone,
            'work_phone'        :   $scope.work_phone,
            'mobile_phone'      :   $scope.mobile_phone,
            'remark'            :   $scope.remark
        };


        EmployeeService.setEmployeeCreate(data).then(function(data){
            if(data.data['success'] == false){
                var new_id = data.data['Employee'];


                $location.path('/');
                window.location.reload(false);
            }

        });


    };


    $http.get('../../api/branch').then(function(response){
        var dataListBranch = [];

        angular.forEach(response.data, function(i, k){
            dataListBranch.push({branch_id: i.id, name: i.name, checked: false});
        });

        $scope.listBranch = dataListBranch;
    });

    $http.get('../../api/employee_type/').then(function(response){
        $scope.listEmployeeType = response.data;
    });

    $http.get('../../api/province').then(function(response){
        $scope.listProvince = response.data;
    });


    /**
     * Update
     * */
    $scope.btnUpdate = function(id){
        $scope.titleheader = "แก้ไขข้อมูลผู้ใช้งาน";
        EmployeeService.getEmployeeView(id).then(function(data){
            $scope.id                  =    data['id'];
            $scope.employee_type_id    =    data['employee_type_id'];
            $scope.admin               =    data['admin'];
            $scope.code                =    data['code'];
            $scope.username            =    data['username'];
            $scope.email               =    data['email'];
            $scope.old_password        =    data['password'];
            $scope.login_timeout       =    data['login_timeout'];
            $scope.avatar              =    data['avatar'];
            $scope.created             =    data['created'];
            $scope.created_by          =    data['created_by'];
            $scope.active              =    data['active'];
            $scope.initial             =    data['initial'];
            $scope.first_name          =    data['first_name'];
            $scope.last_name           =    data['last_name'];
            $scope.gender              =    data['gender'];
            $scope.birthdate           =    data['birthdate'];
            $scope.marital_status      =    data['marital_status'];
            $scope.address             =    data['address'];
            $scope.province_id         =    data['province_id'];
            $scope.district_id         =    data['district_id'];
            $scope.area_id             =    data['area_id'];
            $scope.postal_code         =    data['postal_code'];
            $scope.home_phone          =    data['home_phone'];
            $scope.work_phone          =    data['work_phone'];
            $scope.mobile_phone        =    data['mobile_phone'];
            $scope.remark              =    data['remark'];


            if($scope.province_id.length != 0){

                $http.get('../../api/district/'+$scope.province_id).then(function(response){
                     $scope.listDistrict = response.data;
                });

                $http.get('../../api/area/'+$scope.district_id).then(function(response){
                    $scope.listArea = response.data;
                });

                $http.get('../../api/postal_code/'+$scope.area_id).then(function(response){
                    $scope.listPostalCode = response.data;
                    angular.forEach(response.data, function(i){
                        $scope.postal_code = i['postal_code'];
                    });
                });
            }


            /**
             * auto Check Box
             * */
            $http.get('../../api/branch').then(function(response){
                var dataListBranch = [];
                var resData = [];

                angular.forEach(response.data, function(i, k){
                    dataListBranch.push({branch_id: i.id, name: i.name, checked: false});

                    $scope.employee_branch($scope.id).then(function(response){
                        resData = response.data.filter(function(emp_branch){

                            return emp_branch.branch_id == i.id;

                        }).map(function(){

                            return dataListBranch[k].checked = true;
                        });

                    });
                });
                $scope.listBranch = dataListBranch;
            });



        });
    };

    $scope.btnSaveChange = function(id){
        var data = {
            'id'                :   $scope.id,
            'employee_type_id'  :   $scope.employee_type_id,
            'admin'             :   $scope.admin,
            'code'              :   $scope.code,
            'username'          :   $scope.username,
            'email'             :   $scope.email,
            'password'          :   ($scope.password != "")?$scope.password:'',
            'login_timeout'     :   15,
            'avatar'            :   null,
            'created'           :   $scope.created,
            'created_by'        :   $scope.created_by,
            'updated'           :   $scope.updated,
            'updated_by'        :   $('#updated_by').val(),
            'active'            :   $scope.active,
            'initial'           :   $scope.initial,
            'first_name'        :   $scope.first_name,
            'last_name'         :   $scope.last_name,
            'gender'            :   $scope.gender,
            'birthdate'         :   $scope.birthdate,
            'marital_status'    :   $scope.marital_status,
            'address'           :   $scope.address,
            'province_id'       :   $scope.province_id,
            'district_id'       :   $scope.district_id,
            'area_id'           :   $scope.area_id,
            'postal_code'       :   $scope.postal_code,
            'home_phone'        :   $scope.home_phone,
            'work_phone'        :   $scope.work_phone,
            'mobile_phone'      :   $scope.mobile_phone,
            'remark'            :   $scope.remark
        };
        //console.log(data);

        EmployeeService.getEmployeeUpdate(data).then(function(data){
            if(data.success == false){
                $location.path('/');
                window.location.reload(false);
            }
        });
    };





    /**
     * Delete
     * */
    $scope.btnDelete = function(id){
        ViewEmployee(id);
    };

    $scope.confirmDelete = function(id){

        $http.delete('../../api/employee/'+id);
        $http.get('../../api/employee_branch/'+id).then(function(response){

            if(response.data.length >= 1){
                $http.delete('../../api/employee_branch/'+id);
            }
        });

        $location.path('/');
        window.location.reload(false);
    }


    /**
     * Function
     * */
    $scope.change_province = function(province_id){
        $http.get('../../api/district/'+province_id).then(function(response){
            $scope.listDistrict = response.data;
        });
    };

    $scope.change_district = function(district_id){
        $http.get('../../api/area/'+district_id).then(function(response){
            $scope.listArea = response.data;
        });
    };

    $scope.change_area = function(area_id){
        $http.get('../../api/postal_code/'+area_id).then(function(response){
            $scope.listPostalCode = response.data;
            angular.forEach(response.data, function(i){
                $scope.postal_code = i['postal_code'];
            });
        });
    };


    var ViewEmployee = function(id){
        EmployeeService.getEmployeeView(id).then(function(data){
                $scope.id                  =    data['id'];
                $scope.employee_type_id    =    data['employee_type_id'];
                $scope.admin               =    data['admin'];
                $scope.code                =    data['code'];
                $scope.username            =    data['username'];
                $scope.email               =    data['email'];
                $scope.old_password        =    data['password'];
                $scope.login_timeout       =    data['login_timeout'];
                $scope.avatar              =    data['avatar'];
                $scope.created             =    data['created'];
                $scope.created_by          =    data['created_by'];
                $scope.active              =    data['active'];
                $scope.initial             =    data['initial'];
                $scope.first_name          =    data['first_name'];
                $scope.last_name           =    data['last_name'];
                $scope.gender              =    data['gender'];
                $scope.birthdate           =    data['birthdate'];
                $scope.marital_status      =    data['marital_status'];
                $scope.address             =    data['address'];
                $scope.province_id         =    data['province_id'];
                $scope.district_id         =    data['district_id'];
                $scope.area_id             =    data['area_id'];
                $scope.postal_code         =    data['postal_code'];
                $scope.home_phone          =    data['home_phone'];
                $scope.work_phone          =    data['work_phone'];
                $scope.mobile_phone        =    data['mobile_phone'];
                $scope.remark              =    data['remark'];
        });
    }

    /**
     * On load user by create and Update
     * */
    $scope.setCratedBy = function(uID, data){

        var txt = data.filter(function(data){
            return data.id == uID;
        })
            .map(function(data){
                return data['username'];
            });
        return txt.toString();
    };

    /**
     * auto check box by database
     * */
    $scope.employee_branch = function(uID){

        return $http.get('../../api/employee_branch/'+uID);
    };


     /**
     * Page Load
     * */


})

    .controller('EmployeeCpwdOnPageIndexController', function($scope, $routeParams, EmployeeService){

    var $scope = this;
    $scope.msg = "";

    $scope.change_password = function(){

        var data = {
            'id': $routeParams.id,
            'password': $scope.confirm_password
        };

        $scope.change_password = function(){
            EmployeeService.setEmployeeChangePasswordOnPageIndex(data).then(function(data){
                if(data['success'] == false){
                    window.location.reload(false);
                    $scope.msg = "";
                }else{
                    $scope.msg = data.error;
                }
            });
        };

        $scope.change_password();
    };

    })
    .controller('EmployeeCpwdController', function($scope, $routeParams, EmployeeService){

    var $scope = this;
    $scope.msg = "";

    $scope.change_password = function(){

        var data = {
            'id': $routeParams.id,
            'password': $scope.confirm_password
        };

        $scope.change_password = function(){
            EmployeeService.setEmployeeChangePassword(data).then(function(data){
                if(data['success'] == false){
                    window.location.reload(false);
                    $scope.msg = "";
                }else{
                    $scope.msg = data.error;
                }
            });
        };

        $scope.change_password();
    };

    })
    .controller('EmployeeUpdateProfileController', function($scope, $routeParams, EmployeeService, $http){
        var $scope = this;

        $scope.listDataActive = [{'text':'Yes', 'value':'1'},{'text':'No', 'value':''}];
        $scope.listDataGender = [{'text': 'ชาย', 'value': 'male'}, {'text': 'หญิง', 'value': 'female'}];
        $scope.listDataMaritalStatus = [{'text': 'โสด', 'value': 'single'}, {'text': 'แต่งงาน', 'value': 'married'}];

        $scope.listDistrict =   {};
        $scope.listArea     =   {};


        $scope.id = $routeParams['id'];

        EmployeeService.getEmployeeView($scope.id).then(function(data){
            $scope.username         =   data['username'];
            $scope.email            =   data['email'];
            $scope.employee_type_id =   data['employee_type_id'];
            $scope.admin            =   data['admin'];
            $scope.code             =   data['code'];
            $scope.created          =   data['created'];
            $scope.created_by       =   data['created_by'];
            $scope.active           =   data['active'];
            $scope.initial          =   data['initial'];
            $scope.first_name       =   data['first_name'];
            $scope.last_name        =   data['last_name'];
            $scope.gender           =   data['gender'];
            $scope.birthdate        =   data['birthdate'];
            $scope.marital_status   =   data['marital_status'];
            $scope.address          =   data['address'];
            $scope.province_id      =   data['province_id'];
            $scope.district_id      =   data['district_id'];
            $scope.area_id          =   data['area_id'];
            $scope.postal_code      =   data['postal_code'];
            $scope.home_phone       =   data['home_phone'];
            $scope.work_phone       =   data['work_phone'];
            $scope.mobile_phone     =   data['mobile_phone'];
            $scope.remark           =   data['remark'];


            if($scope.province_id != null){
                $http.get('../../api/district/'+$scope.province_id).then(function(response){
                    $scope.listDistrict = response.data;
                });
                $http.get('../../api/area/'+$scope.district_id).then(function(response){
                    $scope.listArea = response.data;
                });
                $http.get('../../api/postal_code/'+$scope.area_id).then(function(response){
                    $scope.listPostalCode = response.data;
                });
            }

        });

        $http.get('../../api/province').then(function(response){
            $scope.listProvince = response.data;
        });

        $scope.changeProvince = function(province_id){
            $scope.district_id = '';
            $scope.listDistrict = {};

            $http.get('../../api/district/'+province_id).then(function(response){
                $scope.listDistrict = response.data;
            });

            $scope.area_id = '';
            $scope.listArea = {};
            $scope.postal_code = '';
            $scope.listPostalCode = {};
        };

        $scope.changeDistrict = function(district_id){
            $scope.area_id = '';
            $scope.listArea = {};

            $http.get('../../api/area/'+district_id).then(function(response){
                $scope.listArea = response.data;
            });

            $scope.postal_code = '';
            $scope.listPostalCode = {};
        };

        $scope.changeArea = function(area_id){
            $http.get('../../api/postal_code/'+area_id).then(function(response){
                $scope.listPostalCode = response.data;
                if(response.data.length == 1){
                    angular.forEach(response.data, function(i){
                        $scope.postal_code = i['postal_code'];
                    });
                }
            });
        }


        $scope.confirm = function(id){
            var data = {
                'id'                   :   id,
                'employee_type_id'     :   $scope.employee_type_id,
                'admin'                :   $scope.admin,
                'code'                 :   null,
                'updated_by'           :   $scope.updated_by,
                'active'               :   $scope.active,
                'initial'              :   $scope.initial,
                'first_name'           :   $scope.first_name,
                'last_name'            :   $scope.last_name,
                'gender'               :   $scope.gender,
                'birthdate'            :   $scope.birthdate,
                'marital_status'       :   $scope.marital_status,
                'address'              :   $scope.address,
                'province_id'          :   $scope.province_id,
                'district_id'          :   $scope.district_id,
                'area_id'              :   $scope.area_id,
                'postal_code'          :   $scope.postal_code,
                'home_phone'           :   $scope.home_phone,
                'work_phone'           :   $scope.work_phone,
                'mobile_phone'         :   $scope.mobile_phone,
                'remark'               :   $scope.remark,
                'updated_by'           :    $('#updated_by').val()
            };

            EmployeeService.setEmployeeUpdateProfile(data).then(function(data){
                if(data.success == false){
                    window.location.replace(false);
                }
            });
        };

    })
    .controller('EmployeeUpdateProfileOnPageIndexController', function($scope, $routeParams, $http, EmployeeService){
        var $scope = this;
        var id = ($routeParams.id != undefined)? $routeParams.id: null;

        $scope.listGender = [{'text':'ชาย', 'value':'male'}, {'text':'หญิง', 'vale':'female'}];

        // Marital Status
        $scope.listMarital_status = [
            {
                'text'  :   'ไม่ระบุ',
                'value' :   ''
            }
            ,{
                'text'  :   'โสด',
                'value' :   'single'
            }
            ,{
                'text'  :   'แต่งงานแล้ว',
                'value' :   'married'
            }
        ];

        /**
         *  Set params
         * */
        $scope.listProvince = {};
        $scope.listDistrict = {};
        $scope.listPostalCode = {};



         if(id != null) {
             $scope.id = id;

             EmployeeService.getEmployeeViewOnPageIndex(id).then(function (data) {
                 $scope.username = data['username'];
                 $scope.email = data['email'];
                 $scope.employee_type_id = data['employee_type_id'];
                 $scope.admin = data['admin'];
                 $scope.active = data['active'];

                 $scope.initial = data['initial'];
                 $scope.first_name = data['first_name'];
                 $scope.last_name = data['last_name'];
                 $scope.gender = data['gender'];
                 $scope.birthdate = data['birthdate'];
                 $scope.marital_status = ((data['marital_status'] == '') ? 'single' : data['marital_status']);
                 $scope.address = data['address'];
                 $scope.province_id = data['province_id'];
                 $scope.district_id = data['district_id'];
                 $scope.area_id = data['area_id'];
                 $scope.postal_code = data['postal_code'];
                 $scope.home_phone = data['home_phone'];
                 $scope.work_phone = data['work_phone'];
                 $scope.mobile_phone = data['mobile_phone'];
                 $scope.remark = data['remark'];


                 // Get data list 'Province'
                 $http.get('index.php/api/province/').then(function(response){
                     $scope.listProvince = response.data;
                 });

                 $http.get('index.php/api/district/'+$scope.province_id).then(function(response){
                     $scope.listDistrict = response.data;
                     angular.forEach($scope.listDistrict, function(i){
                         $scope.district_id = i.id;
                     });
                 });

                 $http.get('index.php/api/area/'+$scope.district_id).then(function(response){
                     $scope.listArea = response.data;
                 });

                 $http.get('index.php/api/postal_code/'+$scope.area_id).then(function(response){
                     $scope.listPostalCode = response.data;
                     if($scope.listPostalCode.length == 1){
                         angular.forEach($scope.listPostalCode, function(i){
                             $scope.postal_code = i.area_id;
                         });
                     }
                 });

             });
         }



        $scope.change_district = function(province_id){
            console.log(province_id);
            $http.get('index.php/api/district/'+province_id).then(function(response){
                $scope.listDistrict = response.data;
            });
            $scope.district_id = '';
            $scope.listDistrict = {};

            $scope.area_id = '';
            $scope.listArea = {};

            $scope.postal_code = '';
            $scope.listPostalCode = {};

        };

        $scope.change_area = function(district_id){
            $http.get('index.php/api/area/'+district_id).then(function(response){
                $scope.listArea = response.data;
            });
            $scope.area_id = '';
            $scope.listArea = {};

            $scope.postal_code = '';
            $scope.listPostalCode = {};
        };

        $scope.change_postal_code = function(area_id){
            $http.get('index.php/api/postal_code/'+area_id).then(function(response){
                $scope.listPostalCode = response.data;
                if($scope.listPostalCode.length == 1){
                    angular.forEach($scope.listPostalCode, function(i){
                        $scope.postal_code = i.area_id;
                    });
                }

            });
        }

        $scope.confirm = function(){
            var data = {
                'id'            :   $scope.id,
                'username'      :   $scope.username,
                'email'         :   $scope.email,
                'initial'       :   $scope.initial,
                'first_name'    :   $scope.first_name,
                'last_name'     :   $scope.last_name,
                'gender'        :   $scope.gender,
                'marital_status'    : $scope.marital_status,
                'address'       :   $scope.address,
                'province_id'   :   $scope.province_id,
                'district_id'   :   $scope.district_id,
                'area_id'       :   $scope.area_id,
                'postal_code'   :   $scope.postal_code,
                'home_phone'    :   $scope.home_phone,
                'work_phone'    :   $scope.work_phone,
                'mobile_phone'  :   $scope.mobile_phone
            };

            //console.log(data);

            EmployeeService.setEmployeeUpdateProfileOnPageIndex(data).then(function(data){
                //console.log(data);
                if(data.success == false){
                    window.location.reload();
                }
            });

        }

        /**
         * Page Load
         * */
    } );



