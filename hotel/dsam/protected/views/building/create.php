<?php
/* @var $this BuildingController */
/* @var $model Building */

?>

<form action="#"
      class="form-horizontal"
      name="formRoom"
      id="formRoom"
      role="form"
      autocomplete="off">
    <div class="modal-content">
        <div class="modal-header bg-info navbar-fixed-top">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">
                <span class="fa fa-fw fa-plus"></span>
                {{b.titleheader}}
            </h4>
        </div>
        <div class="modal-body">
            <div class="row bootbox-body">

                <!-- Menu panel -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#/building/create#tabPane0" role="tab" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-fw fa-archive"></i>
                            ข้อมูลชั้น
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#/building/create#tabPane1" role="tab" data-toggle="tab">
                            SEO
                        </a>
                    </li>
                </ul>

                <!--  Form content -->

                <div class="tab-content">

                    <div class="tab-pane active" id="tabPane0" role="tabepanel">

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="branch_id" >สาขา</label >
                            <div class="col-xs-9">
                                <p class="form-control-static">
                                    <strong>
                                        <span><?php echo @$_SESSION['branch'];?></span>
                                        <input type="hidden"
                                               ng-required="b.branch_id"
                                               ng-model="b.branch_id"
                                               ng-value="b.branch_id"/>
                                    </strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="name" >
                                <span class="text-danger">*</span> ชื่อ
                            </label >
                            <div class="col-xs-9">
                                <input class="form-control"
                                       name="name"
                                       id="name"
                                       type="text" required
                                    ng-model="b.name"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="remark" >
                                หมายเหตุ
                            </label >
                            <div class="col-xs-9">
                                <textarea name="remark" id="remark"
                                          class="form-control"
                                          cols="30" rows="3"
                                          ng-model="b.remark"></textarea >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="active" >
                                สถานะ
                            </label >
                            <div class="col-xs-9">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-success active">
                                        <input type="radio"
                                               name="active"
                                               id="active"
                                               autocomplete="off" checked
                                               value="1"
                                               ng-model="b.active">
                                        <span class="fa fa-fw fa-check"></span>
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio"
                                               name="active"
                                               id="active"
                                               autocomplete="off"
                                               value=""
                                               ng-model="b.active">
                                        <span class="fa fa-fw fa-remove"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="published" >
                                เปิดใช้งาน
                            </label >
                            <div class="col-xs-9">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-success active">
                                        <input type="radio"
                                               name="published"
                                               id="published"
                                               autocomplete="off" checked
                                               ng-value="1"
                                               ng-model="b.published">
                                        Yes
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio"
                                               name="published"
                                               id="published"
                                               autocomplete="off"
                                               ng-value=""
                                               ng-model="b.published">
                                        No
                                    </label>{{"radio: "+b.published.value | json}}
                                </div>
                            </div>
                        </div>

                    </div > <!-- /Tab2 -->


                            <!-- tab 1 -->
                    <div class="tab-pane" id="tabPane1" role="tabepanel">

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="seo_title" >
                                Title
                            </label >
                            <div class="col-xs-9">
                                <input class="form-control"
                                       name="seo_title"
                                       id="seo_title"
                                       type="text"
                                       maxlength="255"
                                       value=""
                                       placeholder="หัวข้อ"
                                       spellcheck="false"
                                       style="display: block;"
                                       ng-model="b.seo_title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label text-capitalize" for="seo_description" >
                                Description
                            </label >
                            <div class="col-xs-9">
                                        <textarea name="seo_description" id="seo_description" class="form-control"
                                                  cols="30" rows="10" ng-model="b.seo_description"
                                                  placeholder="รายละเอียดท่เกี่ยวข้อง" spellcheck="false"></textarea >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="Keywords" >
                                Keywords
                            </label >
                            <div class="col-xs-9">
                                <input class="form-control"
                                       name="Keywords"
                                       id="Keywords"
                                       type="text"
                                       value=""
                                       placeholder="Keyword"
                                       style="display: block;"
                                       ng-model="b.seo_keywords">
                            </div>
                        </div>

                    </div >

                </div>

            </div>
        </div>

        <div class="modal-footer bg-info">
            <input type="hidden"
                   name="created"
                   id="created"
                   value="<?php echo new CDbExpression('NOW()'); ?>" />
            <input type="hidden"
                   name="created_by"
                   id="created_by"
                   ng-model="b.created_by"
                   data-value="<?php echo Yii::app()->user->id; ?>"
                   value="<?php echo Yii::app()->user->id; ?>"/>

            <input type="hidden"
                   name="updated"
                   id="updated"
                   value="" />
            <input type="hidden"
                   name="updated_by"
                   id="updated_by"
                   value="" />

            <button type="button" class="btn btn-primary" ng-click="b.SaveCreate()">
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