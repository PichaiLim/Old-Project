<?php
/* @var $this InventoryController */
/* @var $dataProvider CActiveDataProvider */
?>


<div ng-controller="InventoryController as i" id="branch_id" data-val="<?php echo $_GET['id']; ?>">
<!--     <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a class="btn btn-default mt0 width-64px"
                   ng-click="i.addInventoryModal();">
                    <i class="fa fa-plus"></i>
                    &nbsp;เพิ่ม
                </a>
            </div>
            <div class="col-xs-8">&nbsp;</div>
        </div>
    </div>
 -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>คลังวัสดุสิ้นเปลือง</h2>
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
                                <th class="text-center sorting" ng-click="i.sort(product_name);" >ประเภท</th >
                                <th class="text-center sorting" ng-click="i.sort(quantity);" >คงเหลือ</th >
                                <th class="text-center sorting" ng-click="i.sort(pushed);" >นำเข้าล่าสุด</th >
                                <th class="text-center sorting" ng-click="i.sort(pulled);" >เบิกออกล่าสุด</th >
                            </tr >
                            </thead>

                            <tbody>
                            <tr dir-paginate="I in i.InventoryDataList | orderBy: i.sortKey:i.reverse | filter: search |
                                itemsPerPage: 10" >
                                <td >
                                    {{I.product_name}}
                                </td >
                                <td class="text text-center" >
                                    <strong ng-class="i.countQuantity(I.quantity)">
                                        {{I.quantity}}
                                    </strong>
                                </td >
                                <td >{{I.pushed}}  <br />
                                    <p class="text text-right">
                                        {{I.pushed_by}}
                                    </p>
                                </td >
                                <td >{{I.pulled}}   <br />
                                    <p class="text text-right">
                                        {{I.pulled_by}}
                                    </p>
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
</div>

<!--add inventory modal -->
<script type="text/ng-template" id="addInventoryModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            {{title}}
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="searchInventory"
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
                    id="search-inventory-modal">
                <thead>
                    <tr role="row">
                      <th id="search-inventory-name">
                        <span> ชื่อสินค้า</span>
                      </th>
                      <th id="search-inventory-price">
                        <span>ราคา</span>
                      </th>
                      <th id="search-inventory-unit">
                        <span>หน่วย</span>
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="search-inventory-table-<[$index+1]>" class="text-left"
                        ng-repeat="data in inventoryList|filter:searchData"
                        ng-click="selectInventory(data)" style="cursor: pointer;">
                        <td id="search-inventory-name-<[$index+1]>">
                          {{data.name}}
                        </td>
                        <td id="search-inventory-price-<[$index+1]>">
                          {{data.price}}
                        </td>
                        <td id="search-inventory-unit-<[$index+1]>">
                          {{data.unit}}
                        </td>
                    </tr>
                    <tr ng-show="(inventoryList | filter:searchData).length == 0">
                        <td id="result-no-data" colspan="3"  class="text-center" >
                          ไม่พบข้อมูล
                        </td>
                    </tr>
                </tbody>
            </table>
        </form >
      </div>
      <div class="modal-footer">
         <!--    <button class="btn btn-primary" type="button" ng-click="ok()">OK</button> -->
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
 </div>
</script>
<!-- end add inventory modal -->