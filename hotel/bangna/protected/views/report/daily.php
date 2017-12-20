<div ng-controller="ReservationController as r"
     id="branch_id"
     class="container-fluid">

    <div class="row" ng-init="r.init(3, <?php echo $_GET['id'];?>)">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>รายงานการเข้าพักรายวัน</h2>
                    <div class="panel-ctrls" style="line-height: normal;">
                        <i class="separator pull-left"></i>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter pull-left">
                        <form name="formSearch">
                            <label class="panel-ctrls-center">
                            ตั้งแต่วันที่
                            </label>
                           <label class="panel-ctrls-center">
                                
                                <input type="text"
                                class="form-control"
                                placeholder="dd/mm/yyyy"
                                name="startDateDailySearch"
                                id="startDateDailySearch"
                                ng-model="startDateDailySearch"
                                aria-describedby="basic-addon2">
                                
                            </label>
                            <label class="panel-ctrls-center">
                            ถึงวันที่
                            </label>
                             <label class="panel-ctrls-center">
                                <input type="text"
                                    class="form-control"
                                    required
                                    placeholder="dd/mm/yyyy"
                                    name="endDateDailySearch"
                                    id="endDateDailySearch"
                                    ng-model="endDateDailySearch"
                                    aria-describedby="basic-addon2">
                               
                            </label>
                            <label class="panel-ctrls-center">
                                 <button class="btn btn-primary" type="button"
                                    ng-click="r.getReportDailyAllList(startDateDailySearch, endDateDailySearch)">ค้นหา</button>
                            </label>

                            <label class="panel-ctrls-center">
                                <a ng-click="r.openPrintModal(startDateDailySearch, endDateDailySearch, r.urlReportDaily)">
                                    <span class="btn btn-default">
                                        <i class="fa fa-fw fa-print"></i>
                                    </span>
                                </a>
                            </label>

                        </form>
                         
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
                            <th class="text-center sorting" ng-click="r.sort($index+1);" >ลำดับ</th >
                            <th class="text-center sorting" ng-click="r.sort('start');" >วันที่</th >
                            <th class="text-center sorting" ng-click="r.sort('reciept_no');" >เลขที่ใบเสร็จ</th >
                            <th class="text-center sorting" ng-click="r.sort('room_name');" >ห้อง</th >
                            <th class="text-center sorting" ng-click="r.sort('first_name');" >ชื่อ - สกุล</th >
                            <th class="text-center sorting" ng-click="r.sort(r.calStartDateAndEndDate(rh.start,rh.end));" >จำนวน</th >
                            <th class="text-center sorting" ng-click="r.sort('price');" >รายวัน</th >
                            <th class="text-center sorting" ng-click="r.sort('deposit');" >ประกัน</th >
                            <th class="text-center sorting" ng-click="r.sort('end');" >เชคเอ้า</th >
                            <th class="text-center sorting" ng-click="r.sort('amount');" >รวม</th >
                        </tr >
                        </thead>

                        <tbody>
                        <tr ng-show="r.setReportDailyAllList.length > 0" 
                            ng-cloak dir-paginate="rh in r.setReportDailyAllList |
                                                orderBy:r.sortKey:r.reverse |
                                                filter:search |
                                                itemsPerPage:20" ng-cloak>
                            <td class="text text-center">{{$index+1}}</td>
                            <td class="text text-center" >{{rh.start}}</td >
                            <td >{{rh.reciept_no}}</td >
                            <td class="text text-center" >{{rh.room_name}}</td >
                            <td>
                                {{rh.initial+rh.first_name+' '+rh.last_name}}
                            </td>
                            <td class="text text-center" >{{r.calStartDateAndEndDate(rh.start,rh.end)}}</td >
                            <td class="text text-center" >{{rh.price}}</td >
                            <td class="text text-center" >{{rh.deposit}}</td >
                            <td class="text text-center" >{{rh.end}}</td >
                            <td class="text text-center" >{{rh.amount}}</td >
                        </tr >
                        <tr ng-show="r.setReportDailyAllList.length ==0">
                            <td colspan="10" class="text text-center" >ไม่พบข้อมูล</td>
                        </tr>
                        
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

 <script>
        $(function() {
            var start = $( "#startDateDailySearch" ).datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd"
            });
            var end = $( "#endDateDailySearch" ).datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd"
            });
        });
    </script>

<!-- modal print report deily -->
<script type="text/ng-template" id="print_modal_content.html">
    <div id="dismiss-content" class="modal-body">
        <iframe src="{{url}}" height="500" width="850" frameborder="0" allowtransparency="true"></iframe>
    </div>
    <div class="modal-footer">
        <button id="dismiss-button" class="btn btn-primary btn-lg btn-block" ng-click="close()">
            ปิด
        </button>
    </div>
</script>
<!-- modal print report deily -->
