<?php
/* @var $this BuildingController */
/* @var $dataProvider CActiveDataProvider */

?>



<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-indigo"
       href="<?php echo Yii::app()->createUrl('/Floor/Index', array('id'=>$_GET['id'])); ?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-bars"></i></div>
            <div class="pull-right">
                <span class="badge">
                    <?php
                        echo Floor::model()->CountFloor($_GET['id'], 'building');
                    ?>
                </span>
            </div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ชั้น</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-brown"
       href="<?php echo Yii::app()->createUrl('/Room/Index', array('id'=>$_GET['id'])); ?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-archive"></i></div>
            <div class="pull-right">
                <span class="badge">
                    <?php
                        echo Room::model()->CountRoom($_GET['id'], 'building');
                    ?>
                </span>
            </div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ห้อง</span>
        </div>
    </a>
</div>