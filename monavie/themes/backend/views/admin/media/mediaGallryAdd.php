<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
?>
<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $title_header; ?></h1>
        <hr/>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'profile-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            ),
            'focus' => array($model, 'name'),
        ));
        ?>
        <div class="span12">
            <table class="table table-striped table-hover">
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'name'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model, 'name'); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'content'); ?>
                    </td>
                    <td>
                        <?php echo $form->textArea($model, 'content'); ?>
                        <?php echo $form->error($model, 'content'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'type'); ?>
                    </td>
                    <td>
                        <?php
                        $arrList = array(
                            '1' => 'Image',
                            '2' => 'Video'
                        );

                        echo $form->radioButtonList($model, 'type', $arrList, array("Checked" => TRUE));
                        ?>
                        <?php echo $form->error($model, 'type'); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'image');?>
                    </td>
                    <td>
                        <?php
                        // extension image
                        // ทำการเรียก CMultiFileUpload ในการเพิ่มไฟล์ จำนวนหลายๆไฟล์
                        $this->widget('CMultiFileUpload', array(
                            'model' => $model, // model ที่ติดต่อกับ table ภายใน database
                            'attribute' => 'image', // ชื่อ fields ที่ต้องการ
                            'accept' => 'jpg|jpeg|gif|png', // extensions ที่สามารถ upload ได้
                            'denied' => 'ต้องเป็นนามสกุล .jpg .jpeg .gif .png เท่านั้น!', // คำที่ใช้เมื่อ extensions ของไฟล์ ไม่ถูกต้อง
                            'max' => 1, // สามารถอัพไฟล์ได้เท่าไร
                            'remove' => '[ลบออก]', // คำที่ใช่ในการลบ
                            'duplicate' => 'ไฟล์ห้ามซ้ำ', // คำที่ใช้เมื่อไฟล์ซ้ำ
                        ));
                        ?>
                        <?php echo $form->error($model,'image');?>
                    </td>
                </tr>
            </table>

            <div class="row-fluid">
                <?php echo $form->hiddenField($model, 'id'); ?>
                <div class="sapn12 text-center">
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="icon-check icon-white"></i> 
                        Submit
                    </button>
                </div>
            </div>
        </div>
        <?php
        $this->endWidget();
        ?>
    </div>
</div>