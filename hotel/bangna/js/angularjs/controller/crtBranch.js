app.controller('BranchController', function($scope, BranchSerivce, $http, $location, CustomerService, $uibModal) {
    var $scope = this;
    $scope.init = function() {
        $scope.getDataListAll();
    };

    $scope.manageBranchModal = function(branchId, userId, branchName) {
        $uibModal.open({
            animation: true,
            templateUrl: 'manageBranchModalContent.html',
            controller: 'ManageBranchModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    branchId: branchId,
                    userId: userId,
                    branchName: branchName
                }
            }
        }).result.then(function() {
            $scope.getDataListAll();
            $location.path('/');
            window.location.reload(false);
        });
    };

    $scope.getDataListAll = function() {
        BranchSerivce.getBranchList().then(function(data) {
            $scope.listBranch = data;
        });
    };

    // Sort data
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };


    $scope.btnDelete = function(id) {
        $scope.id = id;
        BranchSerivce.getBranchView(id).then(function(data) {
            $scope.name = data['name'];
        });
    }

    $scope.confirmDelete = function(id) {
        BranchSerivce.getBranchDelete({
            id: id
        }).then(function() {
            $location.path('/');
            window.location.reload(false);
        });
    };

});

app.controller('ManageBranchModalController', function($uibModalInstance, $scope, modalData, CustomerService, BranchSerivce, $uibModal) {
    $scope.init = function() {
        $scope.id = modalData.branchId;
        $scope.titleheader = $scope.id === 0 ? "เพิ่มสาขา" : "แก้ไขสาขา";
        $scope.branchName = modalData.branchName;
        $scope.userId = modalData.userId;
        CustomerService.getProvince().then(function(response) {
            $scope.listProvince = response.data;
        });

        if ($scope.id != 0) {
            BranchSerivce.getBranchView($scope.id).then(function(data) {
                $scope.id = data['id'];
                $scope.active = data['active'];
                $scope.published = data['published'];
                $scope.name = data['name'];
                $scope.remark = data['remark'];
                $scope.address = data['address'];
                $scope.province_id = data['province_id'];
                $scope.district_id = data['district_id'];
                $scope.area_id = data['area_id'];
                $scope.postal_code = data['postal_code'];
                $scope.map_data = data['map_data'];
                $scope.phone = data['phone'];
                $scope.fax = data['fax'];
                $scope.seo_title = data['seo_title'];
                $scope.seo_description = data['seo_description'];
                $scope.seo_keywords = data['seo_keywords'];

                if ($scope.map_data.length != 0) {
                    var mapDataSplit = $scope.map_data.split(',');

                    $scope.latitude = parseFloat(mapDataSplit[0]);
                    $scope.longitude = parseFloat(mapDataSplit[1]);
                }

                if ($scope.province_id != "") {
                    $scope.changeProvince($scope.province_id);
                    $scope.changeDistrict($scope.district_id);
                    $scope.changeArea($scope.area_id);
                }
            });
        } else {
            $scope.active = 1;
            $scope.published = 1;
        }
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

    $scope.ok = function(userId) {
        var map_data = '';

        if ($scope.latitude != "" && $scope.longitude != "") {
            map_data = $scope.latitude + ',' + $scope.longitude;
        }
        var data = {
            'active': $scope.active,
            'published': $scope.published,
            'name': $scope.name,
            'remark': $scope.remark,
            'address': $scope.address,
            'province_id': $scope.province_id,
            'district_id': $scope.district_id,
            'area_id': $scope.area_id,
            'postal_code': $scope.postal_code,
            'map_data': map_data,
            'phone': $scope.phone,
            'fax': $scope.fax,
            'seo_title': $scope.seo_title,
            'seo_description': $scope.seo_description,
            'seo_keywords': $scope.seo_keywords
        }
        if ($scope.id != 0) {
            data.id = $scope.id;
            data.updated_by = $scope.userId;
            BranchSerivce.getBranchUpdate(data)
                .then(showModal("แก้ไขข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถแก้ไขข้อมูลได้", false));
        } else {
            data.created_by = $scope.userId;
            data.building_count = 0;
            data.floor_count = 0;
            data.room_count = 0;
            data.room_type_count = 0;
            BranchSerivce.getBranchCreate(data)
                .then(showModal("เพิ่มข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถเพิ่มข้อมูลได้", false));
        }
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    function showModal(message, status) {
        return function() {
            var modalData = {
                message: message,
                title: "สาขา",
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