<?php
/* @var $this EmployeeController */
/* @var $model Employee */

?>


<form class="form-horizontal"
      name="addEmp"
      autocomplete="off"
      role="form"
      method="post" novalidate>
    <div class="modal-content">
        <div class="modal-header bg-info navbar-fixed-top">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">
                <span class="fa fa-fw fa-edit"></span>
                {{e.titleheader}}
                <span class="text text-danger">ผู้ใช้งาน {{e.username}}</span>
            </h4>
        </div>
        <div class="modal-body">
            <?php $this->renderPartial('_form'); ?>
        </div>
        <div class="modal-footer bg-info">

            <input type="hidden"
                   name="updated"
                   id="created"
                   value="{{e.created}}"
                   ng-model="e.created"/>
            <input type="hidden"
                   name="created_by"
                   id="created_by"
                   value="{{e.created_by}}"
                   ng-model="e.created_by"/>

            <input type="hidden"
                   name="updated"
                   id="updated"
                   value="<?php echo new CDbExpression('NOW()'); ?>"
                   ng-model="e.updated"/>
            <input type="hidden"
                   name="updated_by"
                   id="updated_by"
                   value="<?php echo Yii::app()->user->id; ?>"
                   ng-model="e.updated_by"/>

            <button type="submit" class="btn btn-primary" ng-click="e.btnSaveChange(e.id);">
                <span class="fa fa-fw fa-check"></span>
                บันทึก
            </button>

            <button type="button" class="btn btn-default" data-dismiss="modal">
                <span class="fa fa-fw fa-close"></span>
                ยกเลิก
            </button>

        </div>
    </div>
</form >

<script>
    $(function() {
        var dateToday = new Date();
        var yrRange = (dateToday.getFullYear() - 40) + ":" + (dateToday.getFullYear()-10);

        $( "#birthdate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: yrRange
        });
    });
</script>