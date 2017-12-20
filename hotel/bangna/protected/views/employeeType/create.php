<?php
/* @var $this EmployeeTypeController */
/* @var $model EmployeeType */

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
                <span class="fa fa-fw fa-plus"></span>
                {{e.titleheader}}&nbsp;
                <span class="text-primary text-capitalize">{{e.name}}</span>
            </h4>
        </div>
        <div class="modal-body">
            <?php $this->renderPartial('_form'); ?>
        </div>
        <div class="modal-footer bg-info">
            <input type="hidden"
                   name="created"
                   id="created"
                   ng-model="e.created"
                   value="<?php echo new CDbExpression('NOW()'); ?>" />
            <input type="hidden"
                   name="created_by"
                   id="created_by"
                   value="<?php echo Yii::app()->user->id; ?>"
                   ng-model="e.created_by"/>

            <!--<input type="hidden"
                   name="updated"
                   id="updated"
                   ng-model="e.updated"
                   value="<?php /*echo new CDbExpression('NOW()'); */?>" />
            <input type="hidden"
                   name="updated_by"
                   id="updated_by"
                   ng-model="e.updated_by"
                   value="<?php /*echo Yii::app()->user->id; */?>" />-->
            <input name="id" id="id" type="hidden" ng-model="e.id" />

            <button type="submit" class="btn btn-primary" ng-click="e.btnSave();">
                <span class="fa fa-fw fa-check"></span>
                บันทึก
            </button>

            <button type="button" class="btn btn-default" data-dismiss="modal">
                <span class="fa fa-fw fa-close"></span>
                ยกเลิก
            </button>

        </div>
</form >