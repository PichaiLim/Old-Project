<?php
/* @var $this RoomTypeController */
/* @var $model RoomType */
/* @var $form CActiveForm */
?>
<form class="form-horizontal" autocomplete="off" role="form">

    <div class="form-group">
        <?php echo CHtml::label('สาขา', null, array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
            <p class="form-control-static">
                <strong>
                    <?php echo $_SESSION['branch']; ?>
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
                placeholder="กรุณาใส่ชื่อประเภทห้อง"/>
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
                       placeholder="0.00"/>
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
                       placeholder="0"/>
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
            <textarea name="remark" id="remark" class="form-control" cols="30" rows="5"
                      placeholder="หมายเหตุ หรือ ข้อมูลเพิ่มเติม"></textarea >
        </div>
    </div>


    <div class="form-group">
        <label for="active" class="col-sm-3 control-label" >
            สถานะ
        </label >
        <div class="col-xs-9">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked value="1">
                    <i class="fa fa-check"></i>
                </label>
                <label class="btn btn-danger">
                    <input type="radio" name="options" id="option2" autocomplete="off" value="">
                    <i class="fa fa-remove"></i>
                </label>
            </div>
            <!--
            <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-">
                <div class="bootstrap-switch-container">
                    <span class="bootstrap-switch-handle-on bootstrap-switch-success">
                        <i class="fa fa-check"></i>
                    </span>

                    <label class="bootstrap-switch-label">&nbsp;</label>

                    <span class="bootstrap-switch-handle-off bootstrap-switch-danger">
                        <i class="fa fa-remove"></i>
                    </span>

                    <input type="checkbox"
                           name="active"
                           value="1"
                           checked=""
                           data-plugin="switch"
                           data-size=""
                           data-on-color="success"
                           data-off-color="danger"
                           data-on-text="<i class=&quot;fa fa-check&quot;></i>"
                           data-off-text="<i class=&quot;fa fa-remove&quot;></i>">
                </div>
            </div> -->
        </div>
    </div>

    <div class="form-group">
        <label for="published" class="col-sm-3 control-label" >
            เผยแพร่
        </label >
        <div class="col-xs-9">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked value="1">
                    Yes
                </label>
                <label class="btn btn-danger">
                    <input type="radio" name="options" id="option2" autocomplete="off" value="">
                    No
                </label>
            </div>

            <!--
            <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-">
                <div class="bootstrap-switch-container">
                    <span class="bootstrap-switch-handle-on bootstrap-switch-success">Yes</span>

                    <label class="bootstrap-switch-label">&nbsp;</label>

                    <span class="bootstrap-switch-handle-off bootstrap-switch-default">No</span>

                    <input type="checkbox"
                           name="published"
                           value="1"
                           checked=""
                           data-plugin="switch"
                           data-size=""
                           data-on-color="success"
                           data-off-color="default"
                           data-on-text="Yes"
                           data-off-text="No">
                </div>
            </div> -->
        </div>
    </div>

</form>

