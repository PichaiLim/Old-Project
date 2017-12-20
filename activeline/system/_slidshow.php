<?php $lnwslide = $lnwphp->table_array_all('lp_slideshow', "`show_slide` = '0'", '10'); ?>
<div id="lnwslide" class="carousel slide hidden-print hidden-xs hidden-sm max1600" data-ride="carousel">

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
    </ol>

    <div class="carousel-inner" role="listbox">
        <?php
        for ($i = 0; $i < count($lnwslide); $i++) {
            if ($i == '0') {
                $ac = 'active';
            } else {
                $ac = '';
            }
            echo '<div class="item ' . $ac . '">
			<img width="100%" src="' . URL . 'image/' . $lnwslide[$i]['images'] . '" alt="' . $lnwslide[$i]['name'] . '">
			<div class="carousel-caption">
				<h1>' . $lnwslide[$i]['name'] . '</h1>
			</div>
		</div>';
        }
        ?>
    </div>

    <a class="left carousel-control" href="#lnwslide" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#lnwslide" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div>&nbsp;</div>