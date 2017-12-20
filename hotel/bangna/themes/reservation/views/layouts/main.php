<?php /* @var $this Controller */
?>
<?php $uri = Yii::app()->controller->id.'/'.Yii::app()->controller->action->id; ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avalon Admin Theme">
    <meta name="author" content="The Red Team">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>


    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">        <!-- Font Awesome -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/styles.css" type="text/css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jstree/dist/themes/avalon/style.min.css" type="text/css" rel="stylesheet">    <!-- jsTree -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/codeprettifier/prettify.css" type="text/css" rel="stylesheet">                <!-- Code Prettifier -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/skins/minimal/blue.css" type="text/css" rel="stylesheet">              <!-- iCheck -->

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" type="text/css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap-select/dist/css/bootstrap-select.css" type="text/css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.11.4.custom/jquery-ui.min.css" type="text/css"
          rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.11.4.custom/jquery-ui.theme.css" type="text/css"
          rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css" type="text/css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/src/datepicker/datepicker.css" type="text/css" rel="stylesheet">

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.12.4.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui-1.12.0.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body ng-app="dsam"
      ng-controller="ReservationController as r"
      class="infobar-overlay breadcrumb-top"
      data-branch-id="<?=$_GET['id'];?>">
    <header id="topnav" class="navbar navbar-primary navbar-fixed-top clearfix" role="banner">

        <div class="yamm navbar-left navbar-collapse collapse in">
            <ul class="nav navbar-nav">
               <?php if(strtolower($uri) == "site/index" || strtolower($uri) == "employee/index"): ?>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/'); ?>"
                       style="min-width: 300px; font-size: 16px;">
                        <strong>
                                <i class="fa fa-fw fa-home"></i>
                                หน้าแรก
                        </strong>
                    </a>
                </li>
                 <?php else: ?>
                 <li>
                    <a href="<?php echo Yii::app()->createUrl('/');?>/Branch/Index/<?=$_GET['id'];?>#/"
                       style="min-width: 300px; font-size: 16px;">
                        <strong>
                                <i class="fa fa-fw fa-code-fork"></i>
                                <?php echo @$_SESSION['branch']; ?>
                        </strong>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>


        <ul class="nav navbar-nav toolbar pull-right">
            <?php if(Yii::app()->user->role == 1): ?>
                <li>
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-fw fa-briefcase"></i>
                        บริษัท
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pl5 pr5" role="menu">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('Branch/List/');?>">
                                <i class="fa fa-fw fa-bolt"></i>
                                จัดการสาขา
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('Product/Index/');?>">
                                <i class="fa fa-fw fa-bookmark"></i>
                                จัดการสินค้า
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('EmployeeType/index'); ?>">
                                <i class="fa fa-fw fa-user"></i>
                                จัดการประเภทพนักงาน
                            </a>
                        </li>
                        <li class="divider active"></li>
                        <li ng-controller="CompanyController as compCtrl">
                            <a ng-click="compCtrl.editCompanyModal()">
                                <i class="fa fa-fw fa-briefcase"></i>
                                ข้อมูลบริษัท
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('Customer/index'); ?>">
                                <i class="fa fa-fw fa-users"></i>
                                ข้อมูลการลูกค้า
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <li class="dropdown">
                <a href="#/" class="dropdown-toggle username" data-toggle="dropdown">
                    <span class="hidden-xs">
                        <?php echo Yii::app()->user->name; ?>
                    </span>
                    <img class="img-circle"
                         src="<?php echo Yii::app()->baseUrl; ?>/assets/demo/avatar/avatar_06.png"
                         alt="Dangerfield" />

                </a>
                <ul class="dropdown-menu userinfo">
                    <li class="<?= (Yii::app()->user->role == 1)? "":"hidden"; ?>">
                        <a href="<?= Yii::app()->createUrl('employee/index', array('id'=>Yii::app()->user->id)); ?>">
                            <i class="fa fa-fw fa-plus-square"></i>
                            เพิ่มผู้ใช้ในระบบ
                        </a>
                    </li>
                   <li ng-controller="EmployeeUpdateProfileController as empUpCtrl">
                        <a ng-click="empUpCtrl.updateProfileModal(<?php echo Yii::app()->user->id; ?>)">
                            <i class="fa fa-fw fa-pencil"></i>
                            แก้ไขข้อมูล
                        </a>
                    </li>
                    <li>
                        <a ng-href="#/employee/changepassword/<?php echo Yii::app()->user->id;?>"
                           data-toggle="modal"
                           data-target="#change">
                            <i class="fa fa-fw fa-lock"></i>
                            เปลี่ยนรหัสผ่าน
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('Site/Logout'); ?>">
                            <i class="fa fa-fw fa-sign-out"></i>
                            ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </header>



    <div id="wrapper" style="height:auto;" ng-init="r.init(1, <?php echo $_GET['id'];?>)">
        <div class="" id="layout-static">
            <?php echo $content; ?>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal modal-fullscreen fade in" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <ng-view>

                </ng-view>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="change" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <ng-view></ng-view>
            </div>
        </div>
    </div>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jqueryui-1.9.2.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    			<!-- Load jQueryUI -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script> 								<!-- Load Script -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/sparklines/jquery.sparklines.min.js"></script>  		<!-- Sparkline -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jstree/dist/jstree.min.js"></script>  				<!-- jsTree -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/enquire.min.js"></script> 									<!-- Enquire for Responsiveness -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootbox/bootbox.js"></script>							<!-- Bootbox -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/simpleWeather/jquery.simpleWeather.js"></script> <!-- Weather plugin-->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/application.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/demo/demo.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/demo/demo-switcher.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular/angular.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-route/angular-route.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-utils-pagination/dirPagination.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/src/modal/modal.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/src/datepicker/datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/app.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtEmployee.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serEmployee.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/dateUtilService.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtCustomer.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/ctrCompany.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serCustomer.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serCompany.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtReservation.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serReservation.js"></script>
<!-- End loading site level scripts -->


<!-- loading page level scripts-->
<script>
    $("[data-toggle=popover]").popover();

    $('table.table-inbox tbody tr').click(function () {
        window.location.href = 'app-inbox-read.html';
    });

    enquire.register("screen and (max-width: 992px)", {
        match : function() {
            //small
            $( ".table-inbox tr" ).each(function( index ) {
                $(this).find("td.inbox-msg-snip").prepend($(this).find("td.inbox-msg-from div").addClass("inbox-from-name"));
            });
        },
        unmatch : function() {
            //big
            $( ".table-inbox tr" ).each(function( index ) {
                $(this).find("td.inbox-msg-from").append($(this).find(".inbox-from-name"));
            });
        }
    });
</script>

<!-- End loading page level scripts-->

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
                               placeholder="dd/mm/yyyy"
                               ng-disabled="true"
                               name="start"
                               id="start"
                               ng-model="start"
                               aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2"></span>
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
                    <label style="margin-top: 10px; margin-bottom: -10px;" ng-if="dataRoomCheckinOrResered.length > 0">
	                    <span class="text text-danger" >
                        	ไม่สามารถเลือกวัน {{end}} ได้ เนื่องจากมีผู้จองหรือเข้าพักแล้ว กรุณาระบุวันที่ไม่ให้ซ้ำกับข้อมูลดังนี้
                        	<ul>
                        		<li ng-repeat="dataRoom in dataRoomCheckinOrResered">
                        		วันที่เริ่มเข้าพัก {{dataRoom.start}}  ถึง  {{dataRoom.end}}
                        		</li>
                        	</ul>
                        </span>
	                </label>
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
                <label class="col-sm-3 control-label">
                    ส่วนลด
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text"
                               min="1"
                               class="form-control"
                               placeholder="0.00"
                               name="discount"
                               id="discount"
                               ng-model="discount"
                               aria-describedby="basic-addon2"
                               ng-blur="calulateDiscount();"
                               ng-change="calulateDiscount();">
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
                <label class="col-sm-3 control-label">
                    รายละเอียด
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                    	<textarea rows="2" cols="50" ng-model="description"  maxlength="80">
						</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ไม่คิดค่ามัดจำ
                </label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio"
                               name="paid_deposit"
                               id="paid_deposit"
                               ng-change="isPaidDeposit()"
                               ng-model="paid_deposit"
                               value="yes" >
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="paid_deposit"
                                id="paid_deposit"
                                ng-change="isPaidDeposit()"
                                ng-model="paid_deposit"
                                value="no">
                        <strong class="text text-danger">No</strong>
                    </label>
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
                    ng-disabled="addReserve.$invalid || dataRoomCheckinOrResered.length > 0"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
      </form >
 </div>
      <script>
        $(function() {
            var minDate = new Date($("#datepicker-left").val());
            minDate.setDate(minDate.getDate() + 1);
            var to = $( "#end" ).datepicker({
                defaultDate: "+1W",
                changeMonth: true,
                numberOfMonths: 3,
                minDate: minDate,
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</script>
<!-- end manage room modal -->

<!--manage room move modal -->
<script type="text/ng-template" id="manageRoomMoveModalContent.html">
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
                                   disabled
                                   ng-model="customerName"
                                   required />
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
                               disabled
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
                               disabled
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
                <label class="col-sm-3 control-label">
                    รายละเอียด
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                    	<textarea rows="2" cols="50" readonly ng-model="description"  maxlength="80">
						</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ไม่คิดค่ามัดจำ
                </label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio"
                               name="paid_deposit"
                               id="paid_deposit"
                               disabled
                               ng-model="paid_deposit"
                               value="yes" >
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="paid_deposit"
                                id="paid_deposit"
                                disabled
                                ng-model="paid_deposit"
                                value="no">
                        <strong class="text text-danger">No</strong>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="border: 1px solid #e5e5e5;">
                     <div class="form-group">
                        <div class="col-sm-8">
                            <p class="form-control-static text-danger">
                                <strong style="font-size: 20px; float: right;">ข้อมูลห้องเดิม</strong>
                            </p>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ประเภทห้อง
                        </label>
                        <div class="col-sm-5">
                            <p class="form-control-static">
                                <strong>{{data.dataRoom.roomTypeName}}</strong>
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
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
                        <label for="inputEmail3" class="col-sm-4 control-label">
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
                        <label for="inputEmail3" class="col-sm-4 control-label">
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
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ยอดรวมที่ต้องชำระ
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
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ชำระเงินแล้ว
                        </label>
                        <div class="col-sm-5">
                            <label class="radio-inline">
                                <input type="radio"
                                       disabled
                                       name="paid_status"
                                       id="paid_status"
                                       ng-model="paid_status"
                                       value="yes" >
                                <strong class="text text-success">Yes</strong>
                            </label>
                            <label class="radio-inline">
                                <input type="radio"
                                        name="paid_status"
                                        id="paid_status"
                                        disabled
                                        ng-model="paid_status"
                                        value="no">
                                <strong class="text text-danger">No</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6" style="border: 1px solid #e5e5e5;">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <p class="form-control-static text-danger">
                                <strong style="font-size: 20px; float: right;">ข้อมูลห้องที่ย้ายไป</strong>
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            อาคาร
                        </label>
                        <div class="col-sm-8">
                            <select name="selectedBuilding" id="selectedBuilding"
                                    class="form-control"
                                    ng-model="selectedBuilding"
                                    required
                                    ng-change="changeBuilding();">
                                <option ng-repeat="b in buildingList" value="{{b.id}}"
                                    ng-selected="selectedBuilding == b.id">{{b.name}}</option >
                            </select >

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ชั้น
                        </label>
                        <div class="col-sm-8">
                            <select name="selectedFloor" id="selectedFloor"
                                    class="form-control"
                                    ng-model="selectedFloor"
                                    required
                                    ng-change="changeFloor();">
                                <option ng-repeat="b in floorList" value="{{b.id}}"
                                    ng-selected="selectedFloor == b.id">{{b.name}}</option >
                            </select >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ห้อง
                        </label>
                        <div class="col-sm-8">
                            <select name="selectedRoom" id="selectedRoom"
                                    class="form-control"
                                    ng-model="selectedRoom"
                                    required
                                    ng-change="changeRoom(selectedRoom);">
                                <option ng-repeat="b in roomList" value="{{b.id}}"
                                    ng-selected="selectedRoom == b.id">{{b.name}}</option >
                            </select>
                            <span class="text text-danger">{{errorRoom}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ประเภทห้อง
                        </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">
                                <strong>{{roomTypeNameNew}}</strong>
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ราคาต่อคืน
                        </label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="number"
                                       min="1"
                                       readonly
                                       class="form-control"
                                       placeholder="0.00"
                                       name="priceNew"
                                       id="priceNew"
                                       ng-model="priceNew"
                                       aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">บาท</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ค่ามัดจำ
                        </label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="number"
                                       class="form-control"
                                       readonly
                                       placeholder="0.00"
                                       name="depositNew"
                                       id="depositNew"
                                       ng-model="depositNew"
                                       aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">บาท</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            ค่ามัดจำเดิม
                        </label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="number"
                                       class="form-control"
                                       readonly
                                       placeholder="0.00"
                                       ng-model="depositOldNew"
                                       aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">บาท</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            {{textAmountNew}}
                        </label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="number"
                                       class="form-control"
                                       readonly
                                       placeholder="0.00"
                                       ng-model="amountNew"
                                       aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">บาท</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">
                            {{textPaidStatusNew}}
                        </label>
                        <div class="col-sm-5">
                            <label class="radio-inline">
                                <input type="radio"
                                       name="paid_status_new"
                                       id="paid_status_new"
                                       ng-disabled="true"
                                       ng-model="paid_status_new"
                                       value="yes" >
                                <strong class="text text-success">Yes</strong>
                            </label>
                            <label class="radio-inline">
                                <input type="radio"
                                        name="paid_status_new"
                                        id="paid_status_new"
                                        ng-model="paid_status_new"
                                        ng-disabled="true"
                                        value="no">
                                <strong class="text text-danger">No</strong>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

      </div>

      <div class="modal-footer">
            <button class="btn btn-primary"`
                    type="button"
                    ng-disabled="addReserve.$invalid || errorRoom"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
      </form >
 </div>

</script>
<!-- end manage room move modal -->

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
                <label class="col-sm-3 control-label">
                    รายละเอียด
                </label>
                <div class="col-sm-5">
                    <div class="input-group">
                    	<textarea rows="2" cols="50" ng-model="description" readonly  maxlength="80">
						</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">
                    ไม่คิดค่ามัดจำ
                </label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio"
                               name="paid_deposit"
                               id="paid_deposit"
                               disabled
                               ng-model="paid_deposit"
                               value="yes" >
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="paid_deposit"
                                id="paid_deposit"
                                disabled
                                ng-model="paid_deposit"
                                value="no">
                        <strong class="text text-danger">No</strong>
                    </label>
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
                               ng-disabled="isDisablePaidStatus"
                               value="yes" >
                        <strong class="text text-success">Yes</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio"
                                name="paid_status"
                                id="paid_status"
                                ng-model="paid_status"
                                ng-disabled="isDisablePaidStatus"
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

<!--search customer modal -->
<script type="text/ng-template" id="searchCustomerModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw {{data.style_icon}}"></i> {{data.titleheader}}
                <span class="text-danger">{{data.roomName}}</span>
                <span class="text-muted">{{data.dataRoom.building_name}} {{data.dataRoom.floor_name}}</span>
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

            <table  class="table table-condensed table-bordered table-hover dataTable no-footer"
                    id="search-customer-modal">
                <thead>
                    <tr role="row">
                      <th id="search-customer-description">
                        <span>ชื่อ</span>
                      </th>
                      <th id="search-customer-description">
                        <span>นามสกุล</span>
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="search-customer-table-<[$index+1]>" class="text-left"
                        ng-repeat="data in CustomerList|filter:searchData"
                        ng-click="selectCustomer(data)" style="cursor: pointer;">
                        <td id="search-customer-firstName-<[$index+1]>">
                          {{data.first_name}}
                        </td>
                        <td id="search-customer-lastName-<[$index+1]>">
                          {{data.last_name}}
                        </td>
                    </tr>
                    <tr ng-show="(CustomerList | filter:searchData).length == 0">
                        <td id="result-no-data" colspan="2"  class="text-center" >
                          ไม่พบข้อมูล
                        </td>
                    </tr>
                </tbody>
            </table>
        </form >
      </div>
      <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
 </div>
</script>
<!-- end search customer modal -->

<!--add customer modal -->
<script type="text/ng-template" id="addCustomerModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw fa-plus"></i> {{title}}
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="addCustomerForm"
              autocomplete="off"
              role="form"
              method="post" >
              <div class="row">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home-tab" aria-controls="home-tab" role="tab" data-toggle="tab" target="_top">ข้อมูลส่วนตัว</a></li>
                    <li role="presentation"><a href="#address-tab" aria-controls="address-tab" role="tab" data-toggle="tab" target="_top" >ที่อยู่อาศัย</a></li>
                    <li role="presentation"><a href="#remark-tab" aria-controls="remark-tab" role="tab" data-toggle="tab" target="_top">หมายเหตุ</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home-tab">

                        <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">
                                <span class="text-danger" >*</span > ชื่อ
                            </label>
                            <div class="col-sm-10">
                                <div class="row" >
                                    <div class="col-xs-3" >
                                        <input type="text"
                                               class="form-control"
                                               id="initial"
                                               maxlength="16"
                                               placeholder="นาย | นาง | นางสาว"
                                               ng-model="initial"
                                               required>
                                    </div >
                                    <div class="col-xs-9" >
                                        <input type="text"
                                               class="form-control"
                                               id="first_name"
                                               placeholder="ชื่อ"
                                               maxlength="64"
                                               ng-blur="validateNameAndLastname(firstName, lastName)"
                                               ng-change="validateNameAndLastname(firstName, lastName)"
                                               required
                                               ng-model="firstName">
                                    </div >
                                </div >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">
                                <span class="text-danger" >*</span > นามสกุล
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="last_name"
                                       placeholder="นาสกุล"
                                       maxlength="64"
                                       ng-blur="validateNameAndLastname(firstName, lastName)"
                                       ng-change="validateNameAndLastname(firstName, lastName)"
                                       required
                                       ng-model="lastName">
                                <div class="text-danger">{{errorDuplicateNameAndLastname}}</div>
                            </div>
                        </div>

                        <div class="form-group error">
                            <label for="email" class="col-sm-2 control-label">
                                 Email
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="email"
                                       placeholder="Email"
                                       ng-maxlength="255"
                                       ng-blur="onBlurEmail()"
                                       ng-change="onChangeEmail()"
                                       ng-model="email"
                                       ng-class="{'input-red-error': emailError}">

                                <div class="text-danger">{{emailError}}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nationality" class="col-sm-2 control-label">
                                สัญชาติ
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="nationality"
                                       placeholder="ไทย | จีน | อังกฤษ ฯลฯ"
                                       ng-maxlength="64"
                                       ng-model="nationality">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birthdate" class="col-sm-2 control-label">
                                วันเกิด
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="birthdate"
                                       placeholder="ปี/เดือน/วัน"
                                       readonly
                                       ng-model="birthdate">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="personal_no" class="col-sm-2 control-label">
                                 เลขที่บัตรประชาชน
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="personal_no"
                                       placeholder=""
                                       ng-maxlength="13"
                                       ng-model="personalNo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="passport_no" class="col-sm-2 control-label">
                                เลขที่หนังสื่อเดินทาง
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="passport_no"
                                       placeholder=""
                                       ng-maxlength="9"
                                       ng-model="passportNo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gemder" class="col-sm-2 control-label">
                               เพศ
                            </label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" ng-model="gender" value="male">ชาย
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" ng-model="gender" value="female">หญิง
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="marital_status" class="col-sm-2 control-label">
                               สถานะภาพ
                            </label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" id="marital_status" ng-model="maritalStatus" value="single">โสด
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" id="marital_status" ng-model="maritalStatus" value="married">แต่งงาน
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="active" class="col-sm-2 control-label">
                               สถานะ
                            </label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="active" id="active" ng-model="active" value="1">Yes
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="active" id="active" ng-model="active" value="">No
                                </label>
                            </div>
                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="address-tab">

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">
                                ที่อยู่
                            </label>
                            <div class="col-sm-10">
                                <textarea name="address"
                                          id="address"
                                          class="form-control"
                                          cols="30"
                                          rows="4"
                                        maxlength="255"
                                        ng-model="address"></textarea >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="province_id" class="col-sm-2 control-label">
                                จังหวัด
                            </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="province_id" id="province_id" ng-model="provinceId"
                                    ng-change="changeProvince(provinceId);">
                                    <option ng-repeat="P in listProvince" value="{{P.id}}" >
                                        {{P.province}}
                                    </option >
                                </select >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="district_id" class="col-sm-2 control-label">
                                 อำเภอ
                            </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="district_id" id="district_id" ng-model="districtId"
                                        ng-change="changeDistrict(districtId);" ng-disabled="!listDistrict">
                                    <option ng-repeat="D in listDistrict" value="{{D.id}}" >
                                        {{D.district}}
                                    </option >
                                </select >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="area_id" class="col-sm-2 control-label">
                                ตำบล
                            </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="area_id" id="area_id" ng-model="areaId"
                                        ng-change="changeArea(areaId);">
                                    <option ng-repeat="A in listArea" value="{{A.id}}" >
                                        {{A.area}}
                                    </option >
                                </select >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="postal_code" class="col-sm-2 control-label">
                                รหัสไปรษณีย์
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="postal_code" id="postal_code" type="text"
                                       ng-model="postalCode" ng-disabled="true"/>{{PC.postal_code}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="home_phone" class="col-sm-2 control-label">
                                เบอร์โทรศัพท์บ้าน
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="home_phone" id="home_phone" type="phone" maxlength="32" ng-model="homePhone"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="work_phone" class="col-sm-2 control-label">
                                เบอร์โทรที่ทำงาน
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="work_phone" id="work_phone" type="phone" maxlength="32"
                                       ng-model="workPhone"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile_phone" class="col-sm-2 control-label">
                                เบอร์โทรมือถือ
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="mobile_phone" id="mobile_phone" type="phone" maxlength="32"
                                       ng-model="mobilePhone"/>
                            </div>
                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="remark-tab">

                        <div class="form-group">
                            <label for="remark" class="col-sm-2 control-label">
                                หมายเหตุ
                            </label>
                            <div class="col-sm-10">
                                <textarea name="address"
                                          id="address"
                                          class="form-control"
                                          cols="30"
                                          rows="4"
                                          maxlength="255"
                                          ng-model="remark"></textarea >
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
      </div>
      <div class="modal-footer" >
            <button class="btn btn-primary" type="button"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)"
                    ng-disabled="addCustomerForm.$invalid || errorDuplicateNameAndLastname">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>

        <script>
            $(function() {
                var dateToday = new Date();
                var yrRange = (dateToday.getFullYear() -70) + ":" + (dateToday.getFullYear());
                var yearDefault = dateToday.getFullYear();
                $( "#birthdate" ).datepicker({
                    defaultDate: new Date(yearDefault, 01, 01),
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    yearRange: yrRange
                });
            });
        </script>
 </div>
</script>
<!-- end add customer modal -->

<!-- modal dismiss -->
<script type="text/ng-template" id="dismiss_modal.html">
    <div class="modal-header" id="result_modal" >
        <span id="dismiss-title" class="modal-title">{{title}}</span>
        <i class="fa dismiss-icon-modal" ng-class="{'fa-exclamation': !isSaveSuccess, 'alert-danger': !isSaveSuccess, 'alert-success': isSaveSuccess, 'fa-check': isSaveSuccess}"></i>
    </div>
    <div id="dismiss-content" class="modal-body">
        <p class="dismiss-content-modal">
            <strong class="ng-binding" ng-class="{'alert-danger': !isSaveSuccess, 'alert-success': isSaveSuccess}">{{message}}</strong>
        </p>
    </div>
    <div class="modal-footer">
        <button id="dismiss-button" class="btn btn-primary btn-lg btn-block" ng-click="close()">
            ตกลง
        </button>
    </div>
</script>
<!-- end modal dismiss -->

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


<!-- company modal -->
<script type="text/ng-template" id="companyModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw fa-plus"></i> {{title}}
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
              name="addCustomerForm"
              autocomplete="off"
              role="form"
              method="post" >

               <div class="form-group">
                    <label for="home_phone" class="col-sm-3 control-label">
                        ชื่อบริษัท (ภาษาไทย)
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="name_th" id="name_th" ng-model="name_th"/>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="home_phone" class="col-sm-3 control-label">
                        ชื่อบริษัท (ภาษาอังกฤษ)
                    </label>
                    <div class="col-sm-8">
                       <input class="form-control" name="name_en" id="name_en" ng-model="name_en"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_th" class="col-sm-3 control-label">
                        ที่อยู่(ภาษาไทย)
                    </label>
                    <div class="col-sm-8">
                        <textarea name="address_th"
                                  id="address_th"
                                  class="form-control"
                                  cols="30"
                                  rows="4"
                                  ng-model="address_th"></textarea >
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_en" class="col-sm-3 control-label">
                        ที่อยู่(ภาษาอังกฤษ)
                    </label>
                    <div class="col-sm-8">
                        <textarea name="address_en"
                                  id="address_en"
                                  class="form-control"
                                  cols="30"
                                  rows="4"
                                  ng-model="address_en"></textarea >
                    </div>
                </div>
                <div class="form-group">
                    <label for="tel" class="col-sm-3 control-label">
                        เบอร์โทร
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="tel" id="tel" ng-model="tel"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fax" class="col-sm-3 control-label">
                        เบอร์แฟกซ์
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="fax" id="fax" ng-model="fax"/>
                    </div>
                </div>
        </form>
      </div>
      <div class="modal-footer" >
            <button class="btn btn-primary" type="button"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
 </div>
</script>
<!-- end company modal -->

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


<!--- update profile modal -->
<script type="text/ng-template" id="updateProfileModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
            <i class="fa fa-fw fa-plus"></i> แก้ไขข้อมูล
        </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"
          action="#"
          autocomplete="off"
          name="updateProfile"
          novalidate>

        <div class="modal-body">
            <div class="row">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#data_system1" aria-controls="data_system1"
                               role="tab"
                               data-toggle="tab"
                                target="_top">
                                ข้อมูลระบบ
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#emp_profile1" aria-controls="emp_profile1"
                               role="tab"
                               data-toggle="tab"
                                target="_top">
                                ข้อมูลพนักงาน
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#address1" aria-controls="address1" role="tab"
                                                   data-toggle="tab" target="_top">
                                ข้อมูลติดต่อ
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="data_system1">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">ชื่อผู้ใช้</label>
                                <div class="col-xs-9">
                                    <p class="form-control-static"><strong>{{username}}</strong></p>
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    อีเมล์
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="email"
                                           type="emial"
                                           maxlength="255"
                                           placeholder="example_mail@mail.com"
                                           spellcheck="false"
                                           required
                                           ng-model="email">
                                </div>
                            </div>

                        </div><!--end tabl01-->

                        <div role="tabpanel" class="tab-pane" id="emp_profile1">
                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    คำนำหน้าชื่อ
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="initial"
                                           type="text"
                                           maxlength="16"
                                           placeholder="นาย / นาง / นางสาว ฯลฯ"
                                           spellcheck="false"
                                        ng-model="initial">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    <span class="text-danger" >*</span > ชื่อ
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="first_name"
                                           type="text"
                                           maxlength="64"
                                           value="จินตนา"
                                           placeholder=""
                                           spellcheck="false"
                                           required
                                        ng-model="first_name">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    <span class="text-danger" >*</span > นามสกุล
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="last_name"
                                           type="text"
                                           maxlength="64"
                                           value=""
                                           placeholder="นามสกุล"
                                           spellcheck="false"
                                           required
                                           ng-model="last_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active" class="col-sm-3 control-label" >
                                    <span class="text-danger" >*</span > เพศ
                                </label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               id="gender" ng-model="gender" value="female">หญิง
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="gender"
                                               id="gender" ng-model="gender" value="male">ชาย
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active" class="col-sm-3 control-label" >
                                    สถานภาพสมรส
                                </label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status"
                                               id="marital_status" ng-model="marital_status"
                                               value="single">โสด
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status"
                                               id="marital_status" ng-model="marital_status"
                                               value="married">แต่งงาน
                                    </label>
                                </div>
                            </div>

                        </div> <!--end tab emp_profile-->

                        <div role="tabpanel" class="tab-pane" id="address1">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    ที่อยู่
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="address"
                                           type="text"
                                           maxlength="255"
                                           value=""
                                           placeholder=""
                                           spellcheck="false"
                                           ng-model="address">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="province_id" class="col-sm-3 control-label">
                                  จังหวัด
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="province_id" id="province_id"        ng-model="province_id"
                                            ng-change="changeProvince(province_id);">
                                        <option ng-repeat="P in listProvince" value="{{P.id}}" >
                                            {{P.province}}
                                        </option >
                                    </select >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="district_id" class="col-sm-3 control-label">
                                    ตำบล
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="district_id"
                                            id="district_id" ng-model="district_id"
                                            ng-change="changeDistrict(district_id);"
                                            ng-disabled="!listDistrict">
                                        <option ng-repeat="D in listDistrict" value="{{D.id}}" >
                                            {{D.district}}
                                        </option >
                                    </select >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="area_id" class="col-sm-3 control-label">
                                  อำเภอ
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="area_id" id="area_id"
                                            ng-model="area_id"
                                            ng-change="changeArea(area_id);">
                                        <option ng-repeat="A in listArea" value="{{A.id}}" >
                                            {{A.area}}
                                        </option >
                                    </select >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="postal_code" class="col-sm-3 control-label">
                                    รหัสไปรษณีย์
                                </label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="postal_code" id="postal_code"       type="text"
                                           ng-model="postal_code" ng-disabled="true"/>{{PC.postal_code}}
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">โทรศัพท์บ้าน</label>
                                <div class="col-xs-9">

                                        <input class="form-control"
                                               name="home_phone"
                                               type="text"
                                               maxlength="32"
                                               value=""
                                               placeholder=""
                                               spellcheck="false"
                                            autocomplete="off"
                                            ng-model="home_phone">

                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">โทรศัพท์ที่ทำงาน</label>
                                <div class="col-xs-9">

                                        <input class="form-control"
                                               name="work_phone"
                                               type="text"
                                               maxlength="32"
                                               ng-model="work_phone"
                                               placeholder=""
                                               spellcheck="false">

                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">มือถือ</label>
                                <div class="col-xs-9">
                                        <input class="form-control"
                                               name="mobile_phone"
                                               type="text"
                                               maxlength="32"
                                               value=""
                                               placeholder=""
                                               spellcheck="false"
                                               ng-model="mobile_phone"
                                               autocomplete="off">
                                    </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
    </form>
</div>
      </div>
      <div class="modal-footer" >
            <button class="btn btn-primary" type="button"
                    ng-click="ok(<?php echo Yii::app()->user->id;?>)">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
 </div>
</script>

<!--- end update profile modal -->

</body>
</html>
