<?php
/* @var $this ReservationController */
/* @var $data Reservation */
?>

<div ng-controller="ReservationController as r"
     id="branch_id"
     class="container-fluid"
     data-building-id="<?php echo $_GET['id']; ?>">

    <div class="row" ng-init="r.init(2, <?php echo $_GET['id'];?>)">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>ข้อมูลการเช็คเอ้าท์ห้องพัก</h2>
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
                           ng-cloak
                           width="100%">
                        <thead>
                        <tr >
                            <th class="text-center sorting" ng-click="r.sort('room_name');" >ห้อง</th >
                            <th class="text-center sorting" ng-click="r.sort('building_name');" >อาคาร</th >
                            <th class="text-center sorting" ng-click="r.sort('first_name');" >ลูกค้า</th >
                            <th class="text-center sorting" ng-click="r.sort('status');" >เช็คเอ้าท์</th >
                            <th class="text-center sorting" ng-click="r.sort('start');" >เริ่ม</th >
                            <th class="text-center sorting" ng-click="r.sort('end');" >สิ้นสุด</th >
                            <th class="text-center none-sorting" >ใบเสร็จ</th >
                            <th class="text-center sorting" ng-click="r.sort('created');" >เพิ่มเมื่อ</th >
                            <th class="text-center sorting" ng-click="r.sort('updated');" >แก้ไขเมื่อ</th >
                        </tr >
                        </thead>

                        <tbody>
                        <tr ng-cloak dir-paginate="rh in r.setReservationDataAllList |
                                                orderBy:r.sortKey:r.reverse |
                                                filter:search |
                                                itemsPerPage:10" ng-cloak>
                            <td class="text text-center" >{{rh.room_name}}</td >
                            <td >{{rh.building_name}}</td >
                            <td >
                                {{rh.initial+rh.first_name+' '+rh.last_name}}
                            </td >
                            <td class="text text-center">
                                <span class="btn btn-group" role="group">
                                <!-- ng-show="rh.status == 'checkin'" -->
                                    <!--<a  ng-show="rh.status == 'reserved'"
                                        class="btn btn-default"
                                        ng-click="r.manageRoomModal(rh.room_id, rh.room_name, 2, rh.id, 2)"
                                        title="reserved" >
                                        <i class="fa fa-flag-o" ></i >
                                    </a >-->

                                    <a ng-show="rh.status == 'checkin'"
                                        class="btn btn-default"
                                        ng-click="r.manageRoomModal(rh.room_id, rh.room_name, 3, rh.id, 2)"
                                        title="checkin" >
                                        <i class="fa fa-arrow-right"> เช็คเอ้าท์</i >
                                    </a >
                                    <a ng-show="rh.status == 'checkin'"
                                        class="btn btn-default"
                                        ng-click="r.manageRoomModal(rh.room_id, rh.room_name, 7, rh.id, 2)"
                                        title="checkin" >
                                        <i class="fa fa-flag"> ยกเลิก</i >
                                    </a >
                                </span>
                            </td >
                            <td class="text text-center" >{{rh.start}}</td >
                            <td class="text text-center" >{{rh.end}}</td >
                            <td class="text text-center" >
                                <a ng-click="r.openInvoice(rh.id)">
                                    <span ng-hide="rh.payee == null" class="btn btn-default">
                                        <i class="fa fa-fw fa-print"></i>
                                    </span>
                                </a>
                            </td >
                            <td >
                                {{rh.created}}
                                <p href class="text-right" >
                                   {{rh.created_by}}
                                </p >
                            </td >
                            <td >
                                {{rh.updated}}
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

<!--manage room modal -->
<script type="text/ng-template" id="manageRoomReadModalContent.html">
    <div ng-init="init()">
    <form class="form-horizontal"
              name="addReserveRead"
              autocomplete="off"
              method="post"
              role="form" novalidate>
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw {{iconMapping(data.type)}}"></i> {{roomNameMapping(data.type)}}
                <span class="text-danger">{{data.roomName}}</span>
                <span class="text-muted">{{data.dataRoom.building_name}} {{data.dataRoom.floor_name}}</span>
        </h3>
      </div>

      <div class="modal-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                     ชื่อลูกค้า
                </label>
                <div class="col-sm-9">
                    <div class="row" >
                        <div class="col-xs-7" >
                            <input name="customersName"
                                   class="form-control"
                                   readonly
                                   ng-model="customerName"/>
                        </div>
                    </div >
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                     วันที่เริ่มเข้าพัก
                </label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               readonly
                               name="startRead"
                               id="startRead"
                               ng-model="start"
                               aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                     วันที่สิ้นสุดการเข้าพัก
                </label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               name="endRead"
                               id="endRead"
                               ng-model="end"
                               readonly
                               aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                     จำนวนวันที่เข้าพัก
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               name="num_days"
                               id="num_days"
                               placeholder="0"
                               readonly
                               ng-model="num_days"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">วัน</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ประเภทห้อง
                </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <strong>{{roomTypeName}}</strong>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ราคาต่อคืน
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text"
                               readonly
                               class="form-control"
                               name="price"
                               id="price"
                               ng-model="price"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ค่ามัดจำ
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               readonly
                               name="deposit"
                               id="deposit"
                               ng-model="deposit"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

             <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ค่ามัดจำเดิม
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               readonly
                               placeholder="0.00"
                               ng-model="depositOld"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ยอดรวมที่ต้องชำระ
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               readonly
                               ng-model="amount"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ชำระเงินแล้ว
                </label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio"
                               name="paid_status"
                               id="paid_status"
                               ng-model="paid_status"
                               disabled
                               value="yes" >
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="paid_status"
                                id="paid_status"
                                ng-model="paid_status"
                                disabled
                                value="no">
                        <strong class="text text-danger">No</strong>
                    </label>
                </div>
            </div>
            <div class="form-group" ng-show="data.type == '3' || data.type == '6'">
                <label for="inputEmail3" class="col-sm-3 control-label">
                ต้องการฝากเงิน
                </label>

                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio"
                               name="give_paid_status"
                               id="give_paid_status"
                               ng-model="give_paid_status"
                               value="yes"
                               required>
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="give_paid_status"
                                id="give_paid_status"
                                ng-model="give_paid_status"
                                value="no"
                                required>
                        <strong class="text text-danger">No</strong>
                    </label>

                </div>

                <div class="col-sm-9">
                    <label ng-show="data.type == '3'">
                        <span class="text text-danger">*</span> <b>เช็คเอ้า </b>จะเป็นการฝากเงินมัดจำ
                    </label>
                    <label ng-show="data.type == '6'">
                        <span class="text text-danger">*</span> <b>ยกเลิกการจอง</b>จะเป็นการฝากเงินทั้งหมด
                    </label>
                </div>
            </div>

      </div>

      <div class="modal-footer">
            <button class="btn btn-primary"`
                    type="button"
                    ng-disabled="addReserveRead.$invalid"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
      </form >
 </div>
</script>
<!-- end manage room modal -->

<!--manage room modal -->
<script type="text/ng-template" id="manageRoomModalContent.html">
    <div ng-init="init()">
    <form class="form-horizontal"
              name="addReserve"
              autocomplete="off"
              method="post"
              role="form" novalidate>
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw {{iconMapping(data.type)}}"></i> {{roomNameMapping(data.type)}}
                <span class="text-danger">{{data.roomName}}</span>
                <span class="text-muted">{{data.dataRoom.building_name}} {{data.dataRoom.floor_name}}</span>
        </h3>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    <span class="text text-danger">*</span> ชื่อลูกค้า
                </label>
                <div class="col-sm-9">
                    <div class="row" >
                        <div class="col-xs-7" >
                            <input name="customersName"
                                   class="form-control"
                                   ng-model="customerName"
                                   required />
                        </div>
                        <div class="col-xs-5">
                            <button type="button" class="btn btn-info" ng-click="searchCustomerModal()">
                              <span class="fa fa-fw fa-search-plus"></span> ค้นหาลูกค้า
                            </button>
                            <button type="button" class="btn btn-primary" ng-click="addCustomerModal()">
                              <span class="fa fa-fw fa-plus"></span> เพิ่มชื่อลูกค้า
                            </button>
                        </div>
                    </div >
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    <span class="text text-danger">*</span> วันที่เริ่มเข้าพัก
                </label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               required
                               placeholder="dd/mm/yyyy"
                               value=""
                               name="start"
                               id="start"
                               ng-model="start"
                               aria-describedby="basic-addon2"
                               ng-blur="calulateDate();"
                               ng-change="calulateDate();">
                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    <span class="text text-danger">*</span> วันที่สิ้นสุดการเข้าพัก
                </label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               required
                               placeholder="dd/mm/yyyy"
                               name="end"
                               id="end"
                               ng-model="end"
                               aria-describedby="basic-addon2"
                               ng-blur="calulateDate();"
                               ng-change="calulateDate();">
                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                     จำนวนวันที่เข้าพัก
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               name="num_days"
                               id="num_days"
                               placeholder="0"
                               readonly
                               ng-model="num_days"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">วัน</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ประเภทห้อง
                </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <strong>{{data.dataRoom.roomTypeName}}</strong>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ราคาต่อคืน
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number"
                               min="1"
                               readonly
                               class="form-control"
                               placeholder="0.00"
                               name="price"
                               id="price"
                               ng-model="price"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ค่ามัดจำ
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               readonly
                               placeholder="0.00"
                               name="deposit"
                               id="deposit"
                               ng-model="deposit"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ค่ามัดจำเดิม
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               readonly
                               placeholder="0.00"
                               ng-model="depositOld"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    {{textAmount}}
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               readonly
                               placeholder="0.00"
                               ng-model="amount"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">บาท</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ชำระเงินแล้ว
                </label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio"
                               name="paid_status"
                               id="paid_status"
                               ng-disabled="isDisablePaidStatus"
                               ng-model="paid_status"
                               value="yes" >
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="paid_status"
                                id="paid_status"
                                ng-disabled="isDisablePaidStatus"
                                ng-model="paid_status"
                                value="no">
                        <strong class="text text-danger">No</strong>
                    </label>
                </div>
            </div>
      </div>

      <div class="modal-footer">
            <button class="btn btn-primary"`
                    type="button"
                    ng-disabled="addReserve.$invalid"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
      </form >
 </div>
      <script>
        $(function() {
            var dateFormat = "yy/mm/dd",
                from = $( "#start" )
                    .datepicker({
                        changeMonth: true,
                        numberOfMonths: 3,
                        minDate: 0,
                        dateFormat: dateFormat
                    })
                    .on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#end" ).datepicker({
                    defaultDate: "+1W",
                    changeMonth: true,
                    numberOfMonths: 3,
                    minDate: 1,
                    dateFormat: dateFormat
                })
                    .on( "change", function() {
                        from.datepicker( "option", "maxDate", getDate( this ) );
                    });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
            }

        });
    </script>
</script>
<!-- end manage room modal -->