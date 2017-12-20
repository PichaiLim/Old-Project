<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <div class="static-sidebar-wrapper sidebar-default">
        <div class="static-sidebar" style="top: 50px;">
            <div class="sidebar">
                <div class="widget">
                    <header class="widget-heading">วันที <?php echo date('d M Y'); ?>่</header>
                    <div class="widget-body p10">
                        <div id="datepicker-left"></div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="widget">
                    <span class="widget-heading">อาคาร</span>
                    <div class="widget-body p10">
                        <select name="building" id="building"
                                class="form-control"
                                ng-model="r.building_id"
                                ng-change="r.changeFloor(r.building_id);">
                            <option ng-repeat="b in r.buildingList" value="{{b.id}}"
                                ng-selected="r.building_id == b.id">{{b.name}}</option >
                        </select >
                    </div>
                    <div id="floorList" ng-repeat="f in r.floorList">

                        <div ng-class="{'floor-item-selected':r.classSelectFloor()}"
                             ng-click="r.clickSelectFloor(f.id)"
                             class="contextual-progress floor-item"
                             data-floor-id="{{f.id}}">
                            <div class="clearfix">
                                <div class="progress-title">{{f.name}}</div>
                                <div style="float: right;">
                                    <span title="ว่าง">
                                        <i class="fa fa-fw block-status-room-empty"></i> <span class="text-color-empty">{{f.emptyRoom}}</span>
                                    </span>
                                    <span title="จอง">
                                        <i class="fa fa-fw block-status-room-reservated"></i><span class="text-color-reservated" >{{f.reservationRoom}}</span>
                                    </span>
                                    <span title="เช็คอิน">
                                        <i class="fa fa-fw block-status-room-checkin" ></i><span class="text-color-checkin" >{{f.checkinRoom}}</span>
                                    </span>
                                    <span title="ปิดปรับปรุง">
                                        <i class="fa fa-fw block-status-room-close" ></i><span class="text-color-roomclose">{{f.closeRoom}}</span>
                                    </span>

                                </div>

                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" style="width: 0.00%"></div>
                                <div class="progress-bar progress-bar-primary" style="width: 0.00%"></div>
                                <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-body p10">
                        <div class="clearfix" style="margin-top: 5px;">
                            <div class="progress-percentage">
                                <span title="จอง">
                                    <i class="fa fa-fw block-status-room-empty"></i> <span class="text-color-empty">ว่าง</span>
                                </span>
                                <span title="ว่าง">
                                    <i class="fa fa-fw block-status-room-reservated"></i><span class="text-color-reservated" >อยู่</span>
                                </span>
                                <span title="เช็คอิน">
                                    <i class="fa fa-fw block-status-room-checkin" ></i><span class="text-color-checkin" >จอง</span>
                                </span>
                                <span title="เช็คอิน">
                                    <i class="fa fa-fw block-status-room-close" ></i><span class="text-color-roomclose">ซ่อม</span>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="static-content-wrapper">
        <div class="static-content">
            <div class="page-content">
                <ol class="breadcrumb">

                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/'); ?>">หน้าแรก</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/');?>/Branch/Index/<?=$_GET['id'];?>#/"><?php echo @$_SESSION['branch']; ?></a>
                    </li>

                </ol>

                <div class="page-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div id="roomList" class="row">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>