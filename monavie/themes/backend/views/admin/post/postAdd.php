<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>



<div class="span9 margin0">
    <h1 style="margin: 0px;"><?php echo $title_header; ?></h1>
    <hr style="margin: 0px;"/>
    <br/>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'postAdd-form',
        'enableClientValidation' => TRUE,
        'clientOptions' => array(
            'validataOnSubmit' => TRUE,
        ),
        'focus' => array($model, 'header'),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    ));
    ?>

    <table class="table table-striped">
        <tr>
            <td><?php echo $form->labelEx($model, 'header'); ?></td>
            <td>
                <?php echo $form->textField($model, 'header'); ?>
                <?php echo $form->error($model, 'header'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'imageHeader'); ?>
            </td>
            <td>
                <?php if ($model->imageHeader !== NULL): ?>
                    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/media/' . $model->imageHeader, NULL, array('class'=>'thumbnail img-polaroid', 'width'=>600,'height'=>400)); ?>
                <?php else: ?>
                    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/media/no_images7.gif', NULL, array('class'=>'thumbnail img-polaroid', 'width'=>600,'height'=>400)); ?>
                <?php endif; ?>
                <br/>
                <?php
                // ทำการเรียก CMultiFileUpload ในการเพิ่มไฟล์ จำนวนหลายๆไฟล์
                $this->widget('CMultiFileUpload', array(
                    'model' => $model, // model ที่ติดต่อกับ table ภายใน database
                    'attribute' => 'imageHeader', // ชื่อ fields ที่ต้องการ
                    'accept' => 'jpg|jpeg|gif|png', // extensions ที่สามารถ upload ได้
                    'denied' => 'ต้องเป็นนามสกุล .jpg .jpeg .gif .png เท่านั้น!', // คำที่ใช้เมื่อ extensions ของไฟล์ ไม่ถูกต้อง
                    'max' => 1, // สามารถอัพไฟล์ได้เท่าไร
                    'remove' => '[ลบออก]', // คำที่ใช่ในการลบ
                    'duplicate' => 'ไฟล์ห้ามซ้ำ', // คำที่ใช้เมื่อไฟล์ซ้ำ
                ));
                ?>
                <?php echo $form->error($model, 'imageHeader'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'detailHeader'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'detailHeader'); ?>
                <?php echo $form->error($model, 'detailHeader'); ?>
            </td>
        </tr>

        <tr>
            <td class="span2"><?php echo $form->labelEx($model, 'content'); ?></td>
            <td class="span10">
                <div>
                    <?php
                    $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model' => $model,
                        'attribute' => 'content',
                        'htmlOptions' => array(),
                    ));
                    ?>
                </div>

            </td>
        </tr>

        <tr>
            <td><?php echo $form->labelEx($model, 'status'); ?></td>
            <td>
                <?php
                $arr = array(
                    '0' => 'No Post',
                    '1' => 'Post'
                );
                echo $form->dropDownList($model, 'status', $arr);
                ?>
                <?php echo $form->error($model, 'status'); ?>
            </td>
        </tr>

        <tr>
            <td><?php echo $form->labelEx($model, 'id_page'); ?></td>
            <td><?php echo $form->dropDownList($model, 'id_page', Post::model()->getPages()); ?></td>
        </tr>

    </table>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <div class="text-center">

        <?php if (empty($_GET['id'])): ?>

            <button type="submit" name="submti" class="btn btn-primary">
                <i class="icon-check icon-white"></i> 
                <?php echo $title_header; ?>
            </button>

        <?php else: ?>

            <button type="submit" name="submti" class="btn btn-warning">
                <i class="icon-check icon-white"></i> 
                <?php echo $title_header; ?>
            </button>

        <?php endif; ?>

    </div>
    <?php $this->endWidget(); ?>
</div>