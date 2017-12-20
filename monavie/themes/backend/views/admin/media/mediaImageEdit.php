<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
$part = "/images/media/";
$noImage = 'no_images7.gif';
?>
<div class="row-fluid">
    <h1><?php echo $title_header; ?></h1>
    <hr/>
    <div class="span12" style="margin: 0px;">
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

        <div class="span7 text-center" style="margin-left: 0px;">
            <?php if (empty($model->file)): ?>
                <img data-src="holder.js/300x200" src='<?php echo $baseUrl . $part . $noImage; ?>' class="img-polaroid"/>
            <?php else: ?>
                <img data-src="holder.js/300x200" src='<?php echo $baseUrl . $part . $model->file; ?>' class="img-polaroid"/>  
            <?php endif; ?>
            &nbsp;
            <?php echo $form->fileField($model, 'file'); ?>
        </div>

        <div class="span5 box-shadow" style="padding-top: 10px; padding-bottom: 10px;">
            <div class="span12" style=" margin-left: 0px;">
                <div class="span4 text-right">
                    Name :
                </div>
                <div class="span8" style="word-break: break-all;">
                    <?php echo $form->textField($model, 'name'); ?>
                </div>
            </div>
            
            <div class="span12">
                <div class="span4 text-right">
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
            <div class="sapn12">
                <div class="span4 text-right">
                    <?php echo $form->labelEx($model, 'link' . " : "); ?>
                </div>
                <div class="span8" style="word-break: break-all;">
                    <?php echo $model->link; ?>
                </div>
            </div>
            &nbsp;
            <div class="span12" style="margin-left: 0px;">
                <div class="span4 text-right">
                    <?php echo $form->labelEx($model, 'date' . ' : '); ?>
                </div>
                <div class="span8">
                    <?php echo $model->date; ?>
                </div>
            </div>
            &nbsp;
            <div class="span12 text-center">
                <?php echo $form->hiddenField($model, 'id'); ?>
                <button type="submit" name="submti" class="btn btn-warning">
                    <i class="icon-check icon-white"></i>
                    Edit
                </button>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>