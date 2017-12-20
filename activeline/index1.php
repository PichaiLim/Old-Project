<?php
session_start();


if (empty($_GET["lang"])) {
    $_SESSION["lang"] = "th";

} else {

    if (isset($_GET["lang"]) && ($_GET["lang"] == "en" || $_GET["lang"] == "th")) {
        $_SESSION["lang"] = $_GET["lang"];
    }

    if(isset($_SESSION["lang"]) && isset($_GET["lang"])){
        $_SESSION["lang"] = $_GET["lang"];
    }
}

/**
 * @package lnwPHP-application
*/

	/*
	PRODUCED BY:lnwPHP Thailand (lnwPHP Admin Manager)
	AUTHOR:Benz@lnwphp (https://www.lnwphp.in.th) benzbenz900@gmail.com
	COPYRIGHT 2014 ALL RIGHTS RESERVED

	You must have purchased a valid license from lnwPHP.in.th in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	*/


/**
* @package load Config File
**/
require_once 'config_database.inc.php';
require_once 'lnwphp/lnwphp.php';

/**
* @package load setting database
**/
$lnwphp = lnwphp::get_instance();
$setting = $lnwphp->table_array('lp_setting');

/**
* @package SET URL WEBSITE
**/
define('URL', $setting->url_web);

/**
* @package load system theme
**/
require_once 'system/_header.php';
require_once 'system/_slidshow.php';
require_once 'system/_nvabar.php';



/**
* @package get file in system
**/

if (isset($_GET['id']) AND isset($_GET['page']) AND isset($_GET['name'])) {
	$idpage = $_GET['id'];
	require_once 'system/p_'.$_GET['page'].'.php';
}else{
	require_once 'system/_news.php';
	require_once 'system/_main.php';
}

require_once 'system/_footer.php';