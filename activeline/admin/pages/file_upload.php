<?php
/**
 * Created by PhpStorm.
 * User: pichai
 * Date: 12/20/2016 AD
 * Time: 12:31 PM
 */

$lnwphp = lnwphp::get_instance();
$lnwphp->table('file_uploaded');
$lnwphp->no_editor('keyword');
$lnwphp->no_editor('description');
$lnwphp->change_type('gallery_1', 'image', '', array('thumbs' =>
    array(
        array(
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)),
        array(
            'width' => 252,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
    )));
$lnwphp->change_type('gallery_2', 'file', '', array('thumbs' =>
    array(
        array(
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)),
        array(
            'width' => 252,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
    )));
$lnwphp->change_type('gallery_3', 'file', '', array('thumbs' =>
    array(
        array(
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)),
        array(
            'width' => 252,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
    )));
$lnwphp->change_type('gallery_4', 'file', '', array('thumbs' =>
    array(
        array(
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)),
        array(
            'width' => 252,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
    )));
$lnwphp->change_type('gallery_5', 'file', '', array('thumbs' =>
    array(
        array(
            'watermark' => '../image/logo_w.png',
            'watermark_position' => array(99, 99)),
        array(
            'width' => 252,
            'height' => 100,
            'crop' => true,
            'folder' => 'thumbs')
    )));
$lnwphp->change_type('view_total', 'none');
$lnwphp->column_name('keyword', 'Keyword');
$lnwphp->column_name('description', 'Description');
$lnwphp->label('keyword', 'Keyword (ไม่จำเป็น)');
$lnwphp->label('name_page', 'Portfolio Name');
$lnwphp->label('detail_page', 'Portfolio Detail');
$lnwphp->label('description', 'Description (ไม่จำเป็น)');
$lnwphp->columns("gallery_1,file_name,gallery_2,gallery_3,gallery_4,gallery_5,view_total,date_time_post");
$lnwphp->change_type('show_portfolio', 'select', '', array('0' => 'แสดง', '1' => 'ไม่แสดง'));
$lnwphp->benchmark();
echo $lnwphp->render();
?>