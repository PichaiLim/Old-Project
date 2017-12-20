<?php
	$lnwphp = lnwphp::get_instance();
    $lnwphp->table('lp_setting');
    $lnwphp->no_editor('keyword');
    $lnwphp->no_editor('description');
    $lnwphp->no_editor('facebook_url');
    $lnwphp->no_editor('code_stat');
    $lnwphp->no_editor('dbd_code');
    $lnwphp->change_type('map_to_mcu', 'point');
    $lnwphp->change_type('logo_website', 'image');
    $lnwphp->change_type('background_image', 'image');
    $lnwphp->unset_add();
    $lnwphp->unset_remove();
    $lnwphp->unset_view();
    $lnwphp->unset_csv();
    $lnwphp->unset_limitlist();
    $lnwphp->unset_numbers();
    $lnwphp->unset_pagination();
    $lnwphp->unset_print();
    $lnwphp->unset_search();
    $lnwphp->unset_title();
    $lnwphp->unset_sortable();
    $lnwphp->hide_button('save_return,return,save_new');
    $lnwphp->set_lang('save_edit','บันทึก');
    $lnwphp->change_type('cache','select','',array('0'=>'ปิด','1'=>'เปิด'));
    $lnwphp->benchmark();
    echo $lnwphp->render('edit',1);
?>