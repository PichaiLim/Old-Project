<div class="container" style="width: 640px;">
    <div class="row-fluid">
        <div class="span3">
            <?php if (!empty($data->imageHeader)): ?>
                <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/media/' . $data->imageHeader, $data->header, array('class' => 'img-polaroid')); ?>
            <?php else: ?>
                <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/media/no_images7.gif', NULL, array()); ?>
            <?php endif; ?>
        </div>

        <div class="span9">
            <h4 style="border-bottom: 1px inset black; margin-top: 0px;">
                <i class="icon-map-marker"></i>&nbsp;
                <?php
                echo CHtml::link($data->header, array('//Posts/ViewArticle', 'id' => $data->id));
                ?>
            </h4>
            <p>
                <?php echo mb_substr(CHtml::encode($data->detailHeader), 0, 100,'utf-8'); ?>……
            </p>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12 text-info text-right pull-right">
            <strong><?php echo CHtml::link('Read Me…', array('//Posts/ViewNewsEvent', 'id' => $data->id)); ?></strong>
        </div>
    </div>
</div>

<hr style="border-bottom: 1px dashed black;"/>