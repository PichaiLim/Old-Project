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



    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" type="text/css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap-select/dist/css/bootstrap-select.css" type="text/css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.11.4.custom/jquery-ui.min.css" type="text/css"
          rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.11.4.custom/jquery-ui.theme.css" type="text/css"
          rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css" type="text/css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/angular-ui-bootstrap/src/datepicker/datepicker.css" type="text/css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ie8.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
    <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker-left" ).datepicker({
                inline: true,
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body ng-app="dsam"
      ng-controller="ReservationController as r"
      class="infobar-overlay breadcrumb-top"
      data-branch-id="<?=$_GET['id'];?>">



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
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('/'); ?>">
                                <i class="fa fa-fw fa-briefcase"></i>
                                ข้อมูลการบริษัท
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
                    <!--<li>
                       <a href="#mail">
                           <i class="fa fa-fw fa-send"></i>
                           จดหมาย
                           <span class="pull-right text text-right">
                               <strong class="">[99]</strong>
                           </span>
                       </a>
                   </li>-->

                    <li class="<?= (Yii::app()->user->role == 1)? "":"hidden"; ?>">
                        <a href="<?= Yii::app()->createUrl('employee/index', array('id'=>Yii::app()->user->id)); ?>">
                            <i class="fa fa-fw fa-plus-square"></i>
                            เพิ่มผู้ใช้ในระบบ
                        </a>
                    </li>
                    <li>
                        <a ng-href="#/employee/updateprofile/<?php echo Yii::app()->user->id;?>"
                           data-toggle="modal"
                           data-target="#profile">
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



    <div id="wrapper" style="height: 705px;">
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

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

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


    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/app.js"></script>
    <!--<script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtBranch.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serBranch.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/ctrBuilding.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serBuilding.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/ctrFloor.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serFloor.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtRoom.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serRoom.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtRoomType.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serRoomType.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtEmployee.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serEmployee.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtEmployeeType.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serEmployeeType.js"></script>

    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtCustomer.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serCustomer.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/crtProduct.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serProduct.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/controller/ctrInventory.js"></script>
    <script src="<?php /*echo Yii::app()->request->baseUrl; */?>/js/angularjs/service/serInventory.js"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/controller/crtReservation.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/angularjs/service/serReservation.js"></script>


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



</body>
</html>
