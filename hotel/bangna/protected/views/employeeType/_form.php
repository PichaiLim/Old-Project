<?php
/* @var $this EmployeeTypeController */
/* @var $model EmployeeType */
/* @var $form CActiveForm */
?>

<div class="row bootbox-body">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" target="_top"> <i class="fa fa-fw fa-info"></i> ข้อมลประเภทพนักงาน</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > ชื่อประเภท
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="name"
                           placeholder="ประเภท: เจ้าหน้าที่, ช่าง ฯลฯ"
                           maxlength="64"
                           required
                           ng-model="e.name">
                </div>
            </div>

            <div class="form-group">
                <label for="last_name" class="col-sm-2 control-label">
                    หมายเหตุ
                </label>
                <div class="col-sm-10">
                    <textarea name="remark" id="remark" class="form-control" cols="30" rows="10" ng-model="e.remark"
                        ></textarea >
                </div>
            </div>

        </div>
    </div>

</div>