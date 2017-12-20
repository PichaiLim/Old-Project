<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_user');
    $lnwphp->change_type('avatar', 'image', '', array('thumbs' => 
    array(
        array(
            'width' => '300',
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)), 
        array(
            'width' => 100,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
        )));
    $lnwphp->change_type('password', 'password');
    $lnwphp->change_type('show_ad','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>