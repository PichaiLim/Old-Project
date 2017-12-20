<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */
?>

<div ng-controller="ProductController as p">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a href="#/product/create"
                   class="btn btn-default mt0 width-64px create"
                   id="create"
                   data-toggle="modal"
                   data-target="#modal-fullscreen"
                   ng-click="p.btnCreate();">
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
                        <h2>สินค้า</h2>
                        <div class="panel-ctrls" style="line-height: normal;">
                            <div class="dataTables_length pull-left" id="DataTables_Table_0_length">
                                <!--<label class="panel-ctrls-center">
                                    <select name="DataTables_Table_0_length"
                                            aria-controls="DataTables_Table_0"
                                            class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="-1">All</option>
                                    </select>
                                </label>-->
                            </div>
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
                        <table id="example" class="table table-condensed table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                            <tr role="row">
                                <th class="text-center sorting" ng-click="p.sort('name');" >ชื่อ</th >
                                <th class="text-center sorting" ng-click="p.sort('price');" >ราคา</th >
                                <th class="text-center sorting" ng-click="p.sort('unit');" >ราคาต่อหน่วย</th >
                                <th class="text-center sorting" ng-click="p.sort('active');" >สถานะ</th >
                                <th class="text-center sorting" ng-click="p.sort('created');" >วันที่สร้าง</th >
                                <th class="text-center sorting" ng-click="p.sort('updated');" >วันที่แก้ไข</th >
                                <th ></th >
                            </tr>
                            </thead>

                            <tbody>
                            <tr dir-paginate="P in p.listProdcutAll | orderBy:p.sortKey:p.reverse | filter:search | itemsPerPage:10">
                                <td >{{P.name}}</td>
                                <td >{{P.price}}</td >
                                <td >{{P.unit}}</td >
                                <td >{{P.active}}</td >
                                <td >{{P.created}} <br /> <p class="text-right">{{P.created_by}}</p>    </td >
                                <td >{{P.updated}} <br /> <p class="text-right">{{P.updated_by}}</p>    </td >
                                <td class="col-xs-1">
                                    <div class="btn-group btn-group-justified">
                                        <a href="#/product/update/"
                                           class="btn btn-default item-edit-btn"
                                           data-toggle="modal"
                                           data-target="#modal-fullscreen"
                                           ng-click="p.btnUpdate(P.id);">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#/product/delete/"
                                           class="btn btn-default item-remove-btn"
                                           data-toggle="modal" data-target="#delete"
                                           ng-click="p.btnDelete(P.id);">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </div>
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
                                    <!--                                    กำลังแสดงหน้าที่ 1 จากทั้งหมด 1 หน้า-->
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


    <!-- Modal event click button delete or remove -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="bootbox-body">
                        <p>
                            <i class="fa fa-remove"></i>
                            ลบ
                            <b>
                                <span class="text-info">สินค้า</span>
                                <span class="text-danger">'{{p.name}}'</span>
                            </b>
                        </p>
                        <p class="">
                            คุณแน่ใจแล้ว
                            <strong class="text-primary">ใช่</strong> หรือ
                            <strong class="text-danger">ไม่</strong> ?
                        </p>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" ng-model="p.id" ng-value="p.id" />
                    <button type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            ng-click="p.btnConfirm();">
                        ตกลง
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
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