<?php
/**
 * Created by PhpStorm.
 * User: pichai
 * Date: 12/19/2016 AD
 * Time: 2:09 PM
 */
$lnwphp = lnwphp::get_instance();
$lnwphp->table('customers');

echo $lnwphp->render();