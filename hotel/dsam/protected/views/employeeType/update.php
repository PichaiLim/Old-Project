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
                <span class="text-primary">{{e.name}}</span>
            </h4>
        </div>
        <div class="modal-body">
            <?php $this->renderPartial('_form'); ?>
        </div>
        <div class="modal-footer bg-info">
            <input type="hidden"
                   name="created"
                   id="created"
                   ng-value="e.created"
                    ng-model="e.created"/>
            <input type="hidden"
                   name="created_by"
                   id="created_by"
                   ng-value="e.created_by"
                   ng-model="e.created_by"/>

            <input type="hidden"
                   name="updated"
                   id="updated"
                   value="<?php echo new CDbExpression('NOW()'); ?>"
                    ng-model="e.updated"/>
            <input type="hidden"
                   name="updated_by"
                   id="updated_by"
                   value="<?php echo Yii::app()->user->id; ?>" />
            <input name="id" id="id" type="hidden" ng-model="e.id" />

            <button type="submit" class="btn btn-primary" ng-click="e.btnSaveUpdate();">
                <span class="fa fa-fw fa-check"></span>
                บันทึก
            </button>

            <button type="button" class="btn btn-default" data-dismiss="modal">
                <span class="fa fa-fw fa-close"></span>
                ยกเลิก
            </button>

        </div>
</form >