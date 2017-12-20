<div class="row pageshowmenu">
	
	<div class="col-md-3 hidden-print hidden-xs hidden-sm">

		<?php include 'pmenu.php';?>

	</div>

	<div class="col-md-9">
		<?php $news_show = $lnwphp->table_array('lp_news',"`id` = '".$idpage."'");?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold"><?php echo $news_show->name_page;?></h3>
			</div>
			<div class="panel-body">
				<?php if ($news_show->image != '') {
					echo '<div class="text-center">
					<img class="img-responsive inner-block" src="'.URL.'image/'.$news_show->image.'?>">
				</div>';
			}
			?><h1><?php echo $news_show->name_page;?></h1>
			<div class="addthis_sharing_toolbox"></div>
			<?php echo $news_show->detail_page;?>
			<div class="addthis_sharing_toolbox"></div>
			<hr>
			<div class="panel panel-default">
				<div class=" panel-heading font_bold">
					<h3 class="panel-title font_bold">ข่าวสารทั่วไป</h3>
				</div>
				<div class="panel-body">
					<?php
					$news = $lnwphp->table_array_all('lp_news',"`show_news` = '0' ORDER BY RAND()",'4');
					for ($i=0; $i < count($news); $i++) {
						echo '<div class="col-md-6 col-sm-6 text-left style_news">
						<a href="'.URL.'news-'.$news[$i]['id'].'@'.$lnwphp->re_url($news[$i]['name_page']).'.html">
							<div class=" inner">
								<div class="col-md-3 col-sm-3 col-xs-3 no_padding">
									<img src="'.URL.'image/thumbs/'.$news[$i]['image'].'" class="img-responsive">
								</div>
								<div class="col-md-9 col-sm-9 col-xs-9 p5 no_padding">
									<p class="font_bold">'.$news[$i]['name_page'].'</p>
									'.$lnwphp->lnw_substr($news[$i]['detail_page'],0,100).'
								</div>
								<div class="clear"></div>
							</div>
						</a>
					</div>';
				}
				?>
				
			</div>
		</div>

		<hr>
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			var disqus_shortname = 'lnwphphostingvipvps';
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
	</div>
</div>

</div>

</div>