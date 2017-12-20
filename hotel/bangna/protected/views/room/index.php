<?php
/* @var $this RoomController */
/* @var $dataProvider CActiveDataProvider */
?>


<div ng-controller="RoomController as b">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a href="#/room/create"
                   class="btn btn-default mt0 width-64px create"
                   data-toggle="modal"
                   data-target="#modal-fullscreen"
                   data-value="<?php echo $_GET['id']; ?>"
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
                        <h2>ห้อง</h2>
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
                                    ng-click="b.sort('name');">
                                    ชื่อ

                                    <span class="glyphicon sort-icon"
                                          ng-show="b.sortKey=='updated'"
                                          ng-class="{'glyphicon-chevron-up':b.reverse,'glyphicon-chevron-down':!b.reverse}">
                                        </span>
                                </th>
                                <th class="text-center sorting"
                                    ng-click="b.sort('building_id');">
                                    อาคาร

                                    <span class="glyphicon sort-icon"
                                          ng-show="b.sortKey=='updated'"
                                          ng-class="{'glyphicon-chevron-up':b.reverse,'glyphicon-chevron-down':!b.reverse}">
                                        </span>
                                </th>
                                <th class="text-center sorting"
                                    ng-click="b.sort('floor_id');">
                                    ชั้น

                                    <span class="glyphicon sort-icon"
                                          ng-show="b.sortKey=='updated'"
                                          ng-class="{'glyphicon-chevron-up':b.reverse,'glyphicon-chevron-down':!b.reverse}">
                                        </span>
                                </th>
                                <th class="text-center none-sorting">
                                    หมายเหตุ

<!--                                    <span class="glyphicon sort-icon"-->
<!--                                          ng-show="b.sortKey=='updated'"-->
<!--                                          ng-class="{'glyphicon-chevron-up':b.reverse,'glyphicon-chevron-down':!b.reverse}">-->
<!--                                        </span>-->
                                </th>
                                <th class="text-center sorting"
                                    ng-click="b.sort('created');">
                                    เพิ่มเมื่อ

                                    <span class="glyphicon sort-icon"
                                          ng-show="b.sortKey=='updated'"
                                          ng-class="{'glyphicon-chevron-up':b.reverse,'glyphicon-chevron-down':!b.reverse}">
                                        </span>
                                </th>
                                <th class="text-center sorting"
                                    ng-click="b.sort('updated');">
                                    แก้ไขเมื่อ

                                    <span class="glyphicon sort-icon"
                                          ng-show="b.sortKey=='updated'"
                                          ng-class="{'glyphicon-chevron-up':b.reverse,'glyphicon-chevron-down':!b.reverse}">
                                        </span>
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr dir-paginate="list in b.roomList | orderBy:b.sortKey:b.reverse | filter:search |
                            itemsPerPage:10">
                                <td ng-bind="list.name">
                                    {{list.name}}
                                </td>
                                <td >
                                    <a href="#"
                                       ng-bind="list.building_name">
                                        {{list.building_name}}
                                    </a >
                                </td>
                                <td class="text-center">
                                    <a href="#" >
                                        {{ "ชั้น" + list.floor_name }}
                                    </a >
                                </td>
                                <td ng-bind="list.remark">{{ list.remark }}</td>
                                <td>
                                    {{ list.created }}
                                    <div class="text-right" >
                                        <a href="#{{list.created_by}}" >
                                            {{ list.created_by }}
                                        </a >
                                    </div >
                                </td>
                                <td >
                                    {{ list.updated }}
                                    <div class="text-right" >
                                        <a href="#{{list.updated_by}}" >
                                            {{list.updated_by}}
                                        </a >
                                    </div >
                                </td>
                                <td class="col-xs-1">
                                    <div class="btn-group btn-group-justified">
                                        <a href="#/room/update/{{list.id}}"
                                           class="btn btn-default item-edit-btn"
                                           data-id="{{list.id}}"
                                           data-toggle="modal"
                                           data-target="#modal-fullscreen"
                                            ng-click="b.btnUpdate(list.id);">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                           class="btn btn-default item-remove-btn"
                                           data-id="{{list.id}}"
                                           data-toggle="modal" data-target="#delete"
                                            ng-click="b.btnDelete(list.id, list.branch_id,
                                                                    list.building_id, list.floor_id,
                                                                    list.name);">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- footer -->
                    <div class="panel-body has-pagination p">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
<!--                                    กำลังแสดงหน้าที่ 1 จากทั้งหมด 1 หน้า-->
                                    &nbsp;
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
                                <span class="text-info">ประเภทห้อง</span>
                                <span class="text-danger">'{{b.roomname}}'</span>
                                <small class="text-muted">'{{b.floor_name}}' อาคาร '{{b.building_name}}'</small>
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