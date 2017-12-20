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
                        <a ng-class="r.checkStyleStatusRoom(room.roomData[0].status)"
                           class="shortcut-tiles has-footer dropdown-toggle m0"
                           data-toggle="dropdown"
                           style="width: 230px;"
                           aria-haspopup="true" aria-expanded="false">
                            <div class="tiles-heading" ng-if="room.roomData[0].endDate != room.selectDate && room.roomData[0].endDate != ''">ถึง {{room.roomData[0].endDate}}</div>
                            <div class="tiles-heading" ng-if="room.roomData[0].endDate == room.selectDate || room.roomData[0].endDate == ''"></br></div>
                            <div class="tiles-body">
                                <strong class="pull-left" ng-bind="room.name">room name</strong>
                            </div>
                            <div class="tiles-footer">
                                <strong>

                                    {{r.checkTextStatusRoom(room.roomData[0].status)}}
                                </strong>
                            </div>
                        </a>

                        <ul class="dropdown-menu tiles-dropdown">
                            <li ng-show="room.roomData[0].status == 3 || room.roomData[0].status == 5 || room.roomData[0].status == 1 || room.roomData[0].status == 4" >
                                <a ng-click="r.manageRoomModal(room.id, room.name, 2, room.roomData[0].reservationId, 1)">
                                    <i class="fa fa-fw fa-flag"></i>
                                    เช็คอิน
                                </a>
                            </li>
                           <!-- <li ng-show="room.roomData[0].status == 2" >
                                <a ng-click="r.manageRoomModal(room.id, room.name, 3, room.roomData[0].reservationId, 1)">
                                    <i class="fa fa-fw fa-flag"></i>
                                    เช็คเอ้าท์
                                </a>
                            </li> -->
                            <li ng-show="room.roomData[0].status == 2 || room.roomData[0].status == 4" >
                                 <a ng-click="r.manageRoomModal(room.id, room.name, 5, room.roomData[0].reservationId, 1)">
                                    <i class="fa fa-fw fa-exchange"></i>
                                    ย้ายห้อง
                                </a>
                            </li>

                            <!-- <li ng-show="room.roomData[0].status == 1 || room.roomData[0].endDate == room.selectDate" > -->
                            <li ng-show="room.roomData[0].status == 1">
                                <a ng-click="r.manageRoomModal(room.id, room.name, 4, room.roomData[0].reservationId, 1)">
                                    <i class="fa fa-fw fa-flag"></i>
                                    จอง
                                </a>
                            </li>
                            <li ng-show="room.roomData[0].status == 4">
                                <a ng-click="r.manageRoomModal(room.id, room.name, 6, room.roomData[0].reservationId, 1)">
                                    <i class="fa fa-fw fa-flag"></i>
                                    ยกเลิกการจอง
                                </a>
                            </li>
                            <li class="divider"></li>

                            <li ng-hide="room.roomData[0].status == 1 || room.roomData[0].status == ''" >
                                <a ng-click="r.openRecieptPrint(room.roomData[0].reservationId)" data-action="/reciept/print/{{room
                                .id}}">
                                    <i class="fa fa-fw fa-print"></i>
                                    พิมพ์ใบเสร็จ
                                </a>
                            </li>

                            <li ng-hide="room.roomData[0].status != ''" >
                                <a href="#/Reservation/toggle/{{room.id}}"
                                   data-action="toggle/{{room.id}}"
                                   ng-click="r.clickChangeActive(room.id, 'open')">
                                    <i class="fa fa-fw fa-check"></i>
                                    เปิดใช้งาน
                                </a>
                            </li>
                            <li ng-show="room.roomData[0].status == 1" >
                                <a href="#/Reservation/toggle/{{room.id}}"
                                   data-action="toggle/{{room.id}}"
                                    ng-click="r.clickChangeActive(room.id, 'close')">
                                    <i class="fa fa-fw fa-remove"></i>
                                    ปิดปรับปรุง
                                </a>
                            </li>
                        </ul>

                    </div>



                </div>

            </div>

        </div>

    </div>

</div>