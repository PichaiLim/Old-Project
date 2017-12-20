<?php
/* @var $this InventoryController */
?>

<div ng-controller="InventoryController as i" id="branch_id" data-val="<?php echo $_GET['id']; ?>" ng-init="i.init(2)">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a class="btn btn-default mt0 width-64px"
                   ng-click="i.addInventoryPullOrPushListModal(2);">
                    <i class="fa fa-plus"></i>
                    &nbsp;เพิ่ม
                </a>
            </div>
            <div class="col-xs-8">&nbsp;</div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>การเบิกออกวัสดุสิ้นเปลือง</h2>
                        <div class="panel-ctrls" style="line-height: normal;">
                            <i class="separator pull-left"></i>
                            <div id="DataTables_Table_0_filter" class="dataTables_filter pull-left">
                                <label class="panel-ctrls-center">
                                    <input type="search"
                                           class="form-control"
                                           placeholder="ค้นหาข้อมูล"
                                           aria-controls="DataTables_Table_0"
                                           ng-model="search">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="panel-body panel-no-padding">
                        <table id="example"
                               class="table table-condensed table-bordered table-hover dataTable no-footer"
                               cellspacing="0"
                               width="100%">
                            <thead>
                            <tr role="row">
                                <th class="text-center sorting" ng-click="i.sort(reciept_no);" >เลขที่ใบเบิกสินค้า</th >
                                <th class="text-center sorting" ng-click="i.sort(created_by);" >เพิ่มข้อมูลโดย</th >
                                <th class="text-center sorting" ng-click="i.sort(created);" >เพิ่มเมื่อ</th >
                                <th class="text-center none-sorting" >ใบเบิกของ</th >
                            </tr >
                            </thead>

                            <tbody>
                            <tr dir-paginate="I in i.InventoryPullDataList | orderBy: i.sortKey:i.reverse | filter: search |
                                itemsPerPage: 10" >
                                <td align="center" ng-click="i.displayInventoryPush(I.reciept_no, 2)" style="cursor: pointer;">
                                    {{I.reciept_no}}
                                </td >
                                <td align="center" ng-click="i.displayInventoryPush(I.reciept_no, 2)" style="cursor: pointer;">
                                    {{I.created_by}}
                                </td >
                                <td align="center" ng-click="i.displayInventoryPush(I.reciept_no, 2)" style="cursor: pointer;">{{I.created}}
                                </td >
                                <td class="text text-center">
                                  <a ng-click="i.openRecieptPrintInventoeyPull(I.reciept_no, 1)">
                                      <span ng-hide="I.reciept_no == null" class="btn btn-default">
                                          <i class="fa fa-fw fa-print"></i>
                                      </span>
                                  </a>
                              </td >
                            </tr >
                            </tbody>
                        </table>
                    </div>


                    <!-- footer -->
                    <div class="panel-body has-pagination p">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    &nbsp; <!--  pagenumber to  number -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    <dir-pagination-controls
                                        max-size="5"
                                        direction-links="true"
                                        boundary-links="true">
                                    </dir-pagination-controls>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end footer -->
                </div>
            </div>
        </div>
    </div>

<!--display more inventory modal  -->
<script type="text/ng-template" id="displayMoreInventoryModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            รายละเอียดการนำเข้าวัสดุสิ้นเปลือง
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="searchCus"
              autocomplete="off"
              role="form"
              method="post" >

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    <span class="text text-danger">*</span> ค้นหา
                </label>
                <div class="col-sm-9">
                    <div class="row" >
                        <div class="col-xs-8" >
                            <input name="searchData"
                                   class="form-control"
                                   ng-model="searchData"/>
                        </div>
                    </div>
                </div>
            </div>

            <table  class="table table-condensed table-bordered table-hover dataTable no-footer"
                    id="search-customer-modal">
                <thead>
                    <tr role="row">
                      <th>
                        <span>ประเภท</span>
                      </th>
                      <th>
                        <span>ราคาต่อหน่วย</span>
                      </th>
                      <th>
                        <span>จำนวน</span>
                      </th>
                      <th>
                        <span>ราคารวม</span>
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-left"
                        ng-repeat="data in inventoryDetailList|filter:searchData">
                        <td>
                          {{data.product_name}}
                        </td>
                        <td>
                          {{data.price}}
                        </td>
                        <td>
                          {{data.quantity}}
                        </td>
                        <td>
                          {{data.sum}}
                        </td>
                    </tr>
                    <tr ng-show="(inventoryDetailList | filter:searchData).length == 0">
                        <td id="result-no-data" colspan="4"  class="text-center" >
                          ไม่พบข้อมูล
                        </td>
                    </tr>
                </tbody>
            </table>
        </form >
      </div>
      <div class="modal-footer">
            <button class="btn btn-default" type="button" ng-click="cancel()">Close</button>
      </div>
 </div>
</script>
<!-- end display more inventory modal -->

<!--add Inventory Push Modal-->
<script type="text/ng-template" id="addInventoryPullOrPushListModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            {{title}}
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="InventoryPushForm"
              autocomplete="off"
              role="form"
              method="post" >

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    <span class="text text-danger"> &nbsp;</span>
                </label>
                <div class="col-sm-9" align="right">
                    <div class="row" >
                        <button type="button" class="btn btn-primary" ng-click="addInventoryDetailModal()">
                          <span class="fa fa-fw fa-plus"></span> {{titleAdd}}
                        </button>
                    </div >
                </div>
            </div>

            <table  class="table table-condensed table-bordered table-hover dataTable no-footer"
                    id="search-customer-modal">
                <thead>
                    <tr role="row">
                      <th id="type">
                        <span>ประเภท</span>
                      </th>
                      <th id="price">
                        <span>ราคาต่อหน่วย</span>
                      </th>
                      <th id="quantity">
                        <span>จำนวน</span>
                      </th>
                      <th id="sum">
                        <span>ราคารวม</span>
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="inventory-push-table-<[$index+1]>" class="text-left"
                        ng-repeat="data in inventoryPushList">
                        <td id="type-<[$index+1]>">
                          {{data.detail.type}}
                        </td>
                        <td id="price-<[$index+1]>">
                          {{data.detail.price}}
                        </td>
                        <td id="quantity-<[$index+1]>">
                          {{data.detail.quantity}}
                        </td>
                        <td id="sum-<[$index+1]>">
                          {{data.detail.sum}}
                        </td>
                    </tr>
                    <tr ng-show="(inventoryPushList).length == 0">
                        <td id="result-no-data" colspan="4"  class="text-center" >
                          ไม่พบข้อมูล
                        </td>
                    </tr>
                </tbody>
            </table>
        </form >
      </div>
      <div class="modal-footer">
          <div class="col-sm-6" align="left">
              <label>
                {{textBill}}
              </label>
              <strong>{{billNumber}}</strong>
          </div>
          <div class="col-sm-6" align="right">
              <button class="btn btn-primary" type="button" ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
              <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
          </div>

      </div>
 </div>
</script>
<!-- end add Inventory Push modal -->

<!-- add Inventory Detail modal -->
<script type="text/ng-template" id="addInventoryDetailModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw fa-plus"></i>เพิ่มเบิกออกวัสดุสิ้นเปลือง
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="addInventoryForm"
              autocomplete="off"
              role="form"
              method="post" >

               <div class="form-group">
                    <label for="district_id" class="col-sm-3 control-label">
                        ประเภทวัสดุสิ้นเปลือง
                    </label>
                    <div class="col-sm-7">
                        <select name="product" id="product" class="form-control" data-live-search="true"
                                ng-model="product"
                                ng-change="changeProduct(product, ProductSelectDataList);">
                            <option value="" >เลือกวัสดุสิ้นเปลือง</option >
                            <option
                                ng-repeat="P in ProductSelectDataList" value="{{P.id}}">
                                {{P.name}} (คงเหลือ {{P.quantity || 0}})
                            </option >
                        </select >
                    </div>
                    <label for="address_th" class="col-sm-1 control-label">
                        &nbsp;
                    </label>
                </div>
                 <div class="form-group">
                    <label for="home_phone" class="col-sm-3 control-label">
                        ราคาต่อหน่วย
                    </label>
                    <div class="col-sm-7">
                       <input class="form-control"
                           type="number"
                           ng-attr-placeholder="{{price}}"
                           minlength="1"
                           min="1"
                           ng-disabled="true"
                           ng-model="price"
                           ng-change="changeKey(myForm);"
                           style="text-align: right;"/>
                    </div>
                    <label for="address_th" class="col-sm-1 control-label">
                        &nbsp;
                    </label>
                </div>
                <div class="form-group">
                    <label for="address_th" class="col-sm-3 control-label">
                        จำนวน
                    </label>
                    <div class="col-sm-7">
                        <input type="number"
                               class="form-control"
                               placeholder="0.00"
                               minlength="1"
                               min="1"
                               required
                               ng-blur="quantityOnBlur(2)"
                               ng-keyup="quantityOnBlur(2)"
                               aria-describedby="basic-addon2"
                               ng-model="quantity"
                               style="text-align: right;">
                        <span class="text text-danger">{{textErrorQuantity}}</span>
                    </div>
                    <label for="address_th" class="col-sm-1 control-label">
                        {{product_unit}}
                    </label>
                </div>
                <div class="form-group">
                    <label for="address_en" class="col-sm-3 control-label">
                        รวม
                    </label>
                    <label for="address_th" class="col-sm-7 control-label">
                        <strong class="text-primary">
                            {{price_total = quantity * price | number:2}}
                            <input name="price_total"
                                   id="price_total"
                                   ng-model="price_total"
                                   value="{{price_total}}" type="hidden" required />
                        </strong>
                    </label>
                    <label for="address_th" class="col-sm-1 control-label">
                        &nbsp;
                    </label>
                </div>
        </form>
      </div>
      <div class="modal-footer" >
            <button class="btn btn-primary" type="button"
                    ng-disabled="isDisabledSubmit"
                    ng-click="ok(ProductSelectDataList, <?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
 </div>
</script>
<!-- end add Inventory Detail modal -->

<!-- modal price reciept inventory pull -->
<script type="text/ng-template" id="reciept_price_inventory_pull_modal_content.html">
    <div id="dismiss-content" class="modal-body">
        <iframe src="{{urlRecieptPriceInventoryPull}}" height="500" width="850" frameborder="0" allowtransparency="true"></iframe>

    </div>
    <div class="modal-footer">
        <button id="dismiss-button" class="btn btn-primary btn-lg btn-block" ng-click="close()">
            ปิด
        </button>
    </div>
</script>
<!-- end modal price reciept inventory pull -->
</div>