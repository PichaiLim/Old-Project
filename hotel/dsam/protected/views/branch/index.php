<?php
/* @var $this BranchController */
/* @var $dataProvider CActiveDataProvider */

?>


<!-- การเข้าพักรายวัน -->

<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-primary"
       href="<?php echo Yii::app()->createUrl('/Reservation/Index',array('id'=>$_GET['id'])); ?>">

        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-bolt"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">
                จัดการห้อง
            </span>
        </div>

    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-magenta"
       href="<?php echo Yii::app()->createUrl('/Reservation/View',array('id'=>$_GET['id'])); ?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-flag"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ข้อมูลการจองห้องพัก</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-info" href="<?php echo Yii::app()->createUrl('/ReservationHistory/Index', array
    ('id'=>$_GET['id']));
    ?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-history"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ประวัติการจอง/ห้องพัก</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-grape" href="<?php echo Yii::app()->createUrl('#/payment'); ?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-money"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ข้อมูลการยืนยันชำระเงิน</span>
        </div>
    </a>
</div>

<div class="clearfix"></div>

<!-- การจัดการวัสดุสิ้นเปลือง -->

<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-alizarin"
       href="<?php echo Yii::app()->createUrl('/Inventory/Index', array('id'=>$_GET['id']));?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-cubes"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">คลังวัสดุสิ้นเปลือง</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-green"
       href="<?php echo Yii::app()->createUrl('/InventoryPush/Index', array('id'=>$_GET['id']));?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-arrow-right"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">นำเข้า</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-danger"
       href="<?php echo Yii::app()->createUrl('/InventoryPull/Index', array('id'=>$_GET['id']));?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-arrow-left"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">เบิกออก</span>
        </div>
    </a>
</div>

<div class="clearfix"></div>

<!-- ข้อมูลอื่นๆ -->

<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-orange"
       href="<?php echo  Yii::app()->createUrl('/Building/Index', array('id'=>$_GET['id']));?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-building"></i></div>
            <div class="pull-right">
                <span class="badge">
                    <?php echo Building::model()->CountBuilding($id, "branch"); ?>
                </span>
            </div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">อาคาร</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-indigo"
       href="<?php echo Yii::app()->createUrl('/Floor/Index', array('id'=>$_GET['id']));?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-bars"></i></div>
            <div class="pull-right">
                <span class="badge">
                    <?php echo Floor::model()->CountFloor($id,'branch'); ?>
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
                    <?php echo Room::model()->CountRoom($id, 'branch');?>
                </span>
            </div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ห้อง</span>
        </div>
    </a>
</div>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <a class="shortcut-tiles tiles-sky"
       href="<?php echo Yii::app()->createUrl('/RoomType/Index', array('id'=>$_GET['id'])); ?>">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-info"></i></div>
            <div class="pull-right">
                <span class="badge">
                    <?php echo RoomType::model()->CountRoomType($id); ?>
                </span>
            </div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">ประเภทห้อง</span>
        </div>
    </a>
</div>
