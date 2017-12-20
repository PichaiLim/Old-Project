<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_event');
    $lnwphp->change_type('show_event','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
    $lnwphp->change_type('images', 'image', '', array('thumbs' => 
    array(
        array(
            'width' => '300',
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)), 
        array(
            'width' => 260,
            'height' => 260,
            'crop' => true,
            'folder' => 'thumbs')
        )));
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>