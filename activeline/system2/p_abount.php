<?php
$abount_show = $lnwphp->table_array_all('lp_page', "`id` = '" . $idpage . "'");
@$nameAboutPage = (($_SESSION['lang'] == "th") ? $abount_show[0]["name_page"] : ($abount_show[0]["name_page_eng"] == "") ? $abount_show[0]["name_page"] : $abount_show[0]["name_page_eng"]);
@$detailAboutPage = (($_SESSION['lang'] == "th") ? $abount_show[0]['detail_page'] : ($abount_show[0]['detail_page_eng'] == "") ? $abount_show[0]["detail_page"] : $abount_show[0]["detail_page_eng"]);
?>
<!-- Content -->
<div id="programs">
    <div class="container content">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header"><?php echo $nameAboutPage; ?></h3>
                <?php echo $detailAboutPage; ?>
            </div>
        </div>
    </div>
</div>