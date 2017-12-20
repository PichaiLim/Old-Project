</div>
<div class="container-fluid sitemap_bg">
	<div class="row text-left">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<h4>Activeline</h4>
			<ul>
			<?php
			$pagea = $lnwphp->table_array_all('lp_page',"`show_page` = '0' AND `position` = '3' ORDER BY `id` DESC",'6');
					for ($i=0; $i < count($pagea); $i++) {
						if ($pagea[$i]['url_link'] == '') {
						$pagea[$i]['url_link'] = URL.'page-'.$pagea[$i]['id'].'@'.$lnwphp->re_url($pagea[$i]['name_page']).'.html';
					}
						echo '<li><a href="'.$pagea[$i]['url_link'].'">'.$pagea[$i]['name_page'].'</a></li>';
					}
			?>
			</ul>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<h4><!--ฝ่ายสนับสนุน--></h4>
			<ul>
			<?php
			$pageb = $lnwphp->table_array_all('lp_page',"`show_page` = '0' AND `position` = '4' ORDER BY `id` DESC",'6');
					for ($i=0; $i < count($pageb); $i++) {
						if ($pageb[$i]['url_link'] == '') {
						$pageb[$i]['url_link'] = URL.'page-'.$pageb[$i]['id'].'@'.$lnwphp->re_url($pageb[$i]['name_page']).'.html';
					}
						echo '<li><a href="'.$pageb[$i]['url_link'].'">'.$pageb[$i]['name_page'].'</a></li>';
					}
			?>
			</ul>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<h4><!--แผนกบริการลูกค้า--></h4>
			<ul>
			<?php
			$pagec = $lnwphp->table_array_all('lp_page',"`show_page` = '0' AND `position` = '5' ORDER BY `id` DESC",'6');
					for ($i=0; $i < count($pagec); $i++) {
						if ($pagec[$i]['url_link'] == '') {
						$pagec[$i]['url_link'] = URL.'page-'.$pagec[$i]['id'].'@'.$lnwphp->re_url($pagec[$i]['name_page']).'.html';
					}
						echo '<li><a href="'.$pagec[$i]['url_link'].'">'.$pagec[$i]['name_page'].'</a></li>';
					}
			?>
			</ul>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<h4>ติดต่อสอบถาม</h4>
			<p><?php echo $setting->address_1.'<br>'.$setting->address_2.'<br>Tel: '.$setting->tel.'<br>Email: '.$setting->email;?></p>
			</div>
		</div>
	</div>

	<div class="container-fluid footer_bg">
		<p>Copyright©2016 P-Soft.asia All rights reserved</p>
		<p><?php echo $setting->address_1.' '.$setting->address_2;?></p>
			<p><?php echo $setting->code_stat;?></p>
			<div class="pull-right dbdlogo hidden-print hidden-xs hidden-sm"><?php echo $setting->dbd_code;?></div>
		</div>


			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=994550257273455";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		
		<script>
			var mywindow = $(window);
			var mypos = mywindow.scrollTop();
			var up = false;
			var newscroll;
			mywindow.scroll(function () {
				newscroll = mywindow.scrollTop();
				if (newscroll > mypos && !up) {
					$('.header').stop().slideToggle();
					up = !up;
					console.log(up);
				} else if(newscroll < mypos && up) {
					$('.header').stop().slideToggle();
					up = !up;
				}
				mypos = newscroll;
			});
		</script>
	</body>
	</html>