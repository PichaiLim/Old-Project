<?php
/* @var $this CustomerController */
/* @var $dataProvider CActiveDataProvider */
?>


<div ng-controller="CustomerController as c" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
                <a class="btn btn-default mt0 width-64px"
                    ng-click="c.addCustomerModal()">
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
                        <h2>ลูกค้า</h2>
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
                                        ng-click="c.sort(first_name);">
                                        ชื่อ-นามสกุล
                                    </th >
                                    <th class="text-center sorting"
                                        ng-click="c.sort(home_phone+mobile_phone)">
                                        เบอร์โทร
                                    </th >
                                    <th class="text-center sorting"
                                        ng-click="c.sort(address);">
                                        ที่อยู่
                                    </th>
                                    <th class="text-center sorting"
                                        ng-click="c.sort(remark);">
                                        รายละเอียด
                                    </th>
                                    <th class="text-center sorting"
                                        ng-click="c.sort(deposit);">
                                        เงินมัดจำเดิมคงเหลือ
                                    </th >
                                    <th class="text-center sorting"
                                        ng-click="c.sort(created);">
                                        เพิ่มเมื่อ
                                    </th >
                                    <th class="text-center sorting"
                                        ng-click="c.sort(updated);">
                                        แก้ไขเมื่อ
                                    </th >
                                    <th class="text-center sorting"></th>
                            </tr >
                            </thead>

                            <tbody>
                                <tr dir-paginate="list in c.listAll | orderBy: e.sortKey:e.reverse | filter: search |
                                itemsPerPage: 10" >
                                    <td >
                                      {{list.initial}}  {{list.first_name}} {{list.last_name}}
                                    </td >
                                     <td >
                                        <p>{{list.home_phone}}</p>
                                        <p>{{list.mobile_phone}}</p>
                                    </td >
                                    <td >
                                        {{list.address}} {{list.area}} {{list.district}} {{list.province}} {{list.postal_code}}
                                    </td >
                                    <td ng-bind="list.remark">
                                        {{list.remark}}
                                    </td >
                                    <td ng-bind="list.deposit" align="center">
                                        {{list.deposit}}
                                    </td >

                                    <td >
                                        <div ng-bind="list.created" >
                                            {{list.created}}
                                        </div >

                                        <div class="text-right" >
                                            {{list.created_by}}
                                        </div >
                                    </td >

                                    <td >
                                        <div ng-bind="list.updated">
                                            {{list.updated}}
                                        </div>

                                        <div class="text-right">
                                           {{list.updated_by}}
                                        </div>
                                    </td >
                                    <td class="col-xs-1">
                                        <div class="btn-group btn-group-justified">
                                            <a class="btn btn-default item-edit-btn"
                                               ng-click="c.btnUpdate(list.id);">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-default item-remove-btn"
                                               ng-click="c.btnDelete(list.id);">
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
</div>





