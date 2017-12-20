<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/13/16
 * Time: 12:35
 */
?>
<div>
    <div class="form-horizontal form-group">
        <select name="i.product" id="product" class="form-control" data-live-search="true"
                ng-model="i.product"
                ng-change="i.changeProduct(i.product, i.ProductSelectDataList);">
            <option value="" >เลือกวัสดุสิ้นเปลือง</option >
            <option
                ng-repeat="P in i.ProductSelectDataList" value="{{P.id}}">
                ({{P.quantity}}) - {{P.product_name}}
            </option >
        </select >
    </div>

    <div class="table-response form-inline">
        <table class="table table-striped table-condensed">
            <thead >
            <tr class="" >
                <th class="warning text text-center col-xs-8" >ประเภทวัสดุสิ้นเปลือง</th >
                <th class="warning text text-center col-xs-4" >จำนวน</th >
            </tr >
            </thead>

            <tbody >
            <tr >
                <td class="col-xs-8" >
                    <p class="form-control-static">
                        {{i.product_name}}
                    </p>
                </td >
                <td class="col-xs-4">
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               ng-attr-placeholder="{{i.quantity}}"
                               minlength="1"
                               min="1"
                               max="{{i.quantityMax}}"
                               maxlength="{{i.quantityMax}}"
                               required
                               aria-describedby="basic-addon2"
                               ng-model="i.quantity"
                               style="text-align: right;">
                        <span class="input-group-addon" id="basic-addon2">{{i.product_unit}}</span>
                    </div>
                </td >
            </tr >
            </tbody >
        </table>
    </div>
</div>