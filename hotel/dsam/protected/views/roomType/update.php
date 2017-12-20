<?php
/* @var $this RoomTypeController */
/* @var $model RoomType */
?>


<div class="modal-content">
    <div class="modal-header bg-info navbar-fixed-top">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">
            <span class="fa fa-fw fa-edit"></span>
            {{r.titleheader}}
            <span class="text-info">ประเภทห้อง</span>
            <span class="text-danger">'{{r.name}}'</span>
            <small class="text-muted">สาขา '{{r.branch_name}}'</small>
        </h4>
    </div>
    <div class="modal-body">
        <div class="row bootbox-body">

            <!-- Menu panel -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#/roomtype/update#tabPane0" role="tab" data-toggle="tab" aria-expanded="true">
                        <i class="fa fa-fw fa-info"></i>
                        ข้อมูลประเภทห้อง
                    </a>
                </li>
                <li role="presentation">
                    <a href="#/roomtype/update#tabPane1" role="tab" data-toggle="tab">
                        SEO
                    </a>
                </li>
            </ul>

            <!--  Form content -->
            <div class="tab-content">
                <div class="tab-pane active" id="tabPane0" role="tabepanel">


                    <form class="form-horizontal" autocomplete="off" role="form">
                        <span ng-show="r.price.$error.number">Hey! No letters, buddy!</span>
                        <div class="hidden alert alert-danger" id="alert-msg">
                            <span class="glyphicon glyphicon-alert"></span>
                            {{r.msg}}
                        </div>
                        <input type="hidden" ng-model="r.id" ng-value="r.id" />

                        <div class="form-group">
                            <?php echo CHtml::label('สาขา', null, array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    <strong>
                                        <span ng-cloak="r.branch_name">{{ r.branch_name }}</span>
                                        <input type="hidden" ng-model="r.branch_id"
                                               ng-value="r.branch_id"/>
                                    </strong>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label" >
                                <span class="text-danger">*</span>
                                ชื่อ
                            </label >
                            <div class="col-sm-9">
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       id="name"
                                       required="required"
                                       autofocus="true"
                                       size="60"
                                       maxlength="64"
                                       placeholder="กรุณาใส่ชื่อประเภทห้อง"
                                       ng-model="r.name"
                                       ng-required="r.name"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-sm-3 control-label" >
                                <span class="text-danger">*</span>
                                ราคา
                            </label >
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="number"
                                           name="price"
                                           class="form-control"
                                           id="price"
                                           required="required"
                                           autofocus="true"
                                           size="10"
                                           min="0"
                                           maxlength="10"
                                           placeholder="0.00"
                                           ng-model="r.price"
                                           ng-required="r.price"/>
                                        <span class="input-group-addon" id="basic-addon2">
                                            <strong>
                                                บาท
                                            </strong>
                                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deposit" class="col-sm-3 control-label" >
                                ค่ามัดจำ
                            </label >
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="number"
                                           name="deposit"
                                           class="form-control"
                                           id="deposit"
                                           size="60"
                                           min="0"
                                           maxlength=""
                                           value="0"
                                           placeholder="0"
                                           ng-model="r.deposit"/>
                                        <span class="input-group-addon" id="basic-addon2">
                                            <strong>
                                                บาท
                                            </strong>
                                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="remark" class="col-sm-3 control-label" >
                                หมายเหตุ
                            </label >
                            <div class="col-sm-9">
                                        <textarea name="remark"
                                                  id="remark"
                                                  class="form-control"
                                                  cols="30"
                                                  rows="5"
                                                  placeholder="หมายเหตุ หรือ ข้อมูลเพิ่มเติม"
                                                  ng-model="r.remark"
                                                  ng-bind="r.remark"></textarea >
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="active" class="col-sm-3 control-label" >
                                สถานะ
                            </label >
                            <div class="col-sm-9">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-success active">
                                        <input type="radio"
                                               name="active"
                                               id="active"
                                               ng-model="r.active"
                                               autocomplete="off"
                                               value="1">
                                        <i class="fa fa-check"></i>
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio"
                                               name="active"
                                               id="active"
                                               ng-model="r.active"
                                               autocomplete="off"
                                               value="">
                                        <i class="fa fa-remove"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="published" class="col-sm-3 control-label" >
                                เผยแพร่
                            </label >
                            <div class="col-sm-9">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-success active">
                                        <input type="radio"
                                               name="published"
                                               id="published"
                                               autocomplete="off"
                                               checked
                                               value="1"
                                               ng-model="r.published"
                                               ng-click="r.radio_published(1);">
                                        Yes
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio"
                                               name="published"
                                               id="published"
                                               autocomplete="off"
                                               checked
                                               value=""
                                               ng-model="r.published">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>

                </div > <!-- /Tab2 -->


                        <!-- tab 1 -->
                <div class="tab-pane" id="tabPane1" role="tabepanel">

                    <form action="#" class="form-horizontal" role="form"  autocomplete="off">


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
                                       placeholder="หัวข้อ"
                                       spellcheck="false"
                                       style="display: block;"
                                       ng-model="r.seo_title">
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
                                              placeholder="รายละเอียด"
                                              spellcheck="false"
                                              style="resize: none; display: block;"
                                              ng-model="r.seo_description"></textarea>
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
                                       placeholder="Keyword"
                                       ng-model="r.seo_keywords"/>
                            </div>
                        </div>

                    </form >

                </div >

            </div>

        </div>
    </div>

    <div class="modal-footer bg-info">

        <input type="hidden"
               name="updated"
               id="updated"
               value="<?php echo new CDbExpression('NOW()'); ?>" />
        <input type="hidden"
               name="updated_by"
               id="updated_by"
               data-value="<?php echo Yii::app()->user->id; ?>"
               value="<?php echo Yii::app()->user->id; ?>"
                ng-model="r.updated_by"/>

        <button type="button" class="btn btn-primary" ng-click="r.Update(r.id);">
            <span class="fa fa-fw fa-check"></span>
            บันทึก
        </button>

        <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="fa fa-fw fa-close"></span>
            ยกเลิก
        </button>

    </div>
</div>