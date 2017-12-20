<div class="row news hidden-print hidden-xs hidden-sm">
	<div class="col-md-8">

		<div class="panel panel-default pantop20">
			<div class="panel-heading font_bold">
				<h3 class="panel-title font_bold">สินค้าของเรา</h3>
			</div>
			<div class="panel-body">
			<?php
			$news = $lnwphp->table_array_all('lp_news',"`show_news` = '0'",'6');
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
			<div class=" clearfix"></div>
			<div class="vinlink">            
				<a href="<?php echo URL.'allnews-1@ข่าวทั่วไป.html';?>" class="toggleopacity label label-default">
					อ่านทั้งหมด »
				</a>
			</div>
		</div>

	</div>
	<div class="col-md-4">

		<div class="alert alert-success alert-successl">
			<form action="<?php echo URL.'contact-ติดต่อ@ติดต่อเรา.html';?>" method="post" class="form-horizontal">
			<h3 class="divtop">ติดต่อเรา</h3>
					<div class="form-group">
						<div class="col-sm-12">
						<input type="text" name="name" class="form-control" placeholder="ชื่อผู้ติดต่อ" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="email" name="email" class="form-control" placeholder="อีเมลผู้ติดต่อ" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" name="subject" class="form-control" placeholder="เรื่องที่จะติดต่อ" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<textarea name="text" class="form-control" placeholder="เขียนข้อความติดต่อ *สำคัญมาก ชื่อ เบอร์ติดต่อ อีเมล" required ></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success">ส่งข้อความถึงเรา</button>
						</div>
					</div>
				</form>
		</div>

	</div>
</div>
