/**
 * Created by Admin on 7/20/16.
 */
app.controller('ReservationController', function($scope, $location, $http, $routeParams, ReservationService){
    var $scope = this;

    var branch_id = $('body').attr('data-branch-id');
    $scope.building = [];
    var buildingNumberID = 0;
    var floorNumberID = 0;
    var status = "";
    $scope.amount = 0;


    $scope.deposit = null;


    $scope.building = function(){
        return ReservationService.getBranchByFk(branch_id).then(function(data){
            $scope.buildingList = data;
            return data;
        });
    };

    $scope.changeFloor = function(buildingID){
        $scope.floorList = ReservationService.getFloorByFK(buildingID).then(function(data){
            $scope.floorList = data;
        });
        return buildingNumberID = buildingID;
    };

    $scope.clickSelectFloor = function(floor_id){
        var data = {
            branch_id: branch_id,
            building_id : buildingNumberID,
            floor_id: floor_id
        };

        $scope.room = ReservationService.getRoomByFK(data).then(function(data){
            if(data.error == 200){
                $scope.roomList = data.models;
            }

        });
        return floorNumberID = floor_id;
    };

    $scope.checkTextStatusRoom = function(active){
        return (active == 1)? "ว่าง":"ปิดปรับปรุง";
    };

    $scope.checkStyleStatusRoom = function(active){
        return (active == 1)? "tiles-success":"tiles-inverse";
    };

    $scope.clickChangeActive = function(roomID, typeOfEnum){
        var id = roomID;
        var type = typeOfEnum;


        switch (type){
            case 'open':
                ReservationService.setRoomUpdateStatusActive({id: id, active: '1'});
                break;
            case 'close':
                ReservationService.setRoomUpdateStatusActive({id: id, active: ''});
                break;
            default:
                ReservationService.setRoomUpdateStatusActive({id: id, active: '1'});
                break;
        };
        window.location.reload(false);
    };

    $scope.clickCheck = function(roomID, roomName){
        $scope.style_icon  ="fa-arrow-right";
        $scope.titleheader = "เช็คอินห้อง ";
        $scope.roomName = roomName;

        $scope.Room = ReservationService.getRoomByPK(roomID).then(function(data){
            angular.forEach(data, function(index){
                $scope.branch_id = index.branch_id;

                $scope.building_id = index.building_id;
                $scope.building_name = index.building_name;

                $scope.floor_id = index.floor_id;
                $scope.floor_name = index.floor_name;
                $scope.room_id = index.id;
                $scope.room_type_id = index.room_type_id;
                $scope.roomTypeName = index.roomTypeName;
                $scope.price = parseFloat(index.roomTypePrice);
                $scope.deposit = parseFloat(index.roomTypeDeposit);
                $scope.paid_status = 'no';
            });
        });
    };

    $scope.clickCheckOut = function(roomID, roomName){
        $scope.style_icon  ="fa-arrow-left";
        $scope.titleheader = "เช็คเอ้าห้อง ";
        $scope.roomName = roomName;

        $scope.Room = ReservationService.getReservationFindByRoomId(roomID).then(function(data){
            console.log(data);
            angular.forEach(data, function(index){
                $scope.branch_id        = index.branch_id;

                $scope.building_id      = index.building_id;
                $scope.building_name    = index.BuildingName;

                $scope.floor_id         = index.floor_id;
                $scope.floor_name       = index.FloorName;
                $scope.room_id          = index.id;
                $scope.room_name        = index.RoomName;
                $scope.room_type_id     = index.room_type_id;
                $scope.roomTypeName     = index.roomTypeName;
                $scope.start            = index.start;
                $scope.num_days         = index.num_days;
                $scope.end              = index.end;
                $scope.price            = parseFloat(index.price);
                $scope.deposit          = parseFloat(index.deposit);
                $scope.previous_deposit = parseFloat(index.CustomerDeposit);
                $scope.amount           = parseFloat(index.amount);
                $scope.customer_id      = index.customer_id;
                $scope.CustomerDeposit  = index.CustomerDeposit;
                $scope.customer_name    = index.CustomerFirstName+" "+index.CustomerLastName;
                $scope.paid_status      = index.paid_status;
            });
        });
    };


    $scope.customers = function(){
        $scope.setCustomerList = ReservationService.getCustomerLimitShow().then(function(data){
            $scope.CustomerList = data;
        });
    };

    $scope.keyCustomer = function(data){
        if(data == undefined || data == null){
            $scope.customers();
            $scope.customer_id = undefined;
            $scope.previous_deposit = parseFloat(0);
        }else{
            $scope.setCustomerList = ReservationService.getCustomerFilter(data).then(function(data){
                $scope.CustomerList = data;
                return data;
            });


            var filterCustomer = $scope.CustomerList.filter(function(dataFilter){
                var fullname = dataFilter.first_name+' '+dataFilter.last_name;
                return fullname == data;
            }). map(function(dataFilterMap){
                return dataFilterMap;
            });

            $scope.customer_id = filterCustomer[0]['id'];
            $scope.previous_deposit = parseFloat(filterCustomer[0]['deposit']);

        }
    };


    // Validation Form in page 'Checkin'
    $scope.validationFormCheckin = function(form){
        //console.log(form);
    };

    $scope.btnSaveCheckIn = function(){
        var dateNow = new Date();
        dateNow = (dateNow.getFullYear()+543).toString().substr(2,2);

        var data = {
            id          : null,
            reciept_no  : ($scope.paid_status.toLowerCase() == "no")? null: "DRC"+dateNow+"-",
            branch_id   : $scope.branch_id,
            building_id : $scope.building_id,
            floor_id    : $scope.floor_id,
            room_id     : $scope.room_id,
            customer_id : $scope.customer_id,
            created     : $('#created').val(),
            created_by  : $('#created_by').val(),
            updated     : null,
            updated_by  : null,
            status      : $routeParams['status'],
            paid_status : $scope.paid_status,
            paid        : ($scope.payee == 'no')? null:dateNow,
            payee       : $('#payee').val(),
            start       : $scope.start,
            end         : $scope.end,
            num_days    : parseInt($('#num_days').val()),
            price       : parseFloat($('#price').val()).toFixed(2),
            deposit     : parseFloat($('#deposit').val()).toFixed(2),
            amount      : parseFloat($scope.amount).toFixed(2)
        };
        //console.log(data);
        /*ReservationService.setEventCheckIn(data).then(function(res){
            console.log(res);
        });*/
        $http.post('../../Reservation/SetBooking/', data).then(function(response){
            if(response.status == 200){
                window.location.reload(false);
                $location.path('/');
            }
        });
    };


    $scope.building();
});


app.controller('ReservationDataController', function($scope, ReservationService){
    var $scope = this;
    $scope.branch_id = $('#branch_id').attr('data-building-id');

    $scope.getReservationDataAllList = ReservationService.getReservationDataAll($scope.branch_id).then(function(data){
        $scope.setReservationDataAllList = data;
    });

    // Sort data
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse  = !$scope.reverse;
    };


    $scope.checkStatus = function(status){
        switch (status.toLowerCase()){
            case 'reserved':
                return "";
            case 'cancelled':
                return "";
            case 'checkin':
                return "";
            case 'checkout':
                return "";

            default :
                return "";
        };


    };

});

app.controller('ReservationHistoryController', function($scope, ReservationService){
    var $scope = this;
    $scope.branch_id = $('#branch_id').attr('data-building-id');

    $scope.getReservationHistoryAllList = ReservationService.getReservationHistoryAll($scope.branch_id).then(function(data){
        $scope.setReservationHistoryAllList = data;
    });

    // Sort data
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse  = !$scope.reverse;
    };

    $scope.checkStatus = function(status){
        return (status.toLowerCase() == "checkout")? "เช็คเอาท์":"ยกเลิก";
    };
});