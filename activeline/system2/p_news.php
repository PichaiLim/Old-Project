<!-- Content -->
<?php $news_show = $lnwphp->table_array('lp_news', "`id` = '" . $idpage . "'");
$pageName = (($_SESSION['lang'] == 'th') ? $news_show->name_page : ($news_show->name_page_eng == "") ? $news_show->name_page : $news_show->name_page_eng);
$pageDetail = (($_SESSION['lang'] == 'th') ? $news_show->detail_page : ($news_show->detail_page_eng == "") ? $news_show->detail_page : $news_show->detail_page_eng);
?>
<div id="programs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <section class="content">
                    <h3 class="page-header">
                        <?php echo $pageName; ?>
                        <!--                        <small>(MaxLoad Pro Truck and Container Loading Software)</small>-->
                    </h3>
                    <?php echo $pageDetail; ?>
                </section>
            </div>

            <!--Article-->
            <div class="col-xs-12 col-md-4">
                <?php require_once 'pmen.php' ?>
            </div>
        </div>
    </div>
</div>