<div ng-controller="EmployeeUpdateProfileController as e">
    <form class="form-horizontal"
          action="#"
          autocomplete="off"
          name="updateProfile"
          novalidate>
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fa fa-fw fa-edit"></i>
                แก้ไขข้อมูล
            </h4>
        </div>

        <div class="modal-body">
            <div class="bootbox-body">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#/employee/updateprofile/{{e.id}}#data_system1" aria-controls="data_system1"
                               role="tab"
                               data-toggle="tab"
                                target="_top">
                                ข้อมูลระบบ
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#/employee/updateprofile/{{e.id}}#emp_profile1" aria-controls="emp_profile1"
                               role="tab"
                               data-toggle="tab"
                                target="_top">
                                ข้อมูลพนักงาน
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#/employee/updateprofile/{{e.id}}#address1" aria-controls="address1" role="tab"
                                                   data-toggle="tab" target="_top">
                                ข้อมูลติดต่อ
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="data_system1">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">ชื่อผู้ใช้</label>
                                <div class="col-xs-9">
                                    <p class="form-control-static"><strong>{{e.username}}</strong></p>
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    อีเมล์
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="email"
                                           type="emial"
                                           maxlength="255"
                                           value=""
                                           placeholder="example_mail@mail.com"
                                           spellcheck="false"
                                           required
                                        ng-model="e.email">
                                </div>
                            </div>

                        </div><!--end tabl01-->

                        <div role="tabpanel" class="tab-pane" id="emp_profile1">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    คำนำหน้าชื่อ
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="initial"
                                           type="text"
                                           maxlength="16"
                                           value=""
                                           placeholder="นาย / นาง / นางสาว ฯลฯ"
                                           spellcheck="false"
                                        ng-model="e.initial">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    <span class="text-danger" >*</span > ชื่อ
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="first_name"
                                           type="text"
                                           maxlength="64"
                                           value="จินตนา"
                                           placeholder=""
                                           spellcheck="false"
                                           required
                                        ng-model="e.first_name">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    <span class="text-danger" >*</span > นามสกุล
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="last_name"
                                           type="text"
                                           maxlength="64"
                                           value=""
                                           placeholder="นามสกุล"
                                           spellcheck="false"
                                           required
                                           ng-model="e.last_name">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">
                                    <span class="text-danger" >*</span > เพศ
                                </label>
                                <div class="col-xs-9">
                                    <select class="form-control" name="gender" ng-model="e.gender" required>
                                        <option ng-repeat="list_getnder in e.listDataGender"
                                                value="{{list_getnder.value}}">
                                                {{list_getnder.text}}
                                        </option >
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    สถานภาพสมรส
                                </label>
                                <div class="col-xs-9">
                                    <select class="form-control" name="marital_status" ng-model="e.marital_status">
                                        <option ng-repeat="list_maritals in e.listDataMaritalStatus"
                                                value="{{list_maritals.value}}">{{list_maritals.text}}</option>
                                    </select>
                                </div>
                            </div>

                        </div> <!--end tab emp_profile-->

                        <div role="tabpanel" class="tab-pane" id="address1">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    ที่อยู่
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control "
                                           name="address"
                                           type="text"
                                           maxlength="255"
                                           value=""
                                           placeholder=""
                                           spellcheck="false"
                                           ng-model="e.address">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">จังหวัด</label>
                                <div class="col-xs-9">
                                    <select class="form-control"
                                            name="province_id"
                                            ng-model="e.province_id"
                                            ng-change="e.changeProvince(e.province_id);">
                                        <option ng-repeat="P in e.listProvince" value="{{P.id}}" >
                                            {{P.province}}
                                        </option >
                                    </select>{{e.province_id | json}}
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    เขต/อำเภอ
                                </label>
                                <div class="col-xs-9">
                                    <select class="form-control"
                                            name="district_id"
                                            ng-model="e.district_id"
                                            ng-change="e.changeDistrict(e.district_id);">
                                        <option ng-repeat="D in e.listDistrict"
                                                value="{{D.id}}"
                                                ng-selected="e.district_id == D.id">
                                            {{D.district}}
                                        </option >
                                    </select>{{e.district_id | json}}
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    แขวง/ตำบล
                                </label>
                                <div class="col-xs-9">
                                    <select class="form-control"
                                            name="area_id"
                                            ng-model="e.area_id"
                                            ng-change="e.changeArea(e.area_id);">
                                        <option ng-repeat="A in e.listArea" value="{{A.id}}"
                                                ng-selected="e.area_id == A.id">
                                            {{A.area}}
                                        </option >
                                    </select>{{e.area_id}}
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    รหัสไปรษณีย์
                                </label>
                                <div class="col-xs-5">
                                    <select class="form-control"
                                            name="postal_code"
                                            ng-model="e.postal_code">
                                        <option ng-repeat="PC in e.listPostalCode"
                                                value="{{PC.area_id}}"
                                                ng-selected="e.postal_code == PC.postal_code">
                                            {{PC.postal_code}}
                                        </option >
                                    </select>{{e.postal_code}}
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">โทรศัพท์บ้าน</label>
                                <div class="col-xs-9">

                                        <input class="form-control"
                                               name="home_phone"
                                               type="text"
                                               maxlength="32"
                                               value=""
                                               placeholder=""
                                               spellcheck="false"
                                            autocomplete="off"
                                            ng-model="e.home_phone">

                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">โทรศัพท์ที่ทำงาน</label>
                                <div class="col-xs-9">

                                        <input class="form-control"
                                               name="work_phone"
                                               type="text"
                                               maxlength="32" value="" placeholder="" spellcheck="false">

                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">มือถือ</label>
                                <div class="col-xs-9">
                                        <input class="form-control"
                                               name="mobile_phone"
                                               type="text"
                                               maxlength="32"
                                               value=""
                                               placeholder=""
                                               spellcheck="false"
                                               autocomplete="off">
                                    </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="hidden" ng-model="e.updated_by" id="updated_by" value="<?php echo  Yii::app()->user->id; ?>" />
            <button type="button" class="btn btn-primary" ng-click="e.confirm(e.id);">
                <i class="fa fa-check"></i>
                บันทึก
            </button>
            <button type="button" class="btn btn-default dialog-btn"  data-dismiss="modal">
                <i class="fa fa-close"></i>
                ยกเลิก
            </button>
        </div>

    </form>
</div>