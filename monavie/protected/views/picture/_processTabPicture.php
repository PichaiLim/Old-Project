<div class="span12" style="margin-left: 0px; padding-bottom: 10px;">
    <div class="span4 thumbnail">
        <img src="<?php echo $data->image; ?>" alt="<?php echo $data->name; ?>" class="img-rounded"/>
    </div>
    <div class="span8">

        <h4 class="text-info" style="border-bottom: 1px inset grey;">
            <?php echo mb_substr($data->name, 0, 50, 'utf-8'); ?>
        </h4>

        <kbd><?php echo mb_substr($data->content, 0, 50, 'utf-8') . '…'; ?></kbd>

        <div class="text-right text-info">
            <?php
            echo CHtml::link('read more…', array('//Gallery/GalleryView', 'id' => $data->id, 'type'=>$data->type));
            ?>
        </div>

    </div>
</div>
