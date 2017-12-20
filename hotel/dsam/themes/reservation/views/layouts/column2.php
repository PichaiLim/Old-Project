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
                                <div class="progress-percentage">
                                    <span class="text-warning" title="จอง"><i class="fa fa-fw fa-flag"></i>0</span>
                                    <span class="text-primary" title="เช็คอิน"><i class="fa fa-fw fa-arrow-right"></i>0</span>
                                    <span class="text-success" title="ว่าง"><i class="fa fa-fw fa-check"></i>25</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" style="width: 0.00%"></div>
                                <div class="progress-bar progress-bar-primary" style="width: 0.00%"></div>
                                <div class="progress-bar progress-bar-success" style="width: 100%"></div>
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