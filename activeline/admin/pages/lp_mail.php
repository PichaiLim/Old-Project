<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_mail');
//    $lnwphp->unset_add();
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>