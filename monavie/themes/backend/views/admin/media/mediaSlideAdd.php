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
            'focus' => array($model, 'name'),
        ));
        ?>
        <?php echo $form->hiddenField($model, 'id'); ?>
        <div class="row-fluid">
            <div class="span7 border1 box-shadow">
                <div class="span12 page-header text-center" style="padding: 5px;">
                    <h2>Select Image
                        <br/> 
                        <small class="text-warning">* Image Support : JPG | JPEG | GIF | PNG </small>
                        <br/>
                        <small class="text-error">[Width : 980px ; Height: 300px;]</small>
                    </h2>
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
                            //'max' => 2, // สามารถอัพไฟล์ได้เท่าไร
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
                    <?php if (!empty($id)): ?>
                        <div class="span12" style="margin-left: 0px;">
                            <div class="span4">
                                <?php echo $form->labelEx($model, 'name'); ?>
                            </div>

                            <div class="span8">
                                <?php echo $form->textField($model, 'name') ?>
                                <?php echo $form->error($model, 'name'); ?>
                            </div>
                        </div>

                        <div class="span12" style="margin-left: 0px;">
                            <div class="span4">
                                <?php echo $form->labelEx($model, 'title'); ?>
                            </div>

                            <div class="span8">
                                <?php echo $form->textField($model, 'title') ?>
                            </div>
                        </div>

                        <div class="span12" style=" border-bottom: 1px solid grey; margin-left: 0px;">
                            <div class="span4">
                                <?php echo $form->labelEx($model, 'content'); ?>
                            </div>

                            <div class="span8">
                                <?php echo $form->textField($model, 'content') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="span12 text-center" style="margin-left: 0px; padding-top: 10px;">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="icon-upload icon-white"></i>
                            Submit
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'editor1', {
    toolbar: 'Basic',
    uiColor: '#9AB8F3'
});
</script>