/**
 * Created by Admin on 6/6/16.
 */
var app = angular.module('dsam', ['ngRoute', 'angularUtils.directives.dirPagination', 'ui.bootstrap']);


var route = function($routeProvider) {
    $routeProvider.


    /**
     * Reservation
     * */
    when('/Reservation/checkin/:id/:status', {
        templateUrl: '../../Reservation/checkin/id/status',
        controller: 'ReservationController'
    }).
    when('/Reservation/checkout/:id/:status', {
        templateUrl: '../../Reservation/checkout/id/status',
        controller: 'ReservationController'
    }).


    /**
     * Employee
     * */
    when('/changepassword/:id', {
        templateUrl: 'index.php/Employee/changepassword/id',
        controller: 'EmployeeCpwdOnPageIndexController'
    }).
    when('/updateprofile/:id', {
        templateUrl: 'index.php/Employee/updateProfile/id',
        controller: 'EmployeeUpdateProfileOnPageIndexController'
    }).
    when('/employee', {
        templateUrl: '/',
        controller: 'EmployeeController'
    }).
    when('/employee/updateprofile/:id', {
        templateUrl: '../../Employee/UpProfile/id',
        controller: 'EmployeeUpdateProfileController'
    }).
    when('/employee/changepassword/:id', {
        templateUrl: '../../Employee/cpassword/id',
        controller: 'EmployeeCpwdController'
    }).
    when('/employee/create/:id', {
        templateUrl: '../../Employee/create/id',
        controller: 'EmployeeController'
    }).
    when('/employee/update/:id', {
        templateUrl: '../../Employee/Update/id',
        controller: 'EmployeeController'
            //controller: 'EmployeeUpdateController'
    })

    /**
     * Employee Type
     * */
    .when('/employeetype/create/', {
            templateUrl: '../EmployeeType/Create',
            controller: 'EmployeeTypeController'
        })
        .when('/employeetype/update/:id', {
            templateUrl: '../EmployeeType/Update/id',
            controller: 'EmployeeTypeController'
        })


    /**
     * Customer
     * */
    .when('/customer/create', {
            templateUrl: '../Customer/Create',
            controller: 'CustomerController'
        })
        .when('/customer/add', {
            templateUrl: '../../Customer/Create',
            controller: 'ReservationController'
        })
        .when('/customer/update/:id', {
            templateUrl: '../Customer/Update/id',
            controller: 'CustomerController'
        })

    /**
     * Production
     * */
    .when('/product/create', {
            templateUrl: '../Product/Create',
            controller: 'ProductController'
        })
        .when('/product/update', {
            templateUrl: '../Product/Update',
            controller: 'ProductController'
        })

    /**
     * Inventory Pull
     * */
    .when('/Inventorypush/create', {
            templateUrl: '../../InventoryPush/Create',
            controller: 'InventoryPushController'
        })
        .when('/inventorypull/create', {
            templateUrl: '../../InventoryPull/Create',
            controller: 'InventoryPullController'
        })

    /**
     * Branch
     * */
    .when('/Branch/List', {
        templateUrl: 'index.php/Branch/list',
        controller: 'BranchListController'
    }).
    when('/Branch/Create/', {
        templateUrl: '../index.php/Branch/create',
        controller: 'BranchController'
    }).
    when('/branch/update/:id', {
        templateUrl: '../../index.php/Branch/Update/id',
        controller: 'BranchUpdateController'
    }).

    /**
     * Building
     * */
    when('/building', {
        templateUrl: '/',
        controller: 'BuildingController'
    }).
    when('/building/create', {
        templateUrl: '../../Building/Create',
        controller: 'BuildingController'
    }).
    when('/building/update/:id', {
        templateUrl: '../../Building/Update/id',
        controller: 'BuildingController'
    }).


    /**
     * Floor
     * */
    when('/floor/create', {
        templateUrl: '../../Floor/Create',
        controller: 'FloorController'
    }).
    when('/floor/update/:id', {
        templateUrl: '../../Floor/Update/id',
        controller: 'FloorController'
    }).
    when('/floor/delete/id', {
        templateUrl: '../../Floor/Delete/id',
        controller: 'FloorController'
    }).

    /**
     * Room
     * */
    when('/room/create', {
        templateUrl: '../../Room/Create',
        controller: 'RoomController'
    }).
    when('/room/update/:id', {
        templateUrl: '../../Room/Update/id',
        controller: 'RoomController'
    }).
    when('/room/delete/:id', {
        templateUrl: '../../Room/Delete/id',
        controller: 'RoomController'
    }).

    /**
     * Room Type
     * */
    when('/roomtype/', {
        templateUrl: '../../RoomType/list',
        controller: 'RoomTypeController'
    }).
    when('/roomtype/view/:id', {
        templateUrl: '../../RoomType/view/id',
        controller: 'RoomTypeController'
    }).
    when('/roomtype/create', {
        templateUrl: '../../RoomType/create',
        controller: 'RoomTypeController'
    }).
    when('/roomtype/create/:id', {
        templateUrl: '../../RoomType/create/id',
        controller: 'RoomTypeController'
    }).
    when('/roomtype/update', {
        templateUrl: '../../RoomType/update',
        controller: 'RoomTypeController'
    }).
    when('/roomtype/delete/:id', {
        templateUrl: '../../RoomType/delete/id',
        controller: 'RoomTypeController'
    }).
    otherwise({
        redirectTo: '/'
    });

};

app.config(['$routeProvider', route]);

//app.constant('URL', "http://localhost/dsam/index.php");
app.constant('URL', "http://bangna.p-soft.asia/index.php");
app.constant('URLREFUND', "http://bangna.p-soft.asia/print_refund.php?id=");
app.constant('URLRECIRPT', "http://bangna.p-soft.asia/print_reciept.php?id=");
app.constant('URLRECIEPTINVENTORYPULL', "http://bangna.p-soft.asia/print_reciept_inventory_pull.php?id=");
app.constant('URLREPORTDAILY', "http://bangna.p-soft.asia/print_report_daily.php");
app.constant('URLREPORTSUMMARYDAILY', "http://bangna.p-soft.asia/print_report_summary_daily.php");

app.factory('moment', function() {
    return moment;
});