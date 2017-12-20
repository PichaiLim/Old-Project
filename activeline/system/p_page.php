<div class="row pageshowmenu2">

	<div class="col-md-9">
		<?php $news_show = $lnwphp->table_array('lp_page',"`id` = '".$idpage."'");?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold"><?php echo $news_show->name_page;?></h3>
			</div>
			<div class="panel-body">
			<?php if ($news_show->gallery_1 != '') {
						echo '<div class="text-center">
				<img class="img-responsive inner-block" src="'.URL.'image/'.$news_show->gallery_1.'?>">
				</div>';
					}
					?>
				<h1><?php echo $news_show->name_page;?></h1>
				<div class="addthis_sharing_toolbox"></div>
				<?php echo $news_show->detail_page;?>
				<hr>
				<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
				<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
				<div class="fotorama" data-allowfullscreen="true" data-loop="true" data-autoplay="true" data-transition="slide" data-clicktransition="crossfade" data-nav="thumbs" data-width="100%" data-height="200">
					<?php if ($news_show->gallery_1 != '') {
						echo '<a href="'.URL.'image/'.$news_show->gallery_1.'"><img src="'.URL.'image/thumbs/'.$news_show->gallery_1.'"></a>';
					}
					if ($news_show->gallery_2 != '') {
						echo '<a href="'.URL.'image/'.$news_show->gallery_2.'"><img src="'.URL.'image/thumbs/'.$news_show->gallery_2.'"></a>';
					}
					if ($news_show->gallery_3 != '') {
						echo '<a href="'.URL.'image/'.$news_show->gallery_3.'"><img src="'.URL.'image/thumbs/'.$news_show->gallery_3.'"></a>';
					}
					if ($news_show->gallery_4 != '') {
						echo '<a href="'.URL.'image/'.$news_show->gallery_4.'"><img src="'.URL.'image/thumbs/'.$news_show->gallery_4.'"></a>';
					}
					if ($news_show->gallery_5 != '') {
						echo '<a href="'.URL.'image/'.$news_show->gallery_5.'"><img src="'.URL.'image/thumbs/'.$news_show->gallery_5.'"></a>';
					}
					?>
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

	<div class="col-md-3 hidden-print hidden-xs hidden-sm">

		<?php include 'pmenu.php';?>

	</div>

</div>