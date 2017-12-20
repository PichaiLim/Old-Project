<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $setting->name_website;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php echo URL;?>component/css/comos.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="<?php echo URL;?>component/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e28580431f64eed" async="async"></script>
	<script src="<?php echo URL;?>component/jquery.bxslider/jquery.bxslider.min.js"></script>
	<link href="<?php echo URL;?>component/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo URL;?>component/css/lnwphp.css">
	<meta name="description" content="<?php echo $setting->description;?>">
	<meta name="keywords" content="<?php echo $setting->keyword;?>">
	<meta name="copyright" content="Copyright © 2015 lnwPHP. all rights reserved.">
	<meta name="author" content="benz@admin.lnwphp.in.th">
	<meta name="generator" content="www.lnwphp.in.th">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo URL;?>image/icon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo URL;?>image/icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL;?>image/icon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL;?>image/icon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL;?>image/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo URL;?>image/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo URL;?>image/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo URL;?>image/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL;?>image/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo URL;?>image/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL;?>image/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo URL;?>image/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL;?>image/icon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo URL;?>image/icon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo URL;?>image/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<base href="<?php echo URL;?>">
	<style type="text/css">body{background-image: url(<?php echo URL;?>/image/<?php echo $setting->background_image;?>); background-size: cover;}</style>
</head>

<body>
	<div id="header" class="header header_bg">
		<a href="<?php echo URL;?>index.html"><img width="90" src="<?php echo URL;?>image/<?php echo $setting->logo_website;?>" class="img-responsive" alt="<?php echo $setting->name_website;?>"></a>
		<div class="pull-right tel hidden-print hidden-xs hidden-sm"><h2 class="teltext"><?php echo $setting->tel;?></h2><?php echo $setting->email;?></div>
	</div>
	<div class="magintop max1600"></div>
	