<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */
?>

<div ng-controller="EmployeeController as e" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a class="btn btn-default mt0 width-64px"
                   ng-click="e.addEmployeeModal(<?php echo Yii::app()->user->id;?>)">
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
                        <h2>พนักงาน</h2>
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
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.username"
                                        ng-cloak="e.attributeLabelName.username"
                                        ng-click="e.sort(username);">
                                        {{e.attributeLabelName.username}}
                                    </th>
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.fullname"
                                        ng-cloak="e.attributeLabelName.fullname"
                                        ng-click="e.sort(first_name);">
                                        {{e.attributeLabelName.fullname}}
                                    </th >
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.address"
                                        ng-cloak="e.attributeLabelName.address"
                                        ng-click="e.sort(address);">
                                        ที่อยู่
                                    </th>
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.tel"
                                        ng-cloak="e.attributeLabelName.tel"
                                        ng-click="e.sort(home_phone+mobile_phone)">
                                        {{e.attributeLabelName.tel}}
                                    </th >
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.remark"
                                        ng-cloak="e.attributeLabelName.remark"
                                        ng-click="e.sort(remark);">
                                        {{e.attributeLabelName.remark}}
                                    </th>
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.created"
                                        ng-cloak="e.attributeLabelName.created"
                                        ng-click="e.sort(created);">
                                        {{e.attributeLabelName.created}}
                                    </th >
                                    <th class="text-center sorting"
                                        ng-bind="e.attributeLabelName.updated"
                                        ng-cloak="e.attributeLabelName.updated"
                                        ng-click="e.sort(updated);">
                                        {{e.attributeLabelName.updated}}
                                    </th >
                                    <th class="text-center sorting"></th>
                            </tr >
                            </thead>

                            <tbody>
                                <tr dir-paginate="list in e.dataList | orderBy: e.sortKey:e.reverse | filter: search |
                                itemsPerPage: 10" >
                                    <td >
                                        {{list.username}}
                                    </td >

                                    <td >
                                        {{list.first_name}} {{list.last_name}}
                                    </td >

                                    <td >

                                        {{list.address}} <!--{{{e.setAddress(list)}} {list.province_id}} {{list.district_id}} {{list.area_id}}
                                        {{list.postal_code}}-->
                                    </td >

                                    <td >
                                        <p>{{list.home_phone}}</p>
                                        <p>{{list.mobile_phone}}</p>
                                    </td >

                                    <td ng-bind="list.remark">
                                        {{list.remark}}
                                    </td >

                                    <td >
                                        <div ng-bind="list.created" >
<!--                                            {{list.created}}-->
                                        </div >

                                        <div class="text-right" >
                                            <a href="#{{list.created_by}}"
                                               ng-click="e.getEmployeeCreateBy(list.created_by);"
                                                >
                                                <span>
                                                    {{ e.setCratedBy(list.created_by, e.dataList) }}
                                                </span>
                                            </a >
                                        </div >
                                    </td >

                                    <td >
                                        <div ng-bind="list.updated">
<!--                                            {{list.updated}}-->
                                        </div>

                                        <div class="text-right">
                                            <a href="#{{list.updated_by}}" >
                                                {{e.setCratedBy(list.updated_by, e.dataList)}}
                                            </a >
                                        </div>
                                    </td >
                                    <td class="col-xs-1">
                                        <div class="btn-group btn-group-justified">
                                            <a class="btn btn-default item-edit-btn"
                                               ng-click="e.editEmployeeModal(list.id);">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#"
                                               class="btn btn-default item-remove-btn"
                                               data-id="{{list.id}}"
                                               data-toggle="modal" data-target="#delete"
                                               ng-click="e.btnDelete(list.id,list.username);">
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
                                <span class="text-info">ผู้ใช้งาน</span>
                                <span class="text-danger">'{{e.username}}'</span>
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
</div>