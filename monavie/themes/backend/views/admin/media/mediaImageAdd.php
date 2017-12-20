<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
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
        ));
        ?>

        <div class="row-fluid">
            <div class="span7 border1 box-shadow">
                <div class="span12 page-header text-center">
                    <h2>Select Image <br/> <small class="text-warning">* Image Support [ JPG | PNG ]</small></h2>
                </div>
                <div class="span12 text-center">
                    <img src="<?php echo $baseUrl; ?>/images/media/no_images7.gif"/>
                </div>
                <div class="span12">
                    <div class="span4 text-right">
                        <?php echo $form->labelEx($model, 'file' . ' :'); ?>
                    </div>
                    <div class="span8">
                        <?php
                        // ทำการเรียก CMultiFileUpload ในการเพิ่มไฟล์ จำนวนหลายๆไฟล์
                        $this->widget('CMultiFileUpload', array(
                            'model' => $model, // model ที่ติดต่อกับ table ภายใน database
                            'attribute' => 'file', // ชื่อ fields ที่ต้องการ
                            'accept' => 'jpg|jpeg|gif|png', // extensions ที่สามารถ upload ได้
                            'denied' => 'ต้องเป็นนามสกุล .jpg .jpeg .gif .png เท่านั้น!', // คำที่ใช้เมื่อ extensions ของไฟล์ ไม่ถูกต้อง
                            //'max' => 4, // สามารถอัพไฟล์ได้เท่าไร
                            'remove' => '[ลบออก]', // คำที่ใช่ในการลบ
                            'duplicate' => 'ไฟล์ห้ามซ้ำ', // คำที่ใช้เมื่อไฟล์ซ้ำ
                        ));
                        ?>
                    </div>
                    <div class="span12">
                        <?php echo $form->error($model, 'file', array('class' => 'alert alert-error span11 text-center', 'style' => 'margin-left:0px;')); ?>
                    </div>
                </div>
            </div>

            <div class="span5 border1 box-shadow" style="padding: 10px;">
                <div class="row-fluid">

                    <div class="span12" style=" border-bottom: 1px solid grey;">
                        <div class="span4">
                            Gallery Name :
                        </div>

                        <div class="span8">
                            <?php if (Gallery::model()->getListGallery() == NULL): ?>
                                <span class="badge badge-important">NONE</span>
                            <?php else: ?>
                                <?php echo $form->dropDownList($model, 'id_gallery', Gallery::model()->getListGallery('1')); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="span12 text-center" style="margin-left: 0px; padding-top: 10px;">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="icon-upload icon-white"></i>
                            Save Upload File Image
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>