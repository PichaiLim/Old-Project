<?php /* @var $this Controller */?>
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

    <!--[if lt IE 10]>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/media.match.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/placeholder.min.js"></script>
    <![endif]-->


    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">        <!-- Font Awesome -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/styles.css" type="text/css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" rel="stylesheet">


    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jstree/dist/themes/avalon/style.min.css" type="text/css" rel="stylesheet">    <!-- jsTree -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/codeprettifier/prettify.css" type="text/css" rel="stylesheet">                <!-- Code Prettifier -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/skins/minimal/blue.css" type="text/css" rel="stylesheet">              <!-- iCheck -->

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css" type="text/css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" type="text/css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ie8.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
    <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body ng-app="dsam" class="infobar-overlay breadcrumb-top">



    <header id="topnav" class="navbar navbar-primary navbar-fixed-top clearfix" role="banner">

        <div class="yamm navbar-left navbar-collapse collapse in">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/'); ?>"
                       style="min-width: 300px; font-size: 16px;">
                        <strong>
                            <?php if(strtolower($uri) == "site/index" || strtolower($uri) == "employee/index"): ?>
                                <i class="fa fa-fw fa-home"></i>
                                หน้าแรก
                            <?php else: ?>
                                <i class="fa fa-fw fa-code-fork"></i>
                                <?php echo @$_SESSION['branch']; ?>
                            <?php endif; ?>
                        </strong>
                    </a>
                </li>
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
                                <i class="fa fa-fw  fa-bolt"></i>
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
                        <li class="divider active">
                        </li>
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
                    <li class="divider"></li>

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
                        <a ng-href="#/changepassword/<?php echo Yii::app()->user->id; ?>"
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

    <div id="wrapper">
        <div id="layout-static">
            <div class="static-content-wrapper">
                <div class="static-content">
                    <div class="page-content">
                        <ol class="breadcrumb">

                            <li>
                                <a href="<?php echo Yii::app()->createUrl('/'); ?>">หน้าแรก</a>
                            </li>

                        </ol>

                        <div class="page-heading">
                            <h1>&nbsp;</h1>
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <?php echo $content;?>
                            </div>

                        </div> <!-- .container-fluid -->
                    </div> <!-- #page-content -->
                </div>
                <footer role="contentinfo">
                    <div class="clearfix">
                        <ul class="list-unstyled list-inline pull-left">
                            <li><h6 style="margin: 0;"> &copy; 2014 Avalon</h6></li>
                        </ul>
                        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
                    </div>
                </footer>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal modal-fullscreen fade in" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <ng-view>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jqueryui-1.9.2.min.js"></script> 							<!-- Load jQueryUI -->
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

<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular/angular.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-route/angular-route.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-utils-pagination/dirPagination.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/src/modal/modal.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/app.js"></script>
    <!--<script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/ctrBuilding.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serBuilding.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/ctrFloor.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serFloor.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtRoom.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serRoom.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtRoomType.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serRoomType.js"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/ctrCompany.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serCompany.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serCustomer.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtReservation.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtEmployee.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serEmployee.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtBranch.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serBranch.js"></script>


<!-- End loading site level scripts -->

<!-- Load page level scripts-->

<script>
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

<script type="text/ng-template" id="manageBranchModalContent.html">
    <div ng-init="init()">
      <div class="modal-header">
        <h3 class="modal-title">
                {{titleheader}}
            <span class="text text-warning">{{branchName}}</span>
        </h3>
      </div>
        <form class="form-horizontal"
              name="myform"
              id="myform"
              role="form"
              action="#"
              autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a aria-controls="system" role="tab" href="#system" data-toggle="tab" target="_top">
                                        <i class="fa fa-fw fa-info"></i>
                                        ข้อมูลระบบ
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a aria-controls="SEO" role="tab" href="#SEO" data-toggle="tab" target="_top">
                                        SEO
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="system">

                                    <div class="form-group">
                                        <label for="name" class="col-sm-3 control-label">
                                            <i class="text text-danger" >*</i >
                                            ชื่อสาขา
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                   name="name" id="name"   placeholder="ชื่อสาขา"
                                                   required maxlength="64" ng-model="name">
                                            <span class="text text-danger" ng-show="myform.name.$dirty && myform.name.$invalid">
                                            <span ng-show="myform.name.$error.required">กรุณากรอกข้อมูลในช่องว่าง</span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-sm-3 control-label">
                                           ที่อยู่
                                        </label>
                                        <div class="col-sm-9">
                                        <textarea name="address" id="address" class="form-control"
                                                  cols="30" rows="3"
                                                  maxlength="255" placeholder="เลขที่ตั้งอาคาร"
                                                  ng-model="address"></textarea >

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
                                             อำเภอ
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
                                            ตำบล
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

                                    <div class="form-group">
                                        <label for="phone" class="col-sm-3 control-label">
                                            เบอร์โทรศัพท์
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="phone" class="form-control" name="phone" id="phone"
                                                   placeholder="เบอร์โทรศัพท์: 0294857192"
                                                   maxlength="32"
                                                   ng-model="phone">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fax" class="col-sm-3 control-label">
                                            เบอร์โทรสาร
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="phone" class="form-control" name="fax" id="fax"
                                                   placeholder="เบอร์โทรสาร: 0294857192"
                                                   maxlength="32"
                                                   ng-model="fax">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label" >แผนที่</label >
                                        <div class="col-sm-9">
                                            <div class="row" >
                                                <div class="col-sm-6" >
                                                    <input class="form-control" type="number"
                                                           ng-model="latitude"/>
                                                </div >
                                                <div class="col-sm-6" >
                                                    <input class="form-control" type="number"
                                                           ng-model="longitude"/>
                                                </div >
                                            </div >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="active" class="col-sm-3 control-label" >
                                            สถานะ
                                        </label>
                                        <div class="col-sm-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="active" id="active" ng-model="active" value="1">Yes
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" name="active" id="active" ng-model="active" value="">No
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="published" class="col-sm-3 control-label" >
                                            เผยแพร่
                                        </label>
                                        <div class="col-sm-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="published" id="published" ng-model="published" value="1">Yes
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" name="published" id="published" ng-model="published" value="">No
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="SEO">

                                    <div class="form-group">
                                        <lable for="seo_title" class="col-sm-3 control-label" >
                                            Title
                                        </lable >

                                        <div class="col-sm-9">
                                            <input class="form-control"
                                                   name="seo_title"
                                                   data-name="seo_title"
                                                   type="text"
                                                   maxlength="255"
                                                   value=""
                                                   placeholder="หัวข้อหรือหัวเรื่อง"
                                                   spellcheck="false"
                                                   style="display: block;"
                                                   ng-model="seo_title">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <lable for="seo_description" class="col-sm-3 control-label" >
                                            Description
                                        </lable >

                                        <div class="col-sm-9">
                                            <textarea class="form-control"
                                                      name="seo_description"
                                                      data-name="seo_description"
                                                      rows="3"
                                                      placeholder="รายละเอียดหรือคำอธิบาย"
                                                      spellcheck="false"
                                                      style="resize: none; display: block;"
                                                      ng-model="seo_description"></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <lable for="seo_keywords" class="col-sm-3 control-label" >
                                            Keywords
                                        </lable >

                                        <div class="col-sm-9">
                                            <input class="form-control"
                                                   name="seo_keywords"
                                                   id="seo_keywords"
                                                   value=""
                                                   type="text"
                                                   placeholder="คำที่ใช้ในการค้นหา"
                                                   ng-model="seo_keywords"/>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </form >
      <div class="modal-footer" >
            <button class="btn btn-primary" type="button"
                    ng-click="ok(<?php echo Yii::app()->user->id; ?>);"
                    ng-disabled="myform.$invalid">OK</button>
            <button class="btn btn-default" type="button" ng-click="cancel()">Cancel</button>
      </div>
 </div>
</script>


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
