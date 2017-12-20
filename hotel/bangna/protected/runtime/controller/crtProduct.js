/**
 * Created by Admin on 7/5/16.
 */

app.controller('ProductController', function($scope, $http, ProductService){
    var $scope = this;
    $scope.titleheader = "เพิ่มรายชื่อสินค้า";

    $scope.listDataActive = [{'text':'Active', 'value':'1'},{'text':'Not Active', 'value':''}];
    $scope.listDataPublished = [{'text':'Yes', 'value':'1'},{'text':'No', 'value':''}];

    /**
     * Function
     * */
    var convertPrice = function(num){
        return (num.length <=0)? 0:parseFloat(num).toFixed(2);
    };

    var ProductView = function(id){
        ProductService.getProductView(id).then(function(data){
            $scope.id           =   data['id'];
            $scope.created      =   data['created'];
            $scope.created_by   =   data['created_by'];
            $scope.active       =   data['active'];
            $scope.published    =   data['published'];
            $scope.name         =   data['name'];
            $scope.price        =   convertPrice(data['price']);
            $scope.unit         =   data['unit'];
        });
    }

    /**
     * List
     * */
    ProductService.getProductAllList().then(function(data){
        $scope.listProdcutAll = data;
    });

    // Sort Data
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;
        $scope.reverse  = !$scope.reverse;
    };


    /**
     * Create
     * */
    $scope.btnCreate = function(){
        $scope.active = '1';
        $scope.published = '1';
        $scope.prince = "0";
    };

    $scope.btnSave = function(){

        var data = {
            'id'        :   $scope.id,
            'created'   :   $scope.created,
            'created_by':   $("#created_by").val(),
            'updated'   :   null,
            'updated_by':   null,
            'active'    :   $scope.active,
            'published' :   $scope.published,
            'name'      :   $scope.name,
            'price'     :   convertPrice($scope.price),
            'unit'      :   $scope.unit
        };

        ProductService.getProductCreate(data).then(function(data){
            console.log(data);
            if(data.success == false){
                window.location.reload(false);
            }
        });

    };


    /**
     * Update
     * */
    $scope.btnUpdate = function(id){
        $scope.titleheader = "แก้ไขรายชื่อสินค้า";
        $scope.id = id;
        ProductView(id);
    };

    $scope.btnSaveUpdate = function(){
        var data = {
            'id'        :   $scope.id,
            'created'   :   $scope.created,
            'created_by':   $scope.created_by,
            'updated'   :   $scope.updated,
            'updated_by':   $('#updated_by').val(),
            'active'    :   $scope.active,
            'published' :   $scope.published,
            'name'      :   $scope.name,
            'price'     :   $scope.price,
            'unit'      :   $scope.unit
        };

        ProductService.getProductUpdate(data).then(function(data){
            if(data.success == false)
            {
                window.location.reload(false);
            }
        });
    };


    /**
     * Delete
     * */
    $scope.btnDelete = function(id){
        ProductView(id);
    };

    $scope.btnConfirm = function(){
        var id = $scope.id;

        ProductService.getProductDelete({id:id}).then(function(){
            window.location.reload(false);
        });
    };


});