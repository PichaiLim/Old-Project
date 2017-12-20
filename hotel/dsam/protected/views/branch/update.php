<?php
/* @var $this BranchController */
/* @var $model Branch */
?>

<form class="form-horizontal"
      name="myform"
      id="myform"
      role="form"
      action="#"
      autocomplete="off"
      ng-controller="BranchUpdateController as b">
    <div class="modal-content">
        <div class="modal-header bg-info navbar-fixed-top">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">
                <span class="fa fa-fw fa-plus"></span>
                {{b.titleheader}}
                <span class="text text-warning">สาขา {{b.name}}</span>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row bootbox-body">

                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#/Branch/Create/#system" aria-controls="system" role="tab" data-toggle="tab"
                               target="_top">
                                <i class="fa fa-fw fa-info"></i>
                                ข้อมูลระบบ
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#/Branch/Create/#SEO" aria-controls="SEO" role="tab" data-toggle="tab"
                               target="_top">
                                SEO
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="system">

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">
                                    <i class="text text-danger" >*</i >
                                    ชื่อสาขา
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อสาขา"
                                           required maxlength="64" ng-model="b.name">
                                <span class="text text-danger" ng-show="myform.name.$dirty && myform.name.$invalid">
                                    <span ng-show="myform.name.$error.required">กรุณากรอกข้อมูลในช่องว่าง</span>
                                </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">
                                    ที่อยู่
                                </label>
                                <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control" cols="30" rows="3"
                                          maxlength="255" placeholder="เลขที่ตั้งอาคาร" required
                                          ng-model="b.address"></textarea >
                                <span class="text text-danger" ng-show="myform.address.$dirty && myform.address.$invalid">
                                    <span ng-show="myform.address.$error.required">กรุณากรอกข้อมูลในช่องว่าง</span>
                                </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="province_id" class="col-sm-3 control-label">
                                    จังหวัด
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="province_id" id="province_id"
                                            required
                                            ng-model="b.province_id"
                                        ng-change="b.change_district();">
                                        <option ng-repeat="P in b.listProvince" value="{{P.id}}"
                                                ng-selected="b.province_id == P.id">
                                            {{P.province}}
                                        </option >
                                    </select >{{b.province_id | json}}
                                <span class="text text-danger" ng-show="myform.province_id.$dirty && myform.province_id.$invalid">
                                    <span ng-show="myform.province_id.$error.required">กรุณาเลือกข้อมูล</span>
                                </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="district_id" class="col-sm-3 control-label">
                                    เขต/ตำบล
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="district_id" id="district_id"
                                            required
                                        ng-mode="b.district_id">
                                        <option ng-repeat="D in b.listDistrict" class="district_id" value="{{D.id}}"
                                                ng-selected="b.district_id == D.id">
                                            {{D.district}}
                                        </option >
                                    </select >{{b.district_id | json}}
                                <!--<span class="text text-danger" ng-show="myform.district_id.$dirty && myform.district_id.$invalid">
                                    <span ng-show="myform.district_id.$error.required">กรุณาเลือกข้อมูล</span>
                                </span>-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="area_id" class="col-sm-3 control-label">
                                    แขวง/อำเภอ
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="area_id" id="area_id"
                                            required
                                            ng-model="b.area_id">
                                        <option ng-repeat="A in b.listArea"
                                                ng-value="{{A.id}}"
                                                ng-selected="b.area_id == A.id">
                                            {{A.area}}
                                        </option >
                                    </select >{{b.area_id | json}}
                                <!--<span class="text text-danger" ng-show="myform.area_id.$dirty && myform.area_id.$invalid">
                                    <span ng-show="myform.area_id.$error.required">กรุณาเลือกข้อมูล</span>
                                </span>-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="postal_code" class="col-sm-3 control-label">
                                    รหัสไปรษณีย์
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="postal_code" id="postal_code"
                                            required
                                            ng-model="b.postal_code">
                                        <option ng-repeat="PC in b.listPostalCode"
                                                value="{{PC.area_id}}"
                                                ng-selected="b.postal_code == PC.postal_code">
                                            {{PC.postal_code}}
                                        </option >
                                    </select >{{b.postal_code | json}}
                                <!--<span class="text text-danger" ng-show="myform.postal_code.$dirty && myform.postal_code.$invalid">
                                    <span ng-show="myform.postal_code.$error.required">กรุณาเลือกข้อมูล</span>
                                </span>-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-sm-3 control-label">
                                    เบอร์โทรศัพท์
                                </label>
                                <div class="col-sm-9">
                                    <input type="phone" class="form-control" name="phone" id="phone"
                                           placeholder="เบอร์โทรศัพท์: 0294857192"
                                           maxlength="32"
                                           ng-model="b.phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fax" class="col-sm-3 control-label">
                                    เบอร์โทรสาร
                                </label>
                                <div class="col-sm-9">
                                    <input type="phone" class="form-control" name="fax" id="fax"
                                           placeholder="เบอร์โทรสาร: 0294857192"
                                           maxlength="32"
                                           ng-model="b.fax">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label" >แผนที่</label >
                                <div class="col-sm-9">
                                    <div class="row" >
                                        <div class="col-sm-6" >
                                            <input class="form-control" type="number"
                                                   ng-model="b.latitude"/>
                                        </div >
                                        <div class="col-sm-6" >
                                            <input class="form-control" type="number"
                                                   ng-model="b.longitude"/>
                                        </div >
                                    </div >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active" class="col-sm-3 control-label" >
                                    สถานะ
                                </label >
                                <div class="col-sm-9">
                                    <label for="active[{{Active.text}}]" class="radio-inline"
                                           ng-repeat="Active in b.listDataActive">
                                        <input type="radio" name="active" id="active[{{Active.text}}]"
                                               value="{{Active.value}}" ng-model="b.active"
                                               ng-checked="Active.value == b.active"/>
                                        {{Active.text}}
                                    </label >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="published" class="col-sm-3 control-label" >
                                    เผยแพร่
                                </label >
                                <div class="col-sm-9">
                                    <label for="published[{{Published.text}}]" class="radio-inline"
                                           ng-repeat="Published in b.listDataPublished">
                                        <input type="radio" name="published" id="published[{{Published.text}}]"
                                               value="{{Published.value}}" ng-model="b.published"
                                               ng-checked="Published.value == b.published" />
                                        {{Published.text}}
                                    </label >
                                </div>
                            </div>

                        </div>

                        <div role="tabpanel" class="tab-pane" id="SEO">

                            <div class="form-group">
                                <lable for="seo_title" class="col-sm-3 control-label" >
                                    Title
                                </lable >

                                <div class="col-sm-9">
                                    <input class="form-control"
                                           name="seo_title"
                                           data-name="seo_title"
                                           type="text"
                                           maxlength="255"
                                           value=""
                                           placeholder="หัวข้อหรือหัวเรื่อง"
                                           spellcheck="false"
                                           style="display: block;"
                                           ng-model="b.seo_title">
                                </div>
                            </div>


                            <div class="form-group">
                                <lable for="seo_description" class="col-sm-3 control-label" >
                                    Description
                                </lable >

                                <div class="col-sm-9">
                                    <textarea class="form-control"
                                              name="seo_description"
                                              data-name="seo_description"
                                              rows="3"
                                              placeholder="รายละเอียดหรือคำอธิบาย"
                                              spellcheck="false"
                                              style="resize: none; display: block;"
                                              ng-model="b.seo_description"></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <lable for="seo_keywords" class="col-sm-3 control-label" >
                                    Keywords
                                </lable >

                                <div class="col-sm-9">
                                    <input class="form-control"
                                           name="seo_keywords"
                                           id="seo_keywords"
                                           value=""
                                           type="text"
                                           placeholder="คำที่ใช้ในการค้นหา"
                                           ng-model="b.seo_keywords"/>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal-footer bg-info">

            <input type="hidden"
                   name="updated_by"
                   id="updated_by"
                   ng-model="b.update_by"
                   value="<?php echo Yii::app()->user->id; ?>" />

            <input type="hidden"
                name="id"
                ng-model="b.id"/>

            <button type="button" class="btn btn-primary" ng-click="b.btnConfirmUpdate();"
                    ng-disabled="myform.name.$invalid || myform.address.$invalid ">
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