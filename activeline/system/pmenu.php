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

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">รับทำโปรเจคอิเล็กทรอนิกส์ต่างๆ</h3>
			</div>
			<div class="panel-body">

			<?php
					$project_a = $lnwphp->table_array_all('lp_ads',"`show_ad` = '0' AND `position` = '0' ORDER BY `id` DESC",'3');
					for ($i=0; $i < count($project_a); $i++) {
						echo '<div class="col-md-12 text-left style_news">
					<a href="'.$project_a[$i]['link_url'].'">
						<div class=" inner">
							<div class="col-md-3 col-sm-3 col-xs-3 no_padding">
								<img src="'.URL.'image/thumbs/'.$project_a[$i]['image'].'" class="img-responsive">
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
								'.$lnwphp->lnw_substr($project_a[$i]['detail'],0,85).'
							</div>
							<div class="clear"></div>
						</div>
					</a>
				</div>';
					}
					?>

			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">รับงานด้านแมกคานิค</h3>
			</div>
			<div class="panel-body">

				<?php
				$project_b = $lnwphp->table_array_all('lp_ads',"`show_ad` = '0' AND `position` = '1' ORDER BY `id` DESC",'4');
					for ($i=0; $i < count($project_b); $i++) {
						echo '<div class="col-md-12 text-left style_news">
					<a href="'.$project_b[$i]['link_url'].'">
						<div class=" inner">
							<div class="col-md-3 col-sm-3 col-xs-3 no_padding">
								<img src="'.URL.'image/thumbs/'.$project_b[$i]['image'].'" class="img-responsive">
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
								'.$lnwphp->lnw_substr($project_b[$i]['detail'],0,85).'
							</div>
							<div class="clear"></div>
						</div>
					</a>
				</div>';
					}
				?>

			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">รับจัดทำงาน Even ต่างๆ</h3>
			</div>
			<div class="panel-body">

				<?php
				$project_c = $lnwphp->table_array_all('lp_ads',"`show_ad` = '0' AND `position` = '2' ORDER BY `id` DESC",'4');
					for ($i=0; $i < count($project_c); $i++) {
						echo '<div class="col-md-12 text-left style_news">
					<a href="'.$project_c[$i]['link_url'].'">
						<div class=" inner">
							<div class="col-md-3 col-sm-3 col-xs-3 no_padding">
								<img src="'.URL.'image/thumbs/'.$project_c[$i]['image'].'" class="img-responsive">
							</div>
							<div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
								'.$lnwphp->lnw_substr($project_c[$i]['detail'],0,85).'
							</div>
							<div class="clear"></div>
						</div>
					</a>
				</div>';
					}
				?>

			</div>
		</div>