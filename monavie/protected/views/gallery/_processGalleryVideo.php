<div class="span6">
    <div class="thumbnail">
        <img data-src="holder.js/300x200" src="<?php echo $data->image; ?>" alt="">
        <div class="caption">
            <h4><?php echo $data->name; ?></h4>
            <p style="word-break: break-all;">
                <?php echo $data->content; ?>
            </p>
            <p class="text-right">
                <a href="
                   <?php echo Yii::app()->createAbsoluteUrl('//Gallery/VideoView', array('id' => $data->id)); ?>
                   " 
                   class="btn btn-primary">
                    <i class="icon-picture icon-white"></i> 
                    View Video
                </a>
            </p>
        </div>
    </div>
</div>
