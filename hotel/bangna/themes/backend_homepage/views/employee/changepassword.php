<div ng-controller="EmployeeCpwdOnPageIndexController as e">
    <form name="form-changepassword" id="form-changepassword" class="form-horizontal" action="#" method="post" role="form"
          autocomplete="off">
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fa fa-fw fa-lock"></i>
                เปลี่ยนรหัสผ่าน
            </h4>
        </div>
        <div class="modal-body">
            <div class="row" >

                <div class="form-group">
                    <label for="changepassword" class="col-sm-3 control-label">
                        รหัสผ่านใหม่
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-fw fa-key"></i></span>
                            <input type="password"
                                   class="form-control"
                                   name="confirm_password"
                                   id="confirm_password"
                                   placeholder="รหัสใหม่"
                                   required
                                   autocomplete="off"
                                   value=""
                                   ng-model="e.confirm_password">
                        </div>
                        <span class="text-danger">{{e.msg}}</span>
                    </div>
                </div>

            </div >

        </div>
        <div class="modal-footer">

            <input type="hidden"
                   name="employee_id"
                   id="employee_id"
                   ng-model="e.employee_id"
                   value="<?php echo Yii::app()->user->id;?>" />

            <button type="button" id="change-password" class="btn btn-primary" ng-click="e.change_password();">
                เปลี่ยนรหัสผ่าน
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                ยกเลิก
            </button>
        </div>
    </form >
</div>