<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/13/16
 * Time: 12:39
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
                {{P.name}}
            </option >
        </select >
    </div>

    <div class="table-response form-inline">
        <table class="table table-striped table-condensed">
            <thead >
            <tr class="" >
                <th class="warning text text-center" >ประเภทวัสดุสิ้นเปลือง</th >
                <th class="warning text text-center" >ราคาต่อหน่วย</th >
                <th class="warning text text-center" >จำนวน</th >
                <th class="warning text text-center" >รวม</th >
                <th class="warning hidden ">&nbsp;</th>
            </tr >
            </thead>

            <tbody >
            <tr >
                <td >{{i.product_name}}</td >
                <td >
                    <input class="form-control"
                           type="number"
                           ng-attr-placeholder="{{i.price}}"
                           minlength="1"
                           min="1"
                            ng-model="i.price"
                           ng-change="i.changeKey(myForm);"
                           style="text-align: center;"/>
                </td >
                <td >
                    <div class="input-group">
                        <input type="number"
                               class="form-control"
                               placeholder="0.00"
                               minlength="1"
                               min="1"
                               required
                               aria-describedby="basic-addon2"
                                ng-model="i.quantity"
                            style="text-align: right;">
                        <span class="input-group-addon" id="basic-addon2">{{i.product_unit}}</span>
                    </div>
                </td >
                <td class="text text-center col-xs-2" >
                    <p class="form-control-static">
                        <strong class="text-primary">
                            {{i.price_total = i.quantity * i.price | number:2}}
                            <input name="price_total"
                                   id="price_total"
                                   ng-model="i.price_total"
                                   value="{{i.price_total}}" type="hidden" required />
                        </strong>
                    </p>
                </td >
                <td class="hidden" >
                    <div class="text text-center">
                    <button class="btn btn-default" ><i class="fa fa-fw fa-remove"></i></button >
                    </div>
                </td >
            </tr >
            </tbody >
        </table>
    </div>
</div>