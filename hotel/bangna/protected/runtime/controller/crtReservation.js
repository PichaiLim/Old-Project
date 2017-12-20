/**
 * Created by Admin on 7/20/16.
 */

/*  remark status room
 = ปิดปรับปรุง,
1 = ห้องว่าง,
2 = เช็คอิน,
3 = เช็คเอ้า,
5 = ย้ายห้อง,
4 = จอง,
6 = ยกเลิกจอง

page
1= จัดการห้อง,
2= จัดการจอง
3= หน้ายืนยันการชำระเงิน
4=ประวัติการจอง
  */
app.controller('ReservationController', function($scope, $location, $http, $routeParams, ReservationService,
    $uibModal, DateUtilService, $filter) {
    var $scope = this;

    var branch_id = $('body').attr('data-branch-id');
    $scope.datePicker = $filter('date')(new Date(), "yyyy-MM-dd");
    $scope.building = [];
    var buildingNumberID = 0,
        payee = 7,
        floorNumberID = 0,
        status = "";
    $scope.amount = 0;
    $scope.deposit = null;

    $(function() {
        $("#datepicker-left").datepicker({
            inline: true,
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            onSelect: function(dateText, inst) {
                $scope.roomList = "";
                $scope.buildingList = "";
                $scope.floorList = "";
                $scope.building_id = "";
                $scope.datePicker = dateText;
                $scope.building();
            }
        });
    });

    $scope.init = function(pageId, branchID) {
        branch_id = branchID;
        if (pageId == 2) {
            $scope.getReservationDataAllList();
        } else {
            $scope.building();
        }
    };

    $scope.checkStatus = function(status) {
        var roomNameMapping = {
            "checkin": "เช็คอิน",
            "checkout": "เช็คเอ้า",
            "reserved": "จอง",
            "cancelled": "ยกเลิกจอง"
        };
        return roomNameMapping[status];
    };

    $scope.getPaymentDataList = function(branchID) {
        ReservationService.getPaymentAll(branchID)
            .then(function(data) {
                $scope.setPaymentDataAllList = data;
            });
    };

    function getTemplateReservation(reservationId) {
        return reservationId ? "manageRoomReadModalContent.html" : "manageRoomModalContent.html";
    }

    $scope.manageRoomModal = function(roomID, roomName, type, reservationId, page) {
        var data = {
            id: roomID,
            branch_id: branch_id
        };
        ReservationService.getRoomByRoomIdAndBranchId(data)
            .then(openModalManageRoom(type, roomName, reservationId, page));
    };

    $scope.openInvoice = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'refund_price_modal_content.html',
            controller: 'RefundPriceModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        });
    };

    $scope.openRecieptPrint = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'reciept_price_modal_content.html',
            controller: 'RecieptPriceModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        });
    };

    function openModalManageRoom(type, roomName, reservationId, page) {
        return function(response) {
            var dataRoom = response.data;
            $uibModal.open({
                animation: true,
                templateUrl: setTemplateMapping(type, reservationId),
                controller: 'ManageRoomModalController',
                backdrop: "static",
                size: "lg",
                resolve: {
                    modalData: {
                        type: type,
                        roomName: roomName,
                        dataRoom: dataRoom,
                        reservationId: reservationId,
                        branchId: branch_id,
                        datePicker: $scope.datePicker
                    }
                }
            }).result.then(updateDeposit(dataRoom, type, reservationId, page));
        };
    }

    function setTemplateMapping(type, reservationId) {
        var templateMapping = {
            "2": getTemplateReservation(reservationId),
            "3": "manageRoomReadModalContent.html",
            "4": getTemplateReservation(reservationId),
            "5": "manageRoomMoveModalContent.html",
            "6": "manageRoomReadModalContent.html"
        };
        return templateMapping[type];
    }

    function updateDeposit(dataRoom, type, reservationId, page) {
        return function(data) {
            if (data.give_paid_status === 'no' && (type === 3 || type === 6 || type === 5)) {
                saveReservedOrHistory(data, dataRoom, type, reservationId, page);
            } else {
                ReservationService.updateDeposit({
                    id: data.customer_id,
                    updated_by: data.userId,
                    deposit: data.depositUpdate
                }).then(saveReserved(data, dataRoom, type, reservationId, page));
            }
        };
    }

    function saveReserved(data, dataRoom, type, reservationId, page) {
        return function() {
            saveReservedOrHistory(data, dataRoom, type, reservationId, page);
        };
    }

    function saveReservedOrHistory(data, dataRoom, type, reservationId, page) {
        if (reservationId) {
            ReservationService.getReservationByPk(reservationId)
                .then(function(response) {
                    ReservationService.saveReservationHistory(getDataReservationHistoryForSave(response.data))
                        .then(updateReservation(data, reservationId, dataRoom.floor_id, type, page));
                    if (type == 3) {
                        $scope.openInvoice(reservationId);
                    } else if (type == 2) {
                        $scope.openRecieptPrint(reservationId);
                    }
                });
        } else {
            ReservationService.saveReservation(getDataReservationForSave(data, dataRoom, branch_id))
                .then(updateRoomStatus(dataRoom.floor_id, page));
        }
    }

    function updateReservation(data, reservationId, floor_id, type, page) {
        return function() {
            ReservationService.updateReservation(getDataReservationForUpdate(data, reservationId, type))
                .then(updateRoomStatus(floor_id, page));
        };
    }

    function updateRoomStatus(floor_id, page) {
        return function(response) {
            var dataSaveOrUpdateReservation = response.data.Reservation;
            if (dataSaveOrUpdateReservation.paid_status == 'yes' && dataSaveOrUpdateReservation.status == 'reserved') {
                $scope.openRecieptPrint(dataSaveOrUpdateReservation.id);
            }
            if (page == 1) {
                $scope.clickSelectFloor(floor_id);
            } else {
                $scope.getReservationDataAllList();
            }
            window.location.reload(true);
        };
    }

    $scope.getReservationDataAllList = function() {
        ReservationService.getReservationDataAll(branch_id)
            .then(function(data) {
                $scope.setReservationDataAllList = data;
            });
    };

    function getDataReservationHistoryForSave(data) {
        return {
            reservation_id: data.id || "",
            reciept_no: data.reciept_no || "",
            branch_id: data.branch_id || "",
            building_id: data.building_id || "",
            floor_id: data.floor_id || "",
            room_id: data.room_id || "",
            customer_id: data.customer_id || "",
            created: data.created || "",
            created_by: data.created_by || "",
            updated: data.updated || null,
            updated_by: data.updated_by || null,
            status: data.status || "",
            paid_status: data.paid_status || "",
            paid: data.paid || null,
            payee: data.payee || "",
            start: data.start || "",
            end: data.end || "",
            num_days: data.num_days || "",
            price: data.price || "",
            deposit: data.deposit || "",
            used_deposit_old: data.used_deposit_old || "",
            deposit_with_me: data.deposit_with_me || "",
            amount: data.amount || ""
        };
    }

    function getDataReservationForUpdate(data, id, type) {
        if (type === 5) {
            return {
                id: id,
                reciept_no: (data.paid_status.toLowerCase() == "no") ? null : "DRC" + DateUtilService.yearNow() + "-",
                updated_by: data.userId,
                status: data.status,
                payee: (data.paid_status === 'no') ? null : data.userId,
                paid_status: data.paid_status,
                building_id: data.building,
                floor_id: data.floor,
                room_id: data.room,
                price: parseFloat(data.price).toFixed(2).toString(),
                deposit: parseFloat(data.deposit).toFixed(2).toString(),
                used_deposit_old: parseFloat(data.used_deposit_old).toFixed(2).toString(),
                deposit_with_me: parseFloat(data.deposit_with_me).toFixed(2).toString(),
                amount: parseFloat(data.amount).toFixed(2).toString(),
                type: type
            };
        } else {
            return {
                id: id,
                reciept_no: (data.paid_status.toLowerCase() == "no") ? null : "DRC" + DateUtilService.yearNow() + "-",
                updated_by: data.userId,
                status: data.status,
                payee: (data.paid_status === 'no') ? null : data.userId,
                paid_status: data.paid_status,
                deposit_with_me: parseFloat(data.deposit_with_me).toFixed(2).toString(),
                type: type
            };
        }
    }

    function getDataReservationForSave(data, dataRoom, branch_id) {
        return {
            id: null,
            reciept_no: (data.paid_status.toLowerCase() == "no") ? null : "DRC" + DateUtilService.yearNow() + "-",
            branch_id: branch_id,
            building_id: dataRoom.building_id,
            floor_id: dataRoom.floor_id,
            room_id: dataRoom.room_id,
            customer_id: data.customer_id,
            created: DateUtilService.dateNow(),
            created_by: data.userId,
            updated: null,
            updated_by: null,
            status: data.status,
            paid_status: data.paid_status,
            paid: (data.paid_status === 'no') ? null : DateUtilService.yearNow(),
            payee: (data.paid_status === 'no') ? null : data.userId,
            start: data.start,
            end: data.end,
            num_days: parseInt(data.num_days),
            price: parseFloat(data.price).toFixed(2).toString(),
            deposit: parseFloat(data.deposit).toFixed(2).toString(),
            used_deposit_old: parseFloat(data.used_deposit_old).toFixed(2).toString(),
            deposit_with_me: parseFloat(data.deposit_with_me).toFixed(2).toString(),
            amount: parseFloat(data.amount).toFixed(2).toString()
        };
    }

    $scope.building = function() {
        return ReservationService.getBranchByFk(branch_id).then(function(data) {
            $scope.buildingList = data;
            return data;
        });
    };

    $scope.changeFloor = function(buildingID) {
        $scope.floorList = [];
        $scope.floorList = ReservationService.getFloorByFK(buildingID).then(function(data) {
            $scope.countStatusRoom(data, buildingID);
        });
        return buildingNumberID = buildingID;
    };

    $scope.countStatusRoom = function(dataFloor, buildingID) {
        for (var i = 0; i < dataFloor.length; i++) {
            ReservationService.countStatusRoom({
                branch_id: branch_id,
                building_id: buildingID,
                floor_id: dataFloor[i].id,
                startDate: $scope.datePicker
            }).then(function(response) {
                $scope.floorList = dataFloor.map(setFloorList(response.data));
            });
        }

    };

    function setFloorList(dataCountStatus) {
        return function(dataFloor) {
            return {
                branch_id: dataFloor.branch_id,
                building_id: dataFloor.building_id,
                id: dataFloor.id,
                name: dataFloor.name,
                emptyRoom: dataCountStatus.emptyRoom || 0,
                reservationRoom: dataCountStatus.reservationRoom || 0,
                checkinRoom: dataCountStatus.checkinRoom || 0,
                closeRoom: dataCountStatus.closeRoom || 0
            };
        };
    }

    $scope.clickSelectFloor = function(floor_id, date) {
        var data = {
            branch_id: branch_id,
            building_id: buildingNumberID,
            floor_id: floor_id
        };

        $scope.room = ReservationService.getRoomByFK(data).then(function(response) {
            ReservationService.getReservationByStartDate({
                startDate: $scope.datePicker
            }).then(getReservationByStartDateSuccess(response.models));
        });
        return floorNumberID = floor_id;
    };

    function getReservationByStartDateSuccess(roomList) {
        return function(response) {
            $scope.roomList = roomList.map(setRoomList(response.data));
        };
    }

    $scope.calNotSumDeposit = function(num_days, price) {
        return parseFloat(price) * parseFloat(num_days);
    };

    $scope.calSumDeposit = function(num_days, price, deposit) {
        return (parseFloat(price) * parseFloat(num_days)) + parseFloat(deposit);
    };

    function setRoomList(reservationList) {
        return function(roomList) {
            var data, status;
            data = {
                id: roomList.id,
                name: roomList.name,
                roomData: [],
                selectDate: $scope.datePicker
            };

            var dataRoomList = [];
            dataRoomList.status = roomList.active;
            dataRoomList.endDate = "";
            dataRoomList.reservationId = "";
            for (var i = 0; i < reservationList.length; i++) {
                if (roomList.id === reservationList[i].room_id) {
                    if (reservationList[i].status === 'checkin') {
                        dataRoomList.status = "2";
                        dataRoomList.reservationId = reservationList[i].id;
                    } else if (reservationList[i].status === 'checkout') {
                        dataRoomList.status = "3";
                        dataRoomList.reservationId = reservationList[i].id;
                    } else if (reservationList[i].status === 'reserved') {
                        dataRoomList.status = "4";
                        dataRoomList.reservationId = reservationList[i].id;
                    }
                    dataRoomList.endDate = reservationList[i].end;
                    // data.roomData.push(dataRoomList);
                }
            }
            data.roomData.push(dataRoomList);
            // console.log(data);
            return data;
        }
    }

    $scope.checkTextStatusRoom = function(status) {
        var result;
        if (status === "1" || status === "3" || status === "5" || status === "6") {
            result = "ว่าง";
        } else if (status === "2") {
            result = "เช็คอิน";
        } else if (status === "4") {
            result = "จอง";
        } else {
            result = "ปิดปรับปรุง";
        }

        return result;
    };

    $scope.checkStyleStatusRoom = function(status) {
        var result;
        if (status === "1" || status === "3" || status === "5" || status === "6") {
            result = "tiles-white";
        } else if (status === "2") {
            result = "tiles-success";
        } else
        if (status === "4") {
            result = "tiles-blue";
        } else {
            result = "tiles-orange";
        }

        return result;
    };

    $scope.clickChangeActive = function(roomID, typeOfEnum) {
        var id = roomID;
        var type = typeOfEnum;

        switch (type) {
            case 'open':
                ReservationService.setRoomUpdateStatusActive({
                    id: id,
                    active: '1'
                });
                break;
            case 'close':
                ReservationService.setRoomUpdateStatusActive({
                    id: id,
                    active: ''
                });
                break;
            default:
                ReservationService.setRoomUpdateStatusActive({
                    id: id,
                    active: '1'
                });
                break;
        };
        window.location.reload(false);
    };

    function getRoomByRoomIdAndBranchIdSuccess(response) {
        var data = response.data;
        $scope.branch_id = data.branch_id;
        $scope.building_id = data.building_id;
        $scope.building_name = data.building_name;

        $scope.floor_id = data.floor_id;
        $scope.floor_name = data.floor_name;
        $scope.room_id = data.room_id;
        $scope.room_type_id = data.room_type_id;
        $scope.roomTypeName = data.roomTypeName;
        $scope.price = parseFloat(data.roomTypePrice);
        $scope.deposit = parseFloat(data.roomTypeDeposit);
        $scope.paid_status = 'no';
    }

    // Sort data
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };
});

app.controller('RefundPriceModalController', function($scope, $uibModalInstance, URLREFUND, modalData) {

    $scope.urlRefundInvoice = URLREFUND + modalData.id;

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('RecieptPriceModalController', function($scope, $uibModalInstance, URLRECIRPT, modalData) {

    $scope.urlRecieptInvoice = URLRECIRPT + modalData.id;

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };
});


app.controller('ManageRoomModalController', function($scope, $uibModalInstance, modalData, ReservationService, $uibModal, DateUtilService, CustomerService) {
    var roomMoveType = "5",
        roomCheckoutType = "3",
        roomCheckinType = "2",
        roomReservatedType = "4";

    $scope.changeBuilding = function() {
        $scope.selectedFloor = "";
        $scope.selectedRoom = "";
        resetInformationRoomNew();
        $scope.floorList = ReservationService.getFloorByFK($scope.selectedBuilding).then(function(data) {
            $scope.floorList = data;
        });
    };

    $scope.changeFloor = function() {
        var dataGetRoom = {
            branch_id: modalData.branchId,
            building_id: $scope.selectedBuilding,
            floor_id: $scope.selectedFloor
        };
        $scope.selectedRoom = "";
        resetInformationRoomNew();
        $scope.room = ReservationService.getRoomNotReservation(dataGetRoom)
            .then(getRoomNotReservationSuccess);
    };

    function resetInformationRoomNew() {
        $scope.roomTypeNameNew = "";
        $scope.priceNew = "";
        $scope.depositNew = "";
        $scope.depositOldNew = "";
        $scope.amountNew = "";
    }

    function getRoomNotReservationSuccess(response) {
        $scope.roomList = response.data.models;
    }

    $scope.changeRoom = function(selectedRoom) {
        $scope.errorRoom = "";
        resetInformationRoomNew();
        ReservationService.getDepositInCustomerByPK($scope.customerId)
            .then(function(depositCustomer) {
                angular.forEach($scope.roomList, function(value, key) {
                    if (value.id === selectedRoom) {
                        $scope.roomTypeNameNew = value.roomTypeName;
                        $scope.priceNew = parseFloat(value.price);
                        $scope.depositNew = parseFloat(value.deposit);
                        $scope.depositOldNew = parseFloat($scope.depositOld);
                        $scope.amountNew = calRoomSumDeposit(parseFloat(value.price), $scope.num_days, $scope.depositNew);
                        if ($scope.priceNew !== $scope.price || $scope.depositNew !== $scope.deposit) {
                            $scope.errorRoom = "ไม่สามารถเลือกห้องที่ราคาต่างกันได้";
                        }
                    }
                });
            });

    };

    function calRoomSumDeposit(price, days, deposit) {
        return (parseFloat(price) * parseFloat(days)) + deposit;
    }

    $scope.roomNameMapping = function(type) {
        var roomNameMapping = {
            "2": "เช็คอิน",
            "3": "เช็คเอ้า",
            "4": "จอง",
            "5": "ย้ายห้อง",
            "6": "ยกเลิกจอง"
        };
        return roomNameMapping[type];
    };

    $scope.isCancelledReserved = function(type) {
        return type === 6;
    };

    $scope.iconMapping = function(type) {
        var iconMapping = {
            "2": "fa-arrow-right",
            "3": "fa-arrow-left",
            "4": "fa-flag",
            "5": "fa-exchange",
            "6": "fa-flag"
        };
        return iconMapping[type];
    };

    $scope.customers = function() {
        $scope.setCustomerList = ReservationService.getCustomerAll().then(function(data) {
            $scope.CustomerList = data;
        });
    };

    $scope.searchCustomerModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'searchCustomerModalContent.html',
            controller: 'SearchCustomerModalController',
            backdrop: "static",
            resolve: {
                modalData: modalData
            }
        }).result.then(function(data) {
            $scope.depositOld = parseFloat(data.deposit);
            $scope.amount = (parseFloat(modalData.dataRoom.roomTypePrice) + parseFloat(modalData.dataRoom.roomTypeDeposit)) - $scope.depositOld;
            $scope.customerName = data.first_name + " " + data.last_name;
            $scope.customerId = data.id;
        });
    };

    $scope.addCustomerModal = function() {
        $uibModal.open({
            animation: true,
            templateUrl: 'addCustomerModalContent.html',
            controller: 'AddCustomerModalController',
            backdrop: "static",
            size: "lg"
        }).result.then(function(data) {});
    };

    function roomStatusMapping(type) {
        var roomStatusMapping = {
            "2": "checkin",
            "3": "checkout",
            "4": "reserved",
            "6": "cancelled"
        };
        return roomStatusMapping[type];
    }

    $scope.init = function() {
        $scope.data = modalData;
        $scope.price = parseFloat(modalData.dataRoom.roomTypePrice);
        $scope.deposit = parseFloat(modalData.dataRoom.roomTypeDeposit);
        $scope.amount = $scope.price + $scope.deposit;
        $scope.paid_status = "no";
        $scope.paid_deposit = "no";
        $scope.give_paid_status = "no";
        $scope.textAmount = "ยอดรวมที่ต้องชำระ";
        $scope.isDisablePaidStatus = false;
        $scope.status = roomStatusMapping(modalData.type);
        $scope.start = modalData.datePicker;
        if ($scope.data.type == roomMoveType) {
            $scope.textAmountNew = "ยอดรวมที่ต้องชำระ";
            $scope.textPaidStatusNew = "ชำระเงินแล้ว";
            $scope.paid_status_new = "yes";
            ReservationService.getBranchByFk(modalData.branchId).then(function(data) {
                $scope.buildingList = data;
            });
        }

        if (modalData.reservationId) {
            ReservationService.getReservationByPk(modalData.reservationId).then(function(response) {
                var dataReservation = response.data;
                $scope.start = dataReservation.start;
                $scope.end = dataReservation.end;
                $scope.num_days = dataReservation.num_days;
                $scope.price = parseFloat(dataReservation.price);
                $scope.deposit = parseFloat(dataReservation.deposit);
                $scope.amount = parseFloat(dataReservation.amount);
                $scope.paid_status = dataReservation.paid_status;
                $scope.paid_deposit = dataReservation.paid_deposit;
                $scope.description = dataReservation.description;
                if ($scope.paid_status === 'yes') {
                    $scope.isDisablePaidStatus = true;
                }
                $scope.customerId = dataReservation.customer_id;
                $scope.depositOld = parseFloat(dataReservation.used_deposit_old);
                if ($scope.data.type == roomMoveType) {
                    $scope.status = dataReservation.status;
                }
                CustomerService.getCustomerView(dataReservation.customer_id).then(function(data) {
                    $scope.customerName = data.first_name + " " + data.last_name;
                });

                ReservationService.getRoomNameByPK(dataReservation.room_id).then(function(data) {
                    $scope.roomTypeName = data.name;
                });
            });
        }
    };

    $scope.ok = function(userId) {
        var depositUpdate = 0,
            deposit_with_me = 0;
        var amount = $scope.amount;
        var used_deposit_old = $scope.depositOld;
        var price = $scope.price;
        var deposit = $scope.deposit;
        var paid_status = $scope.paid_status;
        var selectedBuilding = "",
            selectedFloor = "",
            selectedRoom = "";
        if ($scope.data.type == roomMoveType) {
            selectedBuilding = $scope.selectedBuilding;
            selectedFloor = $scope.selectedFloor;
            selectedRoom = $scope.selectedRoom;
        } else if ($scope.data.type == roomCheckoutType) {
            if ($scope.give_paid_status === "yes" && $scope.paid_status === "yes") {
                depositUpdate = $scope.deposit;
                deposit_with_me = $scope.deposit;
            }
        } else if ($scope.data.type == roomCheckinType || $scope.data.type == roomReservatedType) {
            if ($scope.depositOld > $scope.amount) {
                amount = 0;
                depositUpdate = parseFloat($scope.amount);
                used_deposit_old = parseFloat($scope.depositOld) - parseFloat($scope.amount);
            }
        }

        var data = {
            customer_id: $scope.customerId,
            userId: userId,
            paid_status: paid_status,
            start: $scope.start,
            end: $scope.end,
            num_days: $scope.num_days,
            price: price,
            deposit: deposit,
            depositUpdate: depositUpdate,
            used_deposit_old: used_deposit_old,
            give_paid_status: $scope.give_paid_status,
            amount: amount,
            status: $scope.status,
            building: selectedBuilding,
            floor: selectedFloor,
            room: selectedRoom,
            deposit_with_me: deposit_with_me,
            paid_deposit: $scope.paid_deposit,
            description: $scope.description
        };
        $uibModalInstance.close(data);
    };

    $scope.isPaidDeposit = function(){
        if($scope.paid_deposit === 'yes'){
            $scope.num_days = DateUtilService.dateDiff($scope.start, $scope.end);
            var priceAllDay = (parseFloat($scope.num_days) * parseFloat($scope.price));
            if (priceAllDay > parseFloat($scope.depositOld)) {
                $scope.amount = priceAllDay - parseFloat($scope.depositOld);
            } else {
                $scope.paid_status = "yes";
                $scope.textAmount = "ยอดเงินค่ามัดจำเดิมคงเหลือ";
                $scope.isDisablePaidStatus = true;
                $scope.amount = parseFloat($scope.depositOld) - priceAllDay;
            }
        }else{
            calulateaAmount();
        }
    };

    $scope.calulateDate = function() {
        if ($scope.start && $scope.end) {
            calulateaAmount();
        }
    };

    function calulateaAmount(){
        $scope.num_days = DateUtilService.dateDiff($scope.start, $scope.end);
        var priceAllDay = (parseFloat($scope.num_days) * parseFloat($scope.price)) + parseFloat($scope.deposit);
        if (priceAllDay > parseFloat($scope.depositOld)) {
            $scope.amount = priceAllDay - parseFloat($scope.depositOld);
        } else {
            $scope.paid_status = "yes";
            $scope.textAmount = "ยอดเงินค่ามัดจำเดิมคงเหลือ";
            $scope.isDisablePaidStatus = true;
            $scope.amount = parseFloat($scope.depositOld) - priceAllDay;
        }
    }

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('SearchCustomerModalController', function($scope, $uibModalInstance, ReservationService) {

    $scope.init = function() {
        ReservationService.getCustomerAll().then(function(data) {
            $scope.CustomerList = data;
        });
    };

    $scope.selectCustomer = function(data) {
        $uibModalInstance.close(data);
    };

    $scope.ok = function() {
        $uibModalInstance.close();
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('AddCustomerModalController', function($scope, $uibModalInstance, CustomerService, $uibModal) {
    $scope.listAll = [];
    $scope.listProvince = {};
    $scope.listDistrict = {};
    $scope.listArea = {};
    $scope.listPostalCode = {};
    $scope.title = "เพิ่มข้อมูลลูกค้า";

    $scope.init = function() {
        $scope.maritalStatus = "single";
        $scope.active = "1";
        $scope.gender = "male";
        CustomerService.getProvince().then(function(response) {
            $scope.listProvince = response.data;
        });
        $scope.isSaveSuccess = false;
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
        if (data) {
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
        }
    }

    $scope.isValidEmailFormat = function() {
        return /\S+@\S+\.\S+/.test($scope.email);
    };

    $scope.ok = function(userId) {
        var data = {
            'id': null,
            'email': $scope.email,
            'created': null,
            'created_by': userId,
            'updated': null,
            'updated_by': null,
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

        CustomerService.getCustomerCreate(data)
            .then(showModal("เพิ่มข้อมูลเรียบร้อยแล้ว", true), showModal("ไม่สามารถเพิ่มข้อมูลได้", false));
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

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
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

app.controller('ReservationHistoryMoreModalController', function($uibModalInstance, modalData, $scope, ReservationService, $uibModal) {
    $scope.init = function() {
        ReservationService.getReservationHistoryMore(modalData.id)
            .then(function(data) {
                $scope.setReservationHistoryMoreList = data;
            });
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.checkStatus = function(status) {
        var roomNameMapping = {
            "checkin": "เช็คอิน",
            "checkout": "เช็คเอ้า",
            "reserved": "จอง",
            "cancelled": "ยกเลิกจอง"
        };
        return roomNameMapping[status];
    };

    $scope.openInvoice = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'refund_price_modal_content.html',
            controller: 'RefundPriceModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        });
    };

    $scope.openRecieptPrint = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'reciept_price_modal_content.html',
            controller: 'RecieptPriceModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        });
    };
});

app.controller('ReservationHistoryController', function($scope, ReservationService, $uibModal) {
    var $scope = this;
    $scope.branch_id = $('#branch_id').attr('data-building-id');

    $scope.getReservationHistoryAllList = function() {
        ReservationService.getReservationHistoryAll($scope.branch_id).then(function(data) {
            $scope.setReservationHistoryAllList = data;
        });
    };

    $scope.openMoreReservationHistory = function(id) {
        $uibModal.open({
            animation: true,
            templateUrl: 'reservationHistoryModalContent.html',
            controller: 'ReservationHistoryMoreModalController',
            backdrop: "static",
            size: "lg",
            resolve: {
                modalData: {
                    id: id
                }
            }
        });
    };

    // Sort data
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    };

    $scope.checkStatus = function(status) {
        var roomNameMapping = {
            "checkin": "เช็คอิน",
            "checkout": "เช็คเอ้า",
            "reserved": "จอง",
            "cancelled": "ยกเลิกจอง"
        };
        return roomNameMapping[status];
    };
});