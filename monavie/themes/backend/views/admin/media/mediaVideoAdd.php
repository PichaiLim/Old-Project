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
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal'
            ),
        ));
        ?>

        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->labelEx($model, 'movie_name', array('class' => 'control-label')); ?>&nbsp; : &nbsp;
                <?php echo $form->textField($model, 'movie_name', array('class' => 'span8', 'placeholder' => "Input Type Video Name")); ?>
            </div>
        </div>
        &nbsp;
        <div class="row-fluid">
            <div class="span12">
                <div class="span8 text-center">
                    <?php
                    if (empty($model->movie_link)) {
                        echo CHtml::image(Yii::app()->baseUrl . '/images/media/video.gif');
                    } else {
                        echo $model->movie_link;
                    }
                    ?>
                </div>

                <div class="span4">
                    <div class="row-fluid">
                        <div class="span12 control-group">
                            <?php echo $form->labelEx($model, 'movie_link', array('class' => '')); ?>
                            <?php echo $form->textField($model, 'movie_link', array('class' => 'input-large', 'placeholder' => "www.youtube.com/watch?v=Xq8ng0rj7Dw")); ?>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <?php echo CHtml::label('Gallery', NULL); ?>
                            <?php if (Gallery::model()->getListGallery() == NULL): ?>
                                <span class="badge badge-important">NONE</span>
                            <?php else: ?>
                                <?php echo $form->dropDownList($model, 'id_gallery', Gallery::model()->getListGallery("2")); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    &nbsp;
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-success')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>