<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/27/16
 * Time: 18:08
 */
?>

<form class="form-horizontal"
      name="addCus"
      autocomplete="off"
      role="form"
      method="post" >
    <div class="modal-content">
        <div class="modal-header bg-info navbar-fixed-top">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-fw {{r.style_icon}}"></i> {{r.titleheader}}
                <span class="text-danger">{{r.roomName}}</span>
                <span class="text-muted">{{r.building_name}} {{r.floor_name}}</span>
            </h4>
        </div>
        <div class="modal-body model-body-padding">
            <?php $this->renderPartial('_form'); ?>
        </div>
        <div class="modal-footer bg-info">
            <input type="hidden"
                   name="created"
                   id="created"
                   value="<?php echo new CDbExpression('NOW()'); ?>" />
            <input type="hidden"
                   name="created_by"
                   id="created_by"
                   value="<?php echo Yii::app()->user->id; ?>"
                   ng-model="r.created_by"/>

            <input name="paid"
                   id="paid"
                   value="<?php echo new CDbExpression('NOW()'); ?>"
                   type="hidden" />

            <input name="branch_id"
                   id="branch_id"
                   value="{{r.branch_id}}"
                   type="hidden"
                   ng-model="r.branch_id" />

            <input name="building_id"
                   id="building_id"
                   value="{{r.building_id}}"
                   type="hidden"
                   ng-model="r.building_id" />

            <input name="floor_id"
                   id="floor_id"
                   value="{{r.floor_id}}"
                   type="hidden"
                   ng-model="r.floor_id" />

            <input name="room_id"
                   id="room_id"
                   value="{{r.room_id}}"
                   type="hidden"
                   ng-model="r.room_id" />

            <input name="customer_id"
                   id="customer_id"
                   ng-model="r.customer_id"
                   value="{{r.customer_id}}"
                   type="hidden" />

            <input name="payee"
                   id="payee"
                   ng-model="r.payee"
                   value="<?php echo Yii::app()->user->id; ?>"
                   type="hidden" />

            <button type="submit"
                    class="btn btn-primary"
                    ng-click="r.btnSaveCheckIn();"
                    ng-disabled="r.validationFormCheckin(addCus);">
                <span class="fa fa-fw fa-check"></span>
                บันทึก
            </button>

            <button type="button" class="btn btn-default" data-dismiss="modal">
                <span class="fa fa-fw fa-close"></span>
                ยกเลิก
            </button>

        </div>
</form >