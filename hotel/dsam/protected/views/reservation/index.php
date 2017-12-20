<?php
/* @var $this ReservationController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">

            <div class="container-fluid">
                <div id="roomList" class="row">
                    <div class="col-xs-6 col-sm-4 col-md-3 mb" ng-repeat="room in r.roomList">
                        <a ng-class="r.checkStyleStatusRoom(room.active)"
                           class="shortcut-tiles has-footer dropdown-toggle m0"
                           href="#"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading"></div>
                            <div class="tiles-body">
                                <strong class="pull-left" ng-bind="room.name">room name</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    {{r.checkTextStatusRoom(room.active)}}
                                </strong>
                            </div>
                        </a>

                        <ul class="dropdown-menu tiles-dropdown">
                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/checkin/{{room.id}}/checkin"
                                   data-action="checkin/{{room.id}}/<?php echo date("Y-m-d");?>"
                                   data-toggle="modal"
                                   data-target="#profile"
                                    ng-click="r.clickCheck(room.id, room.name)">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/checkout/{{room.id}}/checkout"
                                   data-action="checkout/{{room.id}}/<?php echo date("Y-m-d");?>"
                                   data-toggle="modal"
                                   data-target="#profile"
                                    ng-click="r.clickCheckOut(room.id, room.name)">
                                    <i class="fa fa-fw fa-arrow-left"></i>
                                    เช็คเอ้าท์
                                </a>
                            </li>
                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/move/{{room.id}}/<?php echo date("Y-m-d");?>"
                                   data-action="reserve/{{room.id}}/<?php echo date("Y-m-d");?>"
                                   data-toggle="modal"
                                   data-target="#profile">
                                    <i class="fa fa-fw fa-exchange"></i>
                                    ย้ายห้อง
                                </a>
                            </li>
                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/reserve/{{room.id}}/reserve"
                                   data-action="reserve/{{room.id}}/<?php echo date("Y-m-d");?>"
                                   data-toggle="modal"
                                   data-target="#profile">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/cancel/{{room.id}}"
                                   data-action="cancel/{{room.id}}"
                                   data-toggle="modal"
                                   data-target="#profile">
                                    <i class="fa fa-fw fa-flag-o"></i>
                                    ยกเลิกการจอง
                                </a>
                            </li>
                            <li class="divider"></li>

                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/reciept/print/{{room.id}}" data-action="/reciept/print/{{room
                                .id}}">
                                    <i class="fa fa-fw fa-print"></i>
                                    พิมพ์ใบเสร็จ
                                </a>
                            </li>

                            <li ng-hide="room.active != ''" >
                                <a href="#/Reservation/toggle/{{room.id}}"
                                   data-action="toggle/{{room.id}}"
                                   ng-click="r.clickChangeActive(room.id, 'open')">
                                    <i class="fa fa-fw fa-check"></i>
                                    เปิดใช้งาน
                                </a>
                            </li>
                            <li ng-hide="room.active == ''" >
                                <a href="#/Reservation/toggle/{{room.id}}"
                                   data-action="toggle/{{room.id}}"
                                    ng-click="r.clickChangeActive(room.id, 'close')">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>

                    </div>

                    <!--
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">202</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/2/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/2/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/2">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">203</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/3/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/3/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/3">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">204</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/4/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/4/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/4">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">205</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/5/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/5/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/5">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">206</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/6/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/6/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/6">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">207</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/7/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/7/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/7">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">208</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/8/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/8/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/8">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">209</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/9/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/9/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/9">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">210</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/10/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/10/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/10">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">211</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/11/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/11/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/11">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">212</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/12/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/12/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/12">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">213</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/13/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/13/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/13">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">214</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/14/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/14/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/14">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">215</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/15/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/15/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/15">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">216</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/16/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/16/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/16">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">217</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/17/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/17/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/17">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">218</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/18/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/18/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/18">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">219</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/19/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/19/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/19">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">220</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/20/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/20/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/20">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">221</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/21/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/21/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/21">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">222</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/22/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/22/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/22">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">223</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/23/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/23/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/23">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">224</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/24/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/24/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/24">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3 mb">
                        <a class="shortcut-tiles tiles-success has-footer dropdown-toggle m0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading">
                            </div>
                            <div class="tiles-body">
                                <strong class="pull-left">225</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>
                                    ว่าง
                                </strong>
                            </div>
                        </a>
                        <ul class="dropdown-menu tiles-dropdown">
                            <li>
                                <a href="#" data-action="checkin/25/2016-07-19">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                    เช็คอิน
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="reserve/25/2016-07-19">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" data-action="toggle/25">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>
                    </div>-->
                </div>
            </div>
        </div>

    </div>
</div>