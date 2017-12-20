<?php
/* @var $this ReservationController */
/* @var $data Reservation */
?>

<div ng-controller="ReservationDataController as r"
     id="branch_id"
     class="container-fluid"
     data-building-id="<?php echo $_GET['id']; ?>">

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
                        <tr >
                            <th class="text-center sorting" ng-click="r.sort('room_name');" >ห้อง</th >
                            <th class="text-center sorting" ng-click="r.sort('building_name');" >อาคาร</th >
                            <th class="text-center sorting" ng-click="r.sort('first_name');" >ลูกค้า</th >
                            <th class="text-center sorting" ng-click="r.sort('status');" >สถานะ</th >
                            <th class="text-center sorting" ng-click="r.sort('start');" >เริ่ม</th >
                            <th class="text-center sorting" ng-click="r.sort('end');" >สิ้นสุด</th >
                            <th class="text-center none-sorting" >ใบเสร็จ</th >
                            <th class="text-center sorting" ng-click="r.sort('created');" >เพิ่มเมื่อ</th >
                            <th class="text-center sorting" ng-click="r.sort('updated');" >แก้ไขเมื่อ</th >
                        </tr >
                        </thead>

                        <tbody>
                        <tr dir-paginate="rh in r.setReservationDataAllList |
                                                orderBy:r.sortKey:r.reverse |
                                                filter:search |
                                                itemsPerPage:10" ng-cloak>
                            <td class="text text-center" >{{rh.room_name}}</td >
                            <td >{{rh.building_name}}</td >
                            <td >
                                {{rh.initial+rh.first_name+' '+rh.last_name}}
                            </td >
                            <td class="text text-center" >
                                <span class="btn btn-group" role="group">
                                    <a  ng-hide="rh.status == 'checkin'"
                                        class="btn btn-default"
                                        href="#reserved/{{rh.status}}"
                                        title="reserved" >
                                        <i class="fa fa-flag-o" ></i >
                                    </a >

                                    <a ng-hide="rh.status != 'reserved' || rh.status == 'checkin'"
                                        class="btn btn-default"
                                        href="#checkin/{{rh.status}}"
                                        title="checkin" >
                                        <i class="fa fa-arrow-right" ></i >
                                    </a >

                                    <a ng-hide="rh.status != 'checkin'"
                                        class="btn btn-default"
                                        href="#checkout/{{rh.status}}"
                                        title="checkout" >
                                        <i class="fa fa-arrow-left" ></i >
                                    </a >
                                </span>
                            </td >
                            <td class="text text-center" >{{rh.start}}</td >
                            <td class="text text-center" >{{rh.end}}</td >
                            <td class="text text-center" >
                                <a href="#{{rh.payee}}">
                                    <span ng-hide="rh.payee == null" class="btn btn-default">
                                        <i class="fa fa-fw fa-print"></i>
                                    </span>
                                </a>
                            </td >
                            <td >
                                {{rh.created}}
                                <br />
                                <p href class="text-right" >
                                    {{rh.created_by}}
                                </p >
                            </td >
                            <td >
                                {{rh.updated}}
                                <br />
                                <p class="text-right" >
                                    {{rh.updated_by}}
                                </p >
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