<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_news');
    $lnwphp->no_editor('keyword');
    $lnwphp->no_editor('description');
    $lnwphp->column_name('keyword', 'Keyword');
    $lnwphp->column_name('description', 'Description');
    $lnwphp->label('keyword','Keyword (ไม่จำเป็น)');
    $lnwphp->label('description','Description (ไม่จำเป็น)');
    $lnwphp->columns('name_page,view_total,date_time_post');
    $lnwphp->change_type('image', 'image', '', array('thumbs' => 
    array(
        array(
//            'width' => '300',
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)), 
        array(
            'width' => 118,
            'height' => 96,
            'crop' => true,
            'folder' => 'thumbs')
        )));
    $lnwphp->change_type('show_news','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>