<?php
/* @var $this ReservationHistoryController */
/* @var $dataProvider CActiveDataProvider */
?>

<div ng-controller="ReservationHistoryController as r"
     id="branch_id"
     class="container-fluid"
     data-building-id="<?php echo $_GET['id']; ?>">

    <div class="row" ng-init="r.getReservationHistoryAllList()">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>ประวัติการจอง/ห้องพัก</h2>
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
                            <th class="text-center none-sorting" >ใบคืนเงิน</th >
                            <th class="text-center sorting" ng-click="r.sort('created');" >เพิ่มเมื่อ</th >
                            <th class="text-center sorting" ng-click="r.sort('updated');" >แก้ไขเมื่อ</th >
                        </tr >
                        </thead>

                        <tbody>
                        <tr dir-paginate="rh in r.setReservationHistoryAllList |
                                                orderBy:r.sortKey:r.reverse |
                                                filter:search |
                                                itemsPerPage:10" ng-cloak>
                            <td class="text text-center" >{{rh.room_name}}</td >
                            <td >{{rh.building_name}}</td >
                            <td >
                              <a ng-click="r.openMoreReservationHistory(rh.id)">{{rh.initial+rh.first_name+' '+rh.last_name}}</a>
                            </td >
                            <td ng-class="{'text-danger':rh.status=='checkout', 'text-warning':rh.status=='cancelled', 'text-success': rh.status=='checkin', 'text-primary':rh.status=='reserved'}"
                                class="text text-center" >
                                {{r.checkStatus(rh.status)}}
                            </td >
                            <td class="text text-center" >{{rh.start}}</td >
                            <td class="text text-center" >{{rh.end}}</td >
                            <td class="text text-center" ng-controller="ReservationController as ctrl">
                                <a ng-click="ctrl.openRecieptPrint(rh.id)">
                                    <span ng-hide="rh.payee == null" class="btn btn-default">
                                        <i class="fa fa-fw fa-print"></i>
                                    </span>
                                </a>
                            </td >
                            <td class="text text-center" ng-controller="ReservationController as ctrl">
                                <a ng-click="ctrl.openInvoice(rh.id)">
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

<!-- modal price refund -->
<script type="text/ng-template" id="refund_price_modal_content.html">
    <div id="dismiss-content" class="modal-body">
        <iframe src="{{urlRefundInvoice}}" height="500" width="850" frameborder="0" allowtransparency="true"></iframe>

    </div>
    <div class="modal-footer">
        <button id="dismiss-button" class="btn btn-primary btn-lg btn-block" ng-click="close()">
            ปิด
        </button>
    </div>
</script>
<!-- end modal price refund-->

<!-- modal price reciept -->
<script type="text/ng-template" id="reciept_price_modal_content.html">
    <div id="dismiss-content" class="modal-body">
        <iframe src="{{urlRecieptInvoice}}" height="500" width="850" frameborder="0" allowtransparency="true"></iframe>

    </div>
    <div class="modal-footer">
        <button id="dismiss-button" class="btn btn-primary btn-lg btn-block" ng-click="close()">
            ปิด
        </button>
    </div>
</script>
<!-- end modal price reciept-->

<!--search customer modal -->
<script type="text/ng-template" id="reservationHistoryModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            รายละเอียดประวัติห้องพัก
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="searchCus"
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
            <table class="table table-condensed table-bordered table-hover dataTable no-footer"
               cellspacing="0"
               width="100%">
            <thead>
            <tr >
                <th class="text-center sorting" ng-click="sort('room_name');" >ห้อง</th >
                <th class="text-center sorting" ng-click="sort('building_name');" >อาคาร</th >
                <th class="text-center sorting" ng-click="sort('first_name');" >ลูกค้า</th >
                <th class="text-center sorting" ng-click="sort('status');" >สถานะ</th >
                <th class="text-center sorting" ng-click="sort('start');" >เริ่ม</th >
                <th class="text-center sorting" ng-click="sort('end');" >สิ้นสุด</th >
                <th class="text-center none-sorting" >ใบเสร็จ</th >
                <th class="text-center sorting" ng-click="sort('created');" >เพิ่มเมื่อ</th >
                <th class="text-center sorting" ng-click="sort('updated');" >แก้ไขเมื่อ</th >
            </tr >
            </thead>

            <tbody>
            <tr dir-paginate="rh in setReservationHistoryMoreList |
                                    orderBy:sortKey:reverse |
                                    filter:searchData |
                                    itemsPerPage:10" ng-cloak
                                    ng-show="setReservationHistoryMoreList.length > 0">
                <td class="text text-center" >{{rh.room_name}}</td >
                <td >{{rh.building_name}}</td >
                <td >
                  {{rh.initial+rh.first_name+' '+rh.last_name}}
                </td >
                <td ng-class="{'text-danger':rh.status=='checkout', 'text-warning':rh.status=='cancelled', 'text-success': rh.status=='checkin', 'text-primary':rh.status=='reserved'}"
                    class="text text-center" >
                    {{checkStatus(rh.status)}}
                </td >
                <td class="text text-center" >{{rh.start}}</td >
                <td class="text text-center" >{{rh.end}}</td >
                <td class="text text-center">
                    <a ng-click="openRecieptPrint(rh.reservationId)"
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
            </tr>
            <tr ng-show="setReservationHistoryMoreList.length == 0">
                <td colspan="9" align="center">ไม่พบข้อมูล</td>
            </tr>
            </tbody>
        </table>
        </form >
      </div>
      <div class="modal-footer">
        <button id="dismiss-button" class="btn btn-primary btn-lg btn-block" ng-click="cancel()">
            ปิด
        </button>
    </div>
 </div>
</script>
<!-- end search customer modal -->
