<div ng-controller="BuildingController as b">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8">
<!--                <button class="btn btn-default mt0 width-64px" data-toggle="modal" data-target="#myModalCreate">-->
<!--                    <i class="fa fa-plus"></i>&nbsp;-->
<!--                    เพิ่ม-->
<!--                </button>-->
                <a href="#"
                   class="btn btn-default mt0 width-64px">
                    <i class="fa fa-plus"></i>
                    &nbsp;เพิ่ม
                </a>
            </div>
            <div class="col-xs-8">&nbsp;</div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>อาคาร</h2>
                        <div class="panel-ctrls" style="line-height: normal;">
                            <div class="dataTables_length pull-left" id="DataTables_Table_0_length">
                                &nbsp;
                            </div>
                            <i class="separator pull-left"></i>
                            <div id="DataTables_Table_0_filter" class="dataTables_filter pull-left">
                                <label class="panel-ctrls-center">
                                    <input type="search"
                                           class="form-control"
                                           placeholder="ค้นหาข้อมูล"
                                           aria-controls="DataTables_Table_0"
                                            ng-model="search">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="panel-body panel-no-padding">
                        <table id="example"
                               class="table table-condensed table-bordered table-hover dataTable no-footer"
                               cellspacing="0"
                               width="100%">
                            <thead>
                                <tr role="row">
                                    <th class="text-center sorting">

                                        ชื่ออาคาร
                                    </th>
                                    <th class="text-center sorting">

                                        หมายเหตุ
                                    </th>
                                    <th class="text-center sorting">

                                        เพิ่มเมื่อ

                                    </th>
                                    <th class="text-center sorting">

                                        แก้ไขเมื่อ

                                    </th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr >
                                    <td>
                                        <a href = "#" >
                                            อาคาร
                                        </a >
                                    </td>

                                    <td>
                                        หมายเหตุ
                                    </td>

                                    <td >
                                        {{ list.created }}
                                        <div class="text-right" >
                                            <a href="#{{list.created_by}}" >
                                                {{list.created_by}}
                                            </a >
                                        </div >
                                    </td>
                                    <td >
                                        {{ list.updated }}
                                        <div class="text-right" >
                                            <a href="#{{list.updated_by}}" >
                                                {{list.updated_by}}
                                            </a >
                                        </div >
                                    </td>
                                    <td class="col-xs-1">
                                        <div class="btn-group btn-group-justified">
                                            <a href="#"
                                               class="btn btn-default item-edit-btn"
                                               data-id="{{list.id}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#"
                                               class="btn btn-default item-remove-btn"
                                               data-id="{{list.id}}">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- footer -->
                    <div class="panel-body has-pagination p">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" role="status" aria-live="polite">
<!--                                    กำลังแสดงหน้าที่ 1 จากทั้งหมด 1 หน้า-->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    <dir-pagination-controls
                                        max-size="5"
                                        direction-links="true"
                                        boundary-links="true">
                                    </dir-pagination-controls>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end footer -->
                </div>
            </div>
        </div>
    </div>

</div>



<!- Modal -->
<div class="bootbox modal modal-fw-tabs dialog-lg in" id="myModalCreate" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="lang-switcher pull-right">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm lang-btn active" href="#" data-lang="th">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/assets/famfamfam_flag_icons/png/th.png">
                            &nbsp;ภาษาไทย
                        </a>
                        <a class="btn btn-info btn-sm lang-btn" href="#" data-lang="en">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/assets/famfamfam_flag_icons/png/us.png">
                            &nbsp;
                            <span>
                                English
                            </span>
                        </a>
                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="lang-menuitem active" role="presentation">
                                <a role="menuitem" href="#" tabindex="-1" data-lang="th">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/famfamfam_flag_icons/png/th.png">
                                    &nbsp;ภาษาไทย
                                </a>
                                </li>
                            <li class="lang-menuitem" role="presentation">
                                <a role="menuitem" href="#" tabindex="-1" data-lang="en">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/assets/famfamfam_flag_icons/png/us.png">
                                    &nbsp;ภาษาอังกฤษ
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <h4 class="modal-title">Modal title</h4>
            </div>


            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form-3" action="" class="form-horizontal">
                        <div class="tab-container tab- tab-" role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tabPane6" role="tab" data-toggle="tab" aria-expanded="true">
                                        ข้อมูลอาคาร
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#tabPane7" role="tab" data-toggle="tab">
                                        SEO
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabPane6" role="tabpanel">
                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">
                                            สาขา
                                        </label>

                                        <div class="col-xs-9">
                                            <p class="form-control-static">
                                                <strong>ทดสอบการสร้างสาขา</strong>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label required">
                                            ชื่อ&nbsp;
                                            <span class="label lang-label label-primary">
                                                TH
                                            </span>
                                        </label>

                                        <div class="col-xs-4">
                                            <input class="form-control formdata-th" name="name[th]" data-name="name" type="text" maxlength="64" value="" placeholder="" spellcheck="false" style="display: block;">
                                            <input class="form-control  formdata-en" name="name[en]" data-name="name" type="text" maxlength="64" value="" placeholder="" spellcheck="false" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">
                                            หมายเหตุ&nbsp;
                                            <span class="label lang-label label-primary">
                                                TH
                                            </span>
                                        </label>

                                        <div class="col-xs-9">
                                            <textarea class="form-control formdata-th" name="remark[th]" data-name="remark" rows="3" placeholder="" spellcheck="false" style="resize: none; display: block;"></textarea>

                                            <textarea class="form-control formdata-en" name="remark[en]" data-name="remark" rows="3" placeholder="" spellcheck="false" style="resize: none; display: none;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">สถานะ</label>
                                        <div class="col-xs-9">
                                            <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-"><div class="bootstrap-switch-container">
                                                    <span class="bootstrap-switch-handle-on bootstrap-switch-success">
                                                        <i class="fa fa-check"></i>
                                                    </span>

                                                    <label class="bootstrap-switch-label">&nbsp;</label>

                                                    <span class="bootstrap-switch-handle-off bootstrap-switch-danger">
                                                        <i class="fa fa-remove"></i>
                                                    </span>

                                                    <input type="checkbox" name="active" value="1" checked="" data-plugin="switch" data-size="" data-on-color="success" data-off-color="danger" data-on-text="<i class=&quot;fa fa-check&quot;></i>" data-off-text="<i class=&quot;fa fa-remove&quot;></i>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">เผยแพร่</label>
                                        <div class="col-xs-9">
                                            <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-">
                                                <div class="bootstrap-switch-container">
                                                    <span class="bootstrap-switch-handle-on bootstrap-switch-success">Yes</span>
                                                    <label class="bootstrap-switch-label">&nbsp;</label>

                                                    <span class="bootstrap-switch-handle-off bootstrap-switch-default">No</span>
                                                    <input type="checkbox" name="published" value="1" checked="" data-plugin="switch" data-size="" data-on-color="success" data-off-color="default" data-on-text="Yes" data-off-text="No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tabPane7" role="tabpanel">
                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">
                                            Title&nbsp;
                                            <span class="label lang-label label-primary">TH</span>
                                        </label>

                                        <div class="col-xs-9">
                                            <input class="form-control  formdata-th" name="seo_title[th]" data-name="seo_title" type="text" maxlength="255" value="" placeholder="" spellcheck="false" style="display: block;">

                                            <input class="form-control  formdata-en" name="seo_title[en]" data-name="seo_title" type="text" maxlength="255" value="" placeholder="" spellcheck="false" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">Description&nbsp;
                                            <span class="label lang-label label-primary">TH</span>
                                        </label>

                                        <div class="col-xs-9">
                                            <textarea class="form-control formdata-th" name="seo_description[th]" data-name="seo_description" rows="3" placeholder="" spellcheck="false" style="resize: none; display: block;"></textarea>

                                            <textarea class="form-control formdata-en" name="seo_description[en]" data-name="seo_description" rows="3" placeholder="" spellcheck="false" style="resize: none; display: none;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group pr20">
                                        <label class="col-xs-3 control-label ">Keywords&nbsp;
                                            <span class="label lang-label label-primary">TH</span>
                                        </label>

                                        <div class="col-xs-9">
                                            <div class="tokenfield form-control" style="width: 100%; display: block;">
                                                <input class="form-control form-control-tokenfield formdata-th" name="seo_keywords[th]" data-name="seo_keywords" type="text" maxlength="255" value="" placeholder="" spellcheck="false" tabindex="-1" style="position: absolute; left: -10000px;">

                                                <input type="text" tabindex="-1" style="position: absolute; left: -10000px;">
                                                <input type="text" class="token-input" autocomplete="off" placeholder="" id="1465269805005134-tokenfield" tabindex="0" style="min-width: 60px; width: 100%;">
                                            </div>
                                            <div class="tokenfield form-control" style="width: 100%; display: none;">
                                                <input class="form-control form-control-tokenfield formdata-en" name="seo_keywords[en]" data-name="seo_keywords" type="text" maxlength="255" value="" placeholder="" spellcheck="false" tabindex="-1" style="position: absolute; left: -10000px;">
                                                <input type="text" tabindex="-1" style="position: absolute; left: -10000px;">
                                                <input type="text" class="token-input" autocomplete="off" placeholder="" id="1465269805009114-tokenfield" tabindex="0" style="min-width: 60px; width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="submit" style="display: none;">
                    </form>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->