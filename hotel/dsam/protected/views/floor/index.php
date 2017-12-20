<?php
/* @var $this FloorController */
/* @var $dataProvider CActiveDataProvider */
?>


<div ng-controller="FloorController as f">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a href="#/floor/create"
                   class="btn btn-default mt0 width-64px create"
                   id="create"
                   data-toggle="modal"
                   data-target="#modal-fullscreen"
                   data-value="<?php echo $_GET['id']; ?>"
                   ng-click="f.btnCreate();">
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
                        <h2>ชั้น</h2>
                        <div class="panel-ctrls" style="line-height: normal;">
                            <div class="dataTables_length pull-left" id="DataTables_Table_0_length">
                                <label class="panel-ctrls-center">
                                    <select name="DataTables_Table_0_length"
                                            aria-controls="DataTables_Table_0"
                                            class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="-1">All</option>
                                    </select>
                                </label>
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
                                <th class="text-center sorting"
                                    ng-click="f.sort('name');">
                                    ชื่อ

<!--                                    <span class="glyphicon sort-icon"-->
<!--                                          ng-show="f.sortKey=='name'"-->
<!--                                          ng-class="{'glyphicon-chevron-up':f.reverse,'glyphicon-chevron-down':!f-->
<!--                                          .reverse}">-->
<!--                                        </span>-->
                                </th>
                                <th class="text-center sorting"
                                    ng-click="f.sort('building_id');">
                                    อาคาร
                                </th>
                                <th class="text-center none-sorting">
                                    หมายเหตุ
                                </th>
                                <th class="text-center sorting"
                                    ng-click="f.sort('created');">
                                    เพิ่มเมื่อ
                                </th>
                                <th class="text-center sorting"
                                    ng-click="f.sort('updated');">
                                    แก้ไขเมื่อ
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr dir-paginate="floorlist in f.floorList | orderBy:f.sortKey:f.reverse | filter:search| itemsPerPage:5" >
                                <td >{{ floorlist.name }}</td >
                                <td >{{ floorlist.building_id }}</td >
                                <td >{{ floorlist.remark }}</td >
                                <td >
                                    {{ floorlist.created }}
                                    <div class="text-right">
                                        <a href="#" >
                                            {{ floorlist.created_by }}
                                        </a >
                                    </div>
                                </td >
                                <td >
                                    {{ floorlist.updated }}
                                    <div class="text-right">
                                        <a href="#" >
                                            {{ floorlist.updated_by }}
                                        </a >
                                    </div>
                                </td >
                                <td class="col-xs-1">
                                    <div class="btn-group btn-group-justified">
                                        <a href="#/floor/update/{{floorlist.id}}"
                                           class="btn btn-default item-edit-btn"
                                           data-id="{{floorlist.id}}"
                                           data-toggle="modal"
                                           data-target="#modal-fullscreen"
                                           ng-click="f.btnUpdate(floorlist.id, floorlist.name);">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#/floor/delete/{{floorlist.id}}"
                                           class="btn btn-default item-remove-btn"
                                           data-id="{{floorlist.id}}"
                                           data-toggle="modal" data-target="#delete"
                                           ng-click="f.btnDelete(floorlist.id, floorlist.name, floorlist.building_id);">
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
                                <span class="text-info">ชั้น</span>
                                <span class="text-danger">'{{f.name}}'</span>
                                <small class="text-muted">อาคาร '{{f.building_name}}'</small>
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
                            ng-click="f.confirmDelete(f.id, f.name, f.building_id);"
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