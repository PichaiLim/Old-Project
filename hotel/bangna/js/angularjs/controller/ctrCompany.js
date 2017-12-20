app.controller('CompanyController', function($scope, $uibModal) {
    var $scope = this;
    $scope.editCompanyModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'companyModalContent.html',
            controller: 'CompanyModalController',
            backdrop: "static",
            size: "lg"
        });
    };

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

app.controller('CompanyModalController', function($uibModalInstance, $scope, CompanyService, $uibModal) {

    $scope.init = function() {
        $scope.message = "แก้ไขข้อมูลลูกค้า";
        $scope.title = "แก้ไขข้อมูลลูกค้า";
        CompanyService.getCompanyView().then(function(data) {
            $scope.name_th = data['name_th'];
            $scope.name_en = data['name_en'];
            $scope.address_th = data['address_th'];
            $scope.address_en = data['address_en'];
            $scope.tel = data['tel'];
            $scope.fax = data['fax'];
        });
    };

    $scope.ok = function(userId) {
        var data = {
            'name_th': $scope.name_th,
            'name_en': $scope.name_en,
            'address_th': $scope.address_th,
            'address_en': $scope.address_en,
            'tel': $scope.tel,
            'fax': $scope.fax,
            'updated_by': userId
        };

        CompanyService.companyUpdate(data)
            .then(showModal("แก้ไขข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถแก้ไขข้อมูลได้", false));
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    function showModal(message, status) {
        return function() {
            var modalData = {
                message: message,
                title: "ข้อมูลบริษัท",
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
                    $uibModalInstance.dismiss('cancel');
                }
            });
        };
    }

});