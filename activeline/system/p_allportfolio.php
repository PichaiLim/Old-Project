<?php
$item_per_page = 8;
$page_url = URL."allportfolio-";
$namepage = '@ผลงานทั้งหมด.html';

if(isset($_GET["id"])){
	$page_number = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');}
}else{
	$page_number = 1;
}

$db = new lnwphp_dbpdo;
$get_total_rows = $db->fetch("SELECT COUNT(*) AS total FROM lp_portfolio");
$total_pages = ceil($get_total_rows->total/$item_per_page);

$page_position = (($page_number-1) * $item_per_page);
?>


<div class="row pageshowmenu">
	
	<div class="col-md-3 hidden-print hidden-xs hidden-sm">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">Page Web</h3>
			</div>
			<div class="panel-body">
				<ul class="nav nav-pills nav-stacked">
					<li role="presentation" class="active"><a href="<?php echo URL;?>index.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Home</a></li>
					<?php
					$page_page = $lnwphp->table_array_all('lp_page',"`show_page` = '0' AND (`position` = '0' OR `position` = '2')",'4');
					for ($i=0; $i < count($page_page); $i++) { 
						echo '<li role="presentation"><a href="'.URL.'page-'.$page_page[$i]['id'].'@'.$lnwphp->re_url($page_page[$i]['name_page']).'.html"><span class="glyphicon glyphicon-menu-hamburger"></span> '.$page_page[$i]['name_page'].'</a></li>';
					}
					?>
					<li role="presentation"><a href="<?php echo URL;?>"><span class="glyphicon glyphicon-menu-hamburger"></span> ติดต่อเรา</a></li>
				</ul>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">Facebook Fanpage</h3>
			</div>
			<div class="panel-body text-center">
				<div class="fb-page" data-href="<?php echo $setting->facebook_url;?>" data-width="100%" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore">lnwPHP Loading...</div></div>
			</div>
		</div>

	</div>

	<div class="col-md-9">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">All tips & details</h3>
			</div>
			<div class="panel-body">
				<?php
				$portfolio_page = $lnwphp->table_array_all('lp_portfolio',"`show_portfolio` = '0'","".$page_position.", ".$item_per_page);
				for ($i=0; $i < count($portfolio_page); $i++) { 
					echo '<div class="col-md-3 col-sm-4 col-xs-6 style_news">
					<div class="product_sale imgrounded">
						<div class="text-center">
							<a class="inner-block" href="'.URL.'protfolio-'.$portfolio_page[$i]['id'].'@'.$lnwphp->re_url($portfolio_page[$i]['name_page']).'.html" title="'.$portfolio_page[$i]['name_page'].'">               
								<img class="img-responsive imgrounded" src="'.URL.'image/thumbs/'.$portfolio_page[$i]['gallery_1'].'">
							</a>
						</div>
						<div class="max42 text-center">
							<strong>'.$portfolio_page[$i]['name_page'].'</strong>
						</div>
						<div class="max73 panding5">'.$lnwphp->lnw_substr($portfolio_page[$i]['detail_page'],0,100).'</div>
						<a class="btn btn-default btn-block" href="'.URL.'protfolio-'.$portfolio_page[$i]['id'].'@'.$lnwphp->re_url($portfolio_page[$i]['name_page']).'.html">ดูรายละเอียด</a>
					</div>
				</div>';
			}

			?>
			<div class=" clearfix"></div>

			<?php

			echo '<div align="center">';
			echo $lnwphp->paginate($item_per_page, $page_number, $get_total_rows->total, $total_pages, $page_url,$namepage);
			echo '</div>';
			?>

		</div>
	</div>

</div>

</div>