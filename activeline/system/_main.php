<div class="row portfolio">
    <div class="col-md-3 hidden-print hidden-xs hidden-sm">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">Page Web</h3>
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="<?php echo URL; ?>index.html"><span
                                    class="glyphicon glyphicon-menu-hamburger"></span> Home</a></li>
                    <?php
                    $page_page = $lnwphp->table_array_all('lp_page', "`show_page` = '0' AND (`position` = '0' OR `position` = '2')", '4');
                    for ($i = 0; $i < count($page_page); $i++) {
                        if ($page_page[$i]['url_link'] == '') {
                            $page_page[$i]['url_link'] = URL . 'page-' . $page_page[$i]['id'] . '@' . $lnwphp->re_url($page_page[$i]['name_page']) . '.html';
                        }
                        echo '<li role="presentation"><a href="' . $page_page[$i]['url_link'] . '"><span class="glyphicon glyphicon-menu-hamburger"></span> ' . $page_page[$i]['name_page'] . '</a></li>';
                    }
                    ?>
                    <li role="presentation"><a
                                href="<?php echo URL; ?>contact-%E0%B8%95%E0%B8%B4%E0%B8%94%E0%B8%95%E0%B9%88%E0%B8%AD@%E0%B8%95%E0%B8%B4%E0%B8%94%E0%B8%95%E0%B9%88%E0%B8%AD%E0%B9%80%E0%B8%A3%E0%B8%B2.html"><span
                                    class="glyphicon glyphicon-menu-hamburger"></span> ติดต่อเรา</a></li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default max269">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">Facebook Fanpage</h3>
            </div>
            <div class="panel-body text-center">
                <div class="fb-page" data-href="<?php echo $setting->facebook_url; ?>" data-tabs="timeline"
                     data-width="288" data-height="200" data-small-header="false" data-adapt-container-width="true"
                     data-hide-cover="false" data-show-facepile="true"></div>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">Topic</h3>
            </div>
            <div class="panel-body">

                <?php
                $portfolio_page = $lnwphp->table_array_all('lp_portfolio', "`show_portfolio` = '0'", '8');
                for ($i = 0; $i < count($portfolio_page); $i++) {
                    echo '<div class="col-md-3 col-sm-4 col-xs-6 style_news" style="min-height: 285px;">
					<div class="product_sale imgrounded">
						<div class="text-center">
							<a class="inner-block" href="' . URL . 'protfolio-' . $portfolio_page[$i]['id'] . '@' . $lnwphp->re_url($portfolio_page[$i]['name_page']) . '.html" title="' . $portfolio_page[$i]['name_page'] . '">               
								<img class="img-responsive imgrounded" src="' . URL . 'image/thumbs/' . $portfolio_page[$i]['gallery_1'] . '">
							</a>
						</div>
						<div class="max42 text-center">
							<strong>' . $portfolio_page[$i]['name_page'] . '</strong>
						</div>
						<div class="max73 panding5">' . $lnwphp->lnw_substr($portfolio_page[$i]['detail_page'], 0, 100) . '</div>
						<a class="btn btn-default btn-block" href="' . URL . 'protfolio-' . $portfolio_page[$i]['id'] . '@' . $lnwphp->re_url($portfolio_page[$i]['name_page']) . '.html">ดูรายละเอียด</a>
					</div>
				</div>';
                }
                ?>


                <div class=" clearfix"></div>
                <div class="vinlink">
                    <a href="<?php echo URL . 'allportfolio-1@ผลงานทั้งหมด.html'; ?>"
                       class="toggleopacity label label-default">
                        อ่านทั้งหมด »
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row event">
    <div class="col-md-12">

        <script type="text/javascript">
            $(document).ready(function () {
                $('.slider1').bxSlider({
                    slideWidth: 5000,
                    minSlides: 4,
                    maxSlides: 4,
                    slideMargin: 5
                });
            });
        </script>


        <link rel="stylesheet" href="<?php echo URL; ?>component/css/ekko-lightbox.min.css" type="text/css"/>
        <script type="text/javascript" src="<?php echo URL; ?>component/js/ekko-lightbox.min.js"></script>

        <script type="text/javascript">
            $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        </script>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">รวมรูปการทำงานของโปรแกรม<!--รวมรูปผลงาน Even ที่ได้เคยทำมา--></h3>
            </div>
            <div class="panel-body">

                <div class="slider1">
                    <?php
                    $slide_event = $lnwphp->table_array_all('lp_event', "`show_event` = '0'", '12');
                    for ($i = 0; $i < count($slide_event); $i++) {
                        echo '<div class="slide">
						<a data-toggle="lightbox" data-gallery="multiimages" data-title="' . $slide_event[$i]['name'] . '" href="' . URL . 'image/' . $slide_event[$i]['images'] . '" title="' . $slide_event[$i]['name'] . '">
						<img src="' . URL . 'image/thumbs/' . $slide_event[$i]['images'] . '">
						</a>
						</div>';
                    }
                    ?>
                </div>


                <div class=" clearfix"></div>
                <div class="vinlink">
                    <a href="<?php echo URL . 'allevent-1@รูปผลงานทั้งหมด.html'; ?>"
                       class="toggleopacity label label-default">
                        อ่านทั้งหมด »
                    </a>
                </div>
            </div>
        </div>

    </div>
    <!--<div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">รับทำโปรเจคอิเล็กทรอนิกส์ต่างๆ</h3>
            </div>
            <div class="panel-body">

                <?php
    /*                $project_a = $lnwphp->table_array_all('customers', "ORDER BY `idCustomer` DESC", '4');

                    /*for ($i = 0; $i < count($project_a); $i++) {
                        echo '<div class="col-md-12 text-left style_news">
                        <a href="' . $project_a[$i]['link_url'] . '">
                            <div class=" inner">
                                <div class="col-md-3 col-sm-3 col-xs-3 no_padding">
                                    <img src="' . URL . 'image/thumbs/' . $project_a[$i]['image'] . '" class="img-responsive">
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
                                    ' . $lnwphp->lnw_substr($project_a[$i]['detail'], 0, 85) . '
                                </div>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </div>';
                    }*/
    ?>

            </div>
        </div>

    </div>-->
</div>


<div class="row video">
    <div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">Download Program</h3>
            </div>
            <div class="panel-body">

                <?php
                $project_b = $lnwphp->table_array_all('file_uploaded', "`show_portfolio` = '0' ORDER BY `id` DESC", '4');

                for ($i = 0; $i < count($project_b); $i++) {
                    echo '  <div class="col-md-12 text-left style_new" style="margin-bottom: 1em;">
                                <a href="image/' . $project_b[$i]['gallery_2'] . ' " target="_new" download="' . $project_b[$i]['gallery_2'] . '">
                                    <div class=" inner">
                                        <div class="col-md-3 col-sm-3 col-xs-3 no_padding">
                                            <img src="' . URL . 'image/thumbs/' . $project_b[$i]['gallery_1'] . '" class="img-responsive">
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
                                        ' . $lnwphp->lnw_substr($project_b[$i]['file_name'], 0, 85) . '
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </a>
                            </div>';
                }

                ?>
                <?php
                /* $project_b = $lnwphp->table_array_all('lp_ads', "`show_ad` = '0' AND `position` = '1' ORDER BY `id` DESC", '4');
                 for ($i = 0; $i < count($project_b); $i++) {
                     echo '<div class="col-md-12 text-left style_news">
                     <a href="' . $project_b[$i]['link_url'] . '">
                         <div class=" inner">
                             <div class="col-md-3 col-sm-3 col-xs-3 no_padding">
                                 <img src="' . URL . 'image/thumbs/' . $project_b[$i]['image'] . '" class="img-responsive">
                             </div>
                             <div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
                                 ' . $lnwphp->lnw_substr($project_b[$i]['detail'], 0, 85) . '
                             </div>
                             <div class="clear"></div>
                         </div>
                     </a>
                 </div>';
                 }*/
                ?>

            </div>
        </div>


        <!--<div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">รับจัดทำงาน Even ต่างๆ</h3>
            </div>
            <div class="panel-body">

                <?php
        /*                $project_c = $lnwphp->table_array_all('lp_ads', "`show_ad` = '0' AND `position` = '2' ORDER BY `id` DESC", '4');
                        for ($i = 0; $i < count($project_c); $i++) {
                            echo '<div class="col-md-12 text-left style_news">
                            <a href="' . $project_c[$i]['link_url'] . '">
                                <div class=" inner">
                                    <div class="col-md-3 col-sm-3 col-xs-3 no_padding">
                                        <img src="' . URL . 'image/thumbs/' . $project_c[$i]['image'] . '" class="img-responsive">
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
                                        ' . $lnwphp->lnw_substr($project_c[$i]['detail'], 0, 85) . '
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </a>
                        </div>';
                        }
                        */ ?>

            </div>
        </div>-->

    </div>

    <div class="col-md-9">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title font_bold">รวมวีดีโอ</h3>
            </div>
            <div class="panel-body">

                <?php
                $video_page = $lnwphp->table_array_all('lp_videos', "`show_video` = '0'", '8');
                for ($i = 0; $i < count($video_page); $i++) {
                    echo '<div class="col-md-3 col-sm-4 col-xs-6 style_news" style="min-height: 285px;">
					<div class="product_sale imgrounded">
						<div class="text-center">
							<a class="inner-block" href="' . URL . 'videos-' . $video_page[$i]['id'] . '@' . $lnwphp->re_url($video_page[$i]['name_video']) . '.html" title="' . $video_page[$i]['name_video'] . '">               
								<img class="img-responsive imgrounded" src="' . $lnwphp->get_youtube_thumb($video_page[$i]['youtube_link']) . '">
							</a>
						</div>
						<div class="max42 text-center">
							<strong>' . $video_page[$i]['name_video'] . '</strong>
							<strong>' . $video_page[$i]['name_video'] . '</strong>
						</div>
						<div class="max73 panding5">' . $lnwphp->lnw_substr($video_page[$i]['detail_video'], 0, 100) . '</div>
						<a class="btn btn-default btn-block" href="' . URL . 'videos-' . $video_page[$i]['id'] . '@' . $lnwphp->re_url($video_page[$i]['name_video']) . '.html">ดูวิดีโอ</a>
					</div>
				</div>';
                }
                ?>

                <div class=" clearfix"></div>
                <div class="vinlink">
                    <a href="<?php echo URL . 'allvideos-1@วิดีโอทั้งหมด.html'; ?>"
                       class="toggleopacity label label-default">
                        อ่านทั้งหมด »
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>
