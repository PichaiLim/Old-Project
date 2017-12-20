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
        
        <?php echo $form->hiddenField($model,'id'); ?>

        <div class="row-fluid">
            <div class="span7 border1 box-shadow">
                <div class="span12 page-header text-center" style="padding: 5px;">
                    <h2>Select Video <br/> <small class="text-warning">* Video Support : FLV | SWF | F4V | MOV | MP4 | MP3 | M3U </small></h2>
                </div>

                <div class="span12 text-center">
                    <?php if (!empty($model->file)): ?>
                        <?php
                        $this->widget('ext.EjwPlayer.EjwPlayer', array(
                            'width' => 470,
                            'height' => 370,
                            'title' => $model->name,
                            'controls' => 'true',
                            'autostart' => 'true',
                            'playlist' => array(
                                array(
                                    'image' => $baseUrl.'/images/media/video.gif',
                                    'sources' => array(
                                        array('file' => $model->link, 'height' => 720),
                                        array('file' => $model->link, 'height' => 270),
                                    )
                                ),
                            /* array(
                              'image' => 'https://eduk-videos.s3.amazonaws.com/sey/2012-09-29/js-speaker5-preview.jpg',
                              'sources' => array(
                              array('file' => '/videos/sample2-270.mp4', 'height' => 270),
                              array('file' => '/videos/sample2-720.mp4', 'height' => 720),
                              )
                              ),
                             */
                            ),
                        ));
                        ?>
                    <?php else: ?>
                        <img src="<?php echo $baseUrl; ?>/images/media/novideo.png"/>
                    <?php endif; ?>
                </div>
                &nbsp;
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
                            'accept' => 'FLV|SWF|F4V|MOV|MP4|MP3|M3U', // extensions ที่สามารถ upload ได้
                            'denied' => 'ต้องเป็นนามสกุล FLV, SWF, F4V, MOV, MP4 and MP3, M3U  เท่านั้น!', // คำที่ใช้เมื่อ extensions ของไฟล์ ไม่ถูกต้อง
                            'max' => 1, // สามารถอัพไฟล์ได้เท่าไร
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
                    <div class="span12" style=" margin-left: 0px;">
                        <div class="span4 text-right">
                            Name :
                        </div>
                        <div class="span8" style="word-break: break-all;">
                            <?php echo $form->textField($model, 'name'); ?>
                        </div>
                    </div>

                    <div class="span12" style=" margin-left: 0px;">
                        <div class="span4 text-right">
                            File Name :
                        </div>
                        <div class="span8" style="word-break: break-all;">
                            <?php echo $model->file; ?>
                        </div>
                    </div>

                    <div class="span12" style=" margin-left: 0px;">
                        <div class="span4 text-right">
                            Link :
                        </div>
                        <div class="span8" style="word-break: break-all;">
                            <?php echo $model->link; ?>
                        </div>
                    </div>

                    <div class="span12" style="border-bottom: 1px solid grey; margin-left: 0px;">
                        <div class="span4 text-right">
                            Gallery Name :
                        </div>

                        <div class="span8">
                            <?php if (Gallery::model()->getListGallery() == NULL): ?>
                                <span class="badge badge-important">NONE</span>
                            <?php else: ?>
                                <?php echo $form->dropDownList($model, 'id_gallery', Gallery::model()->getListGallery("2")); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="span12 text-center" style="margin-left: 0px; padding-top: 10px;">
                        <button type="submit" name="submit" class="btn btn-warning">
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