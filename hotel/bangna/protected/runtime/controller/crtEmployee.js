/**
 * Created by Admin on 6/15/16.
 */

app.controller('EmployeeController', function($scope, EmployeeService, $routeParams, $http, $location, $uibModal) {

    var $scope = this;
    $scope.titleheader = "เพิ่มข้อมูลผู้ใช้งาน";

    $scope.id = 0;
    $scope.listDataGender = [{
        'text': 'ชาย',
        'value': 'male'
    }, {
        'text': 'หญิง',
        'value': 'female'
    }];
    $scope.listDataMaritalStatus = [{
        'text': 'โสด',
        'value': 'single'
    }, {
        'text': 'แต่งงาน',
        'value': 'married'
    }];
    $scope.branch_id = {};

    // attributes
    $scope.attributeLabelName = {
        'id': '#',
        'employee_type_id': 'ประเภทผู้ใช้งาน',
        'admin': 'สถานะ Admin',
        'code': 'Code',
        'username': 'ชื่อผู้เช้าใช้งาน',
        'email': 'Email',
        'password': 'รหัสผ่าน',
        'login_timeout': 'ระยะเวลาในการใช้งาน',
        'avatar': 'Avatar',
        'created': 'วันที่สร้าง',
        'created_by': 'สร้างโดยใคร',
        'updated': 'วันที่แก้ไข',
        'updated_by': 'แก้ไขโดยใคร',
        'active': 'Active',
        'initial': 'Initial',
        'first_name': 'ชื่อ',
        'last_name': 'นามสกุล',
        'gender': 'เพศ',
        'birthdate': 'วันเกิด',
        'marital_status': 'สถานะภาพ',
        'address': 'ที่อยู่',
        'province_id': 'จังหวัด',
        'district_id': 'เขต/อำเภอ',
        'area_id': 'แขวง/ตำบล',
        'postal_code': 'รหัสไปรษณีย์',
        'home_phone': 'โทรศัพท์บ้าน',
        'work_phone': 'โทรศัพท์ที่ทำงาน',
        'mobile_phone': 'เบอร์มือถือ',
        'remark': 'หมายเหตุ',
        'fullname': 'ชื่อ - นามสกุล',
        'tel': 'เบอร์โทรศัพท์',
        'tool': 'เครื่องมือ',
        'confirm_password': 'ยืนยันรหัสผ่าน',
        'branch_id': 'สาขา'
    };

    $scope.addEmployeeModal = function(user_id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'addEmployeeModalContent.html',
            controller: 'AddEmployeeModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    user_id: user_id
                }
            }
        }).result.then(function() {
            $location.path('/');
            window.location.reload(false);
        });
    };

    $scope.editEmployeeModal = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'addEmployeeModalContent.html',
            controller: 'EditEmployeeModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        }).result.then(function() {
            $location.path('/');
            window.location.reload(false);
        });
    };

    function getEmployeeList() {
        // Table data list.
        EmployeeService.getEmployeeList().then(function(data) {
            $scope.dataList = data;
        });
    }

    getEmployeeList();

    // Sort data
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };


    /**
     * Update
     * */
    $scope.btnUpdate = function(id) {
        $scope.titleheader = "แก้ไขข้อมูลผู้ใช้งาน";
        EmployeeService.getEmployeeView(id).then(function(data) {
            $scope.id = data['id'];
            $scope.employee_type_id = data['employee_type_id'];
            $scope.admin = data['admin'];
            $scope.code = data['code'];
            $scope.username = data['username'];
            $scope.email = data['email'];
            $scope.old_password = data['password'];
            $scope.login_timeout = data['login_timeout'];
            $scope.avatar = data['avatar'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.active = data['active'];
            $scope.initial = data['initial'];
            $scope.first_name = data['first_name'];
            $scope.last_name = data['last_name'];
            $scope.gender = data['gender'];
            $scope.birthdate = data['birthdate'];
            $scope.marital_status = data['marital_status'];
            $scope.address = data['address'];
            $scope.province_id = data['province_id'];
            $scope.district_id = data['district_id'];
            $scope.area_id = data['area_id'];
            $scope.postal_code = data['postal_code'];
            $scope.home_phone = data['home_phone'];
            $scope.work_phone = data['work_phone'];
            $scope.mobile_phone = data['mobile_phone'];
            $scope.remark = data['remark'];


            if ($scope.province_id.length != 0) {

                $http.get('../../api/district/' + $scope.province_id).then(function(response) {
                    $scope.listDistrict = response.data;
                });

                $http.get('../../api/area/' + $scope.district_id).then(function(response) {
                    $scope.listArea = response.data;
                });

                $http.get('../../api/postal_code/' + $scope.area_id).then(function(response) {
                    $scope.listPostalCode = response.data;
                    angular.forEach(response.data, function(i) {
                        $scope.postal_code = i['postal_code'];
                    });
                });
            }


            /**
             * auto Check Box
             * */
            $http.get('../../api/branch').then(function(response) {
                var dataListBranch = [];
                var resData = [];

                angular.forEach(response.data, function(i, k) {
                    dataListBranch.push({
                        branch_id: i.id,
                        name: i.name,
                        checked: false
                    });

                    $scope.employee_branch($scope.id).then(function(response) {
                        resData = response.data.filter(function(emp_branch) {

                            return emp_branch.branch_id == i.id;

                        }).map(function() {

                            return dataListBranch[k].checked = true;
                        });

                    });
                });
                $scope.listBranch = dataListBranch;
            });



        });
    };

    $scope.btnSaveChange = function(id) {
        var data = {
            'id': $scope.id,
            'employee_type_id': $scope.employee_type_id,
            'admin': $scope.admin,
            'code': $scope.code,
            'username': $scope.username,
            'email': $scope.email,
            'password': ($scope.password != "") ? $scope.password : '',
            'login_timeout': 15,
            'avatar': null,
            'created': $scope.created,
            'created_by': $scope.created_by,
            'updated': $scope.updated,
            'updated_by': $('#updated_by').val(),
            'active': $scope.active,
            'initial': $scope.initial,
            'first_name': $scope.first_name,
            'last_name': $scope.last_name,
            'gender': $scope.gender,
            'birthdate': $scope.birthdate,
            'marital_status': $scope.marital_status,
            'address': $scope.address,
            'province_id': $scope.province_id,
            'district_id': $scope.district_id,
            'area_id': $scope.area_id,
            'postal_code': $scope.postal_code,
            'home_phone': $scope.home_phone,
            'work_phone': $scope.work_phone,
            'mobile_phone': $scope.mobile_phone,
            'remark': $scope.remark
        };
        //console.log(data);

        EmployeeService.getEmployeeUpdate(data).then(function(data) {
            if (data.success == false) {
                $location.path('/');
                window.location.reload(false);
            }
        });
    };





    /**
     * Delete
     * */
    $scope.btnDelete = function(id) {
        ViewEmployee(id);
    };

    $scope.confirmDelete = function(id) {
        EmployeeService.deletedEmployeeAndEmployeeBranch({
            id: id
        }).then(function() {
            $location.path('/');
            window.location.reload(false);
        });
    }


    /**
     * Function
     * */
    $scope.change_province = function(province_id) {
        $http.get('../../api/district/' + province_id).then(function(response) {
            $scope.listDistrict = response.data;
        });
    };

    $scope.change_district = function(district_id) {
        $http.get('../../api/area/' + district_id).then(function(response) {
            $scope.listArea = response.data;
        });
    };

    $scope.change_area = function(area_id) {
        $http.get('../../api/postal_code/' + area_id).then(function(response) {
            $scope.listPostalCode = response.data;
            angular.forEach(response.data, function(i) {
                $scope.postal_code = i['postal_code'];
            });
        });
    };


    var ViewEmployee = function(id) {
        EmployeeService.getEmployeeView(id).then(function(data) {
            $scope.id = data['id'];
            $scope.employee_type_id = data['employee_type_id'];
            $scope.admin = data['admin'];
            $scope.code = data['code'];
            $scope.username = data['username'];
            $scope.email = data['email'];
            $scope.old_password = data['password'];
            $scope.login_timeout = data['login_timeout'];
            $scope.avatar = data['avatar'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.active = data['active'];
            $scope.initial = data['initial'];
            $scope.first_name = data['first_name'];
            $scope.last_name = data['last_name'];
            $scope.gender = data['gender'];
            $scope.birthdate = data['birthdate'];
            $scope.marital_status = data['marital_status'];
            $scope.address = data['address'];
            $scope.province_id = data['province_id'];
            $scope.district_id = data['district_id'];
            $scope.area_id = data['area_id'];
            $scope.postal_code = data['postal_code'];
            $scope.home_phone = data['home_phone'];
            $scope.work_phone = data['work_phone'];
            $scope.mobile_phone = data['mobile_phone'];
            $scope.remark = data['remark'];
        });
    }

    /**
     * On load user by create and Update
     * */
    $scope.setCratedBy = function(uID, data) {

        var txt = data.filter(function(data) {
                return data.id == uID;
            })
            .map(function(data) {
                return data['username'];
            });
        return txt.toString();
    };

    /**
     * auto check box by database
     * */
    $scope.employee_branch = function(uID) {

        return $http.get('../../api/employee_branch/' + uID);
    };


    /**
     * Page Load
     * */


})

.controller('EmployeeCpwdOnPageIndexController', function($scope, $routeParams, EmployeeService) {

        var $scope = this;
        $scope.msg = "";

        $scope.change_password = function() {

            var data = {
                'id': $routeParams.id,
                'password': $scope.confirm_password
            };

            $scope.change_password = function() {
                EmployeeService.setEmployeeChangePasswordOnPageIndex(data).then(function(data) {
                    if (data['success'] == false) {
                        window.location.reload(false);
                        $scope.msg = "";
                    } else {
                        $scope.msg = data.error;
                    }
                });
            };

            $scope.change_password();
        };

    })
    .controller('EmployeeCpwdController', function($scope, $routeParams, EmployeeService) {

        var $scope = this;
        $scope.msg = "";

        $scope.change_password = function() {

            var data = {
                'id': $routeParams.id,
                'password': $scope.confirm_password
            };

            $scope.change_password = function() {
                EmployeeService.setEmployeeChangePassword(data).then(function(data) {
                    if (data['success'] == false) {
                        window.location.reload(false);
                        $scope.msg = "";
                    } else {
                        $scope.msg = data.error;
                    }
                });
            };

            $scope.change_password();
        };

    })
    .controller('EmployeeUpdateProfileController', function($scope, $uibModal, $location) {
        var $scope = this;
        $scope.updateProfileModal = function(userId) {
            $uibModal.open({
                animation: true,
                templateUrl: 'updateProfileModalContent.html',
                controller: 'UpdateProfileModalController',
                backdrop: "static",
                size: "lg",
                resolve: {
                    modalData: {
                        userId: userId
                    }
                }
            }).result.then(function() {
                $location.path('/');
                window.location.reload(true);
            });
        };
    })
    .controller('EmployeeUpdateProfileOnPageIndexController', function($scope, $routeParams, $http, EmployeeService) {
        var $scope = this;
        var id = ($routeParams.id != undefined) ? $routeParams.id : null;

        $scope.listGender = [{
            'text': 'ชาย',
            'value': 'male'
        }, {
            'text': 'หญิง',
            'vale': 'female'
        }];

        // Marital Status
        $scope.listMarital_status = [{
            'text': 'ไม่ระบุ',
            'value': ''
        }, {
            'text': 'โสด',
            'value': 'single'
        }, {
            'text': 'แต่งงานแล้ว',
            'value': 'married'
        }];

        /**
         *  Set params
         * */
        $scope.listProvince = {};
        $scope.listDistrict = {};
        $scope.listPostalCode = {};



        if (id != null) {
            $scope.id = id;

            EmployeeService.getEmployeeViewOnPageIndex(id).then(function(data) {
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
                $http.get('index.php/api/province/').then(function(response) {
                    $scope.listProvince = response.data;
                });

                $http.get('index.php/api/district/' + $scope.province_id).then(function(response) {
                    $scope.listDistrict = response.data;
                    angular.forEach($scope.listDistrict, function(i) {
                        $scope.district_id = i.id;
                    });
                });

                $http.get('index.php/api/area/' + $scope.district_id).then(function(response) {
                    $scope.listArea = response.data;
                });

                $http.get('index.php/api/postal_code/' + $scope.area_id).then(function(response) {
                    $scope.listPostalCode = response.data;
                    if ($scope.listPostalCode.length == 1) {
                        angular.forEach($scope.listPostalCode, function(i) {
                            $scope.postal_code = i.area_id;
                        });
                    }
                });

            });
        }



        $scope.change_district = function(province_id) {
            console.log(province_id);
            $http.get('index.php/api/district/' + province_id).then(function(response) {
                $scope.listDistrict = response.data;
            });
            $scope.district_id = '';
            $scope.listDistrict = {};

            $scope.area_id = '';
            $scope.listArea = {};

            $scope.postal_code = '';
            $scope.listPostalCode = {};

        };

        $scope.change_area = function(district_id) {
            $http.get('index.php/api/area/' + district_id).then(function(response) {
                $scope.listArea = response.data;
            });
            $scope.area_id = '';
            $scope.listArea = {};

            $scope.postal_code = '';
            $scope.listPostalCode = {};
        };

        $scope.change_postal_code = function(area_id) {
            $http.get('index.php/api/postal_code/' + area_id).then(function(response) {
                $scope.listPostalCode = response.data;
                if ($scope.listPostalCode.length == 1) {
                    angular.forEach($scope.listPostalCode, function(i) {
                        $scope.postal_code = i.area_id;
                    });
                }

            });
        }

        $scope.confirm = function() {
            var data = {
                'id': $scope.id,
                'username': $scope.username,
                'email': $scope.email,
                'initial': $scope.initial,
                'first_name': $scope.first_name,
                'last_name': $scope.last_name,
                'gender': $scope.gender,
                'marital_status': $scope.marital_status,
                'address': $scope.address,
                'province_id': $scope.province_id,
                'district_id': $scope.district_id,
                'area_id': $scope.area_id,
                'postal_code': $scope.postal_code,
                'home_phone': $scope.home_phone,
                'work_phone': $scope.work_phone,
                'mobile_phone': $scope.mobile_phone
            };

            //console.log(data);

            EmployeeService.setEmployeeUpdateProfileOnPageIndex(data).then(function(data) {
                //console.log(data);
                if (data.success == false) {
                    window.location.reload();
                }
            });
        }
    });




app.controller('AddEmployeeModalController', function($scope, $uibModalInstance, CustomerService, $uibModal, EmployeeService) {
    $scope.listAll = [];
    $scope.listProvince = {};
    $scope.listDistrict = {};
    $scope.listArea = {};
    $scope.listPostalCode = {};
    $scope.title = "เพิ่มข้อมูลพนักงาน";

    $scope.init = function() {
        $scope.checkedBranch = [];
        $scope.maritalStatus = "single";
        $scope.active = "1";
        $scope.admin = "1";
        $scope.gender = "male";
        CustomerService.getProvince().then(function(response) {
            $scope.listProvince = response.data;
        });
        $scope.isSaveSuccess = false;
        $scope.getEmployeeTypeList();
        $scope.getBranchList();
    };

    $scope.toggleCheck = function(branch) {
        if ($scope.checkedBranch.indexOf(branch) === -1) {
            $scope.checkedBranch.push(branch);
        } else {
            $scope.checkedBranch.splice($scope.checkedBranch.indexOf(branch), 1);
        }
    };

    $scope.getBranchList = function() {
        EmployeeService.getBranchList()
            .then(function(data) {
                $scope.listBranch = data;
            });
    };

    $scope.getEmployeeTypeList = function() {
        EmployeeService.getEmployeeTypeList()
            .then(function(data) {
                $scope.listEmployeeType = data;
            });
    };

    $scope.changeProvince = function(provinceID) {
        $scope.listDistrict = "";
        $scope.listArea = "";
        $scope.postalCode = "";
        CustomerService.getDistrict(provinceID).then(getDistrictListSuccess);
    };

    function getDistrictListSuccess(response) {
        $scope.listDistrict = response.data;
    }

    $scope.changeDistrict = function(districtID) {
        $scope.listArea = "";
        $scope.postalCode = "";
        CustomerService.getArea(districtID).then(getAreaListSuccess);
    };

    function getAreaListSuccess(response) {
        $scope.listArea = response.data;
    }

    $scope.changeArea = function(areaID) {
        $scope.postalCode = "";
        CustomerService.getPostalCode(areaID).then(getPostalCodeSuccess);
    };

    function getPostalCodeSuccess(response) {
        $scope.listPostalCode = response.data;
        angular.forEach(response.data, function(i) {
            $scope.postalCode = i['postal_code'];
        });
    }

    $scope.onChangeEmail = function() {
        $scope.emailError = "";
        isSetErrorEmail();
    };

    $scope.onBlurEmail = function() {
        isSetErrorEmail();
    };

    function isSetErrorEmail() {
        if ($scope.email) {
            $scope.emailError = $scope.isValidEmailFormat() ? "" : "อีเมล์ไม่ถูกต้อง";
        }
    }

    $scope.isValidEmailFormat = function() {
        return /\S+@\S+\.\S+/.test($scope.email);
    };

    $scope.ok = function(userId) {
        var data = {
            'id': 0,
            'employee_type_id': $scope.employee_type_id,
            'admin': $scope.admin,
            'code': null,
            'username': $scope.username,
            'email': $scope.email,
            'password': $scope.password,
            'login_timeout': 15,
            'avatar': null,
            'created_by': userId,
            'updated': null,
            'updated_by': null,
            'active': $scope.active,
            'initial': $scope.initial,
            'first_name': $scope.first_name,
            'last_name': $scope.last_name,
            'gender': $scope.gender,
            'birthdate': $scope.birthdate,
            'marital_status': $scope.maritalStatus,
            'address': $scope.address,
            'province_id': $scope.provinceId,
            'district_id': $scope.districtId,
            'area_id': $scope.areaId,
            'postal_code': $scope.postalCode,
            'home_phone': $scope.homePhone,
            'work_phone': $scope.workPhone,
            'mobile_phone': $scope.mobilePhone,
            'remark': $scope.remark,
            'checkedBranch': $scope.checkedBranch
        };

        EmployeeService.setEmployeeCreate(data)
            .then(showModal("เพิ่มข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถเพิ่มข้อมูลได้", false));
    };

    function showModal(message, status) {
        return function() {
            var modalData = {
                message: message,
                title: "พนักงาน",
                isSaveSuccess: status
            };

            $uibModal.open({
                animation: true,
                templateUrl: 'dismiss_modal.html',
                controller: 'DismissModalController',
                backdrop: "static",
                size: "md",
                resolve: {
                    modalData: modalData
                }
            }).result.then(function() {
                if (status) {
                    $uibModalInstance.close();
                }
            });
        };
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('EditEmployeeModalController', function($uibModalInstance, modalData, $scope, CustomerService, $uibModal, EmployeeService) {

    $scope.init = function() {
        $scope.id = modalData.id;
        $scope.message = "แก้ไขข้อมูลลูกค้า";
        $scope.title = "แก้ไขข้อมูลลูกค้า";
        $scope.checkedBranch = [];
        $scope.isEdit = true;

        CustomerService.getProvince().then(function(response) {
            $scope.listProvince = response.data;
        });

        EmployeeService.getEmployeeTypeList().then(function(data) {
            $scope.listEmployeeType = data;
        });

        EmployeeService.getEmployeeBranchForEdit({
            id: $scope.id
        }).then(function(data) {
            $scope.dataBranchChecked = data;
        });

        EmployeeService.getEmployeeView($scope.id).then(function(data) {
            $scope.employee_type_id = data['employee_type_id'];
            $scope.admin = data['admin'];
            $scope.username = data['username'];
            $scope.email = data['email'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.active = data['active'];
            $scope.initial = data['initial'];
            $scope.first_name = data['first_name'];
            $scope.last_name = data['last_name'];
            $scope.gender = data['gender'];
            $scope.birthdate = data['birthdate'];
            $scope.nationality = data['nationality'];
            $scope.personalNo = data['personal_no'];
            $scope.passportNo = data['passport_no'];
            $scope.maritalStatus = data['marital_status'];
            $scope.address = data['address'];
            $scope.provinceId = data['province_id'];
            $scope.districtId = data['district_id'];
            $scope.areaId = data['area_id'];
            $scope.postalCode = data['postal_code'];
            $scope.homePhone = data['home_phone'];
            $scope.workPhone = data['work_phone'];
            $scope.mobilePhone = data['mobile_phone'];
            $scope.remark = data['remark'];
            $scope.password = data['password'];

            if ($scope.provinceId != "") {
                $scope.changeProvince($scope.provinceId);
                $scope.changeDistrict($scope.districtId);
                $scope.changeArea($scope.areaId);
            }

            EmployeeService.getBranchList().then(function(data) {
                $scope.listBranch = data;
            });

        });



        //console.log($scope.employee_type_id);
    };

    $scope.isChecked = function(id) {
        if ($scope.dataBranchChecked) {
            var match = false;
            for (var i = 0; i < $scope.dataBranchChecked.length; i++) {
                if ($scope.dataBranchChecked[i].id == id) {
                    match = true;
                }
            }
            return match;
        }

    };

    $scope.toggleCheck = function(branch) {
        if ($scope.checkedBranch.indexOf(branch) === -1) {
            $scope.checkedBranch.push(branch);
        } else {
            $scope.checkedBranch.splice($scope.checkedBranch.indexOf(branch), 1);
        }
        console.log($scope.checkedBranch);
    };

    $scope.changeProvince = function(provinceID) {
        $scope.listDistrict = "";
        $scope.listArea = "";
        $scope.postalCode = "";
        CustomerService.getDistrict(provinceID).then(getDistrictListSuccess);
    };

    function getDistrictListSuccess(response) {
        $scope.listDistrict = response.data;
    }

    $scope.changeDistrict = function(districtID) {
        $scope.listArea = "";
        $scope.postalCode = "";
        CustomerService.getArea(districtID).then(getAreaListSuccess);
    };

    function getAreaListSuccess(response) {
        $scope.listArea = response.data;
    }

    $scope.changeArea = function(areaID) {
        $scope.postalCode = "";
        CustomerService.getPostalCode(areaID).then(getPostalCodeSuccess);
    };

    function getPostalCodeSuccess(response) {
        $scope.listPostalCode = response.data;
        angular.forEach(response.data, function(i) {
            $scope.postalCode = i['postal_code'];
        });
    }

    $scope.onChangeEmail = function() {
        $scope.emailError = "";
        isSetErrorEmail();
    };

    $scope.onBlurEmail = function() {
        isSetErrorEmail();
    };

    function isSetErrorEmail() {
        if ($scope.email) {
            $scope.emailError = $scope.isValidEmailFormat() ? "" : "อีเมล์ไม่ถูกต้อง";
        }
    }

    $scope.isValidEmailFormat = function() {
        return /\S+@\S+\.\S+/.test($scope.email);
    };

    $scope.ok = function(userId) {
        var data = {
            'id': $scope.id,
            'employee_type_id': $scope.employee_type_id,
            'admin': $scope.admin,
            'code': $scope.code,
            'username': $scope.username,
            'email': $scope.email,
            'password': ($scope.password != "") ? $scope.password : '',
            'login_timeout': 15,
            'updated_by': userId,
            'active': $scope.active,
            'initial': $scope.initial,
            'first_name': $scope.first_name,
            'last_name': $scope.last_name,
            'gender': $scope.gender,
            'birthdate': $scope.birthdate,
            'nationality': $scope.nationality,
            'personal_no': $scope.personalNo,
            'passport_no': $scope.passportNo,
            'marital_status': $scope.maritalStatus,
            'address': $scope.address,
            'province_id': $scope.provinceId,
            'district_id': $scope.districtId,
            'area_id': $scope.areaId,
            'postal_code': $scope.postalCode,
            'home_phone': $scope.homePhone,
            'work_phone': $scope.workPhone,
            'mobile_phone': $scope.mobilePhone,
            'remark': $scope.remark,
            'checkedBranch': $scope.checkedBranch
        };
        //console.log(data);
        EmployeeService.getEmployeeUpdate(data)
            .then(showModal("แก้ไขข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถแก้ไขข้อมูลได้", false));
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    function showModal(message, status) {
        return function() {
            var modalData = {
                message: message,
                title: "ลูกค้า",
                isSaveSuccess: status
            };

            $uibModal.open({
                animation: true,
                templateUrl: 'dismiss_modal.html',
                controller: 'DismissModalController',
                backdrop: "static",
                size: "md",
                resolve: {
                    modalData: modalData
                }
            }).result.then(function() {
                if (status) {
                    $uibModalInstance.close();
                }
            });
        };
    }
});


app.controller('UpdateProfileModalController', function($uibModalInstance, $scope, CustomerService, $uibModal, EmployeeService, modalData) {

    $scope.init = function() {
        $scope.id = modalData.userId;
        CustomerService.getProvince().then(function(response) {
            $scope.listProvince = response.data;
        });

        EmployeeService.getEmployeeView($scope.id).then(function(data) {
            $scope.username = data['username'];
            $scope.email = data['email'];
            $scope.employee_type_id = data['employee_type_id'];
            $scope.admin = data['admin'];
            $scope.code = data['code'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.active = data['active'];
            $scope.initial = data['initial'];
            $scope.first_name = data['first_name'];
            $scope.last_name = data['last_name'];
            $scope.gender = data['gender'];
            $scope.birthdate = data['birthdate'];
            $scope.marital_status = data['marital_status'];
            $scope.address = data['address'];
            $scope.province_id = data['province_id'];
            $scope.district_id = data['district_id'];
            $scope.area_id = data['area_id'];
            $scope.postal_code = data['postal_code'];
            $scope.home_phone = data['home_phone'];
            $scope.work_phone = data['work_phone'];
            $scope.mobile_phone = data['mobile_phone'];
            $scope.remark = data['remark'];

            if ($scope.province_id != "") {
                $scope.changeProvince($scope.province_id);
                $scope.changeDistrict($scope.district_id);
                $scope.changeArea($scope.area_id);
            }

        });
    };

    $scope.changeProvince = function(provinceID) {
        $scope.listDistrict = "";
        $scope.listArea = "";
        $scope.postal_code = "";
        CustomerService.getDistrict(provinceID).then(getDistrictListSuccess);
    };

    function getDistrictListSuccess(response) {
        $scope.listDistrict = response.data;
    }

    $scope.changeDistrict = function(districtID) {
        $scope.listArea = "";
        $scope.postal_code = "";
        CustomerService.getArea(districtID).then(getAreaListSuccess);
    };

    function getAreaListSuccess(response) {
        $scope.listArea = response.data;
    }

    $scope.changeArea = function(areaID) {
        $scope.postal_code = "";
        CustomerService.getPostalCode(areaID).then(getPostalCodeSuccess);
    };

    function getPostalCodeSuccess(response) {
        $scope.listPostalCode = response.data;
        angular.forEach(response.data, function(i) {
            $scope.postal_code = i['postal_code'];
        });
    }

    $scope.onChangeEmail = function() {
        $scope.emailError = "";
        isSetErrorEmail();
    };

    $scope.onBlurEmail = function() {
        isSetErrorEmail();
    };

    function isSetErrorEmail() {
        if ($scope.email) {
            $scope.emailError = $scope.isValidEmailFormat() ? "" : "อีเมล์ไม่ถูกต้อง";
        }
    }

    $scope.isValidEmailFormat = function() {
        return /\S+@\S+\.\S+/.test($scope.email);
    };

    $scope.ok = function(userId) {
        var data = {
            'id': $scope.id,
            'employee_type_id': $scope.employee_type_id,
            'admin': $scope.admin,
            'email': $scope.email,
            'code': null,
            'updated_by': $scope.updated_by,
            'active': $scope.active,
            'initial': $scope.initial,
            'first_name': $scope.first_name,
            'last_name': $scope.last_name,
            'gender': $scope.gender,
            'birthdate': $scope.birthdate,
            'marital_status': $scope.marital_status,
            'address': $scope.address,
            'province_id': $scope.province_id,
            'district_id': $scope.district_id,
            'area_id': $scope.area_id,
            'postal_code': $scope.postal_code,
            'home_phone': $scope.home_phone,
            'work_phone': $scope.work_phone,
            'mobile_phone': $scope.mobile_phone,
            'remark': $scope.remark,
            'updated_by': userId
        };

        EmployeeService.setEmployeeUpdateProfile(data)
            .then(showModal("แก้ไขข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถแก้ไขข้อมูลได้", false));
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    function showModal(message, status) {
        return function() {
            var modalData = {
                message: message,
                title: "ลูกค้า",
                isSaveSuccess: status
            };

            $uibModal.open({
                animation: true,
                templateUrl: 'dismiss_modal.html',
                controller: 'DismissModalController',
                backdrop: "static",
                size: "md",
                resolve: {
                    modalData: modalData
                }
            }).result.then(function() {
                if (status) {
                    $uibModalInstance.close();
                }
            });
        };
    }

});