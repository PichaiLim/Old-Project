/**
 * Created by Admin on 7/11/16.
 */

/**
 * Inventory
 * */
app.controller('InventoryController', function($scope, InventoryService){
    var $scope = this;
    var id =  $("#branch_id").attr('data-val');

    $scope.InventoryList = InventoryService.getInventoryList(id).then(function(data){
        $scope.InventoryDataList = data;
    });

    $scope.sort = function(keyname){
        $scope.key = keyname;
        $scope.reverse  = !$scope.reverse;
    };

    $scope.countQuantity = function(number){
        return (number > 1)? "text-success":"text-danger";
    };

});










/**
 * Inventory Push Controller
 * */
app.controller('InventoryPushController', function($scope, InventoryPushService, $location, $http){
    var $scope = this;
    var id =  $("#branch_id").attr('data-val');
    $scope.product = [];

    InventoryPushService.getInventoryPushList(id).then(function(data){
        $scope.InventoryPushDataList = data;
    });

    $scope.sort = function(keyname){
        $scope.key = keyname;
        $scope.reverse  = !$scope.reverse;
    };

    /**
     * Create
     * */
    $scope.btnCreate = function(){
        $scope.Product = $http.get('../../api/product').then(function(response){
            $scope.ProductSelectDataList = response.data;
        });
        $scope.branch_id = id;
    };


    $scope.changeProduct = function(id, product){
        var obj = [];

        product.filter(function(res){
            return res.id == id;
        }).map(function(res){

            return obj=res;
        });

        $scope.product_id = obj.id;
        $scope.product_name = obj.name;
        $scope.price = obj.price.toString();
        $scope.product_unit = obj.unit;
    };

    $scope.btnSave = function(){
        var data = {
            'id'        :   null,
            'branch_id' :   $scope.branch_id,
            'product_id':   $scope.product_id,
            'created'   :   null,
            'created_by':   $('#created_by').val(),
            'price'     :   $scope.price,
            'quantity'  :   $scope.quantity,
            'price_total':  $scope.price_total
        };
        InventoryPushService.getInventoryUpdate(data).then(function(data){
            console.log(data);
            if(data.success == false){
                $location.path('/');
                window.location.reload(false);
            }
        });
    };



    $scope.validateForm = function(form){
        return form.$invalid;
    };


    $scope.btnCreate();
});



/**
 * Inventory Pull Controller
 * */
app.controller('InventoryPullController', function($scope, InventoryPullService, $http, $location){
    var $scope = this;
    var id =  $("#branch_id").attr('data-val');

    $scope.InventoryPullList = InventoryPullService.getInventoryPullList(id).then(function(data){
        $scope.InventoryPullDataList = data;
    });

    $scope.sort = function(keyname){
        $scope.key = keyname;
        $scope.reverse  = !$scope.reverse;
    };

    /**
     * Create
     * */
    $scope.btnCreate = function(){
        $scope.Product = $http.get('../../api/inventory/'+id).then(function(response){
            $scope.ProductSelectDataList = response.data;
        });
        $scope.branch_id = id;
    }


    $scope.changeProduct = function(id, product){
        var obj = [];

        product.filter(function(res){
            return res.id == id;
        }).map(function(res){

            return obj=res;
        });

        $scope.product_id = obj.product_id;
        $scope.product_name = obj.product_name;
        $scope.quantity = obj.quantity;
        $scope.quantityMax = obj.quantity;
        $scope.product_unit = obj.product_unit;
    };

    $scope.btnSave = function(){
        var data = {
            'id'        :   null,
            'branch_id' :   $scope.branch_id,
            'product_id':   $scope.product_id,
            'created'   :   null,
            'created_by':   $('#created_by').val(),
            'price'     :   $scope.price,
            'quantity'  :   $scope.quantity,
            'price_total':  $scope.price_total
        };

        InventoryPullService.getInventoryUpdate(data).then(function(data){
            if(data.success == false){
                $location.path('/');
                window.location.reload(false);
            }
        });
    };


    $scope.validateForm = function(form){

        return form.$invalid;
    };

    $scope.btnCreate();
});