<div class="row pageshowmenu2">
	
	<div class="col-md-3 hidden-print hidden-xs hidden-sm">

		<?php include 'pmenu.php';?>

	</div>

	<div class="col-md-9">
		<?php $news_show = $lnwphp->table_array('lp_videos',"`id` = '".$idpage."'");?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold"><?php echo $news_show->name_video;?></h3>
			</div>
			<div class="panel-body">
				<div class="text-center">
					<img class="img-responsive inner-block" src="<?php echo $lnwphp->get_youtube_thumb($news_show->youtube_link);?>">
				</div>
				<h1><?php echo $news_show->name_video;?></h1>
				<div class="addthis_sharing_toolbox"></div>
				<?php echo $news_show->detail_video;?>
				<hr>
				<?php echo $lnwphp->playyoutube($news_show->youtube_link);?>
				<div class="text-center"><h3><?php echo $news_show->name_video;?></h3></div>
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