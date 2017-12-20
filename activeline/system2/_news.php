<div id="programs">
    <div class="container">
        <div class="row">
            <?php
            $news = $lnwphp->table_array_all('lp_news', "`show_news` = '0'", '6');

            for ($i = 0; $i < count($news); $i++):
                $urlNews = URL . 'news-' . $news[$i]['id'] . '@' . $lnwphp->re_url($news[$i]['name_page']) . '.html';
                $imgNews = URL . 'image/' . $news[$i]['image'];
                $headerName = (($_SESSION['lang'] == "th") ? $news[$i]['name_page'] : ($news[$i]['name_page_eng'] == "") ? $news[$i]['name_page'] : $news[$i]['name_page_eng']);
                $detailPageName = (($_SESSION['lang'] == "th") ? $news[$i]['detail_page'] : ($news[$i]['detail_page_eng'] == "") ? $news[$i]['detail_page'] : $news[$i]['detail_page_eng']);
                ?>
                <div class="clearfix">
                    <div class="col-xs-12 col-md-4 text-center">
                        <a href="<?php echo $urlNews; ?>">
                            <img class="img-responsive img-shadow" src="<?php echo $imgNews.'?v=100'; ?>" alt="...">
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <h3 class="page-header page-header-clear-padding-top"><?php echo $headerName; ?></h3>
                        <?php echo $detailPageName; ?>
                        <p class="pull-right">
                            <a href="<?php echo $urlNews; ?>" class="btn btn-danger">
                                <?php echo $headerName; ?>
                                <i class="glyphicon glyphicon-circle-arrow-right"></i>
                            </a>
                        </p>
                    </div>
                </div>

                <hr>
            <?php endfor; ?>

        </div>
    </div>
</div>