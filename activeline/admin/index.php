<?php
ob_start();
session_start();
require ('../lnwphp/lnwphp.php');
require ('html/pagedata.php');

$lnwphp = lnwphp::get_instance();
$title_2 = 'lnwPHP.in.th';

$page = (isset($_GET['page']) && isset($pagedata[$_GET['page']])) ? $_GET['page'] : 'default';
extract($pagedata[$page]);

$file = dirname(__file__) . '/pages/' . $filename;
$code = file_get_contents($file);

include ('html/template.php');
?>