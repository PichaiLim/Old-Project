<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>


<div class="row bootbox-body">

    <!--Menu panel-->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#/employee/update/{{e.id}}#tabPane00" aria-controls="tabPane00" role="tab"
               data-toggle="tab"
               aria-expanded="true"
               target="_top">
                <i class="fa fa-fw fa-info"></i>
                ข้อมูลระบบ
            </a>
        </li>

        <li role="presentation">
            <a href="#/employee/update/{{e.id}}#tabPane11" aria-controls="tabPane11" role="tab" data-toggle="tab" aria-expanded="true" target="_top">
                ข้อมูลส่วนตัว
            </a>
        </li>
    </ul>

    <!--  Form content -->
    <div class="tab-content">
        <div class="tab-pane active" id="tabPane00" role="tabepanel">

            <div class="form-group ">
                <label class="col-xs-3 control-label" for="username" required >
                    <i class="text text-danger">*</i> {{e.attributeLabelName.username}}
                </label >

                <div class="col-xs-9" >
                    <input name="username" id="username" class="form-control" maxlength="64"
                           placeholder="ชื่อผู้เข้าใช้งาน"
                           type="text"
                           required ng-model="e.username" value="{{e.username}}" />
                </div >
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label" for="password" required >
                    <i class="text text-danger">*</i> {{e.attributeLabelName.password}}
                </label >

                <div class="col-xs-9" >
                    <input class="form-control" name="password" id="password" value="" type="password"
                           required placeholder="Password" autofocus="autofocus"
                           autocomplete="off" ng-model="e.password"
                           ng-maxlength="41" ng-minlength="4" />
                    <input type="hidden" ng-model="e.old_password" value="{{e
                    .old_password}}" />
                </div >
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label" for="email" required >
                    <i class="text text-danger">*</i> {{e.attributeLabelName.email}}
                </label >

                <div class="col-xs-9" >
                    <input class="form-control" name="email" id="email" value="" type="text"
                           placeholder="example@email.com" autofocus="autofocus" autocomplete="off"
                           required ng-maxlength="255"
                           ng-model="e.email" />
                </div >
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="employee_type_id" >
                    {{e.attributeLabelName.employee_type_id}}
                </label >

                <div class="col-xs-9">
                    <select class="form-control" name="employee_type_id" id="employee_type_id"
                            ng-model="e.employee_type_id"
                            ng-options="empType.name for empType in e.listEmployeeType
                                                    track by e.employee_type_id">
                    </select >
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="branch_id" >
                    {{e.attributeLabelName.branch_id}}
                </label >

                <div class="col-xs-9">
                    <span ng-repeat="branch in e.listBranch">
                        <label class="checkbox-inline">
                            <input type="checkbox"
                                   name="branch_id"
                                   id="branch"
                                   class="chk_branch"
                                   ng-model="branch.checked"
                                   ng-value="branch.id"
                                   ng-checked="branch.checked"
                                   ng-click="e.click_branch_id(branch);">
                            {{branch.name}}
                        </label>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <labe class="col-xs-3 control-label">สถานะ Admin</labe>
                <div class="col-xs-9">
                    <label class="radio-inline" ng-repeat="admin in e.listDataAdmin">
                        <input type="radio" name="admin" id="admin"
                               ng-value="admin.value"
                               ng-model="e.admin">
                        {{admin.text}}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="active" >
                    {{e.attributeLabelName.active}}
                </label >

                <div class="col-xs-9">
                    <label class="radio-inline" ng-repeat="active in e.listDataActive">
                        <input type="radio" id="active" class="chk_active" ng-model="e.active"
                               ng-value="active.value">
                        {{active.text}}
                    </label>
                </div>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane" id="tabPane11">


            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="first_name" >
                    <i class="text text-danger">*</i>
                    {{e.attributeLabelName.first_name}}
                </label >

                <div class="col-xs-9">
                    <div class="row" >
                        <div class="col-xs-3" >
                            <input class="form-control" name="initial" id="initial"
                                   placeholder="คำนำหน้า" autocomplete="on"
                                   ng-maxlength="16"
                                   type="text" value="" ng-model="e.initial" />
                        </div >
                        <div class="col-xs-9" >
                            <input class="form-control col-xs-9" name="first_name" id="first_name"
                                   placeholder="ชื่อ" required="required"
                                   ng-maxlength="64"
                                   type="text" value="" ng-model="e.first_name" />
                        </div >
                    </div >
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="last_name" >
                    <i class="text text-danger">*</i>
                    {{e.attributeLabelName.last_name}}
                </label >

                <div class="col-xs-9">
                    <input class="form-control" name="last_name" id="last_name" ng-maxlength="64"
                           placeholder="นามสกุล" required="required"
                           type="text" value="" ng-model="e.last_name" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="gender" >
                    {{e.attributeLabelName.gender}}
                </label >

                <div class="col-xs-9">
                    <label class="radio-inline" ng-repeat="gender in e.listDataGender">
                        <input type="radio" id="gender" class="chk_gender" ng-model="e.gender"
                               ng-value="gender.value">
                        {{gender.text}}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="birthdate" >
                    {{e.attributeLabelName.birthdate}}
                </label >

                <div class="col-xs-9">
                    <input class="form-control" name="birthdate" id="birthdate" ng-maxlength="64"
                           placeholder="ปี/เดือน/วัน" readonly="readonly"
                           type="text" ng-value="e.birthdate" ng-model="e.birthdate" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="marital_status" >
                    {{e.attributeLabelName.marital_status}}
                </label >

                <div class="col-xs-9">
                    <label class="radio-inline" ng-repeat="maritalStatus in e.listDataMaritalStatus">
                        <input type="radio" id="marital_status" class="chk_marital_status"
                               ng-model="e.marital_status"
                               ng-value="maritalStatus.value">
                        {{maritalStatus.text}}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="address" >
                    {{e.attributeLabelName.address}}
                </label >

                <div class="col-xs-9">
                    <textarea name="address" class="form-control" id="address" cols="30" rows="3"
                              ng-model="e.address"></textarea >
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="province_id" >
                    {{e.attributeLabelName.province_id}}
                </label >

                <div class="col-xs-9">
                    <select class="form-control" name="province_id" id="province_id"
                            ng-model="e.province_id"
                            ng-change="e.change_province(e.province_id);">
                        <option ng-repeat="P in e.listProvince" value="{{P.id}}"
                                ng-selected="e.province_id == P.id">
                            {{P.province}}
                        </option >
                    </select >
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="district_id" >
                    {{e.attributeLabelName.district_id}}
                </label >

                <div class="col-xs-9">
                    <select class="form-control" name="district_id" id="district_id"
                            ng-model="e.district_id"
                            ng-change="e.change_district(e.district_id);">
                        <option ng-repeat="D in e.listDistrict" value="{{D.id}}" >
                            {{D.district}}
                        </option >
                    </select >
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="area_id" >
                    {{e.attributeLabelName.area_id}}
                </label >

                <div class="col-xs-9">
                    <select class="form-control"
                            name="area_id"
                            ng-model="e.area_id"
                            ng-change="e.change_area(e.area_id);">
                        <option ng-repeat="A in e.listArea" value="{{A.id}}" >
                            {{A.area}}
                        </option >
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="postal_code" >
                    {{e.attributeLabelName.postal_code}}
                </label >

                <div class="col-xs-9">
                    <select class="form-control"
                            name="postal_code"
                            ng-model="e.postal_code">
                        <option ng-repeat="PC in e.listPostalCode" value="{{PC.area_id}}"
                                ng-selected="e.postal_code == PC.postal_code">
                            {{PC.postal_code}}
                        </option >
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="home_phone" >
                    {{e.attributeLabelName.home_phone}}
                </label >

                <div class="col-xs-9">
                    <input class="form-control" name="home_phone" id="home_phone" maxlength="32"
                           type="phone" ng-model="e.home_phone" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="work_phone" >
                    {{e.attributeLabelName.work_phone}}
                </label >

                <div class="col-xs-9">
                    <input class="form-control" name="work_phone" id="work_phone" maxlength="32"
                           type="phone" ng-model="e.work_phone" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="mobile_phone" >
                    {{e.attributeLabelName.mobile_phone}}
                </label >

                <div class="col-xs-9">
                    <input class="form-control" name="mobile_phone" id="mobile_phone" maxlength="32"
                           type="phone" ng-model="e.mobile_phone" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3 control-label"
                       for="remark" >
                    {{e.attributeLabelName.remark}}
                </label >

                <div class="col-xs-9">
                                <textarea name="remark" class="form-control" id="remark" cols="30" rows="3"
                                          ng-model="e.remark"></textarea >
                </div>
            </div>


        </div>

    </div>

</div>