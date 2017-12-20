app.controller('InventoryController', function($scope, InventoryService, $uibModal, InventoryPushService, InventoryPullService) {
    var $scope = this;
    var id = $("#branch_id").attr('data-val');

    listInventory();

    $scope.init = function(type) {
        if (type === 1) {
            getInventoryPushList();
        } else if (type === 2) {
            getInventoryPullList();
        }
    };

    function getInventoryPullList() {
        InventoryPullService.getInventoryPullList(id)
            .then(function(data) {
                $scope.InventoryPullDataList = data;
            });
    }

    function getInventoryPushList() {
        InventoryPushService.getInventoryPushList(id).then(function(data) {
            $scope.InventoryPushDataList = data;
        });
    }

    function listInventory() {
        $scope.InventoryList = InventoryService.getInventoryList(id).then(function(data) {
            $scope.InventoryDataList = data;
        });
    }

    $scope.sort = function(keyname) {
        $scope.key = keyname;
        $scope.reverse = !$scope.reverse;
    };

    $scope.countQuantity = function(number) {
        return (number > 1) ? "text-success" : "text-danger";
    };

    $scope.addInventoryModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'addInventoryModalContent.html',
            controller: 'addInventoryModalController',
            backdrop: "static",
            resolve: {
                modalData: {
                    id: id
                }
            }
        }).result.then(function(data) {
            var dataSave = {
                branch_id: id,
                product_id: data.id
            };
            InventoryService.saveInventory(dataSave)
                .then(saveInventorySuccess, saveInventoryFail);
        });
    };

    $scope.addInventoryPullOrPushListModal = function(type) {
        $uibModal.open({
            animation: true,
            templateUrl: 'addInventoryPullOrPushListModalContent.html',
            controller: 'AddInventoryPullOrPushListModalController',
            backdrop: "static",
            size: "md",
            resolve: {
                modalData: {
                    type: type,
                    branch_id: id
                }
            }
        }).result.then(function(data) {
            var fieldsList;
            if (data.length > 0) {
                var dataSave = {
                    created_by: data[0].userBy,
                    branch_id: id,
                    reciept_no: data.reciept_no,
                    detail: []
                }

                for (var i = 0; i < data.length; i++) {
                    fieldsList = {
                        product_id: data[i].detail.product_id,
                        quantity: data[i].detail.quantity
                    };
                    dataSave.detail.push(fieldsList);
                }
                if (type === 1) {
                    InventoryPushService.getInventoryUpdate(dataSave)
                        .then(function() {
                            showModal("เพิ่มข้อมูลเรียบร้อยแล้ว", true);
                            getInventoryPushList();
                        }, saveInventoryFail);
                } else {
                    InventoryPullService.getInventoryUpdate(dataSave)
                        .then(function(response) {
                            $scope.openRecieptPrintInventoeyPull(response.model, 2);
                        }, saveInventoryFail);
                }
            }
        });
    };

    $scope.openRecieptPrintInventoeyPull = function(id, type) {
        $uibModal.open({
            animation: true,
            templateUrl: 'reciept_price_inventory_pull_modal_content.html',
            controller: 'RecieptPriceInventoryPullModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        }).result.then(function() {
            if (type === 2) {
                showModal("เพิ่มข้อมูลเรียบร้อยแล้ว", true);
                getInventoryPullList();
            }
        });
    };

    function refreshPage() {
        window.location.reload(false);
    }

    $scope.displayInventoryPush = function(recieptNo, type) {
        $uibModal.open({
            animation: true,
            templateUrl: 'displayMoreInventoryModalContent.html',
            controller: 'displayMoreInventoryModalController',
            backdrop: "static",
            resolve: {
                modalData: {
                    reciept_no: recieptNo,
                    type: type
                }
            }
        });
    }

    function saveInventorySuccess() {
        showModal("เพิ่มข้อมูลเรียบร้อยแล้ว", true);
        listInventory();
    }

    function saveInventoryFail() {
        showModal("ไม่สามารถเพิ่มข้อมูลได้", false);
    }

    function showModal(message, status) {
        var modalData = {
            message: message,
            title: "คลังวัสดุสิ้นเปลือง",
            isSaveSuccess: status
        };

        $uibModal.open({
            animation: true,
            templateUrl: 'dismiss_modal.html',
            controller: 'DismissModalController',
            backdrop: "static",
            size: "md",
            resolve: {
                modalData: modalData,
                status: status
            }
        }).result.then(function() {
            refreshPage();
        });
    }

});

app.controller('RecieptPriceInventoryPullModalController', function($scope, $uibModalInstance, URLRECIEPTINVENTORYPULL, modalData) {

    $scope.urlRecieptPriceInventoryPull = URLRECIEPTINVENTORYPULL + modalData.id;
    $scope.close = function() {
        $uibModalInstance.close();
    };
});

app.controller('DismissModalController', function($uibModalInstance, modalData, $scope) {
    $scope.message = modalData.message;
    $scope.title = modalData.title;
    $scope.isSaveSuccess = modalData.isSaveSuccess;

    $scope.close = function() {
        $uibModalInstance.close();
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});


app.controller('addInventoryModalController', function($scope, $uibModalInstance, InventoryService, modalData) {

    $scope.init = function() {
        InventoryService.getInventoryNotProductByBranchIDList(modalData.id)
            .then(function(response) {
                $scope.inventoryList = response.data;
            });
    };

    $scope.selectInventory = function(data) {
        $uibModalInstance.close(data);
    };

    $scope.ok = function() {
        $uibModalInstance.close();
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('displayMoreInventoryModalController', function($scope, $uibModalInstance, InventoryPushService, modalData, InventoryPullService) {

    $scope.init = function() {
        if (modalData.type === 1) {
            InventoryPushService.getInventoryPushDetailList(modalData.reciept_no)
                .then(getInventoryDetailListSuccess);
        } else if (modalData.type === 2) {
            InventoryPullService.getInventoryPullDetailList(modalData.reciept_no)
                .then(getInventoryDetailListSuccess);
        }
    };

    function getInventoryDetailListSuccess(response) {
        $scope.inventoryDetailList = response;
    }


    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('AddInventoryPullOrPushListModalController', function($scope, $uibModalInstance, ProductService, $uibModal, modalData, InventoryPullService, InventoryPushService) {
    $scope.inventoryPushList = [];

    $scope.init = function() {
        $scope.errorBillNumber = "";
        $scope.title = getTitleInventory(modalData.type);
        $scope.titleAdd = getTitleAddInventory(modalData.type);
        if (modalData.type === 2) {
            $scope.textBill = "เลขที่ใบเบิกสินค้า";
            InventoryPullService.getLastInventoryPullRecieptNo()
                .then(function(billNumber) {
                    $scope.billNumber = billNumber;
                });
        } else {
            $scope.textBill = "หมายเลขบิล";
            InventoryPushService.getLastInventoryPushRecieptNo()
                .then(function(billNumber) {
                    $scope.billNumber = billNumber;
                });
        }
    };

    $scope.changeBillNumber = function(billNumber) {
        $scope.errorBillNumber = "";
        if (billNumber) {
            InventoryPushService.verifyRecieptNo(billNumber)
                .then(function(data) {
                    if (data.reciept_no) {
                        $scope.errorBillNumber = "หมายเลขบิลนี้มีอยู่แล้ว ไม่สามารถใช้ได้";
                    }
                });
        }
    };

    function getTitleAddInventory(type) {
        var listType = {
            "1": "เพิ่มนำเข้าวัสดุสิ้นเปลือง",
            "2": "เพิ่มเบิกออกวัสดุสิ้นเปลือง"
        };
        return listType[type];
    }

    function getTitleInventory(type) {
        var listType = {
            "1": "นำเข้าวัสดุสิ้นเปลือง",
            "2": "เบิกออกวัสดุสิ้นเปลือง"
        };
        return listType[type];
    }

    $scope.ok = function() {
        $scope.inventoryPushList.reciept_no = $scope.billNumber;
        $uibModalInstance.close($scope.inventoryPushList);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.addInventoryDetailModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'addInventoryDetailModalContent.html',
            controller: 'AddInventoryDetailModalController',
            backdrop: "static",
            size: "md",
            resolve: {
                modalData: {
                    branch_id: modalData.branch_id
                }
            }
        }).result.then(function(data) {
            $scope.inventoryPushList.push(data);
        });
    };
});

app.controller('AddInventoryDetailModalController', function($scope, $uibModalInstance, InventoryService, modalData) {

    $scope.init = function() {
        $scope.isDisabledSubmit = true;
        $scope.textErrorQuantity = "";
        InventoryService.getProductHaveInventoryByBranchIDList(modalData.branch_id)
            .then(function(response) {
                $scope.ProductSelectDataList = response;
            });
    };

    $scope.changeProduct = function(id, product) {
        $scope.isDisabledSubmit = true;
        $scope.textErrorQuantity = "";
        var obj = [];
        product.filter(function(res) {
            return res.id == id;
        }).map(function(res) {
            return obj = res;
        });

        $scope.product_id = obj.id;
        $scope.product_name = obj.name;
        $scope.price = parseFloat(obj.price);
        $scope.product_unit = obj.unit;
        $scope.quantityMax = parseFloat(obj.quantity) || 0;
        $scope.quantity = "";
    };

    $scope.quantityOnBlur = function(type) {
        if ($scope.quantity > 0) {
            $scope.isDisabledSubmit = false;
            $scope.textErrorQuantity = "";
            if (type === 2) {
                verifyQuantity();
            }
        } else {
            $scope.isDisabledSubmit = true;
            $scope.textErrorQuantity = "กรุณากรอกจำนวน";
        }
    };

    function verifyQuantity() {
        if ($scope.quantityMax === 0) {
            $scope.isDisabledSubmit = true;
            $scope.textErrorQuantity = "ไม่สามารถเบิกวัสดุสิ้นเปลืองได้ เนื่องจากมีจำนวน " + $scope.quantityMax;
        } else if ($scope.quantityMax < $scope.quantity) {
            $scope.isDisabledSubmit = true;
            $scope.textErrorQuantity = "กรุณากรอกจำนวนน้อยกว่าหรือเท่ากับ " + $scope.quantityMax;
        }
    }

    $scope.ok = function(productSelect, userBy) {
        var productName, productPrice;
        for (i = 0; i < productSelect.length; i++) {
            if ($scope.product === productSelect[i].id) {
                productName = productSelect[i].name;
                productPrice = productSelect[i].price;
            }
        }
        var data = {
            userBy: userBy,
            detail: {
                type: productName,
                price: productPrice,
                sum: $scope.quantity * productPrice,
                quantity: $scope.quantity,
                product_id: $scope.product
            }
        };
        $uibModalInstance.close(data);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

});