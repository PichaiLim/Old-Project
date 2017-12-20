/**
 * Created by Admin on 7/4/16.
 */

app.controller('CustomerController', function($scope, $location, $http, $routeParams, CustomerService, URL, $uibModal) {
    var $scope = this;
    $scope.listAll = [];

    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };

    $scope.addCustomerModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'addCustomerModalContent.html',
            controller: 'AddCustomerModalController',
            backdrop: "static",
            size: "lg"
        }).result.then(function() {
            listCustomer();
        });
    };

    $scope.btnUpdate = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'addCustomerModalContent.html',
            controller: 'EditCustomerModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        }).result.then(function() {
            listCustomer();
        });
    };

    $scope.btnDelete = function(id) {
        var modalData = {
            title: "ลูกค้า",
            message: "คุณต้องการลบข้อมูลหรือไม่ ?"
        };
        $uibModal.open({
            animation: true,
            templateUrl: 'confirmation_modal.html',
            controller: 'ConfirmationModalController',
            backdrop: "static",
            size: "md",
            resolve: {
                modalData: modalData
            }
        }).result.then(function() {
            CustomerService.getCustomerDelete({
                id: id
            }).then(function() {
                dismissModal("ลบข้อมูลเรียบร้อยแล้ว")
            });
        });
    };

    function dismissModal(message) {
        var modalData = {
            message: message,
            title: "ลูกค้า",
            isSaveSuccess: true
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
            listCustomer();
        });
    }

    listCustomer();

    function listCustomer() {
        CustomerService.getCustomerAllList().then(function(data) {
            $scope.listAll = data;
        });
    }

});

app.controller('ConfirmationModalController', function($uibModalInstance, modalData, $scope) {
    $scope.message = modalData.message;
    $scope.title = modalData.title;

    $scope.confirm = function() {
        $uibModalInstance.close();
    };

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('EditCustomerModalController', function($uibModalInstance, modalData, $scope, CustomerService, $uibModal) {

    $scope.init = function() {
        CustomerService.getProvince().then(function(response) {
            $scope.listProvince = response.data;
        });
        $scope.message = "แก้ไขข้อมูลลูกค้า";
        $scope.title = "แก้ไขข้อมูลลูกค้า";
        $scope.id = modalData.id;
        CustomerService.getCustomerView($scope.id).then(function(data) {
            $scope.email = data['email'];
            $scope.created = data['created'];
            $scope.created_by = data['created_by'];
            $scope.active = data['active'];
            $scope.initial = data['initial'];
            $scope.firstName = data['first_name'];
            $scope.lastName = data['last_name'];
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

            if ($scope.provinceId != "") {
                $scope.changeProvince($scope.provinceId);
                $scope.changeDistrict($scope.districtId);
                $scope.changeArea($scope.areaId);
            }

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

    $scope.validateNameAndLastname = function(name, lastName) {
        if (name != "" && lastName != "") {
            CustomerService.validateNameAndLastName({
                first_name: name,
                last_name: lastName
            }).then(validateNameAndLastnameSuccess, resetErrorDuplicateNameAndLastname);
        }
    }

    function validateNameAndLastnameSuccess(data) {
        resetErrorDuplicateNameAndLastname();
        if (data.id != $scope.id && data.id != undefined) {
            $scope.errorDuplicateNameAndLastname = "ชื่อและนามสกุลมีผู้ใช้แล้ว กรุณากรอกใหม่";
        }
    }

    function resetErrorDuplicateNameAndLastname() {
        $scope.errorDuplicateNameAndLastname = "";
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
            if (!$scope.isValidEmailFormat()) {
                CustomerService.validateNameAndLastName({
                    data: {
                        firstName: $scope.firstName,
                        lastName: $scope.lastName
                    }
                }).then(validateNameAndLastNameSuccess, validateNameAndLastNameFail);
            }
        }
    }

    function validateNameAndLastNameSuccess(data) {
        console.log(data);
        $scope.emailError = "";
    }

    function validateNameAndLastNameFail() {
        $scope.emailError = "";
    }

    $scope.isValidEmailFormat = function() {
        return /\S+@\S+\.\S+/.test($scope.email);
    };

    $scope.ok = function(userId) {
        var data = {
            'id': $scope.id,
            'email': $scope.email,
            'created_by': userId,
            'updated_by': userId,
            'active': $scope.active,
            'initial': $scope.initial,
            'first_name': $scope.firstName,
            'last_name': $scope.lastName,
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
            'remark': $scope.remark
        };

        CustomerService.getCustomerUpdate(data)
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