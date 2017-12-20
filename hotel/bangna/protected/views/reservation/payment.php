<div ng-controller="ReservationController as r"
     id="branch_id"
     class="container-fluid"
     data-building-id="<?php echo $_GET['id']; ?>">

    <div class="row" ng-init="r.getPaymentDataList(<?php echo $_GET['id'];?>)">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>ข้อมูลยืนยันการชำระเงิน</h2>
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
                            <th class="text-center sorting" ng-click="r.sort('num_days');" >จำนวนวันที่พัก</th >
                            <th class="text-center sorting" ng-click="r.sort('price');" >ราคาต่อคืน</th >
                            <th class="text-center sorting" ng-click="r.sort('deposit');" >ค่ามัดจำ</th >
                            <th class="text-center sorting" >ราคาไม่รวมค่ามัดจำ</th >
                            <th class="text-center sorting" >ราคารวมค่ามัดจำ</th >
                            <th class="text-center sorting" ng-click="r.sort('status');" >สถานะ</th >
                            <th class="text-center sorting" >สถานะคืนเงินค่ามัดจำ</th >
                            <th class="text-center none-sorting" >ใบเสร็จ</th >
                            <th class="text-center none-sorting" >ใบคืนเงิน</th >
                        </tr >
                        </thead>

                        <tbody>
                        <tr dir-paginate="rh in r.setPaymentDataAllList |
                                                orderBy:r.sortKey:r.reverse |
                                                filter:search |
                                                itemsPerPage:10" ng-cloak>
                            <td class="text text-center" >{{rh.room_name}}</td >
                            <td >{{rh.building_name}}</td >
                            <td >
                              <a ng-click="r.openMoreReservationHistory(rh.id)">{{rh.initial+rh.first_name+' '+rh.last_name}}</a>
                            </td >
                            <td align="center">{{rh.num_days}}</td >
                            <td align="center">{{rh.price}}</td >
                            <td align="center">{{rh.deposit}}</td >
                            <td align="center">{{r.calNotSumDeposit(rh.num_days, rh.price)}}</td >
                            <td align="center">{{r.calSumDeposit(rh.num_days, rh.price, rh.deposit)}}</td >
                            <td ng-class="{'text-danger':rh.status=='checkout', 'text-warning':rh.status=='cancelled', 'text-success': rh.status=='checkin', 'text-primary':rh.status=='reserved'}"
                                class="text text-center" >
                                {{r.checkStatus(rh.status)}}
                            </td >
                            <td align="center">{{rh.deposit_with_me}}</td >
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

<!-- modal price invoice -->
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
<!-- end modal price invoice-->

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
