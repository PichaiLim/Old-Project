<?php
    $lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_videos');
    $lnwphp->no_editor('keyword');
    $lnwphp->no_editor('description');
    $lnwphp->change_type('image', 'image', '', array('thumbs' => 
    array(
        array(
            'width' => '300',
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)), 
        array(
            'width' => 252,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
        )));
    $lnwphp->change_type('view_total','none');
    $lnwphp->column_name('keyword', 'Keyword');
    $lnwphp->column_name('description', 'Description');
    $lnwphp->label('keyword','Keyword (ไม่จำเป็น)');
    $lnwphp->label('description','Description (ไม่จำเป็น)');
    $lnwphp->columns('name_video,view_total,date_time_post');
    $lnwphp->change_type('show_video','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>