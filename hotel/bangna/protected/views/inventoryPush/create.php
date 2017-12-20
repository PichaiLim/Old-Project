<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/13/16
 * Time: 12:06
 */
?>
<form action="" name="myForm" id="myForm">


    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-fw fa-arrow-right"></i> นำเข้าวัสดุสิ้นเปลือง</h4>
        </div>
        <div class="modal-body">

            <?php $this->renderPartial('_form'); ?>

        </div>
        <div class="modal-footer">
            <input name="branch_id" id="branch_id" type="hidden" ng-model="i.branch_id" value="{{i.branch_id}}" required />
            <input name="product_id" id="product_id" type="hidden" ng-model="i.product_id" value="{{i.product_id}}"
                   required />
            <input name="created_by" id="created_by" value="<?php echo Yii::app()->user->id; ?>" type="hidden" />
            <button type="button" class="btn btn-primary"
                    ng-disabled="i.validateForm(myForm);"
                    ng-click="i.btnSave();">
                    <i class="fa fa-fw fa-check"></i> บันทึกข้อมูล</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <i class="fa fa-fw fa-remove"></i> ยกเลิก</button>
        </div>
    </div>

</form >