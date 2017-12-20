<div class="row bootbox-body">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home-tab" aria-controls="home-tab" role="tab" data-toggle="tab" target="_top">ข้อมูลส่วนตัว</a></li>
        <li role="presentation"><a href="#address-tab" aria-controls="address-tab" role="tab" data-toggle="tab" target="_top" >ที่อยู่อาศัย</a></li>
        <li role="presentation"><a href="#remark-tab" aria-controls="remark-tab" role="tab" data-toggle="tab" target="_top">หมายเหตุ</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home-tab">

            <div class="form-group">
                <label for="first_name" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > ชื่อ
                </label>
                <div class="col-sm-10">
                    <div class="row" >
                        <div class="col-xs-3" >
                            <input type="text"
                                   class="form-control"
                                   id="initial"
                                   maxlength="16"
                                   placeholder="นาย | นาง | นางสาว"
                                   ng-model="c.initial">
                        </div >
                        <div class="col-xs-9" >
                            <input type="text"
                                   class="form-control"
                                   id="first_name"
                                   placeholder="ชื่อ"
                                   maxlength="64"
                                   required
                                   ng-model="c.first_name">
                        </div >
                    </div >
                </div>
            </div>

            <div class="form-group">
                <label for="last_name" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > นามสกุล
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="last_name"
                           placeholder="นาสกุล"
                           maxlength="64"
                           required
                           ng-model="c.last_name">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > Email
                </label>
                <div class="col-sm-10">
                    <input type="email"
                           class="form-control"
                           id="email"
                           placeholder="Email"
                           maxlength="255"
                           required
                           ng-model="c.email">
                </div>
            </div>

            <div class="form-group">
                <label for="nationality" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > สัญชาติ
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="nationality"
                           placeholder="ไทย | จีน | อังกฤษ ฯลฯ"
                           required
                           ng-maxlength="64"
                           ng-model="c.nationality">
                </div>
            </div>

            <div class="form-group">
                <label for="birthdate" class="col-sm-2 control-label">
                    วันเกิด
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="birthdate"
                           placeholder="ปี/เดือน/วัน"
                           readonly
                           ng-model="c.birthdate">
                </div>
            </div>

            <div class="form-group">
                <label for="personal_no" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > เลขที่บัตรประชาชน
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="personal_no"
                           placeholder=""
                           required
                           ng-maxlength="13"
                           ng-model="c.personal_no">
                </div>
            </div>

            <div class="form-group">
                <label for="passport_no" class="col-sm-2 control-label">
                    เลขที่หนังสื่อเดินทาง
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="passport_no"
                           placeholder=""
                           ng-maxlength="9"
                           ng-model="c.passport_no">
                </div>
            </div>

            <div class="form-group">
                <label for="gemder" class="col-sm-2 control-label">
                    เพศ
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" ng-repeat="G in c.listDataGender">
                        <input type="radio"
                               name="gender"
                               id="gender"
                               value="{{G.value}}"
                                ng-model="c.gender"> {{G.text}}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="marital_status" class="col-sm-2 control-label">
                    สถานะภาพ
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" ng-repeat="M in c.listDataMaritalStatus">
                        <input type="radio"
                               name="marital_status"
                               id="marital_status"
                               value="{{M.value}}"
                                ng-model="c.marital_status"> {{M.text}}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="active" class="col-sm-2 control-label">
                    สถานะ
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" ng-repeat="A in c.listDataActive">
                        <input type="radio"
                               name="active"
                               id="active"
                               value="{{A.value}}"
                               ng-model="c.active">
                        {{A.text}}
                    </label>
                </div>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane" id="address-tab">

            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">
                    ที่อยู่
                </label>
                <div class="col-sm-10">
                    <textarea name="address"
                              id="address"
                              class="form-control"
                              cols="30"
                              rows="4"
                            maxlength="255"
                            ng-model="c.address"></textarea >
                </div>
            </div>

            <div class="form-group">
                <label for="province_id" class="col-sm-2 control-label">
                    จังหวัด
                </label>
                <div class="col-sm-10">
                    <select class="form-control" name="province_id" id="province_id" ng-model="c.province_id"
                        ng-change="c.changeProvince(c.province_id);">
                        <option ng-repeat="P in c.listProvince" value="{{P.id}}" >
                            {{P.province}}
                        </option >
                    </select >
                </div>
            </div>

            <div class="form-group">
                <label for="district_id" class="col-sm-2 control-label">
                    ตำบล
                </label>
                <div class="col-sm-10">
                    <select class="form-control" name="district_id" id="district_id" ng-model="c.district_id"
                            ng-change="c.changeDistrict(c.district_id);" ng-disabled="!c.listDistrict">
                        <option ng-repeat="D in c.listDistrict" value="{{D.id}}" >
                            {{D.district}}
                        </option >
                    </select >
                </div>
            </div>

            <div class="form-group">
                <label for="area_id" class="col-sm-2 control-label">
                    อำเภอ
                </label>
                <div class="col-sm-10">
                    <select class="form-control" name="area_id" id="area_id" ng-model="c.area_id"
                            ng-change="c.changeArea(c.area_id);">
                        <option ng-repeat="A in c.listArea" value="{{A.id}}" >
                            {{A.area}}
                        </option >
                    </select >
                </div>
            </div>

            <div class="form-group">
                <label for="postal_code" class="col-sm-2 control-label">
                    รหัสไปรษณีย์
                </label>
                <div class="col-sm-10">
                    <input class="form-control" name="postal_code" id="postal_code" type="text"
                           ng-model="c.postal_code" ng-disabled="true"/>{{PC.postal_code}}
                </div>
            </div>

            <div class="form-group">
                <label for="home_phone" class="col-sm-2 control-label">
                    เบอร์โทรศัพท์บ้าน
                </label>
                <div class="col-sm-10">
                    <input class="form-control" name="home_phone" id="home_phone" type="phone" maxlength="32"
                           ng-model="c.home_phone"/>
                </div>
            </div>

            <div class="form-group">
                <label for="work_phone" class="col-sm-2 control-label">
                    เบอร์โทรที่ทำงาน
                </label>
                <div class="col-sm-10">
                    <input class="form-control" name="work_phone" id="work_phone" type="phone" maxlength="32"
                           ng-model="c.work_phone"/>
                </div>
            </div>

            <div class="form-group">
                <label for="mobile_phone" class="col-sm-2 control-label">
                    เบอร์โทรมือถือ
                </label>
                <div class="col-sm-10">
                    <input class="form-control" name="mobile_phone" id="mobile_phone" type="phone" maxlength="32"
                           ng-model="c.mobile_phone"/>
                </div>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane" id="remark-tab">

            <div class="form-group">
                <label for="remark" class="col-sm-2 control-label">
                    หมายเหตุ
                </label>
                <div class="col-sm-10">
                    <textarea name="address"
                              id="address"
                              class="form-control"
                              cols="30"
                              rows="4"
                              maxlength="255"
                              ng-model="c.remark"></textarea >
                </div>
            </div>

        </div>
    </div>

</div>

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