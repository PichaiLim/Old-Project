<?php
/**
 * Created by PhpStorm.
 * User: pichai
 * Date: 12/19/2016 AD
 * Time: 2:41 PM
 */
$lnwphp = lnwphp::get_instance();
$lnwphp->table('out_activate_license');
echo $lnwphp->render();