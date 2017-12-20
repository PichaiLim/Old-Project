<nav class="navbar navbar-default max1600">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Activeline</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo URL;?>index.html">Activeline</a>
			</div>
<?php $navbar = $lnwphp->table_array_all('lp_page',"`show_page` = '0' AND (`position` = '0' OR `position` = '1')",'10');?>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav ">
				<?php
				for ($i=0; $i < count($navbar); $i++) {
					if ($navbar[$i]['url_link'] == '') {
						$navbar[$i]['url_link'] = URL.'page-'.$navbar[$i]['id'].'@'.$lnwphp->re_url($navbar[$i]['name_page']).'.html';
					}

					echo '<li><a href="'.$navbar[$i]['url_link'].'">'.$navbar[$i]['name_page'].'</a></li>';
				}
				?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo URL;?>contact-ติดต่อ@ติดต่อเรา.html">ติดต่อเรา</a></li>
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</li> -->
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">