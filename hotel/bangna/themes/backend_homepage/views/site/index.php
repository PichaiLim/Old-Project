<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>''
)); ?>
<?php if(Yii::app()->user->role != ''): ?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" ng-controller="BranchController as bc">
    <a class="shortcut-tiles tiles-primary"
       href=""
       ng-click="bc.manageBranchModal(0, <?=Yii::app()->user->id;?>,'');">
        <div class="tiles-body">
            <div class="pull-left"><i class="fa fa-fw fa-plus-circle"></i></div>
        </div>
        <div class="tiles-footer">
            <span class="pull-right">
                เพิ่มสาขา
            </span>
        </div>
    </a>
</div>
<?php endif; ?>

<? if((Yii::app()->params['show_branch'] === 0 && Yii::app()->params['count_branch'] === 0)
    && Yii::app()->user->role === ""):?>

    <div class="jumbotron">
        <h1>ยินดีตอนรับ <?php echo Yii::app()->user->name; ?> เข้าสู้ระบบ</h1>
        <p>
                กรุณากดที่ปุ่มด้านล่างเพื่อทำการร้องขอ ในการเปิดใช้งานในสาขาของท่านที่ต้องการจะเข้าถึง
        </p>
        <p class="text text-warning">
            *** คุณ <?php echo Yii::app()->user->name; ?> ไม่ได้อยู่ในสถานะที่จะสามารถเข้าถึงข้อมูลสาขาได้
        </p>
        <p class="text text-right">
            <a class="btn btn-primary btn-lg" href="#"
                                      role="button">
                <i class="fa fa-fw fa-phone"></i>กดปุ่มเพื่อติดต่อ
            </a>
        </p>
    </div>

<?php endif; ?>
<?php
/* @var $this BranchController */
/* @var $model Branch */
?>
