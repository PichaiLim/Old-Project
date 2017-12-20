<?php
/* @var $this BranchController */
/* @var $data Branch */
?>


<!-- สาขา -->
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="<?php echo Branch::model()->TilesClassColor($data->id); ?>"
       href="<?php echo Yii::app()->createUrl('Branches', array('id' => $data->id));?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-code-fork"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">
                <?php echo CHtml::encode($data->name); ?>
            </span>
        </div>
    </a>
</div>

