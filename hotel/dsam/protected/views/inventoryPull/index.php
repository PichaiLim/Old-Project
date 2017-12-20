<?php
/* @var $this InventoryPullController */

?>

<div ng-controller="InventoryPullController as i" id="branch_id" data-val="<?php echo $_GET['id']; ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a href="#/inventorypull/create"
                   class="btn btn-default mt0 width-64px"
                   data-toggle="modal"
                   data-target="#modal-fullscreen"
                   ng-click="c.btnCreate();">
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
                                <th class="text-center sorting" ng-click="i.sort(product_name);" >ประเภท</th >
                                <th class="text-center sorting" ng-click="i.sort(pushed);" >จำนวน</th >
                                <th class="text-center sorting" ng-click="i.sort(pulled);" >เพิ่มเมื่อ</th >
                            </tr >
                            </thead>

                            <tbody>
                            <tr dir-paginate="I in i.InventoryPullDataList | orderBy: i.sortKey:i.reverse | filter: search |
                                itemsPerPage: 10" >
                                <td >
                                    {{I.product_name}}
                                </td >
                                <td >
                                    {{I.quantity}}
                                </td >
                                <td >{{I.created}}  <br />
                                    <p class="text text-right">
                                        {{I.created_by}}
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


    <!-- Modal fullscreen -->
    <div class="modal modal-fullscreen fade in" id="modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <ng-view></ng-view>
        </div>
    </div>

</div>