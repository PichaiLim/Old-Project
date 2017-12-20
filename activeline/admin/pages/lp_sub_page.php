<?php
$lnwphp = lnwphp::get_instance();
$lnwphp->table('lp_sub_page');
$lnwphp->no_editor('keyword');
$lnwphp->no_editor('description');
$lnwphp->no_editor('url_link');
$lnwphp->change_type('gallery_1', 'image', '', array('watermark' => '../image/logo_w.png',
    'watermark_position' => array(99, 99)));
$lnwphp->change_type('gallery_2', 'image', '', array('watermark' => '../image/logo_w.png',
    'watermark_position' => array(99, 99)));
$lnwphp->change_type('gallery_3', 'image', '', array('watermark' => '../image/logo_w.png',
    'watermark_position' => array(99, 99)));
$lnwphp->change_type('gallery_4', 'image', '', array('watermark' => '../image/logo_w.png',
    'watermark_position' => array(99, 99)));
$lnwphp->change_type('gallery_5', 'image', '', array('watermark' => '../image/logo_w.png',
    'watermark_position' => array(99, 99)));
$lnwphp->change_type('view_total','none');
$lnwphp->column_name('keyword', 'Keyword');
$lnwphp->column_name('description', 'Description');
$lnwphp->label('keyword','Keyword (ไม่จำเป็น)');
$lnwphp->label('description','Description (ไม่จำเป็น)');
$lnwphp->columns('name_page,main_page_id,view_total,date_time_post');
$lnwphp->change_type('show_page','select','',array('0'=>'แสดง','1'=>'ไม่แสดง'));
$lnwphp->change_type('position','select','',array(
    '0'=>'เมนูเว็บและแถบเมนู',
    '1'=>'แถบเมนู',
    '2'=>'เมนู่เว็บ',
    '3'=>'MUC Thailand',
    '4'=>'ฝ่ายสนับสนุน',
    '5'=>'แผนกบริการลูกค้า'
));
$lnwphp->benchmark();
echo $lnwphp->render();
?>