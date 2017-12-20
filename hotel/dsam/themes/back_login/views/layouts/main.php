<?php /* @var $this Controller */ ?>
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

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/styles.css" type="text/css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/skins/minimal/blue.css" type="text/css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
    <link href="assets/css/ie8.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="focused-form" cz-shortcut-listen="true">
<?php echo $content; ?>



<!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jqueryui-1.9.2.min.js"></script> 							<!-- Load jQueryUI -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/sparklines/jquery.sparklines.min.js"></script>  		<!-- Sparkline -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jstree/dist/jstree.min.js"></script>  				<!-- jsTree -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/enquire.min.js"></script> 									<!-- Enquire for Responsiveness -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/bootbox/bootbox.js"></script>							<!-- Bootbox -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/simpleWeather/jquery.simpleWeather.min.js"></script> <!-- Weather plugin-->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/application.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/demo/demo.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/demo/demo-switcher.js"></script>


<!-- End loading site level scripts -->
<!-- Load page level scripts-->


<!-- End loading page level scripts-->

</body>

</html>
