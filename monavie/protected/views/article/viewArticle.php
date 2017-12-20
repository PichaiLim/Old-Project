<?php $this->pagetitle = Yii::app()->name.' - '.$title ?>
<h2>
    <?php echo CHtml::encode($modelPost->header);?>
</h2>
<hr/>
<div class="row-fluid">
    <?php echo $modelPost->content;?>
</div>