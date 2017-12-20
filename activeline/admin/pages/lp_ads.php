<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_ads');
    $lnwphp->no_editor('link_url');
    $lnwphp->no_editor('detail');
    $lnwphp->change_type('image', 'image', '', array('thumbs' => 
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
    $lnwphp->change_type('view_total','none');
    $lnwphp->column_name('keyword', 'Keyword');
    $lnwphp->column_name('description', 'Description');
    $lnwphp->label('keyword','Keyword (ไม่จำเป็น)');
    $lnwphp->label('description','Description (ไม่จำเป็น)');
    $lnwphp->change_type('show_ad','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
    $lnwphp->change_type('position','select','',array('0'=>'รับทำโปรเจคอิเล็กทรอนิกส์ต่างๆ','1'=>'รับงานด้านแมกคานิค','2'=>'รับจัดทำงาน Even ต่างๆ'));
    $lnwphp->benchmark();
    echo $lnwphp->render();
?>