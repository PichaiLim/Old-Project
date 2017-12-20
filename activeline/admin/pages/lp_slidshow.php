<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_slideshow');
    $lnwphp->change_type('show_slide','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
    $lnwphp->change_type('images', 'image');
    $lnwphp->column_name('images', 'Images');
    $lnwphp->label('images','images (1400x300,1400x200)');
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>