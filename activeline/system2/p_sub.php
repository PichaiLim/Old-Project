<!-- Content -->
<?php
$news_show = $lnwphp->table_array('lp_sub_page', "id = '{$idpage}'");

$arr = array();
foreach ($news_show as $item => $value) {
    $arr[$item] = $value;
}
$subPagName = (($_SESSION['lang'] == 'th') ? $arr['name_page'] : ($arr['name_page_eng'] == "") ? $arr['name_page'] : $arr['name_page_eng']);
$subPageDetail = (($_SESSION['lang'] == 'th') ? $arr['detail_page'] : ($arr['detail_page_eng'] == "") ? $arr['detail_page'] : $arr['detail_page_eng']);
?>

<div id="programs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <section class="content">
                    <h3 class="page-header">
                        <?php echo $subPagName; ?>
                        <!--                        <small>(MaxLoad Pro Truck and Container Loading Software)</small>-->
                    </h3>
                    <?php echo $subPageDetail; ?>
                </section>
            </div>

            <!--Article-->
            <div class="col-xs-12 col-md-4">
                <?php require_once 'pmen.php' ?>
            </div>
        </div>
    </div>
</div>