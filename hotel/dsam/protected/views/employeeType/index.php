<?php
/* @var $this EmployeeTypeController */
?>

<div ng-controller="EmployeeTypeController as e" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a href="#/employeetype/create"
                   class="btn btn-default mt0 width-64px"
                   data-toggle="modal"
                   data-target="#modal-fullscreen"
                   ng-click="e.btnCreate();">
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
                        <h2>ประเภทพนักงาน</h2>
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
                                <th class="text-center sorting" ng-click="e.sort('name');" >ชื่อประเภทพนักงาน</th >
                                <th class="text-center none-sorting" >หมายเหตุ</th >
                                <th class="text-center sorting" ng-click="e.sort('created');" >วันที่สร้าง</th >
                                <th class="text-center sorting" ng-click="e.sort('updated');" >วันที่แก้ไข</th >
                                <th class="text-center sorting" ></th>
                            </tr >
                            </thead>

                            <tbody>
                            <tr dir-paginate="ET in e.listEmployeeType | orderBy: e.sortKey:e.reverse | filter: search |
                                itemsPerPage: 10">
                                <td ng-bind="ET.name">Detail Content</td >
                                <td ng-bind="ET.remark">Detail Content</td >
                                <td >
                                    {{ET.created}}
                                    <br />
                                    <p class="text-right">{{ET.created_by}}</p>
                                </td >
                                <td >
                                    {{ET.updated}}
                                    <br />
                                    <p class="text-right">{{ET.updated_by}}</p>
                                </td >
                                <td class="col-xs-1">
                                    <div class="btn-group btn-group-justified">
                                        <a href="#/employeetype/update/{{ET.id}}"
                                           class="btn btn-default item-edit-btn"
                                           data-toggle="modal"
                                           data-target="#modal-fullscreen"
                                           ng-click="e.btnUpdate(ET.id);">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                           class="btn btn-default item-remove-btn"
                                           data-id="{{list.id}}"
                                           data-toggle="modal" data-target="#delete"
                                           ng-click="e.btnDelete(ET.id);">
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
                                <span class="text-info">ประเภท</span>
                                <span class="text-danger">'{{e.name}}'</span>
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
                            ng-click="e.confirmDelete(e.id);"
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