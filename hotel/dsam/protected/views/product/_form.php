<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="row bootbox-body">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab" target="_top">
                <i class="fa fa-fw fa-info-circle"></i>
                ข้อมูลสินค้า
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > ชื่อสินค้า
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="name"
                           placeholder="ชื่อสินค้า"
                           maxlength="64"
                           required
                           ng-model="p.name">
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > ราคา
                </label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               id="number"
                               placeholder="0.00"
                               required
                               min="0.01"
                               step="0.01"
                               max="99999999"
                               ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/"
                               ng-model="p.price"
                                value="{{p.price}}">
                        <span class="input-group-addon" id="basic-addon2"><storng>บาท.</storng></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="unit" class="col-sm-2 control-label">
                    <span class="text-danger" >*</span > หน่วยนับที่เล็กที่สุด
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           id="unit"
                           placeholder="กรัม, กล้อง, ขวด ฯลฯ"
                           required
                           ng-maxlength="64"
                           ng-model="p.unit">
                </div>
            </div>

            <div class="form-group">
                <label for="active" class="col-sm-2 control-label">
                    สถานะ
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" ng-repeat="A in p.listDataActive">
                        <input type="radio"
                               name="active"
                               id="active"
                               value="{{A.value}}"
                               ng-model="p.active">
                        {{A.text}}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="published" class="col-sm-2 control-label">
                    เปิดใช้งาน
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" ng-repeat="P in p.listDataPublished">
                        <input type="radio"
                               name="published"
                               id="published"
                               value="{{P.value}}"
                               ng-model="p.published">
                        {{P.text}}
                    </label>
                </div>
            </div>

        </div>
    </div>

</div>