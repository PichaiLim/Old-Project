<div ng-controller="EmployeeUpdateProfileOnPageIndexController as e">
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
                            <a href="#/updateprofile/{{e.id}}#data_system" aria-controls="data_system" role="tab"
                               data-toggle="tab" target="_top">
                                ข้อมูลระบบ
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#/updateprofile/{{e.id}}#emp_profile" aria-controls="emp_profile" role="tab"
                               data-toggle="tab" target="_top">
                                ข้อมูลพนักงาน
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#/updateprofile/{{e.id}}#address" aria-controls="address" role="tab"
                               data-toggle="tab" target="_top">
                                ข้อมูลติดต่อ
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="data_system">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label required">ชื่อผู้ใช้</label>
                                <div class="col-xs-9">
                                    <p class="form-control-static">
                                        <strong >
                                            {{e.username}}
                                        </strong >
                                    </p >
                                    <!--<input class="form-control"
                                           name="username"
                                           type="text"
                                           maxlength="20"
                                           value=""
                                           placeholder="ชื่อผู้เข้าใช้งาน"
                                            ng-model="e.username">-->
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

                        <div role="tabpanel" class="tab-pane" id="emp_profile">

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
                                        <option ng-repeat="list_gender in e.listGender"
                                                value="{{list_gender.value}}"
                                                ng-selected="list_gender.value == e.gender">
                                                {{list_gender.text}}
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
                                        <option ng-repeat="list_maritals in e.listMarital_status"
                                                value="{{list_maritals.value}}">{{list_maritals.text}}</option>
                                    </select>
                                </div>
                            </div>

                        </div> <!--end tab emp_profile-->

                        <div role="tabpanel" class="tab-pane" id="address">

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">
                                    ที่อยู่
                                </label>
                                <div class="col-xs-9">
                                    <input class="form-control " name="address" type="text" maxlength="255" value="" placeholder="" spellcheck="false" ng-model="e.address">
                                </div>
                            </div>

                            <div class="form-group pr20">
                                <label class="col-xs-3 control-label ">จังหวัด</label>
                                <div class="col-xs-9">
                                    <select class="form-control"
                                            name="province_id"
                                            ng-model="e.province_id"
                                            ng-change="e.change_district(e.province_id);">
                                        <option ng-repeat="Province in e.listProvince"
                                                ng-value="Province.id"
                                                ng-selected="e.province_id == Province.id">
                                            {{Province.province}}
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
                                            ng-change="e.change_area(e.district_id);">
                                        <option ng-repeat="District in e.listDistrict"
                                                ng-value="District.id"
                                                ng-selected="e.district_id == District.id">
                                            {{District.district}}
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
                                            ng-change="e.change_postal_code(e.area_id);">
                                        <option ng-repeat="Area in e.listArea"
                                            ng-value="Area.id"
                                            ng-selected="e.area_id == Area.id">
                                            {{Area.area}}
                                        </option >
                                    </select>{{e.area_id | json}}
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
                                        <option ng-repeat="PostalCode in e.listPostalCode"
                                                ng-value="PostalCode.area_id"
                                                ng-selected="e.postal_code == PostalCode.area_id">
                                            {{PostalCode.postal_code}}
                                        </option >
                                    </select>
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
            <button type="button" class="btn btn-primary" ng-click="e.confirm();">
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