<!-- Slide -->
<?php $lnwslide = $lnwphp->table_array_all('lp_slideshow', "`show_slide` = '0'", '10'); ?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        for ($i = 0; $i < count($lnwslide); $i++) {
            if ($i == '0') {
                $ac = 'active';
            } else {
                $ac = '';
            }
            echo '<li data-target="#lnwslide" data-slide-to="0" class="' . $ac . '"></li>';
        }
        ?>
        <!--<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>-->
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
        for ($i = 0; $i < count($lnwslide); $i++) :
            if ($i == '0') {
                $ac = 'active';
            } else {
                $ac = '';
            }

            $img = (string)"http://placehold.it/1900x700";
            if (!empty($lnwslide[$i]['images'])) {
                $img = (string)URL . 'image/' . $lnwslide[$i]['images'].'?v=100';
            }

            $title = "";
            if (!empty($lnwslide[$i]['name'])) {
                $title = (string)(($_SESSION['lang'] == "th") ? $lnwslide[$i]['name'] : ($lnwslide[$i]['name_eng'] == "") ? $lnwslide[$i]['name'] : $lnwslide[$i]['name_eng']);
            }
            ?>
            <div class="item <?php echo $ac; ?>">
                <img width="100%" src="<?php echo $img; ?>"
                     alt="<?php echo $title; ?>"
                     class="img-responsive">
                <div class="carousel-caption">
                    <h1><?php echo $title; ?></h1>
                </div>
            </div>
            <?php
        endfor;
        ?>
        <!--        <div class="item">
                    <img src="http://placehold.it/1900x700" class="img-responsive" alt="img1">
                    <div class="carousel-caption">
                        Image 1
                    </div>
                </div>-->

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="clearfix"></div>