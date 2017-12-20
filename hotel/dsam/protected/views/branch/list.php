<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/1/16
 * Time: 20:02
 */
?>

<div ng-controller="BranchListController as b">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a href="#branch/create"
                   id="create"
                   class="btn btn-default mt0 width-64px hidden"
                   data-toggle="modal"
                   data-target="#modal-fullscreen"
                   data-value="<?=Yii::app()->user->id;?>"
                   ng-click="b.btnCreate();">
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
                        <h2>สาขา</h2>
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
                                <th class="text-center sorting" ng-click="b.sort('name');">
                                    ชื่อสาขา
                                </th>
                                <th class="text-center none-sorting">หมายเหตุ</th>
                                <th class="text-center sorting" ng-click="b.sort('active');">สถานะ</th>
                                <th class="text-center sorting" ng-click="b.sort('created');">วันที่สร้าง</th>
                                <th class="text-center sorting" ng-click="b.sort('updated');">วันที่แก้ไข</th>
                                <th class="text-center sorting"></th>
                            </tr >
                            </thead>

                            <tbody>
                                <tr dir-paginate="Branch in b.listBranch | orderBy:b.sortKey:b.received | filter:search | itemsPerPage:10">
                                    <td >
                                        {{Branch.name}}
                                    </td>
                                    <td >{{Branch.remark}}</td>
                                    <td >{{Branch.active}}</td>
                                    <td >{{Branch.created}}<br/><p class="pull-right" >{{Branch.created_by}}</p ></td >
                                    <td >{{Branch.updated}}<br/><p class="pull-right" >{{Branch.updated_by}}</p ></td >
                                    <td class="col-xs-1">
                                        <div class="btn-group btn-group-justified">
                                            <a href="#/branch/update/{{Branch.id}}"
                                               class="btn btn-default item-edit-btn"
                                               data-toggle="modal"
                                               data-target="#modal-fullscreen"
                                                ng-click="b.btnUpdate();">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#"
                                               class="btn btn-default item-remove-btn"
                                               data-id="{{Branch.id}}"
                                               data-toggle="modal" data-target="#delete"
                                                ng-click="b.btnDelete(Branch.id);">
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
                                <span class="text-info">สาขา</span>
                                <span class="text-danger">'{{b.name}}'</span>
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
                    <button type="button"
                            class="btn btn-primary"
                            ng-click="b.confirmDelete(b.id);"
                            data-dismiss="modal">
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
